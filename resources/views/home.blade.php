@extends('layouts.app')

@section('content')
    @isset($users, $teams)
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
                                                <p><img class=" img-fluid" src="" alt="card image"></p>
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
    <section id="stats" class="pb-5">
        <div class="container">
            <h5 class="section-title h1">STATISTICS</h5>
            <div class="row">
{{--                <nav>--}}
{{--                    <ul>--}}
{{--                        <li class="underline-hover current"><a href="">Statistic 1</a></li>--}}
{{--                        <li class="underline-hover"><a href="">Statistic 2</a></li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
                @foreach ($teams as $team)

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h4 class="card-title">{{ $team->name }}</h4>
                                            <p class="card-text">Points: {{ $team->point }}</p>
                                            <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

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

                            bar: {groupWidth: "40%"},

                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                    }
                </script>
                <div id="chart_div"></div>

            </div>
        </div>
    </section>
@endisset
@endsection
