@extends('layouts.app')

@section('content')
{{--    @foreach ($opdrachten as $opdracht)--}}
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="image-flip">
                <div class="mainflip">
                    <div class="frontside">
                        <div class="card">
                            <div class="card-body text-center">
                                <p><img class=" img-fluid" src="" alt="card image"></p>
                                <h4 class="card-title">Test{{-- $opdracht->title --}}</h4>
                                <p class="card-text">Meer Test{{-- $opdracht->describtion --}}</p>
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--    @endforeach--}}
@endsection
