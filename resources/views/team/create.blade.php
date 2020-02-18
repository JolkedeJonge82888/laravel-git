@extends('layouts.app')

@section('content')
    <div class="card uper">
        <div class="card-header">
            Add team
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('team.store') }}">
                <div class="form-group centered">
                    @csrf
                    <label class="" for="name">Team Name:</label>
                    <input type="text" class="form-control teamName" name="team_name" placeholder="Team Name..."/>
                    <br>
                    @if ($errors->has('team_name'))
                        <div class="alert alert-danger" style="padding: 2px !important; height: 30px;">
                            <ul>
                                @if ($errors->has('team_name'))
                                    <li>{{ $errors->first('team_name') }}</li>
                                @endif
                            </ul>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Add Team</button>
                </div>

            </form>
        </div>
    </div>
@endsection
