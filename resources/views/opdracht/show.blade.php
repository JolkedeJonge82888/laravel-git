@extends('layouts.app')

@section('content')

        <div class="image-flip"  style="padding: 20px; max-width: 9px%; margin: auto 0;">
            <div class="mainflip">
                <div class="frontside">
                    <div class="card">
                        <h2 class="card-header text-center">{{ $opdracht->title }}</h2>
                        <div class="card-body" style="width: 90%; margin: auto;">

                            <p class="card-text">{{-- $opdracht->description->text --}} <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores commodi distinctio eos esse iste itaque quaerat, quia quod sit. Doloribus eaque non odit quaerat quam quidem quis, sapiente totam? Doloremque?</span></p>
                            <p class="card-text underlined" style="width:200px;">Start date: {{ $opdracht->start_date }}</p>
                            <p class="card-text underlined" style="width:200px;">End date: {{ $opdracht->end_date }}</p>
                            <p class="card-text">Opdrachtgever: {{ $klant }}</p>
                            @if(!auth()->user()->isDocent())<a href="#" class="btn btn-primary">I Want this Project</a>@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
