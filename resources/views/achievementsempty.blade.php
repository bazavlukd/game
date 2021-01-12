@extends('layouts.app')
@section('content')
<div class="content">
    <div class="title m-b-md"></div>
    <div class="h1">
        Let's start the devGame.<br> 
        Please check your achievements and press Submit.
    </div>
    <div class="links">
    <div class="col-md-12">
        Achievements List 
    <form action="/achievements/saveAchievements" method="post">
        @csrf
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Emoji</th>
                    <th>Achievement</th>
                    <th>Description</th>
                    <th>Checking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $value)
                <tr>
                    <td><img width="50" src="{{ asset('avatars/'. $value->id .'.jpg') }}"></td>
                    <td><label for="title">{{ $value->achievement }}</label></td>
                    <td><input name="description[{{ $value->id }}]" type="text"></td> 
                    <td><input name="achievement[{{ $value->id }}]" type="checkbox" value="1"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection