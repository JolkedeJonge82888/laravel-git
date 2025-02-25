@extends('layouts.app')

@section('content')
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif
    </div>
    <div class="image-flip" style="padding: 20px; max-width: 9px%; margin: auto 0;">
        <div class="mainflip">
            <div class="frontside">
                <div class="card">
                    <h2 class="card-header text-center">{{ $opdracht->title }}</h2>
                    <div class="card-body" style="width: 90%; margin: auto;">
                        @if(\App\Gesprek::where('opdracht_id', '=', $opdracht->id)->where('team_id', '=', \App\Users::find(Auth::user()->id)->Team->pluck('id')->first())->pluck('check')->first() == 0)
                            <p class="card-text">{{ $opdracht->description->text }}</p>
                            <p class="card-text underlined" style="width:200px;">Start
                                date: {{ date('d-m-Y', strtotime($opdracht->start_date)) }}</p>
                            <p class="card-text underlined" style="width:200px;">Close
                                date: {{ date('d-m-Y', strtotime($opdracht->end_date)) }}</p>
                            <p class="card-text">Opdrachtgever: {{ $klant }}</p>

                            @if(!auth()->user()->isDocent())
                                @if(!auth()->user()->hasGesprek($opdracht->id) && \App\TeamOpdracht::where('opdracht_id', '=', $opdracht->id)->where('team_id', '=', \App\Users::find(Auth::user()->id)->Team->pluck('id')->first())->count() != 1)
                                    <a href="{{ route('gesprek', $opdracht->id)}}" class="btn btn-primary btn-sm">Vraag
                                        klantgesprek</a>
                                @else
                                    @if(\App\TeamOpdracht::where('opdracht_id', '=', $opdracht->id)->where('team_id', '=', \App\Users::find(Auth::user()->id)->Team->pluck('id')->first())->count() == 1)
                                        <p class=" btn-primary ">Deze opdracht is active</p>
                                    @else
                                        <p class=" btn-primary ">Gesprek is aan gevraagt</p>
                                    @endif

                                @endif
                            @endif
                        @else
                            @if(!auth()->user()->isDocent())
                                @if(\App\Offerte::where('opdracht_id', '=', $opdracht->id)->where('team_id', '=', \App\Users::find(Auth::user()->id)->Team->pluck('id')->first())->count() < 1 )
                                    <div class="form-group">
                                        <form method="POST" action="{{ route('offerte') }}" enctype="multipart/form-data">
                                            @method('POST')
                                            @csrf

                                            <div class="form-group">
                                                <label class="@if($errors->has('offerte')) text-danger @endif"
                                                       for="quantity">Upload Offerte:</label>
                                                <input type="file"
                                                       class="form-control @if($errors->has('files')) text-danger border border-danger @endif"
                                                       name="offerte"/>
                                                @if ($errors->has('offerte'))
                                                    <div class="alert alert-danger"
                                                         style="padding: 2px !important; height: 30px;">
                                                        <ul>
                                                            @if ($errors->has('offerte'))
                                                                <li>{{ $errors->first('offerte') }}</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @endif
                                                <input type="hidden" class="form-control" name="team"
                                                       value="{{ \App\Users::find(Auth::user()->id)->Team->pluck('name')->first() }}"/>
                                                <input type="hidden" class="form-control" name="opdracht"
                                                       value="{{ $opdracht->title }}"/>
                                                <input type="hidden" class="form-control" name="teamID"
                                                       value="{{ \App\Users::find(Auth::user()->id)->Team->pluck('id')->first() }}"/>
                                                <input type="hidden" class="form-control" name="opdrachtID"
                                                       value="{{ $opdracht->id }}"/>
                                                <br>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </form>
                                    </div>
                                @else
                                    <p class="card-text underlined" style="width:200px;">Wait for your answer!</p>

                                    <div class="form-group">
                                        <form method="POST" action="{{ route('offerte') }}" enctype="multipart/form-data">
                                            @method('POST')
                                            @csrf

                                            <div class="form-group">
                                                <label class="@if($errors->has('offerte')) text-danger @endif"
                                                       for="quantity">Reupload Offerte:</label>
                                                <input type="file"
                                                       class="form-control @if($errors->has('files')) text-danger border border-danger @endif"
                                                       name="offerte"/>
                                                @if ($errors->has('offerte'))
                                                    <div class="alert alert-danger"
                                                         style="padding: 2px !important; height: 30px;">
                                                        <ul>
                                                            @if ($errors->has('offerte'))
                                                                <li>{{ $errors->first('offerte') }}</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @endif
                                                <input type="hidden" class="form-control" name="team"
                                                       value="{{ \App\Users::find(Auth::user()->id)->Team->pluck('name')->first() }}"/>
                                                <input type="hidden" class="form-control" name="opdracht"
                                                       value="{{ $opdracht->title }}"/>
                                                <input type="hidden" class="form-control" name="teamID"
                                                       value="{{ \App\Users::find(Auth::user()->id)->Team->pluck('id')->first() }}"/>
                                                <input type="hidden" class="form-control" name="opdrachtID"
                                                       value="{{ $opdracht->id }}"/>
                                                <br>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </form>
                                    </div>
                                @endif
                            @else
                                <p class="card-text">{{ $opdracht->description->text }}</p>
                                <p class="card-text underlined" style="width:200px;">Start
                                    date: {{ date('d-m-Y', strtotime($opdracht->start_date)) }}</p>
                                <p class="card-text underlined" style="width:200px;">Close
                                    date: {{ date('d-m-Y', strtotime($opdracht->end_date)) }}</p>
                                <p class="card-text">Opdrachtgever: {{ $klant }}</p>
                            @endif
                         @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
