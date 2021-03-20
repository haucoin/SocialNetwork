@extends('layouts.appmaster')
@section('title', 'Social Network: Login')
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
    <h2>Login</h2>
    @if(isset($returnMessage))
   		<p style="color: red">{{$returnMessage}}</p>
	@endif 
    <form method= "POST" action= "loginUser" class="was-validated">
    <input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    	<table>
    	<tr>
    		<td>   
    			<div class="form-group">
    				<label for="username">Username: </label>
    				<input type="text" name="username" class="form-control" placeholder="Enter username" required="required"/>
    				<div class="invalid-feedback">Valid username required.</div>
    			</div>
        	</td>
    	</tr>
    	
    	<tr>
    		<td>
    			<div class="form-group">
    				<label for="password">Password: </label>
    				<table>
    					<tr>
    						<td>
    							<input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required="required"/>
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
    		<td colspan= "2" align="center">
	    		<div align="center">
	    			<input type= "submit" value= "Login" class="btn btn-info">
	    		</div>
    		</td>
    	</tr>	
    	</table>
    	<br/>
    </form>
</div><br/>
@endsection