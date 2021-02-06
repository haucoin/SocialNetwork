@extends('layouts.appmaster')
@section('title', 'Social Network: Login Form')

@section('content')
<div align="center">
    <h2>Login Form</h2>
    @if(isset($returnMessage))
   		{{$returnMessage}}
	@endif 
    <form method= "POST" action= "loginUser" class="was-validated">
    <input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    	<table>
    	<tr>
    		<td>   
    			<div class="form-group">
    				<label for="username">Username: </label>
    				<input type="text" name="username" class="form-control" placeholder="Enter username" required="required"/>
    				<div class="invalid-feedback">Incorrect Information</div>
    			</div>
        	</td>
    	</tr>
    	
    	<tr>
    		<td>
    			<div class="form-group">
    				<label for="password">Password: </label>
    				<input type="password" name="password" class="form-control" placeholder="Enter password" required="required"/>
    				<div class="invalid-feedback">Incorrect Information</div>
    			</div>
    		</td>
    	</tr>
    		
    	<tr>
    		<td colspan= "2" align="center">
    		<div align="center">
    		<input type= "submit" value= "Login" class="btn btn-primary">
    		</div>
    		</td>
    	</tr>	
    	</table>
    	<br/>
    </form>
</div><br/>
@endsection