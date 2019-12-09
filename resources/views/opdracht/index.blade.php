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
    <div class="row">
            @foreach($opdrachts as $opdracht)
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ $opdracht->title }}</h4>
                                        <p class="card-text">{{ $opdracht->description->text }}</p>
                                        <p class="card-text">{{ $opdracht->start_date }}</p>
                                        <p class="card-text">{{ $opdracht->end_date }}</p>
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
            @endforeach
    </div>
@endsection
