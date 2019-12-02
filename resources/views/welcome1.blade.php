@extends('layouts.app')

@section('content')
    <style>
        fieldset {
            padding: 16px 16px 16px 16px;
        }
    </style>
    <form>
        <fieldset>
            <legend>Test</legend>
            <label for=""></label><br><input type="text"><br>
            <label for=""></label><br><input type="password"><br>
            <label for=""></label><br><input type="email"><br>
            <label for=""></label><br><input type="date"><br>
        </fieldset>
    </form>
@endsection
