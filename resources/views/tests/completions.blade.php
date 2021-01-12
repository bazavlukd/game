@extends('layouts.app')
@section('content')

<div class="content container">
<div class="h2 m-b-md">Complete the sentence</div>
	<form class="form-inline" align="left" method="post" action="/english/saveAnswers">
	@csrf
	<input type="hidden" name="type" value="completions">
	@foreach($tasks as $key=>$value)
        <div style="margin: 10px;">
        	<div class="card text-white bg-secondary" style="width:100%" >
            <h4 class="card-header">
                {!! questionFormat($key, $value->text, $value->var1, $value->var2, $value->var3, $value->var4) !!}
            </h4>
        </div></div>
   	@endforeach
	<button type="submit" class="btn btn-primary">Send answers</button>
	</form>
</div>    
@endsection