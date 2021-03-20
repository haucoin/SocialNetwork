@extends('layouts.appmaster')
@section('title', 'Social Network: Registration')
@section('content')

<script>
function togglePassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    document.getElementById("passwordicon").className = 'fa fa-fw fa-eye-slash field-icon toggle-password'; 
    x.type = "text";
  } else {
      document.getElementById("passwordicon").className = 'fa fa-fw fa-eye field-icon toggle-password'; 
    x.type = "password";
  }
}
</script>

<div align="center" style="padding-top: 25px">
    <h2>Registration</h2><br>
    @if(isset($returnMessage))
		<p style="color: red">{{$returnMessage}}</p>
	@endif 
    <form method= "POST" action="registerUser" class="was-validated">
    <input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    	<table>
    	<tr>
    		<td>
    			<div class="form-group">
    				<label>First Name: </label>
    				<input type="text" name="firstName" class="form-control" placeholder="Enter First Name" minlength="2" maxlength="15" required="required"/>
    				<div class="invalid-feedback">Valid first name required.</div>
    			</div>		
    		</td>
    		<td>
    			<div class="form-group">
    				<label>Last Name: </label>
    				<input type="text" name="lastName" class="form-control" placeholder="Enter Last Name" minlength="2" maxlength="15" required="required"/>
    				<div class="invalid-feedback">Valid last name required.</div>
    			</div>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<div class="form-group">
    				<label>Username: </label>
    				<input type="text" name="username" class="form-control" placeholder="Enter Username" pattern="[a-z]{4,15}" title="Must only contain lowercase letters, no numbers or symbols, and be 4 to 15 characters" required="required"/>
    				<div class="invalid-feedback">Valid username required.</div>
    			</div>		
    		</td>
    		<td>
    			<div class="form-group">
    				<label>Password: </label>
    				<table>
    					<tr>
    						<td style="width: 190px">
    							<input type="password" id="password" name="password" class="form-control" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="required"/>
    							<div class="invalid-feedback">Valid password required.</div>
    						</td>
    						<td style="vertical-align: top">
    							<span style="vertical-align: middle" class="input-group-text" onclick="togglePassword()">
                                	<i id="passwordicon" style="height: 25px; padding-top: 3px" class="fa fa-fw fa-eye field-icon toggle-password"></i>
                            	</span>
    						</td>
    					</tr>
					</table>
    			</div>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<div class="form-group">
    				<label>Email: </label>
    				<input type="email" name="email" class="form-control" placeholder="Enter Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required="required"/>
    				<div class="invalid-feedback">Valid email required.</div>
    			</div>			
    		</td>
    		<td>
    			<div class="form-group">
    				<label>Phone Number: </label>
    				<input type="tel" name="phoneNumber" class="form-control" placeholder="Enter Phone Number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}|\([0-9]{3}\)[0-9]{3}-[0-9]{4}" title="Must meet one of the following patterns: ***-***-**** or (***)***-****" required="required"/>
    				<div class="invalid-feedback">Valid phone number required.</div>
    			</div>			
    		</td>
    	</tr>
    	<tr>
    		<td colspan= "2" align="center">
    		<input type= "submit" value= "Register" class="btn btn-info">
    		</td>
    	</tr>
    		
    	</table>	
   </form>
</div><br><br>
@endsection