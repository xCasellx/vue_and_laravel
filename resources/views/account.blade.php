@extends('layouts.template')

@section('title') User @endsection


@section('content')
    <account user_id = "{{$id}}"/>
@endsection
