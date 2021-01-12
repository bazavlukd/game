@extends('layouts.app')
@section('content')
<div class="content">
<div class="title m-b-md">My votes this month </div>
    <h2>
    Codestyle: 
        @foreach ($codestyle as $value)
            {{ $users[$value->user_id - 1]->username}}({{ $value->point * $value->koefficient}}), 
        @endforeach
    <br>
    Mentoring: 
        @foreach ($mentoring as $value)
            {{ $users[$value->user_id - 1]->username}}({{ $value->point * $value->koefficient}}),
        @endforeach
    <br>
    Responsibility:
        @foreach ($responsibility as $value)
            {{ $users[$value->user_id - 1]->username}}({{ $value->point * $value->koefficient}}),
        @endforeach
    </h2>
</div>
@endsection