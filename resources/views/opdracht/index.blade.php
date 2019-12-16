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
            </div><br />
        @endif
    </div>
    @docent
    <div class="container">
        <a href="{{ route('opdracht.create') }}" class="btn btn-primary">Create Assignment</a>
    </div>
    <br>
    @enddocent
    <div class="row">
        @isset($opdrachts)
            @foreach($opdrachts as $opdracht)

                @if(!auth()->user()->hasOpdracht($opdracht->id) || !auth()->user()->isDocent())
                    @if($opdracht->start_date <= Today() && $opdracht->end_date >= Today())
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="image-flip">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <h4 class="card-title">{{ $opdracht->title }} - Assignment</h4>
                                                <p class="card-text">{{ $opdracht->description->text }}</p>
                                                <p class="card-text">{{ date('d-m-Y', strtotime($opdracht->start_date)) }}</p>
                                                <p class="card-text">{{ date('d-m-Y', strtotime($opdracht->end_date)) }}</p>
                                                @docent
                                                @if(auth()->user()->hasOpdracht($opdracht->id))
                                                    <a href="{{ route('opdracht.edit',$opdracht->id)}}" class="btn btn-primary">Edit</a>
                                                    <form action="{{ route('opdracht.destroy', $opdracht->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                    </form>
                                                @endif
                                                @enddocent
                                                <a href="{{ route('opdracht.show', $opdracht->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @docent
                    @if(auth()->user()->hasOpdracht($opdracht->id))
                        @if($opdracht->start_date <= Today() && $opdracht->end_date >= Today())
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="image-flip">
                                    <div class="mainflip">
                                        <div class="frontside">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h4 class="card-title">{{ $opdracht->title }} - Open</h4>
                                                    <p class="card-text">{{ $opdracht->description->text }}</p>
                                                    <p class="card-text">{{ date('d-m-Y', strtotime($opdracht->start_date)) }}</p>
                                                    <p class="card-text">{{ date('d-m-Y', strtotime($opdracht->end_date)) }}</p>
                                                    @docent
                                                    @if(auth()->user()->hasOpdracht($opdracht->id))
                                                        <a href="{{ route('opdracht.edit',$opdracht->id)}}" class="btn btn-primary">Edit</a>
                                                        <form action="{{ route('opdracht.destroy', $opdracht->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">Delete</button>
                                                        </form>
                                                    @endif
                                                    @enddocent
                                                    <a href="{{ route('opdracht.show', $opdracht->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="image-flip">
                                    <div class="mainflip">
                                        <div class="frontside">
                                            <div class="card" style="background-color:rgba(248,250,252,0.3); color: rgba(0,0,0,0.5);">
                                                <div class="card-body text-center">
                                                    <h4 class="card-title" style="color: rgba(255,0,0,0.5) !important;">{{ $opdracht->title }} - Closed</h4>
                                                    <p class="card-text">{{ $opdracht->description->text }}</p>
                                                    <p class="card-text">{{ date('d-m-Y', strtotime($opdracht->start_date)) }}</p>
                                                    <p class="card-text">{{ date('d-m-Y', strtotime($opdracht->end_date)) }}</p>
                                                    @docent
                                                    @if(auth()->user()->hasOpdracht($opdracht->id))
                                                        <a href="{{ route('opdracht.edit',$opdracht->id)}}" class="btn btn-primary" style="background-color:rgba(248,250,252,0.3); color: rgba(0,0,0,0.5);">Edit</a>
                                                        <form action="{{ route('opdracht.destroy', $opdracht->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit" style="background-color:rgba(248,250,252,0.3); color: rgba(0,0,0,0.5);">Delete</button>
                                                        </form>
                                                    @endif
                                                    @enddocent


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @enddocent
            @endforeach

            <div class="fixed-bottom" style="margin-bottom: 50px;">
                <div class="container col-xs-12 col-sm-6 col-md-4">
                    {{ $opdrachts->render() }}
                </div>
            </div>
@endisset
    </div>
@endsection
