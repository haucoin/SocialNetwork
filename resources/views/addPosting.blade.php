@extends('layouts.appmaster') 
@section('title', 'Social Network: Job Posting') 
@section('content')

<div
	style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div
		style="padding-bottom: 15px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Job Posting</h2>
	</div>
	<form method="POST" action="createPost">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
		<table style="width: 100%;">
			<tr>
				<td>
					<h5>New Job Posting Information</h5>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="companyName">Company Name</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="companyName" name="companyName" type="text" placeholder="Enter the Company Name" class="form-control input-md" required>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="jobTitle">Position Title</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="jobTitle" name="jobTitle" type="text" placeholder="Enter the Job Title" class="form-control input-md" required>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="jobDescription">Description</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<textarea class="form-control" rows="8" id="jobDescription" name="jobDescription" placeholder="Enter the Job Description" style="color: grey" required></textarea>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="salary">Salary</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="salary" name="salary" type="number" min="0" max="1000000" step=".01" placeholder="Enter the Salary" class="form-control input-md" required>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="location">Location</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="location" name="location" type="text" placeholder="Enter the Location" class="form-control input-md" required>
							</div>
						</div>
					</div>
				</td>
			</tr>
			
			<tr>
				<td colspan="2" >
					<div align="center">
						<input type="submit" value="Save Changes" class="btn btn-info">
					</div>
				</td>
			</tr>
		</table>
	</form>
</div>
<br>
@endsection
