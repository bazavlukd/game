@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="title m-b-md">devGame</div>
        <table class="table table-striped" id="myTable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="h2">Emoji</th>
                    <th class="h2">Username</th>
                    <th class="h2">time</th>
                    <th class="h2">mentoring</th>
                    <th class="h2">responsibility</th>
                    <th class="h2">codestyle</th>
                    <th class="h2">sum</th>
                    <th class="h2">Result</th>
                </tr>
            </thead>
            <tbody>
                @php $i=0; @endphp
                @foreach ($users as $user)
                <tr>
                    <td class="h2">{!! $avatars[$i++]['avatar'] !!}</td>
                    <td class="h2">{!! $user['username'] !!}</td>
                    <td class="h2">{!! $user['trackingtime'] !!}</td>
                    <td class="h2">{!! $user['mentoring'] !!}</td>
                    <td class="h2">{!! $user['responsibility'] !!}</td>
                    <td class="h2">{!! $user['codestyle']  !!}</td>
                    <td class="h2">{!! $user['codestyle'] + $user['responsibility'] + $user['mentoring'] !!}</td>
                    <td class="h2">{!! $user['trackingtime'] + $user['codestyle'] + $user['responsibility'] + $user['mentoring'] !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection