<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at'
    ];
    public function file()
    {
        return $this->hasOne(File::class);
    }
    public function assignFile(File $file)
    {
        $file->task_id = $this->id;
        $file->save();
    }
    public function addTags($tags)
    {
        $this->tags()->saveMany($tags);
    }
    public function addTag($tag)
    {
        $this->tags()->save($tag);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function assignUser(User $user)
    {
        $this->user()->associate($user);
        $this->save();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function toggleCompleted()
    {
        $this->completed= !$this->completed;
        $this->save();
    }
    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'completed' => (boolean) $this->completed,
            'user_id' => $this->user_id,
            'user_name' => optional($this->user)->name,
            'user_email' => optional($this->user)->email,
            'user' => $this->user,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'created_at_formated'=>$this->created_at_formated,
            'updated_at_formated'=>$this->updated_at_formated,
            'updated_at_human'=>$this->updated_at_human,
            'created_at_human'=>$this->created_at_human,
            'created_at_timestamp'=>$this->created_at_timestamp,
            'updated_at_timestamp'=>$this->updated_at_timestamp,

        ];
    }
}
