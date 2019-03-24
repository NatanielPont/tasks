@extends('layouts.app')
@section('title')
    Tasques
@endsection
@section('content')
    <show-task :task="{{$task}}" :tags="{{$tags}}"></show-task>
@endsection
