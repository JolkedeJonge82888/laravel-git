@extends('layouts.app')

@section('content')
    @if(isset($users) && isset($teams))
    <section id="team" class="pb-5">
        <div class="container">

                <h5 class="section-title h1">OUR TEAM</h5>
                <div class="row">

                    @foreach ($users as $user)
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="image-flip">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <p><img class="img-fluid" src="" alt="card image"></p>
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


        </div>
    </section>

    @isset($opdrachten)
        <section id="stats" class="pb-5">
            <div class="container">
                <h5 class="section-title h1">Current Assignments</h5>
            </div>
            @foreach($opdrachten as $opdracht)
                    @if(!auth()->user()->hasOpdracht($opdracht->id) || !auth()->user()->isDocent())
                        <div class="assignment" class="col-xs-12 col-sm-6 col-md-4" style="display: block;">
                            <div class="image-flip">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <h4 class="card-title">{{ $opdracht->title }} - Active</h4>
                                                <p class="card-text">{{ $opdracht->description->text }}</p>
                                                <p class="card-text">{{ date('d-m-Y', strtotime($opdracht->start_date)) }}</p>
                                                <p class="card-text">{{ date('d-m-Y', strtotime($opdracht->end_date)) }}</p>
                                                <a href="{{ route('opdracht.show', $opdracht->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

            @endforeach
        </section>
    @endisset

    <section id="stats" class="pb-5">

        <div class="container">
            <h5 class="section-title h1">STATISTICS</h5>
            <nav>
                <ul class="switch-content">
                    <li><h2><a onclick="switch1()">Statistics 1</a></h2></li>
                    <li><h2><a onclick="switch2()">Statistics 2</a></h2></li>
                </ul>
            </nav>
            <div id="switch-content1" style="display: flex" class="row statistic">

                @foreach ($teams as $team)

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h4 class="card-title">{{ $team->name }}</h4>
                                            <p class="card-text">Points: {{ $team->point }}</p>
                                            <a href="" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <div id="switch-content2" style="display: none;" class="row statistic">
                <script>

                    google.charts.load("current", {packages:['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Points', 'Teams'],
                            @foreach($teams as $team)
                            ['{{$team->name}}', {{$team->point}}],
                            @endforeach

                        ]);
                        var options = {
                            title: "Team Points",
                            width: 600,
                            height: 240,
                            bar: {groupWidth: "40%"},

                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                    }
                </script>
                <div id="chart_div" class="chart-div" style="width: 90%; margin: auto;"></div>

            </div>
        </div>
    </section>
    <script>
        function switch1() {
            var switch1 = document.getElementById("switch-content1");
            var switch2 = document.getElementById("switch-content2");

            if (switch1.style.display === "none") {
                switch1.style.display = "flex";
                    switch2.style.display = "none";
            }
        }

        function switch2() {
            var switch1 = document.getElementById("switch-content1");
            var switch2 = document.getElementById("switch-content2");

            if (switch1.style.display === "flex") {
                switch1.style.display = "none";
                switch2.style.display = "block";
            }
        }

    </script>
    @else
        <div style="position: relative; align-items: center;display: flex; justify-content: center; height: 80vh;">
            <div style="border-right: 2px solid; font-size: 26px; padding: 0 15px 0 15px; text-align: center;">
                No Team</div>

            <div class="message" style="padding: 10px; font-size: 18px; text-align: center;">
                Ask your teacher to be added in a team!</div>
        </div>
@endif

@endsection
