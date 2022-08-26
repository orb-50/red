<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory; 

   protected $fillable = [
        'title',
        'sStartAt',
        'sFinishAt',
        'startAt',
        'finishAt',
        'user_id',
        'category_id',
        'open',
        "ticket_contents",
        'status',
        'progress',
        'priority',
        'work_hours',
    ];

    protected $casts = [
        'open' => 'integer',
        'status' => 'integer',
        'priority' => 'integer',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }


    public function scopeTitle($query,$keyword){
        
        if(!is_null($keyword))
        {
           //全角スペースを半角に
           $spaceConvert = mb_convert_kana($keyword,'s');
            
           //空白で区切る
           $keywords = preg_split('/[\s]+/', $spaceConvert,-1,PREG_SPLIT_NO_EMPTY);

           //単語をループで回す
           foreach($keywords as $word)
           {
               $query->where('tickets.title','like','%'.$word.'%');
           }
           return $query;  

        } else {
            return;
        }
    }

    public function scopeUsername($query,$keyword){
        if(!is_null($keyword))
        {
           //全角スペースを半角に
           $spaceConvert = mb_convert_kana($keyword,'s');
            
           //空白で区切る
           $keywords = preg_split('/[\s]+/', $spaceConvert,-1,PREG_SPLIT_NO_EMPTY);

           
           //単語をループで回す
           foreach($keywords as $word)
           {
               $query->whereHas('user',function(Builder $query)use($word){
                $query->where('name','like','%'.$word.'%');
               });
           }
           
           return $query;  

        } else {
            return;
        }
    }

    public function scopeCategory($query,$categoryId){
        if($categoryId!='0'){
            return $query->where('category_id',$categoryId);
        }
        else{
            return;
        }
    }

    public function scopeOpen($query,$openId){
        if($openId!='0'){
            return $query->where('open',$openId);
        }
        else{
            return;
        }
    }

    public function scopeStatus($query,$statusId){
        if($statusId!='0'){
            return $query->where('status',$statusId);
        }
        else{
            return;
        }
    }

    public function scopePriority($query,$priorityId){
        if($priorityId!='0'){
            return $query->where('priority',$priorityId);
        }
        else{
            return;
        }
    }

    public function scopeSort($query,$sortName){
        
        if($sortName=='old'){
            return $query->orderBy("updated_at","asc");
        }
        else if($sortName=='young'){
            return $query->orderBy("updated_at","desc");
        }
    }
}
