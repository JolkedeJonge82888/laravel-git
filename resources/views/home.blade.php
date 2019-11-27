@extends('layouts.app')

@section('content')

<section id="team" class="pb-5">
    <div class="container">
        @isset($users)
            <h5 class="section-title h1">OUR TEAM</h5>
            <div class="row">

                @foreach ($users as $user)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p><img class=" img-fluid" src="https://outlook.office365.com/owa/service.svc/s/GetPersonaPhoto?email={{$user->username}}@glr.nl&UA=0&size=HR648x648&sc=1574867599147" alt="card image"></p>
                                            <h4 class="card-title">{{ $user->name }}</h4>
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
<section id="stats" class="pb-5">
    <div class="container">
        <h5 class="section-title h1">STATISTICS</h5>
        <div class="row">
            <nav>
                <ul>
                    <li class="underline-hover current"><a href="">Statistic 1</a></li>
                    <li class="underline-hover"><a href="">Statistic 2</a></li>
                </ul>
            </nav>
        </div>
    </div>
</section>
@endsection
