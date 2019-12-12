@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Add Assignment
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('opdracht.store') }}">
                <div class="form-group">
                    @csrf
                    <label class="@if($errors->has('opdracht_title')) text-danger @endif" for="name">* Assignment Title:</label>
                    <input type="text" class="form-control @if($errors->has('opdracht_title')) text-danger border border-danger @endif" name="opdracht_title" value="{{ old('opdracht_title') }}"/>
                    <br>
                @if ($errors->has('opdracht_title'))
                        <div class="alert alert-danger" style="padding: 2px !important; height: 30px;">
                            <ul>
                                @if ($errors->has('opdracht_title'))
                                    <li>{{ $errors->first('opdracht_title') }}</li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="price" class="@if($errors->has('opdracht_description')) text-danger @endif">* Assignment Description:</label>
                    <textarea class="form-control @if($errors->has('opdracht_description')) text-danger border border-danger @endif" rows="5" name="opdracht_description">{{ old('opdracht_description') }}</textarea>
                    <br>
                    @if ($errors->has('opdracht_description'))
                        <div class="alert alert-danger" style="padding: 2px !important; height: 30px;">
                            <ul>
                                @if ($errors->has('opdracht_description'))
                                    <li>{{ $errors->first('opdracht_description') }}</li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="form-group">

                    <label for="quantity" class="@if($errors->has('opdracht_startdate')) text-danger @endif">* Assignment Start Date:</label>
                    <input type="date" class="form-control @if($errors->has('opdracht_startdate')) text-danger border border-danger @endif" placeholder="yyyy-mm-dd" name="opdracht_startdate" value="{{ old('opdracht_startdate') }}"/>
                    <br>
                    @if ($errors->has('opdracht_startdate'))
                        <div class="alert alert-danger" style="padding: 2px !important; height: 30px;">
                            <ul>
                                @if ($errors->has('opdracht_startdate'))
                                    <li>{{ $errors->first('opdracht_startdate') }}</li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="form-group">

                    <label for="quantity" class="@if($errors->has('opdracht_enddate')) text-danger @endif">* Assignment Close Date:</label>
                    <input type="date" class="form-control @if($errors->has('opdracht_enddate')) text-danger border border-danger @endif" placeholder="yyyy-mm-dd" name="opdracht_enddate" value="{{ old('opdracht_enddate') }}" />
                    <br>
                    @if ($errors->has('opdracht_enddate'))
                        <div class="alert alert-danger" style="padding: 2px !important; height: 30px;">
                            <ul>
                                @if ($errors->has('opdracht_enddate'))
                                    <li>{{ $errors->first('opdracht_enddate') }}</li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Add Assignment</button>
            </form>
        </div>
    </div>
@endsection
