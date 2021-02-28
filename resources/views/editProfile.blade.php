@extends('layouts.appmaster') 
@section('title', 'Social Network: Edit Profile') 
@section('content')

<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div style="padding-bottom: 30px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Edit Profile</h2>
	</div>
	<form method="POST" action="updateProfile">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
		<input type="hidden" name="profileId" name="profileId" value="{{$userProfile->getId()}}">
		<table style="width: 100%;">
			<tr>
				<td colspan="2">
					<h5>User Information</h5>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="city">City</label>
						<div class="col-md-12">
							<input type="text" name="city" class="form-control" placeholder="Enter a City" value="{{ $userProfile->getCity() }}" style="color: grey"/>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="state">State</label>
						<div class="col-md-12">
							<input type="text" name="state" class="form-control" placeholder="Enter a State" value="{{ $userProfile->getState() }}" style="color: grey"/>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="bio">Overview</label>
						<div class="col-md-12">
							<textarea class="form-control" rows="8" id="bio" name="bio" placeholder="Enter an Overview" style="color: grey">{{ $userProfile->getBio() }}</textarea>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="skills">Skills</label>
						<div class="col-md-12">
							<textarea class="form-control" rows="4" id="skills" name="skills" placeholder="Enter Skills" style="color: grey">{{ $userProfile->getSkills() }}</textarea>
						</div>
					</div>

				</td>
			</tr>
			<tr>
				<td colspan= "2" align="center">
					<div align="center">
						<p style="color: grey; font-size: 10px">To change your user information, visit the settings page.</p>
					</div>
				</td>
			</tr>
			@if(session()->get('currentUser')->getId() == $userProfile->getUserId())
			<tr>
	    		<td colspan= "2" align="center">
		    		<div align="center">
			    		<input type= "submit" value= "Save Changes" class="btn btn-info">
		    		</div>
	    		</td>
			</tr>
			@endif
		</table>
	</form>
		
</div>
<br>
@endsection
