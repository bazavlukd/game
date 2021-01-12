@extends('layouts.app')
@section('content')

<div class="content container">
<div class="h3 m-b-md" align="justify">
  There are several sentences, each followed by four possible ways of restating the main idea of the sentence in different words. For each question choose the one restatement which best expresses the meaning of the original sentence. 
</div>

<form method="post" action="/english/saveAnswers">
@csrf
<input type="hidden" name="type" value="restatements">
@foreach($tasks as $key=>$value)
<div class="row">
    <div class="col-sm-11">         
        <div class="card text-white bg-success mb-2">
            <h4 class="card-header" align="left">
                {!! $value->text !!}
            </h4>
            @for ($i=1; $i < 6; $i++)
            @if (!empty($value->{'var'.$i}))
            <div class="form-check form-check-inline" style="margin: 10px;">
                <input type="radio" name="{{$key}}" value="{{$i}}">
                <label class="form-check-label" align="justify">{!! $value->{'var'.$i} !!}</label>
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