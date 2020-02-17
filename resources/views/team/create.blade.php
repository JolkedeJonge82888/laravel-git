@extends('layouts.app')

@section('content')
    <div class="card uper">
        <div class="card-header">
            Add team
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('team.store') }}">
                <div class="form-group">
                    @csrf
                    <label class="" for="name">Team Name:</label>
                    <input type="text" class="form-control teamName" name="team_title" value="Team Name"/>
                    <br>
                </div>
                <button type="submit" class="btn btn-primary">Add Team</button>
            </form>
        </div>
    </div>
@endsection
