@extends('layouts.app')
@section('content')
<div class="content">
<div class="title m-b-md">Completed contracts</div>
put description and feedback to client from 0 to 10.
<div class="links">
   
     @foreach ($contract as $key => $value)
     {{$value->title}} {{$value->contract}}
     <table class="table table-sm">
        <thead>
            <tr>
                <th>Technologies</th>
                <th>Description</th>
                <th>My feedback</th>
                <th>Submit</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td><input name="technologies[{{ $value->id }}]" type="text" ></td>
            <td><textarea rows="10" cols="45" name="description[{{ $value->id }}]"></textarea></td> 
            <td><input name="feedback[{{ $value->id }}]" type="number" min="0" max="10" ></td>
            <td><button type="submit" class="btn btn-primary">Submit</button></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection