@extends('layouts.app')

@section('content')

<section id="team" class="pb-5">
    <div class="container">
        @isset($team)
            <h5 class="section-title h1">OUR TEAM</h5>
            <div class="row">

                @foreach ($team as $teams)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p><img class=" img-fluid" src="" alt="card image"></p>
                                            <h4 class="card-title">{{ $teams->name }}</h4>
                                            <p class="card-text">This is basic card with image on top, title, description and button.</p>
                                            <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset
    </div>
</section>
@endsection
