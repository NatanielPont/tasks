<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTags;
use App\Http\Requests\StoreTasks;
use App\Tag;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    //parametres=dependencia
    public function show(Request $request, Tag $tag)
    {
//        dd('hola');
        $tag=Tag::orderBy('created_at','desc')->get();

        return $tag;
        
        
    }

    public function destroy(Request $request, Tag $tag)
    {
        $tag->delete();

    }

    public function store(StoreTags $request)
    {
//        //opcio acceptable
//        $request->validate([
//            'name'=>'required'
//        ]);
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();
        return $tag->map();

    }
    public function index()
    {

    }public function update(StoreTags $request,Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
        return $tag->map();
//        $tag->name = $request->name;
//        $tag->save();
//        return $tag;
////        $tag=Tag::findOrFail($request->id);
//        $tag->fresh();
////        return view('tag_edit',compact('tag'));
//        return $tag;

    }
}
