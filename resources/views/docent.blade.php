@extends('layouts.app')
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>

    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif
    </div>
    @if(!isset($gespreken) || $gespreken == '[]')
        <div style="position: relative; align-items: center;display: flex; justify-content: center; height: 80vh;">
            <div style="border-right: 2px solid; font-size: 26px; padding: 0 15px 0 15px; text-align: center;">
                No Interview</div>

            <div class="message" style="padding: 10px; font-size: 18px; text-align: center;">
                No Teams asked for an interview!</div>
        </div>
    @endif
    @isset($gespreken)

        <div style="display: flex" class="row statistic">
        @foreach($gespreken as $gesprek)
            @foreach($gesprek as $gesprek1)

                @if(\App\TeamOpdracht::where('opdracht_id', '=', $gesprek1->pivot->pivotParent->id) != null)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h4 class="card-title">
                                                Assignment: {{ $gesprek1->pivot->pivotParent->title }}</h4>

                                            @if($gesprek1->pivot->check != 1)
                                                <p class="card-text">Interview with: {{ $gesprek1->name }}</p>
                                                <form action="{{ route('gesprek/accept', $gesprek1->pivot->id) }}"
                                                      method="GET">
                                                    @csrf
                                                    @method('GET')
                                                    <button class="btn btn-danger" type="submit"><i class="fa fa-check">
                                                            Interview Done </i></button>
                                                </form>
                                            @else
                                                <p class="card-text">Interview done with: <b style="color: red;">{{ $gesprek1->name }}</b></p>
                                                @if(\App\Offerte::where('opdracht_id', '=', $gesprek1->pivot->pivotParent->id)->where('team_id', '=', $gesprek1->id)->first() != null )
                                                    <form method="POST" action="{{ route('team/select') }}">
                                                        @method('POST')
                                                        <div class="form-group">
                                                            @csrf
                                                            <a href="files/{{ \App\Offerte::where('opdracht_id', '=', $gesprek1->pivot->pivotParent->id)->where('team_id', '=', $gesprek1->id)->pluck('name')->first() }}">Download
                                                                Offerte</a>
                                                            <br>
                                                            <br>
                                                            <input type="hidden" value="{{$gesprek1->id}}"
                                                                   name="team_id"/>
                                                            <input type="hidden"
                                                                   value="{{$gesprek1->pivot->pivotParent->id}}"
                                                                   name="opdracht_id"/>
                                                            <label class="@if($errors->has('coin')) text-danger @endif"
                                                                   for="name">* Assignments Coins:</label>
                                                            <input type="text"
                                                                   class="form-control @if($errors->has('coin')) text-danger border border-danger @endif"
                                                                   name="coin" placeholder="Max Coins..." value="{{ old('coin') }}"/>
                                                            <br>
                                                            @if ($errors->has('coin'))
                                                                <div class="alert alert-danger"
                                                                     style="padding: 2px !important; height: 30px;">
                                                                    <ul>
                                                                        @if ($errors->has('coin'))
                                                                            <li>{{ $errors->first('coin') }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="form-group">

                                                            <label for="quantity"
                                                                   class="@if($errors->has('startdate')) text-danger @endif">*
                                                                Assignment Start Date:</label>
                                                            <input type="date"
                                                                   class="form-control @if($errors->has('startdate')) text-danger border border-danger @endif"
                                                                   placeholder="yyyy-mm-dd" name="startdate"
                                                                   value="{{ old('startdate') }}"/>
                                                            <br>
                                                            @if ($errors->has('startdate'))
                                                                <div class="alert alert-danger"
                                                                     style="padding: 2px !important; height: 30px;">
                                                                    <ul>
                                                                        @if ($errors->has('startdate'))
                                                                            <li>{{ $errors->first('startdate') }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">

                                                            <label for="quantity"
                                                                   class="@if($errors->has('enddate')) text-danger @endif">*
                                                                Assignment Close Date:</label>
                                                            <input type="date"
                                                                   class="form-control @if($errors->has('enddate')) text-danger border border-danger @endif"
                                                                   placeholder="yyyy-mm-dd" name="enddate"
                                                                   value="{{ old('enddate') }}"/>
                                                            <br>
                                                            @if ($errors->has('enddate'))
                                                                <div class="alert alert-danger"
                                                                     style="padding: 2px !important; height: 30px;">
                                                                    <ul>
                                                                        @if ($errors->has('enddate'))
                                                                            <li>{{ $errors->first('enddate') }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Add team to
                                                            assignment
                                                        </button>
                                                    </form>
                                        </div>
                                    </div>
                                    @else
                                        <p class="card-text">Wait for Offerte!</p>
                                    @endif

                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
        </div>
    @endisset


@endsection
