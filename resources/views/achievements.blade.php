@extends('layouts.app')
@section('content')
    <div class="content">
    <div class="title m-b-md">Achievements List </div>
    <form action="/achievements/saveAchievements" method="post">
        @csrf
        <table class="table table-sm">
            <thead>
            <tr>
                <th></th>
                <th>Achievement</th>
                <th>Done</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $key => $value)
                <tr>
                    <td><img width="50" src="{{ asset('avatars/'. $value->id .'.jpg') }}"></td>
                    <td><label for="title">{{ $value->achievement }}</label></td> 
                    @if(!empty($achievements[$value->id]))  
                        <td><img width="50" src="{{ asset('avatars/done.png') }}"></td>
                        <td>{{ $achievements[$value->id]->format('j F, Y') }}</td>
                    @else
                        <td><input name="achievement[{{$value->id}}]" type="checkbox" value="1"></td>
                        <td><input name="description[{{ $value->id }}]" type="text" value="{{ $value->placeholder}}" placeholder="{{ $value->placeholder }}"></td> 
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
