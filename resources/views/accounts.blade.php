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
    @for ($i=0; $i < count($accounts); $i++)
    @if (($i != count($accounts)-1) &&
        ($accounts[$i]->account == $accounts[$i+1]->account))
    <tr class="table-secondary">
    @else
    <tr>
    @endif
        <td>{{$accounts[$i]->account}}</td>
        <td>{{$accounts[$i]->firstname}} {{$accounts[$i]->lastname}}</td>
        <td>{{$accounts[$i]->skype}} </td>
        <td>{{$accounts[$i]->username}}</td>
        <td>{{$accounts[$i]->point}} / {{$accounts[$i]->limit}}</td>
        <td>{{$accounts[$i]->contact}}</td>
    </tr>
    @endfor
    </tbody>
</table>
</div>
@endsection