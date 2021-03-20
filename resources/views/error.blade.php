@extends('layouts.appmaster')
@section('title', 'Social Network: Error') 
@section('content')

<div
	style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div
		style="padding-bottom: 15px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Error</h2>
	</div>
	
	<div style="padding: 20">
		<img src="resources/ErrorImage.png" alt="Error" width="120px" />
		<br/>
		<br/>
		<h4>Oops! An error occurred.</h4>
		<br/>
		<p>It looks like something went wrong. Please return back to the <a href="home" style="color: #14A3B8">home page.</a></p>
	</div>
		
</div>
<br>
@endsection
