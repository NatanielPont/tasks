@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">

@section('content')
   <tasks :tasks="{{$tasks}}">

   </tasks>
    @endsection