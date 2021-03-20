@extends('layouts.appmaster') @section('title', 'Social Network:
Application') @section('content')

<div
	style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div
		style="padding-bottom: 15px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Application Form</h2>
	</div>
			<form method="" action="" class="was-validated">
				<table style="width: 100%;">
				<tr>
					<td>
						<h5>Application Form</h5>
					</td>
				</tr>
				<tr>
					<td>
						<!-- Firstname Name -->
						<div class="form-group">
							<label class="col-md-12 control-label" for="firstName">First Name</label>
							<div class="col-md-12">
								<input id="firstName" name="firstName" type="text" value="{{session()->get('currentUser')->getFirstName()}}" placeholder="First Name" class="form-control input-md" minlength="2" maxlength="15" required="required">
							    <div class="invalid-feedback">Valid first name required.</div>
							</div>
						</div>
					</td>
					<td>
						<!--Last Name -->
						<div class="form-group">
							<label class="col-md-12 control-label" for="lastName">Last Name</label>
							<div class="col-md-12">
								<input id="lastName" name="lastName" type="text" value="{{session()->get('currentUser')->getLastName()}}" placeholder="Last Name" class="form-control input-md" minlength="2" maxlength="15" required="required">
							    <div class="invalid-feedback">Valid last name required.</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<!--Email -->
						<div class="form-group">
							<label class="col-md-12 control-label" for="email">Email Address</label>
							<div class="col-md-12">
								<input id="email" name="email" type="text" value="{{session()->get('currentUser')->getEmail()}}" placeholder="Email Address" class="form-control input-md" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required="required">
							    <div class="invalid-feedback">Valid email address required.</div>
							</div>
						</div>
					</td>
					<td>
						<!--Phone Number -->
						<div class="form-group">
							<label class="col-md-12 control-label" for="phoneNumber">Phone Number</label>
							<div class="col-md-12">
								<input id="phoneNumber" name="phoneNumber" type="text" value="{{session()->get('currentUser')->getPhoneNumber()}}" placeholder="Phone number" class="form-control input-md" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}|\([0-9]{3}\)[0-9]{3}-[0-9]{4}" title="Must meet one of the following patterns: ***-***-**** or (***)***-****" required="required">
							    <div class="invalid-feedback">Valid phone number required.</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<!--Upload Application -->
						<div class="form-group">
							<label class="col-md-12 control-label">Upload Resume</label>
							<div class="col-md-12">
								<input type="file" id="myFile" name="filename" required>
							</div>
						</div>
					</td>
				</tr>
				</table>
			</form>
			<table>
				<tr>
					<td colspan="2">
						<form method="POST" action="submitApplication" style="display: inline;" onsubmit="alert('Congratulations, you have submitted your application!')">
		    				<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
							<div align="center">
								<input type="submit" value="Apply" class="btn btn-info">
							</div>
		    			</form>
					</td>
				</tr>
			</table>
</div>
<br>
@endsection
