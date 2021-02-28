@extends('layouts.appmaster')
@section('title', 'Social Network: Job Posting') 
@section('content')

<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div style="padding-bottom: 15px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Job Posting</h2>
	</div>
		<table style="width: 100%;">
			<tr>
				<td>
					<h5>Job Posting Information</h5>
				</td>
				@if(session()->get('currentUser')->getRole() == 0)
				<td align="right">
					<form method="POST" action="editPost">
						<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
						<input type="hidden" name="postId" name="postId" value="{{$post->getId()}}">
						<button type="submit" style="font-size: 10px; border: 0; background-color: transparent">
	                    	<i class="material-icons">edit</i>
	                   	</button>
	                </form>
				</td>
				@endif
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="companyName">Company Name</label>
						<div class="col-md-12">
							<p id="companyName" name="companyName" style="color: grey">{{$post->getCompanyName()}}</p>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="jobTitle">Position Title</label>
						<div class="col-md-12">
							<p id="jobTitle" name="jobTitle" style="color: grey">{{$post->getJobTitle()}}</p>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="jobDescription">Description</label>
						<div class="col-md-12">
							<textarea disabled class="form-control" rows="8" id="jobDescription" name="jobDescription" style="color: grey">{{$post->getJobDescription()}}</textarea>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="salary">Salary</label>
						<div class="col-md-12">
							<p id="salary" name="salary" style="color: grey">${{$post->getSalary()}}</p>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="location">Location</label>
						<div class="col-md-12">
							<p id="location" name="location" style="color: grey">{{$post->getLocation()}}</p>
						</div>
					</div>
				</td>
			</tr>
		</table>
</div>
<br>
@endsection
