@extends('layouts.app')
@section('content')
    <div class="card uper">
        <div class="card-header">
            Add members
        </div>
        @isset($team)
            <div class="card-body" style="">
                <form method="POST" action="{{ route('addMember', $team->id) }}">
                    @csrf
                    @method('POST')
                    <div class="form-group centered">
                        @isset($users)
                            <select multiple name='user[]'>
                                <option class="option" value="" disabled selected>Choose your user(s)</option>
                                @foreach($users as $user)
                                    <option class="option" value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        @endisset
                        @if ($errors->has('user'))
                            <div class="alert alert-danger" style="padding: 2px !important; height: 30px;">
                                <ul>
                                    @if ($errors->has('user-1'))
                                        <li>{{ $errors->first('user-1') }}</li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Add member(s) to team</button>
                    </div>
                </form>
            </div>
        @endisset
    </div>
@endsection
