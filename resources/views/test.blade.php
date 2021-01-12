@extends('layouts.app')
@section('content')
<div class="content container">
	
<div class="row">
  <div class="col-md-10">
  <h3>LAMPdev English Tests</h3>
  <div id="content">
  	<h4 align="justify">English tests contains three types of questions: Sentence Completion, Restatement and Reading Comprehension. Each question is followed by 4 or 5 possible responses. Choose the response which best answers the question. <br>Each right answer add 5 points to your result but each wrong answer subtract 2 points.</h4>
    <table class="table table-striped" border="2">
        <tr style="background:#eee;" border="2">
			<td style="text-align:center">Type</td>
            <td style="text-align:center">first attempt</td>
            <td style="text-align:center">second attempt</td>
            <td style="text-align:center">third attempt</td>
            <td style="text-align:center">Analiz</td>
		</tr>
		<tr>
			<td style="text-align:center"><b>Completions</b>
			<div align="justify" >This part consists of sentences with a words missing in each. For each question, choose the answer which best completes the sentence. </div></td>
           
        @for($i=1; $i < 4; $i++)
            @if(!empty($results['completions'][$i]['result'])) 
            <td> {!! $results['completions'][$i]['right'] !!} /  {!! $results['completions'][$i]['all'] !!} <br> result
        {!! $results['completions'][$i]['result'] !!}</td>
        @else
        <td></td>
        @endif
			@endfor

			@if ($attempt_completions >2 )
            	<td><form method="get" action="/english/analiz">
            <input type="hidden" name="type" value="completions">
			<button type="submit" class="btn btn-primary">Analiz</button>
			</form></td>
			@else
			<td><form method="get" action="english/completions">
			<button type="submit" class="btn btn-primary">Go</button>
			</form></td>
			@endif
		</tr>
		<tr>
			<td style="text-align:center"><b>Restatements</b>
			<div align="justify"><br>There are several sentences, each followed by four possible ways of restating the main idea of the sentence in different words. For each question choose the one restatement which best expresses the meaning of the original sentence.</div></td>
        @for($i=1; $i < 4; $i++)
            @if(!empty($results['restatements'][$i]['result'])) 
            <td> {!! $results['restatements'][$i]['right'] !!} /  {!! $results['restatements'][$i]['all'] !!} <br> result
        {!! $results['restatements'][$i]['result'] !!}</td>
        @else
        <td></td>
        @endif
			@endfor

			@if ($attempt_restatements >2 )
            	<td><form method="get" action="/english/analiz">
            <input type="hidden" name="type" value="restatements">
			<button type="submit" class="btn btn-primary">Analiz</button>
			</form></td>
			@else
			<td><form method="get" action="english/restatements">
			<button type="submit" class="btn btn-primary">Go</button>
			</form></td>
			@endif
		</tr>
		<tr>
			<td style="text-align:center"><b>Reading</b>
			<div align="justify">There is a passage followed by related questions. For each question, choose the most appropriate answer based on the text.</div></td>
        @for($i=1; $i < 4; $i++)
            @if(!empty($results['reading'][$i]['result'])) 
            <td> {!! $results['reading'][$i]['right'] !!} /  {!! $results['reading'][$i]['all'] !!} <br> result
        {!! $results['reading'][$i]['result'] !!}</td>
        @else
        <td></td>
        @endif
			@endfor
			@if ($attempt_reading > 2 )
            	<td><form method="get" action="/english/analiz">
            <input type="hidden" name="type" value="reading">
			<button type="submit" class="btn btn-primary">Analiz</button>
			</form></td>
			@else
			<td><form method="get" action="english/reading">
			<button type="submit" class="btn btn-primary">Go</button>
			</form></td>
			@endif
		</tr>
		<tr>
			<td style="text-align:center"><b>Logic</b>
			<div align="justify">Critical reasoning questions test your ability to analyze logical arguments. The arguments cover a range of topics and situations which average developers would be expected to be able to understand, even if they are not very familiar with the subject area. You do not need to know formal logic. You do need to be able to evaluate a piece of reasoning.</div></td>
        @for($i=1; $i < 4; $i++)
            @if(!empty($results['logic'][$i]['result'])) 
            <td> {!! $results['logic'][$i]['right'] !!} /  {!! $results['logic'][$i]['all'] !!} <br> result
        {!! $results['logic'][$i]['result'] !!}</td>
        @else
        <td></td>
        @endif
			@endfor
			@if ($attempt_logic > 2 )
            	<td><form method="get" action="/english/analiz">
            <input type="hidden" name="type" value="logic">
			<button type="submit" class="btn btn-primary">Analiz</button>
			</form></td>
			@else
			<td><form method="get" action="english/logic">
			<button type="submit" class="btn btn-primary">Go</button>
			</form></td>
			@endif
		</tr>
	</table> 
	<a href="/english/schedule">English lessons schedule</a>
@endsection