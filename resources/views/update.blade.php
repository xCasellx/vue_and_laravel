@extends('layouts.template')


@section('title') Edit profile @endsection
@section('content')
<div class="container">
    <div  class="row mt-2 justify-content-center">
        <div class="col-md-8 ">
            <user-update/>
        </div>
        <div class="col-md-8 mt-3">
            <update-password/>
        </div>
        <div class="col-md-8 mt-3">
            <update-image/>
        </div>
    </div>
</div>
@endsection
