<?php

namespace App\Models;
use App\Models\ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [
        "id"
    ];

    public function child()
    {
        return $this->hasMany(Comment::class,'pararent_id');
    }

    public function children()
    {
        return $this->belongsTo(Comment::class,'pararent_id');
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
