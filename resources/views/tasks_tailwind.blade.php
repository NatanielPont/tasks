@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
{{--<link href="{{ ('css/app.css') }}" rel="stylesheet">--}}
@section('content')
   <taskstailwind :tasks="{{$tasks}}">

   </taskstailwind>
    @endsection