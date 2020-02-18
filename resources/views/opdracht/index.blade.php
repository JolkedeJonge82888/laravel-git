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

    <div class="container">
        @docent
            <a href="{{ route('opdracht.create') }}" class="btn btn-primary">Create Assignment</a>
            <a onclick="showOpen()" class="btn btn2 btn-primary">Hide Open</a>
            <a onclick="showClosed()" class="btn btn3 btn-primary">Hide Closed</a>
        @enddocent
        @if( !auth()->user()->isDocent())
            <a onclick="showAssignment()" class="btn btn1 btn-primary" style="margin-left: 50px; ">Hide Assignment</a>
        @endif
        <a onclick="showActive()" class="btn btn4 btn-primary" style="margin-left: 50px; ">Hide Active</a>

    </div>

    @if(!isset($opdrachts) || !$opdrachts->isNotEmpty())
        <div style="position: relative; align-items: center;display: flex; justify-content: center; height: 80vh;">
            <div style="border-right: 2px solid; font-size: 26px; padding: 0 15px 0 15px; text-align: center;">
                No Assignments</div>

            <div class="message" style="padding: 10px; font-size: 18px; text-align: center;">
                Wait for the teacher to make assignments!</div>
        </div>
    @endif
    <br>

    <div class="row">
        @isset($opdrachts)
            @foreach($opdrachts as $opdracht)
                    @if(!auth()->user()->hasOpdracht($opdracht->id) || !auth()->user()->isDocent())
                        @if($opdracht->start_date <= Today() && $opdracht->end_date >= Today())
                            <div class="assignment" class="col-xs-12 col-sm-6 col-md-4" style="display: block;">
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
                                                        <a href="{{ route('opdracht.edit',$opdracht->id)}}" class="btn btn-nfr btn-primary">Edit</a>
                                                        <form action="{{ route('opdracht.destroy', $opdracht->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-nfr btn-danger" type="submit">Delete</button>
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
                                @if(\App\Opdracht::find($opdracht->id)->TeamOpdracht->where('id', '=', \App\Users::find(Auth::user()->id)->Team->pluck('id')->first())->count() == 0)
                                        <div class="opdracht open" class="col-xs-12 col-sm-6 col-md-4" style="display: block;">
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
                                        @php($active = \App\Opdracht::find($opdracht->id)->TeamOpdracht->where('id', '=', \App\Users::find(Auth::user()->id)->Team->pluck('id')->first()))
                                        @foreach($active as $active1)
                                            <div class="opdracht active" class="col-xs-12 col-sm-6 col-md-4" style="display: block;">
                                            <div class="image-flip">
                                                <div class="mainflip">
                                                    <div class="frontside">
                                                        <div class="card">
                                                            <div class="card-body text-center">
                                                                <h4 class="card-title">{{ $active1->pivot->pivotParent->title }} - <color style="color: red;">Active</color></h4>
                                                                <p class="card-text">{{ $active1->pivot->pivotParent->Description->text }}</p>
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

                                        @endforeach
                                    @endif

                                @else
                                <div class="opdracht closed" class="col-xs-12 col-sm-6 col-md-4" style="display: block;">
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
                                                                <button class="btn btn-nfr btn-danger" type="submit" style="background-color:rgba(248,250,252,0.3); color: rgba(0,0,0,0.5);">Delete</button>
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
    <script type="text/javascript">

        function showAssignment()
        {
            $(document).ready(function(){
                $(".assignment").toggle(function () {
                    if( $(".assignment").is(':visible') === true)
                    {
                        $(".btn1").text("Hide Assignment");
                    }
                    else
                    {
                        $(".btn1").text("Show Assignment");
                    }
                });
            });
        }

        function showOpen()
        {
            $(document).ready(function(){
                $(".open").toggle(function () {
                    if( $(".open").is(':visible') === true)
                    {
                        $(".btn2").text("Hide Open");
                    }
                    else
                    {
                        $(".btn2").text("Show Open");
                    }
                });
            });
        }

        function showActive()
        {
            $(document).ready(function(){
                $(".active").toggle(function () {
                    if( $(".active").is(':visible') === true)
                    {
                        $(".btn4").text("Hide Active");
                    }
                    else
                    {
                        $(".btn4").text("Show Active");
                    }
                });
            });
        }

        function showClosed()
        {
            $(document).ready(function(){
                $(".closed").toggle(function () {
                    if( $(".closed").is(':visible') === true)
                    {
                        $(".btn3").text("Hide Closed");
                    }
                    else
                    {
                        $(".btn3").text("Show Closed");
                    }
                });
            });
        }


    </script>
@endsection
