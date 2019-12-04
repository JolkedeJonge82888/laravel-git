@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Add Opdracht
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post">
                <div class="form-group">
                    @csrf
                    <label for="name">Opdracht Title:</label>
                    <input type="text" class="form-control" name="opdracht_title"/>
                </div>
                <div class="form-group">
                    <label for="price">Opdracht Description:</label>
                    <textarea class="form-control" rows="5" name="opdracht_description"></textarea>
                </div>
                <div class="form-group">
                    <label for="quantity">Opdracht Start Date:</label>
                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="opdracht_startdate"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Opdracht End Date:</label>
                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="opdracht_enddate"/>
                </div>
                <button type="submit" class="btn btn-primary">Add Opdracht</button>
            </form>
        </div>
    </div>
@endsection
