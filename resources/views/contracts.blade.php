@extends('layouts.app')
@section('content')
<div class="content">
<div class="title m-b-md">find your contracts</div>
<div class="links">
<form action="/contracts/saveContract" method="post">
    @csrf
    <table class="table table-hover table-sm">
        <thead>
            <tr>
                
                <th>Name</th>
                <th>Title</th>
                <th>Hours</th>
                <th>Start</th>
                <th>Finish</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($contracts as $key => $value)
            <tr>
                
                <td>{{$value->contact}}</td>
                <td>{{$value->title}}</td> 
                <td>{{$value->hours}}</td>
                <td>{{$value->start}}</td>
                <td>{{$value['end'] }}</td>
                <td><input name="contract[{{ $value->id }}]" type="submit" value="my contract"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
</div>
</div>
@endsection