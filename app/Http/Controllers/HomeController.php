<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRequest;
use Illuminate\Pagination\LengthAwarePaginator;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    public function welcome()
    {  
        return view('layouts.welcome');
    }

    public function index()
    {  
        $categories=Category::all();
        return view('layouts.app', compact('categories'));
    }

    public function detail($id)
    {   
        
        $user=Auth::user();
        $t=Ticket::where("id",$id)->first();
        if (Gate::allows('user',$id)) {
            if($user->id==$t->user_id||$t->open==1){
                $ticket=Ticket::where("id",$id)->first();
                $comments=Comment::where("ticket_id",$id)->orderby("updated_at","desc")->get();
                return view('layouts.detail',compact("ticket","comments"));
            }
            else{
                abort(403);
            }
        }
        else if(Gate::allows('stuff',$id)) {
            if($user->id==$t->user_id||$t->open==1||$t->open==2){
                $ticket=Ticket::where("id",$id)->first();
                $comments=Comment::where("ticket_id",$id)->orderby("updated_at","desc")->get();
                return view('layouts.detail',compact("ticket","comments"));
            }
            else{
                abort(403);
            }
        }
        else if(Gate::allows('administrator',$id)) {
                $ticket=Ticket::where("id",$id)->first();
                $comments=Comment::where("ticket_id",$id)->orderby("updated_at","desc")->get();
                return view('layouts.detail',compact("ticket","comments"));   
        }
    }
    public function comment(Request $request,$ticket_id)
    {  
        $user=Auth::user();
        $comment = Comment::create(
            [   
                'user_id' => $user->id,
                'ticket_id' => $ticket_id,
                'comment' => $request->	comment,
                'pararent_id' => $request->pararent_id,
            ]
        );
        return redirect()->route('detail', ['id' => $ticket_id]);
    }
    
    public function commentDelete(Request $request,$comment)
    {  
        $c=Comment::where("id",$comment)->first();
        if($c->child->isEmpty()){
            $c->delete(); 
        }
        else{
            DB::transaction(function ()use($c) {
                $c->delete();
                foreach($c->child as $child){
                    $child->delete();
                }
            });
        }
        return redirect()->route('detail', ['id' => $request->ticket_id]);
    }

    public function store(StoreRequest $request)
    {   
        
        $ticket = Ticket::create(
            [
                'title' => $request->title,
                'sStartAt' => $request->sStartAt,
                'sFinishAt' => $request->sFinishAt,
                'startAt' => $request->startAt,
                'finishAt' => $request->finishAt,
                'category_id' => $request->category_id,
                'user_id' => auth()->id(),
                'open' => $request->open,
                'priority' => $request->priority,
                'status' => $request->status,
                'progress' => $request->progress,
                'work_hours' => $request->work_hours,
                'ticket_contents' => $request->ticket_contents,
            ]
        );
        return view('home', compact('ticket'));
    }
    public function list(Request $request)
    {   
        $user=Auth::user();
        if (Gate::allows('user',$request)) {
            $ticket=Ticket::select("tickets.*","A.name as status_name","B.name as open_name","C.name as priority_name")
                            ->leftjoin("codes as A","tickets.status","=","A.id")
                            ->leftjoin("codes as B","tickets.open","=","B.id")
                            ->leftjoin("codes as C","tickets.priority","=","C.id")
                            ->where("user_id",$user->id)->orWhere("open","1")->get();
                            // LengthAwarePaginatorの作成
            $tickets = new LengthAwarePaginator(
                $ticket->forPage($request->page, 7), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
                $ticket->count(), // 総件数
                7,
                null, // 現在のページ(ページャーの色がActiveになる)
                ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
                );
        }
            
        else if (Gate::allows('stuff',$request)) {
            $ticket=Ticket::where("open","1")->orWhere("open","2")->orWhere("user_id",$user->id)->get();
            $tickets = new LengthAwarePaginator(
                $ticket->forPage($request->page, 7), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
                $ticket->count(), // 総件数
                7,
                null, // 現在のページ(ページャーの色がActiveになる)
                ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
                );
        }
        else if (Gate::allows('administrator',$request)) {
            $ticket=Ticket::get();
            $tickets = new LengthAwarePaginator(
                $ticket->forPage($request->page, 7), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
                $ticket->count(), // 総件数
                7,
                null, // 現在のページ(ページャーの色がActiveになる)
                ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
                );
        }
        $categories=Category::all();
        return view('layouts.ticket', compact('tickets','user','categories'));
    }
    public function updateMenu($id){
        $user=Auth::user();
        $ticket=Ticket::where("id",$id)->first();
        $categories=Category::all();
        $this->authorize('update',$ticket);
        return view("layouts.update",compact('user','ticket','categories'));
    }
    public function update(StoreRequest $request,Ticket $ticket){
        
        $param=[
            "title"=>$request->title,
            "sStartAt"=>$request->sStartAt,
            "sFinishAt"=>$request->sFinishAt,
            "startAt"=>$request->startAt,
            "finishAt"=>$request->finishAt,
            "category_id"=>$request->category_id,
            "open"=>$request->open,
            "progress"=>$request->progress,
            "status"=>$request->status,
            "priority"=>$request->priority,
            "work_hours"=>$request->work_hours,
            "ticket_contents"=>$request->ticket_contents,
        ];

        $up=Ticket::where("id",$request->id)->update($param);
        return redirect()->route('detail', ['id' => $request->id]);
    }

    public function ticketdelete($id){
        Auth::user()->id;
        $ticket=Ticket::where("id",$id)->first();
        if($ticket->user_id==Auth::user()->id||Auth::user()->role==1){
            DB::transaction(function ()use($id) {
                DB::table('tickets')->where("id",$id)->delete();
                DB::table('comments')->where("ticket_id",$id)->delete();
            });
            return redirect("ticketList");
        }
        else{
            abort(403);
        }
    }

    public function search(request $request){
        $user=Auth::user();
        if (Gate::allows('user',$request)) {
            $ticket=Ticket::select("tickets.*","A.name as status_name","B.name as open_name","C.name as priority_name")
                            ->leftjoin("codes as A","tickets.status","=","A.id")
                            ->leftjoin("codes as B","tickets.open","=","B.id")
                            ->leftjoin("codes as C","tickets.priority","=","C.id")
                            ->where("user_id",$user->id)->orWhere("open","1")->title($request->title)
                            ->username($request->name)->category($request->category)->open($request->open)
                            ->status($request->status)->priority($request->priority)->get();
                            // LengthAwarePaginatorの作成
            $tickets = new LengthAwarePaginator(
                $ticket->forPage($request->page, 7), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
                $ticket->count(), // 総件数
                7,
                null, // 現在のページ(ページャーの色がActiveになる)
                ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
                );
        }
        else if (Gate::allows('stuff',$request)) {
            $ticket=Ticket::where("open","1")->orWhere("open","2")->orWhere("user_id",$user->id)
            ->title($request->title)->username($request->name)->category($request->category)
            ->open($request->open)->status($request->status)->priority($request->priority)->get();
            $tickets = new LengthAwarePaginator(
                $ticket->forPage($request->page, 7), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
                $ticket->count(), // 総件数
                7,
                null, // 現在のページ(ページャーの色がActiveになる)
                ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
                );
        }
        else if (Gate::allows('administrator',$request)) {
            $ticket=Ticket::title($request->title)->username($request->name)->category($request->category)
            ->open($request->open)->status($request->status)->priority($request->priority)->get();
            $tickets = new LengthAwarePaginator(
                $ticket->forPage($request->page, 7), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
                $ticket->count(), // 総件数
                7,
                null, // 現在のページ(ページャーの色がActiveになる)
                ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
                );
        }



        $categories=Category::all();
        $para=$request->input();
        return view('layouts.ticket', compact('tickets','user','categories','para'));
    }
}
