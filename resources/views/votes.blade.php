@extends('layouts.app')
@section('content')
<div class="content">
<div class="title m-b-md">{{ $user_name }} Cabinet</div>

    <form action="/votes/saveValues" method="post">
    @csrf
    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th>developer</th>
                <th>codestyle</th>
                <th>mentoring</th>
                <th>responsibility</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><label for="title">{{ $user->username }}</label></td> 
                    <td><input type="checkbox" name="codestyle[{{ $user->id }}]"></td>
                    <td><input type="checkbox" name="mentoring[{{ $user->id }}]"></td>
                    <td><input type="checkbox" name="responsibility[{{ $user->id }}]"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection