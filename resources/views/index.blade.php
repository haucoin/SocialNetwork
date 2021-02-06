@extends('layouts.appmaster')
@section('title', 'Social Network: Index')

@section('content')
<div align="center">
    <h2>Social Network</h2><br/>
    
    Please select Login or Register to continue:
    <br/><br/>
    
    <div align="center">
        <table style="padding: 10px;">
        	<tr>
        		<td align="center">
        			<form method= "GET" action= "login">
        				<input type= "submit" value= "Login" class="btn btn-primary">
        			</form>
        		</td>
        	</tr>
        	<tr>
        		<td align="center">
        			<form method= "GET" action= "registration">
        				<input type= "submit" value= "Registration" class="btn btn-primary">
        			</form>
        		</td>
        	</tr>
    	</table><br/>
	</div>
</div>
@endsection