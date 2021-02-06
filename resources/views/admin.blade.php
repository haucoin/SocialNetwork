@extends('layouts.appmaster')
@section('title', 'Social Network: Admin')

@section('content')
<link rel="stylesheet" href="resources/style/adminPage.css">
<br>
    <div class="container" style="font-size: 13px">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>User <b>Management</b></h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr style="text-align: center">
                        <th>#</th>
                        <th>Name</th>						
						<th>Username</th>
						<th>Role</th>
                        <th>Status</th>
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
                        <td>{{$user->getUserName()}}</td>
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
    							<button formaction="suspendUser" class="pause" title="Pause" data-toggle="tooltip">-</button>
    						</form>
    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?')">
    							<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    							<input type="hidden" name="userId" value="{{$user->getId()}}">
    							<button formaction="deleteUser" class="delete" title="Delete" data-toggle="tooltip">X</button>
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