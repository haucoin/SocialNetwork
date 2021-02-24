@extends('layouts.appmaster') @section('title', 'Social Network:
Profile') @section('content')
<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div style="padding-bottom: 30px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Profile</h2>
	</div>
	<form method="POST" action="editProfilePage">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
		<input type="hidden" name="userId" name="userId" value="{{$userProfile->getUserId()}}">
		<table style="width: 100%;">
			<tr>
				<td width="50%">
					<h5>User Information</h5>
				</td>
				<td width="50%">
					<h5>Contact Information</h5>
				</td>
				<td align="right" width="5px">
					@if(session()->get('currentUser')->getId() == $userProfile->getUserId())
						<button type="submit" style="font-size: 10px; border: 0; background-color: transparent">
                    		<i class="material-icons">edit</i>
                    	</button>
                	@endif
				</td>
			</tr>
			<tr>
				<td>
					<!-- Name -->
					<div class="col-md-6">
						<p id="name" name="name" style="color: grey">{{session()->get('currentUser')->getFirstName()}} {{session()->get('currentUser')->getLastName()}}</p>
					</div>
				</td>
				<td>
					<!-- Phone Number -->
					<div class="col-md-6">
						<p id="phoneNumber" name="phoneNumber" style="color: grey">{{session()->get('currentUser')->getPhoneNumber()}}</p>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<!-- Username -->
					<div class="col-md-6">
						@if($userProfile->getCity() == "" && $userProfile->getState() == "")
							<p style="color: grey">No location listed.</p>
						@else
							<p id="location" name="location" style="color: grey">{{$userProfile->getCity()}}, {{$userProfile->getState()}}</p>
						@endif
					</div>
				</td>
				<td>
					<!-- Email Address -->
					<div class="col-md-6">
						<p id="email" name="email" style="color: grey">{{session()->get('currentUser')->getEmail()}}</p>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div class="form-group">
						<label class="col-md-12 control-label" for="bio">Overview</label>
						<div class="col-md-12">
							@if($userProfile->getBio() == "")
								<textarea disabled class="form-control" rows="8" style="color: grey">No overview listed.</textarea>
							@else
								<textarea disabled class="form-control" rows="8" id="bio" name="bio" style="color: grey">{{ $userProfile->getBio() }}</textarea>
							@endif
						</div>
					</div>

				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div class="form-group">
						<label class="col-md-12 control-label" for="skills">Skills</label>
						<div class="col-md-12">
							@if($userProfile->getSkills() == "")
								<p style="color: grey">No skills listed.</p>
							@else
								<p id="skills" name="skills" style="color: grey">{{ $userProfile->getSkills() }}</p>
							@endif
						</div>
					</div>

				</td>
			</tr>
		</table>
	</form>
		
		<hr /><br />
		
		<table style="width: 100%;">
		
			<td style="width: 50%; vertical-align: top; padding-right: 15px">
				<!-- Education History table -->
				<table style="width: 100%; padding-right: 5px">
					<tr>
						<td>
							<h5>Education History</h5>
							<br/>
						</td>
						<td align="right" width="5px">
							@if(session()->get('currentUser')->getId() == $userProfile->getUserId())
								<form method="GET" action="addEducation">
									<button type="submit" style="font-size: 10px; border: 0; background-color: transparent">
			                    		<i class="material-icons">add_box</i>
			                    	</button>
			                    </form>
	                		@endif
						</td>
					</tr>
					@if($educationHistory == null)
						<tr>
							<td>
								<p style="color: grey">No education history listed.</p>
							</td>
						</tr>
					@else
						@foreach($educationHistory as $education)
						<tr>
							<td>
								<p id="school" name="school" style="color: grey"><b style="color: black">School:  </b>{{$education->getSchool()}}</p>
								<p id="degree" name="degree" style="color: grey"><b style="color: black">Degree:  </b>{{$education->getDegree()}}</p>
								<p id="fieldOfStudy" name="fieldOfStudy" style="color: grey"><b style="color: black">Field of Study:  </b>{{$education->getFieldOfStudy()}}</p>
								<p id="graduationYear" name="graduationYear" style="color: grey"><b style="color: black">Graduation Year:  </b>{{$education->getGraduationYear()}}</p>
								<p id="gpa" name="gpa" style="color: grey"><b style="color: black">GPA:  </b>{{$education->getGpa()}}</p>
								<br/>
								<br/>
							</td>
							<td style="vertical-align: top;">
	    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this job posting?')">
    								<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    								<input type="hidden" name="educationId" value="{{$education->getId()}}">
	    							<button formaction="deleteEducation" title="Delete" style="font-size: 10px; border: 0; background-color: transparent">
	    								<i class="material-icons">clear</i>
	    							</button>
	    						</form>
							</td>
						</tr>
						@endforeach
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
							<br/>
						</td>
						<td align="right" width="5px">
							@if(session()->get('currentUser')->getId() == $userProfile->getUserId())
								<form method="GET" action="addJob">
									<button type="submit" style="font-size: 10px; border: 0; background-color: transparent">
			                    		<i class="material-icons">add_box</i>
			                    	</button>
			                    </form>
		                	@endif
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
									<p id="title" name="title" style="color: grey"><b style="color: black">Position:  </b>{{$job->getTitle()}}</p>
									<p id="description" name="description" style="color: grey"><b style="color: black">Description:  </b>{{$job->getDescription()}}</p>
									<p id="company" name="company" style="color: grey"><b style="color: black">Company:  </b>{{$job->getCompany()}}</p>
									<p id="location" name="location" style="color: grey"><b style="color: black">Location:  </b>{{$job->getLocation()}}</p>
									<p id="startDate" name="startDate" style="color: grey"><b style="color: black">Start Date:  </b>{{$job->getStartDate()}}</p>
									@if($job->getEndDate() == null)
										<p id="startDate" name="startDate" style="color: grey"><b style="color: black">End Date:  </b>Present</p>
									@else
										<p id="startDate" name="startDate" style="color: grey"><b style="color: black">End Date:  </b>{{$job->getEndDate()}}</p>
									@endif
									<br/>
									<br/>
								</td>
								<td style="vertical-align: top;">
		    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this job?')">
		    								<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    										<input type="hidden" name="jobId" value="{{$job->getId()}}">
		    							<button formaction="deleteJob" title="Delete" style="font-size: 10px; border: 0; background-color: transparent">
		    								<i class="material-icons">clear</i>
		    							</button>
		    						</form>
								</td>
							</tr>
							@endforeach
						@endif
					</tr>
				</table>
			
			</td>

			
			
		</table>
</div>
<br>
@endsection
