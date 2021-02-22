@extends('layouts.appmaster') @section('title', 'Social Network:
Job') @section('content')
<div
	style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div
		style="padding-bottom: 15px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Job</h2>
	</div>
	<form method="POST" action="addUserJob">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
		<table style="width: 100%;">
			<tr>
				<td>
					<h5>New Job Information</h5>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="title">Title</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="title" name="title" type="text" placeholder="Enter the Job Title" class="form-control input-md" required>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="description">Description</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<textarea class="form-control" rows="8" id="description" name="description" placeholder="Enter the Job Description" style="color: grey" required></textarea>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="company">Company</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="company" name="company" type="text" placeholder="Enter the Company Name" class="form-control input-md" required>
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
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="startDate">Start Date</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="startDate" name="startDate" type="date" class="form-control input-md" required>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="endDate">End Date</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="endDate" name="endDate" type="date" class="form-control input-md">
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
