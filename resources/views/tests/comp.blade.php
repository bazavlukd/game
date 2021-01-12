@extends('layouts.app')
@section('content')

<div class="content container">
<div class="h2 m-b-md">Complete the sentence</div>

	@foreach($tasks as $value)
<p><table border="1">   
    <tr><td bgcolor="blue"><font color="yellow">{{$value['text']}}</font></td></tr>
      <tr>  <td>{{$value['var1']}}</td></tr>
      <tr>  <td>{{$value['var2']}}</td></tr>
     <tr>   <td>{{$value['var3']}}</td></tr> 
     <tr>   <td>{{$value['var4']}}</td></tr>
</table>
</p>                
   	@endforeach
	
</div>    
@endsection