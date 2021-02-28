@extends('layouts.appmaster')
@section('title', 'Social Network: Home Page')
@section('content')

<div align="center" style="padding-top: 25px">
    <h2>Home Page</h2><br/>
    	@if(isset($returnMessage))
    		<h4> {{$returnMessage}}</h4>
		@endif
</div>
@endsection