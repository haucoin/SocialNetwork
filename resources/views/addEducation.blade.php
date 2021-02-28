@extends('layouts.appmaster') 
@section('title', 'Social Network: Education')
@section('content')

<div
	style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div
		style="padding-bottom: 15px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Education</h2>
	</div>
	<form method="POST" action="createEducation">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
		<table style="width: 100%;">
			<tr>
				<td>
					<h5>New Education Information</h5>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="school">School</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="school" name="school" type="text" placeholder="Enter the School Name" class="form-control input-md" required>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="lastName">Degree</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<select id="degree" name="degree" class="form-control" style="color: grey">
										<option selected="selected" value="-">-</option>
										<option value="Associate">Associate</option>
										<option value="Bachelors">Bachelors</option>
										<option value="Masters">Masters</option>
										<option value="Doctorate">Doctorate</option>
								</select>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="fieldOfStudy">Field of Study</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="fieldOfStudy" name="fieldOfStudy" type="text" placeholder="Enter the Field of Study" class="form-control input-md" required>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="graduationYear">Graduation Year</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="graduationYear" name="graduationYear" type="number" min="1900" max="2030" placeholder="Enter the Graduation Year" class="form-control input-md" required>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="gpa">GPA</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="gpa" name="gpa" type="number" min="0" max="5" step="any" placeholder="Enter the GPA" class="form-control input-md" required>
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
