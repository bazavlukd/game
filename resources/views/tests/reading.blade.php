@extends('layouts.app')
@section('content')

<div class="content container">
<div class="h2 m-b-md">Read the text and answer the questions</div>
<div align="justify">{!! $text !!}</div>
<form method="post" action="/english/saveAnswers">
@csrf
<input type="hidden" name="type" value="reading">
@foreach($tasks as $key => $value)
<div class="row">
    <div class="col-sm-11">         
        <div class="card text-white bg-primary mb-2">
            <h4 class="card-header" align="left">
                {!! $value->text !!}
            </h4>
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="{{ $value->id }}" value="1">
                <label class="form-check-label">{!! $value->var1 !!}</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="{{ $value->id }}" value="2">
              <label class="form-check-label" ">{!! $value->var2 !!}</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="{{ $value->id }}" value="3">
              <label class="form-check-label">{!! $value->var3 !!}</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="{{ $value->id }}" value="4">
              <label class="form-check-label" >{!! $value->var4 !!}</label>
            </div>
            @if(!empty($value->var5))
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="{{ $value->id }}" value="5">
              <label class="form-check-label" >{!! $value->var5 !!}</label>
            </div>
            @endif
        </div>
    </div>
</div>
@endforeach
<button type="submit" class="btn btn-primary">Send answers</button>
</form>

</div>    
@endsection