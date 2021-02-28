@extends('layouts.appmaster')
@section('title', 'Social Network: Group') 
@section('content')

<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div style="padding-bottom: 15px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Edit Group</h2>
	</div>
	<form method="POST" action="updateGroup">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
		<input type="hidden" name="groupId" name="groupId" value="{{$group->getId()}}">
		<table style="width: 100%;">
			<tr>
				<td>
					<h5>Group Information</h5>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="name">Name</label>
						<div class="col-md-12">
							<div class="input-group-prepend">
								<input id="name" name="name" type="text" placeholder="Enter the Name" value="{{ $group->getName() }}" class="form-control input-md" required>
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
								<textarea class="form-control" rows="8" id="description" name="description" placeholder="Enter the Description" style="color: grey" required>{{$group->getDescription()}}</textarea>
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
