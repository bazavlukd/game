@extends('layouts.app')
@section('content')

<div class="content container">
@if ($type == 'completions')
  @foreach($attempts as $attempt=>$result)  
  <div class="h2 m-b-md">
    @if($attempt == 0) 
      First attempt (result {{ $results[1]['result'] }} )
    @endif
    @if($attempt == 1) 
      Second attempt (result {{ $results[2]['result'] }} )
    @endif
    @if($attempt == 2) 
      Third attempt (result {{ $results[3]['result'] }} )
    @endif
  </div>
  <table class="table table-striped table-bordered table-hover">
    @foreach($result as $value)
    <tr>
      @if( $value->answer != $value->right_answer)
      <td class="card text-white bg-danger"><p>
        {!! analizFormatFalse($value->text, $value->{'var'.$value->answer }, $value->{'var'.$value->right_answer }) !!}
      </p></td>
      @else
      <td class="card text-white bg-success"><p>
        {!! analizFormatTrue($value->text, $value->{'var'.$value->right_answer }) !!}
      </p></td>
      @endif
    </tr>
    @endforeach
  </table>
  @endforeach 

@elseif (($type == 'restatements') || ($type == 'logic'))

  @foreach($attempts as $attempt=>$result)  
  <div class="h2 m-b-md">
    @if($attempt == 0) 
      First attempt (result {{ $results[1]['result'] }})
    @endif
    @if($attempt == 1) 
      Second attempt (result {{ $results[2]['result'] }})
    @endif
    @if($attempt == 2) 
      Third attempt (result {{ $results[3]['result'] }})
    @endif
  </div>
  <table class="table table-striped table-bordered">
  @foreach($result as $value)
    <tr>
      @if( $value->answer != $value->right_answer)
        <td class="card text-white bg-danger">
        <h4 class="card-header bg-secondary" align="justify">
          {!! $value->text !!}
        </h4>
        <h4 align="left" style='text-decoration: line-through;'>
          {!! $value->{'var'.$value->answer } !!}
        </h4>
        <h4 align="left">
          {!! $value->{'var'.$value->right_answer } !!}
        </h4>
      @else
        <td class="card text-white bg-success">
        <h4 class="card-header bg-secondary" align="left">
          {!! $value->text !!}
        </h4>
        <h4 align="left">
          {!! $value->{'var'.$value->right_answer } !!}
        </h4>
      @endif
    </td>
    </tr>
  @endforeach
  </table>
  @endforeach   

@elseif ($type == 'reading')

  @foreach($attempts as $attempt=>$result)  
   @if($attempt == 0) <div class="h2 m-b-md">
      First attempt (result {{ $results[1]['result'] }} )</div>
      <div align="justify">{!! $texts[0]['text_en'] !!} </div>
    @endif
    @if($attempt == 1) <div class="h2 m-b-md"> 
      Second attempt (result {{ $results[2]['result'] }} )</div>
      <div align="justify">{!! $texts[1]['text_en'] !!}</div> 
    @endif
    @if($attempt == 2) <div class="h2 m-b-md"> 
      Third attempt (result {{ $results[3]['result'] }} )</div>
      <div align="justify">{!! $texts[2]['text_en'] !!}</div> 
    @endif


  <table class="table table-striped table-bordered">
  @foreach($result as $value)
    
    <tr>
      @if( $value->answer != $value->right_answer)
        <td class="card text-white bg-danger">
        <h4 class="card-header bg-secondary">
          {!! $value->text !!}
        </h4>
        <h4 align="left" style='text-decoration: line-through;'>
          {!! $value->{'var'.$value->answer } !!}
        </h4>
        <h4 align="left">
          {!! $value->{'var'.$value->right_answer } !!}
        </h4>
      @else
        <td class="card text-white bg-success">
        <h4 class="card-header bg-secondary">
          {!! $value->text !!}
        </h4>
        <h4 align="left">
          {!! $value->{'var'.$value->right_answer } !!}
        </h4>
      @endif
    </td>
    </tr>
  @endforeach
  </table>
  @endforeach   
 
@endif
</div>
@endsection