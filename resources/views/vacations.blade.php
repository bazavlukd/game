@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="title m-b-md">devVacations</div>
        <table class="table table-striped" id="myTable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="h3">Username</th>
                    <th class="h3">start</th>
                    <th class="h3">end</th>
                    <th class="h3">location</th>
                </tr>
            </thead>
            <tbody>
            @php $i=0; @endphp
            @foreach ($vacations as $user)
                <tr>
                <form action="/vacations/saveValues" method="post">
                @csrf
                    <td class="h3">{!! $user['username'] !!}</td>
                    @if(!empty($user['start']))
                        <td class="h3">{!! $user['start'] !!}</td>
                        <td class="h3">{!! $user['end'] !!}</td>
                        <td class="h3">{!! $user['location'] !!}</td>
                    @else
                        <td colspan="2"><input type="text" id="daterange" name="period[{!! $user['user_id'] !!}]" value="" /></td>
                        <td><input type="submit" value="Select"></td>
                    @endif
                </form>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection