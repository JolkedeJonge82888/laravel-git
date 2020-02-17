@extends('layouts.app')

@section('content')
    @isset($team)
        <div class="image-flip" style="padding: 20px; max-width: 9px%; margin: auto 0;">
            <div class="mainflip">
                <div class="frontside">
                    <div class="card">
                        <h2 class="card-header text-center">{{ $team->name }}</h2>
                        <div class="card-body" style="width: 90%; margin: auto;">
                            @foreach($members as $member)
                                <p class="card-text">{{ $member->name }}</p>
                            @endforeach
                        </div>
                        @docent
                            <a href="{{ route('opdracht.create') }}" class="btn btn-primary">Add member</a>
                        @enddocent
                    </div>
                </div>
            </div>
        </div>
    @endisset
@endsection
