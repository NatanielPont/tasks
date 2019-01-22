<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagsIndex;
use App\Http\Requests\TagsStore;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagsIndex $request)
    {
//        return map_collection(Tag::orderBy('created_at')->get());

        $tags = map_collection(Tag::orderBy('created_at', 'desc')->get());
        $uri = '/api/v1/tags';
        return view('tags', compact('tags','uri'));
//        if (Auth::user()->can('tags.manage')){
//            $tags = map_collection(Tag::orderBy('created_at','desc')->get());
//            $uri = '/api/v1/tags';
//        }else{
//            $tags = map_collection($request->user()->tasks);
//            $uri = '/api/v1/user/tags';
//        }
////        dd($tags);
//        $users = map_collection(User::all());
////        dd('hola');
//        return view('tags',compact('tags','users','uri'));
    }
//

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
