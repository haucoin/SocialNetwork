@extends('layouts.appmaster') @section('title', 'Social Network:
Edit Profile') @section('content')
<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div style="padding-bottom: 30px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Edit Profile - Admin</h2>
	</div>
	<form method="POST" action="adminSaveUser">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
		<input type="hidden" name="userId" name="userId" value="{{$currentUser->getId()}}">
		<table style="width: 100%;">
			<tr>
				<td colspan="2">
					<h5>User Information</h5>
				</td>
			</tr>
			
			
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="role">User Role</label>
						<div class="col-md-12">
							<select id="role" name="role" class="form-control" style="color: grey">
								@if($currentUser->getRole() == 1)
									<option selected="selected" value="1">User</option>
									<option value="0">Admin</option>
								@else
									<option value="1">User</option>
									<option selected="selected" value="0">Admin</option>
								@endif
							</select>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="active">Status</label>
						<div class="col-md-12">
							<select id="active" name="active" class="form-control" style="color: grey">
								@if($currentUser->getActive() == 1)
									<option selected="selected" value="1">Active</option>
									<option value="0">Inactive</option>
								@else
									<option value="1">Active</option>
									<option selected="selected" value="0">Inactive</option>
								@endif
							</select>
						</div>
					</div>
				</td>
			</tr>
			
			
			
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="firstName">First Name</label>
						<div class="col-md-12">
							<input disabled type="text" name="firstName" class="form-control" value="{{ $currentUser->getFirstName() }}" style="color: grey"/>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="lastName">Last Name</label>
						<div class="col-md-12">
							<input disabled type="text" name="lastName" class="form-control" value="{{ $currentUser->getLastName() }}" style="color: grey"/>
						</div>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="username">Username</label>
						<div class="col-md-12">
							<input disabled type="text" name="username" class="form-control" value="{{ $currentUser->getUsername() }}" style="color: grey"/>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="password">Password</label>
						<div class="col-md-12">
							<input disabled type="password" name="password" class="form-control" value="{{ $currentUser->getPassword() }}" style="color: grey"/>
						</div>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="email">Email</label>
						<div class="col-md-12">
							<input disabled type="text" name="email" class="form-control" value="{{ $currentUser->getEmail() }}" style="color: grey"/>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="phoneNumber">Phone Number</label>
						<div class="col-md-12">
							<input disabled type="text" name="phoneNumber" class="form-control" value="{{ $currentUser->getPhoneNumber() }}" style="color: grey"/>
						</div>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="city">City</label>
						<div class="col-md-12">
							<input disabled type="text" name="city" class="form-control" value="{{ $userProfile->getCity() }}" style="color: grey"/>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="state">State</label>
						<div class="col-md-12">
							<input disabled type="text" name="state" class="form-control" value="{{ $userProfile->getState() }}" style="color: grey"/>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="bio">Overview</label>
						<div class="col-md-12">
							<textarea disabled class="form-control" rows="8" id="bio" name="bio" style="color: grey">{{ $userProfile->getBio() }}</textarea>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="skills">Skills</label>
						<div class="col-md-12">
							<textarea disabled class="form-control" rows="4" id="skills" name="skills" style="color: grey">{{ $userProfile->getSkills() }}</textarea>
						</div>
					</div>

				</td>
			</tr>
		</table>
		
		<table style="width: 100%;">
		
			<td style="width: 50%; vertical-align: top; padding-right: 15px">
				<!-- Education History table -->
				<table style="width: 100%; padding-right: 5px">
					<tr>
						<td>
							<h5>Education History</h5>
						</td>
					</tr>
					@if($educationHistory == null)
						<tr>
							<td>
								<p style="color: grey">No education history listed.</p>
							</td>
						</tr>
					@else
						<tr>
							<td>
								<p style="color: grey">this will do something later</p>
							</td>
						</tr>
					@endif
				</table>
			
			</td>
			<td style="width: 0px; height: 100%; padding: 0px; border: 1px solid #E5E5E5">
				
			</td>
			<td style="width: 50%; vertical-align: top; padding-left: 15px">
				<!-- Job History table -->
				<table style="width: 100%; padding-left: 5px">
					<tr>
						<td style="padding-left: 10px;">
							<h5>Job History</h5>
						</td>
					</tr>
					<tr>
						@if($jobHistory == null)
							<tr>
								<td>
									<p style="color: grey">No job history listed.</p>
								</td>
							</tr>
						@else
							@foreach($jobHistory as $job)
							<tr>
								<td>
									<p style="color: grey"></p>
								</td>
							</tr>
							@endforeach
						@endif
					</tr>
				</table>
			
			</td>
		
		</table>
		<br/><br/>
		
			@if(session()->get('currentUser')->getRole() == 0)
			<table style="width: 100%;">
				<tr>
		    		<td align="center">
			    		<div align="center">
				    		<input type= "submit" value= "Save Changes" class="btn btn-info">
			    		</div>
		    		</td>
				</tr>
			</table>
			@endif
	</form>
		
</div>
<br>
@endsection
