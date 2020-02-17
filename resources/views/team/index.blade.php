@extends('layouts.app')

@section('content')

    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
    </div>
    <div class="container">
        @docent
            <a href="{{ route('team.create') }}" class="btn btn-primary">Create Team</a>
        @enddocent
    </div>

    <div style="display: flex" class="row statistic">
    @foreach ($teams as $team)

        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="image-flip">
                <div class="mainflip">
                    <div class="frontside">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ $team->name }}</h4>
                                <p class="card-text">Points: {{ $team->point }}</p>
                                <a href="" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    </div>
@endsection
