@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Add Opdracht
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
            <form method="POST" action="{{ route('opdracht.store') }}">
                <div class="form-group">
                    @csrf
                    <label class="@if($errors->has('opdracht_title')) text-danger @endif" for="name">* Opdracht Title:</label>
                    <input type="text" class="form-control @if($errors->has('opdracht_title')) text-danger border border-danger @endif" name="opdracht_title" value="{{ old('opdracht_title') }}"/>
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @if ($errors->has('opdracht_title'))
                                    <li>{{ $error }}</li>
                                @endif
                            </ul>
                        </div><br />
                    @endif
                </div>
                <div class="form-group">
                    <label for="price" class="@if($errors->has('opdracht_description')) text-danger @endif">* Opdracht Description:</label>
                    <textarea class="form-control @if($errors->has('opdracht_description')) text-danger border border-danger @endif" rows="5" name="opdracht_description">{{ old('opdracht_description') }}</textarea>
{{--                @if ($errors->any())--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->has('opdracht_description') as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div><br />--}}
{{--                    @endif--}}
                </div>
                <div class="form-group">
{{--                    @if ($errors->any())--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->has('opdracht_startdate') as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div><br />--}}
{{--                    @endif--}}
                    <label for="quantity" class="@if($errors->has('opdracht_startdate')) text-danger @endif">* Opdracht Start Date:</label>
                    <input type="date" class="form-control @if($errors->has('opdracht_startdate')) text-danger border border-danger @endif" placeholder="yyyy-mm-dd" name="opdracht_startdate" value="{{ old('opdracht_startdate') }}"/>
                </div>
                <div class="form-group">
{{--                    @if ($errors->any())--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->has('opdracht_enddate') as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div><br />--}}
{{--                    @endif--}}
                    <label for="quantity" class="@if($errors->has('opdracht_enddate')) text-danger @endif">* Opdracht Close Date:</label>
                    <input type="date" class="form-control @if($errors->has('opdracht_enddate')) text-danger border border-danger @endif" placeholder="yyyy-mm-dd" name="opdracht_enddate" value="{{ old('opdracht_enddate') }}" />
                </div>
                <button type="submit" class="btn btn-primary">Add Opdracht</button>
            </form>
        </div>
    </div>
@endsection
