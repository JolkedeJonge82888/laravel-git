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
                                            <p><img class=" img-fluid" src="https://eur.delve.office.com//mt/v3/people/profileimage?userId={{$user->username}}%40glr.nl&size=L" alt="card image"></p>
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

            <div class="row">
                <nav>
                    <ul>
                        <li><a>Statistic 1</a></li>
                        <li><a>Statistic 2</a></li>
                    </ul>
                </nav>
            </div>


        @endisset
    </div>
</section>
@endsection
