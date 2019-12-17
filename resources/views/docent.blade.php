@extends('layouts.app')
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
                                        @foreach($gesprek->TeamGesprek as $gesprek1)
                                            <p class="card-text">Interview with: {{ $gesprek1->name }}</p>
                                        @endforeach
                                        <form action="" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-check">Interview Done</i></button>
                                        </form>
                                        <a href="" class="btn btn-primary btn-sm">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    @endisset
@endsection
