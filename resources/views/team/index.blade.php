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
                                <a href="{{route('team.show', $team->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a><br>
                                @docent
                                    <a href="{{ route('team.edit',$team->id)}}" class="btn btn-nfr btn-primary">Edit</a>
                                    <form action="{{ route('team.destroy', $team->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-nfr btn-danger" type="submit">Delete</button>
                                    </form>
                                @enddocent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    </div>
@endsection
