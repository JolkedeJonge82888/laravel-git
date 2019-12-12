@extends('layouts.app')

@section('content')
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
    </div>
        <div class="image-flip"  style="padding: 20px; max-width: 9px%; margin: auto 0;">
            <div class="mainflip">
                <div class="frontside">
                    <div class="card">
                        <h2 class="card-header text-center">{{ $opdracht->title }}</h2>
                        <div class="card-body" style="width: 90%; margin: auto;">

                            <p class="card-text">{{ $opdracht->description->text }}</p>
                            <p class="card-text underlined" style="width:200px;">Start date: {{ date('d-m-Y', strtotime($opdracht->start_date)) }}</p>
                            <p class="card-text underlined" style="width:200px;">Close date: {{ date('d-m-Y', strtotime($opdracht->end_date)) }}</p>
                            <p class="card-text">Opdrachtgever: {{ $klant }}</p>

                            @if(!auth()->user()->isDocent())
                                @if(!auth()->user()->hasGesprek($opdracht->id))
                                    <a href="{{ route('gesprek', $opdracht->id)}}" class="btn btn-primary btn-sm">Vraag klantgesprek</a>
                                @else
                                    <p class=" btn-primary ">Gesprek is aan gevraagt</p>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
