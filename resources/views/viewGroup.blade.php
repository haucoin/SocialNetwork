@extends('layouts.appmaster')
@section('title', 'Social Network: Group')
@section('content')

<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div style="padding-bottom: 15px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Group</h2>
	</div>
		<table style="width: 100%;">
			<tr>
				<td>
					<h5>Group Information</h5>
				</td>
				@if(session()->get('currentUser')->getRole() == 0)
				<td align="right">
					<form method="POST" style="display: inline" action="editGroup">
						<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
						<input type="hidden" name="groupId" name="groupId" value="{{$group->getId()}}">
						<button type="submit" style="font-size: 10px; border: 0; background-color: transparent">
	                    	<i class="material-icons">edit</i>
	                   	</button>
	                </form>
	                <form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this group?')">
    					<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    					<input type="hidden" name="groupId" value="{{$group->getId()}}">
    					<button formaction="deleteGroup" title="Delete" style="font-size: 10px; border: 0; background-color: transparent">
    						<i class="material-icons">close</i>
    					</button>
    				</form>
    			</td>
    			@else
    			<td align="right">
    				@if(in_array($group->getId(), $myGroups))
						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to leave this group?')">
	    					<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
	    					<input type="hidden" name="groupId" value="{{$group->getId()}}">
	    					<button formaction="leaveGroup" title="Leave" style="font-size: 10px; border: 0; background-color: transparent">
	    						<i class="material-icons">clear</i>
	    					</button>
	    				</form>
    				@else
	    				<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to join this group?')">
	    					<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
	    					<input type="hidden" name="groupId" value="{{$group->getId()}}">
	    					<button formaction="joinGroup" title="Join" style="font-size: 10px; border: 0; background-color: transparent">
	    						<i class="material-icons">check</i>
	    					</button>
	    				</form>
    				@endif
    			</td>
				@endif
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="col-md-12 control-label" for="name">Name</label>
						<div class="col-md-12">
							<p id="name" name="name" style="color: grey">{{$group->getName()}}</p>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="description">Description</label>
						<div class="col-md-12">
							<textarea disabled class="form-control" rows="8" id="description" name="description" style="color: grey">{{$group->getDescription()}}</textarea>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<label class="col-md-12 control-label" for="users">Users</label>
						<div class="col-md-12">
							<p id="name" name="name" style="color: grey">{{$users}}</p>
						</div>
					</div>
				</td>
			</tr>
		</table>
</div>
<br>
@endsection
