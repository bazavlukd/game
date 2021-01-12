@extends('layouts.app')
@section('content')
<div class="content">
<div class="title m-b-md">LAMPdev accounts </div>
<table class="table table-striped" id="myTable">
    <thead>
        <tr>
            <th>Account</th>
            <th>Name</th>
            <th>Skype</th>
            
            <th>Developer</th>
            <th>Limit</th>
            <th>Client</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($accounts as $key => $value)
    <tr>
        <td>{{$value['account']}}</td>
        <td>{{$value['name']}}</td>
        <td>{{$value['skype']}}</td>

        <td>@if(!empty($value['contract1']))
                {{$value['contract1']['developer']->username}}
            @endif
            @if(!empty($value['contract2']))<br>
                {{$value['contract2']['developer']->username}}
            @endif
        </td>
        <td>@if(!empty($value['contract1']))
                {{$value['contract1']['client']->point}} / {{$value['contract1']['client']->limit}}
            @endif
            @if(!empty($value['contract2']))<br>
                {{$value['contract2']['client']->point}} /
                {{$value['contract1']['client']->limit}}
            @endif
        </td>
        <td>@if(!empty($value['contract1']))
                {{$value['contract1']['client']->contact}}
            @endif
            @if(!empty($value['contract2']))<br>
                {{$value['contract2']['client']->contact}}
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection