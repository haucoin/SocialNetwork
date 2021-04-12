@extends('layouts.appmaster')
@section('title', 'Social Network: Confirmation') 
@section('content')

<div
	style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div
		style="padding-bottom: 15px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Registration Confirmation</h2>
	</div>
	
	<div style="padding: 20">
		<img src="resources/confirmation.png" alt="Confirmed" width="120px" />
<!-- 		<img src="https://cst256-socialnetwork.scm.azurewebsites.net/api/vfs/site/wwwroot/SocialNetwork/resources/confirmation.png" alt="Confirmed" width="120px" /> -->
		<br/>
		<br/>
		<h4>Thank you!</h4>
		<br/>
		<p>Congratulations, your registration was successful.<br/>You have been sent an email confirmation and you are now able to begin using <i>Social Network</i>.</p>
		<p>We're glad you're here!</p>
		
		<form method="GET" action="home">
        	<input type="submit" value="Get started" class="btn btn-info">
       	</form>
	</div>
		
</div>
<br>
@endsection