
@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit Opdracht
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
                    <label class="@if($errors->has('opdracht_title')) text-danger @endif" for=" name">Opdracht Title:</label>
                    <input type="text" class="form-control @if($errors->has('opdracht_title')) text-danger border border-danger @endif" name="opdracht_title" value="{{ $opdracht->title }}" />
                </div>
                <div class="form-group">
                    <label class="@if($errors->has('opdracht_description')) text-danger @endif" for="price">Opdracht Description:</label>
                    <textarea class="form-control @if($errors->has('opdracht_description')) text-danger border border-danger @endif" rows="5" name="opdracht_description">{{ $opdracht->description->text }}</textarea>
                </div>
                <div class="form-group">
                    <label class="@if($errors->has('opdracht_startdate')) text-danger @endif" for="quantity">Opdracht Start Date:</label>
                    <input type="date" class="form-control @if($errors->has('opdracht_startdate')) text-danger border border-danger @endif" placeholder="yyyy-mm-dd" name="opdracht_startdate" value="{{ $opdracht->start_date }}"/>
                </div>

                <div class="form-group">
                    <label class="@if($errors->has('opdracht_enddate')) text-danger @endif" for="quantity">Opdracht Start Date:</label>
                    <input type="date" class="form-control @if($errors->has('opdracht_enddate')) text-danger border border-danger @endif" placeholder="yyyy-mm-dd" name="opdracht_enddate" value="{{ $opdracht->end_date }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
