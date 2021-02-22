@extends('layouts.appmaster')
@section('title', 'Social Network: Admin')

@section('content')

<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div style="padding-bottom: 30px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>User Management</h2>
	</div>
    <div style="font-size: 13px">

            <table class="table table-striped table-hover" >
                <thead>
                    <tr style="text-align: center">
                        <th>#</th>
                        <th>Name</th>						
						<th>Username</th>
						<th>Role</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($userList as $user)
                    <tr style="text-align: center">
                        <td>{{$user->getId()}}</td>
                        <td>
                        <form method="POST" action="adminViewUser" id="userProfileForm{{$user->getId()}}" style="vertical-align: middle">
                        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                        	<input type="hidden" name="userId" value="{{$user->getId()}}">
                        	<a style="cursor: pointer" onclick="document.getElementById('userProfileForm{{$user->getId()}}').submit();">{{$user->getFirstName()}}</a>
                        </form>
                        </td>
                        <td>{{$user->getUsername()}}</td>
                        @if($user->getRole() == 0)                        
                        	<td>Admin</td>
                        @else
                        	<td>User</td>
                    	@endif
                    	@if($user->getActive())
							<td><span class="status text-success">&bull;</span> Active</td>
						@else
							<td><span class="status text-danger">&bull;</span> Suspended</td>
						@endif
						<td>
						@if(session()->get('currentUser')->getId() != $user->getId())
    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to change the active status of this user?')">
    							<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    							<input type="hidden" name="userId" value="{{$user->getId()}}">
    							<button formaction="suspendUser" title="Pause" style="font-size: 10px; border: 0; background-color: transparent">
    							    <i class="material-icons">do_not_disturb</i>
    							</button>
    						</form>
    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?')">
    							<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    							<input type="hidden" name="userId" value="{{$user->getId()}}">
    							<button formaction="deleteUser" title="Delete" style="font-size: 10px; border: 0; background-color: transparent">
    								<i class="material-icons">remove_circle</i>
    							</button>
    						</form>
						@endif
						</td>
                    </tr>
                  @endforeach 
                </tbody>
            </table>
	</div> 
</div>

@endsection