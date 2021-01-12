@extends('layouts.app')
@section('content')

<div class="content container">
<div class="h3 m-b-md" align="justify">
  Critical reasoning questions test your ability to analyze logical arguments. The arguments cover a range of topics and situations which average developers would be expected to be able to understand, even if they are not very familiar with the subject area. You do not need to know formal logic. You do need to be able to evaluate a piece of reasoning.. 
</div>

<form method="post" action="/english/saveAnswers">
@csrf
<input type="hidden" name="type" value="logic">
@foreach($tasks as $key=>$value)
<div class="row">
    <div class="col-sm-11">         
        <div class="card text-white bg-dark mb-2">
            <h4 class="card-header" align="left">
                {!! $value->text !!}
            </h4>
            @for ($i=1; $i < 6; $i++)
            @if (!empty($value->{'var'.$i}))
            <div class="form-check form-check-inline" style="margin: 10px;">
                <input type="radio" name="{{$key}}" value="{{$i}}">
                <label class="form-check-label">{!! $value->{'var'.$i} !!}</label>
            </div>
            @endif
            @endfor
          
       
      </div>
    </div>
</div>
@endforeach
<button type="submit" class="btn btn-primary">Send answers</button>

</form>
</div>    
@endsection