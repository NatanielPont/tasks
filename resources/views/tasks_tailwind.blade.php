@extends('layouts.app')
{{--<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">--}}
@section('content')
   TASQUES TAILWIND
   <tasks :tasks="{{$tasks}}">

   </tasks>
    @endsection