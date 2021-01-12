@extends('layouts.app')
@section('content')
<div class="content container">
    <div class="h2 m-b-md">LAMPdev English Groups</div>
   
    @foreach ($groups as $value)
    <div class="row">
        <div class="col-sm-6">
            <div class="card text-white {{ $value['time'][0]->name }} mb-2">
            <h5 class="card-header">{{ $value['time'][0]->day }}
            {{ dateFormat($value['time'][0]->start) }} - {{ dateFormat($value['time'][0]->end) }}</h5>
                <div class="card-body">
                    @foreach ($value['users'] as $developer)
                        {{ $developer->username }} 
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-white {{ $value['time'][0]->name }} mb-2">
            <h5 class="card-header">{{ $value['time'][1]->day }} 
            {{ dateFormat($value['time'][1]->start) }} - {{ dateFormat($value['time'][1]->end) }}</h5>
                <div class="card-body">
                    @foreach ($value['users'] as $developer)
                        {{ $developer->username }} 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection