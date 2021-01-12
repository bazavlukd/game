@extends('layouts.app')
@section('content')
    <div class="content">
   
        <div class="title m-b-md">Hall of Fame</div>
        <table class="table table-striped" id="myTable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="h2">Username</th>
                    @for($i=1; $i <= $tour; $i++)   
                    <th class="h2">Tour {{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
            @foreach($bonuses as $name => $place)             
                <tr>
                    <td class="h2">{!! $name !!}</td>
                    @for($i=1; $i <= $tour; $i++) 
                    <td class="h2">@if (!empty($place[$i])) &#x1F94{!! $place[$i]+6 !!} @endif</td>
                    @endfor
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection