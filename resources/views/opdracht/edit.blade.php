
@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit Share
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
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">Opdracht Title:</label>
                    <input type="text" class="form-control" name="opdracht_title" value={{ $opdracht->title }}/>
                </div>
                <div class="form-group">
                    <label for="price">Opdracht Description:</label>
                    <textarea class="form-control" rows="5" name="opdracht_description">{{ $opdracht->description->text }}</textarea>
                </div>
                <div class="form-group">
                    <label for="quantity">Opdracht Start Date:</label>
                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="opdracht_startdate" value={{ $opdracht->start_date }}/>
                </div>

                <div class="form-group">
                    <label for="quantity">Opdracht Start Date:</label>
                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="opdracht_startdate" value={{ $opdracht->start_date }}/>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
