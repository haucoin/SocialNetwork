@extends('layouts.appmaster') @section('title', 'Social Network: Admin
User View') @section('content')
<div
	style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div
		style="padding-bottom: 15px; background: #299be4; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Profile</h2>
	</div>
	<form method="POST" action="adminEditUser">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
		<table style="width: 100%;">
			<tr>
				<td>
					<h4>User Information</h4>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-6 control-label" for="role">User Role</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="role" name="role" type="text"
									value="{{$currentUser->getRole()}}" placeholder="User Role"
									class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-6 control-label" for="active">Status</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="active" name="active" type="text"
									value="{{$currentUser->getActive()}}" placeholder="Status"
									class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<!-- Firstname Name -->
					<div class="form-group">
						<label class="col-md-6 control-label" for="firstName">First Name</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="firstName" name="firstName" type="text"
									value="{{$currentUser->getFirstName()}}"
									placeholder="First Name" class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<!--Last Name -->
					<div class="form-group">
						<label class="col-md-6 control-label" for="lastName">Last Name</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="lastName" name="lastName" type="text"
									value="{{$currentUser->getLastName()}}" placeholder="Last Name"
									class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<!-- User Name -->
					<div class="form-group">
						<label class="col-md-6 control-label" for="username">Username</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="username" name="username" type="text"
									value="{{$currentUser->getUsername()}}" placeholder="Username"
									class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<!-- password -->
					<div class="form-group">
						<label class="col-md-6 control-label" for="password">Password</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="password" name="password" type="password"
									value="{{$currentUser->getPassword()}}" placeholder="Password"
									class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<!--Email -->
					<div class="form-group">
						<label class="col-md-6 control-label" for="email">Email Address</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="email" name="email" type="text"
									value="{{$currentUser->getEmail()}}"
									placeholder="Email Address" class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-6 control-label" for="bio">Overview (max 200
							words)</label>
						<div class="col-md-6">
							<textarea class="form-control" rows="10" id="bio" name="bio">{{$currentUser->getProfile()->getBio()}}</textarea>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<!--Email -->
					<div class="form-group">
						<label class="col-md-6 control-label" for="phoneNumber">Phone
							Number</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="phoneNumber" name="phoneNumber" type="text"
									value="{{$currentUser->getProfile()->getPhoneNumber()}}"
									placeholder="Phone Number" class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-6 control-label" for="streetAddress">Street
							Address</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="streetAddress" name="streetAddress" type="text"
									value="{{$currentUser->getProfile()->getStreetAddress()}}"
									placeholder="Street Address" class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-6 control-label" for="city">City</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="city" name="city" type="text"
									value="{{$currentUser->getProfile()->getCity()}}"
									placeholder="City" class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-6 control-label" for="state">State</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="state" name="state" type="text"
									value="{{$currentUser->getProfile()->getState()}}"
									placeholder="State" class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-6 control-label" for="zipCode">Zip Code</label>
						<div class="col-md-6">
							<div class="input-group-prepend">
								<input id="zipCode" name="zipCode" type="text"
									value="{{$currentUser->getProfile()->getZipCode()}}"
									placeholder="Zip Code" class="form-control input-md">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<input type="hidden" name="userId" value="{{$currentUser->getId()}}" />
				<td><input type="submit" value="Save Changes"
					class="btn btn-success"></td>
			</tr>
		</table>
	</form>
</div>
<br>
@endsection
