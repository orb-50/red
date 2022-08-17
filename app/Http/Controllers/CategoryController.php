<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ticket;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::all();
        return view('category',compact('categories'));
    }

    public function store(Request $request){
        $category=Category::create([
            "category"=>"入力してください",
        ]);
        return redirect()->route('category.index');
    }

    public function update(Request $request){
        foreach($request->category as $category){
            $key=array_keys($request->category, $category);
            $cate = Category::find($key[0]);
            $cate->category = $request->category[$key[0]];
            $cate->save();
        }


        return redirect()->route('category.index');
    }

    public function delete($id){
        $i=Category::findOrFail($id);
        $i->delete();
        Ticket::where("category_id",$id)->delete();
        return redirect()->route('category.index');
    }
}
