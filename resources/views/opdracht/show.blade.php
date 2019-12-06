@extends('layouts.app')

@section('content')

        <div class="image-flip">
            <div class="mainflip">
                <div class="frontside">
                    <div class="card">
                        <h2 class="card-header text-center">{{ $opdracht->title }}</h2>
                        <div class="card-body">

                            <p class="card-text ">{{ $opdracht->description->text }}</p>
                            <p class="card-text">Start date:{{ $opdracht->start_date }}</p>
                            <p class="card-text">End date: {{ $opdracht->end_date }}</p>
                            <p class="card-text">Opdrachtgever: {{ $klant }}</p>
                            @if(!auth()->user()->isDocent())<a href="#" class="btn btn-primary">I Want this Project</a>@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
