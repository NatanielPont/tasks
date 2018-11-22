@extends('layouts.app')

@section('content')
   TASQUES VUE

   <tasks :tasks="{{$tasks}}">

   </tasks>
    @endsection