<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
//    protected  $fillable=['name','completed'];
    protected $guarded=[];

//    public static function create()
//    {
//
//    }

    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'completed' => $this->completed,
            'user_id' => $this->user_id,
            'user_name' => optional($this->user)->name,
            'user_email' => optional($this->user)->email,
            'user' => $this->user
//            'tags' => $this->tags
//            'file' => $this->file
        ];
    }
}
