@extends('layouts.app')
@php
//toDo Remove this and Fix title
@endphp
@section('content')
    @isset($gespreken)
        @foreach($gespreken as $gesprek)
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">Assignment: {{ $gesprek->title }}</h4>
                                        <p class="card-text">Interview with: {{ $gesprek->name }}</p>
                                        <a href="" class="btn btn-primary btn-sm"><i class="fa fa-check"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    @endisset
@endsection
