
@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit Assignment
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="POST" action="{{route('opdracht.update', $opdracht->id) }}">
                @method('PATCH')
                @csrf

                <div class="form-group">
                    <label class="@if($errors->has('opdracht_title')) text-danger @endif" for=" name">Assignment Title:</label>
                    <input type="text" class="form-control @if($errors->has('opdracht_title')) text-danger border border-danger @endif" name="opdracht_title" value="{{ $opdracht->title }}" />
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
                    <label class="@if($errors->has('opdracht_description')) text-danger @endif" for="price">Assignment Description:</label>
                    <textarea class="form-control @if($errors->has('opdracht_description')) text-danger border border-danger @endif" rows="5" name="opdracht_description">{{ $opdracht->description->text }}</textarea>
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
                    <label class="@if($errors->has('opdracht_startdate')) text-danger @endif" for="quantity">Assignment Start Date:</label>
                    <input type="date" class="form-control @if($errors->has('opdracht_startdate')) text-danger border border-danger @endif" placeholder="yyyy-mm-dd" name="opdracht_startdate" value="{{ $opdracht->start_date }}"/>
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
                    <label class="@if($errors->has('opdracht_enddate')) text-danger @endif" for="quantity">Assignment Closing Date:</label>
                    <input type="date" class="form-control @if($errors->has('opdracht_enddate')) text-danger border border-danger @endif" placeholder="yyyy-mm-dd" name="opdracht_enddate" value="{{ $opdracht->end_date }}"/>
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
                <button type="submit" class="btn btn-nfr btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
