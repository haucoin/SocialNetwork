@extends('layouts.appmaster')
@section('title', 'Social Network: Registration Form')

@section('content')
<div align="center">
    <h2>Registration Form</h2><br>
    @if(isset($returnMessage))
   		{{$returnMessage}}
	@endif 
    <form method= "POST" action="registerUser" class="was-validated">
    <input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    	<table>
    	<tr>
    		<td>
    			<div class="form-group">
    				<label>First Name: </label>
    				<input type="text" name="firstName" class="form-control" placeholder="Enter First Name" required="required"/>
    				<div class="invalid-feedback">Incorrect Information</div>
    			</div>		
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<div class="form-group">
    				<label>Last Name: </label>
    				<input type="text" name="lastName" class="form-control" placeholder="Enter Last Name" required="required"/>
    				<div class="invalid-feedback">Incorrect Information</div>
    			</div>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<div class="form-group">
    				<label>Username: </label>
    				<input type="text" name="username" class="form-control" placeholder="Enter Username" required="required"/>
    				<div class="invalid-feedback">Incorrect Information</div>
    			</div>		
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<div class="form-group">
    				<label>Password: </label>
    				<input type="password" name="password" class="form-control" placeholder="Enter password" required="required"/>
    				<div class="invalid-feedback">Incorrect Information</div>
    			</div>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<div class="form-group">
    				<label>Email: </label>
    				<input type="text" name="email" class="form-control" placeholder="Enter Email" required="required"/>
    				<div class="invalid-feedback">Incorrect Information</div>
    			</div>			
    		</td>
    	</tr>
    	<tr>
    		<td colspan= "2" align="center">
    		<input type= "submit" value= "Register" class="btn btn-primary">
    		</td>
    	</tr>
    		
    	</table>	
   </form>
</div><br><br>
@endsection