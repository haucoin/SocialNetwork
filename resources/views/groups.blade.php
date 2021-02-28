@extends('layouts.appmaster')
@section('title', 'Social Network: Groups')
@section('content')

<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div style="padding-bottom: 30px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Groups</h2>
	</div>
    <div style="font-size: 13px">
    
    		@if(session()->get('currentUser')->getRole() == 0)
	        	<div align="right">		
	    			<form method="GET" action="addGroup">
						<button type="submit" style="font-size: 10px; border: 0; background-color: transparent">
	                		<i class="material-icons">add_box</i>
	                	</button>
	            	</form>
	            </div>
            @endif
            
            <table class="table table-striped table-hover" >
                <thead>
                    <tr style="text-align: center">
                        <th>#</th>
                        <th>Name</th>		
                        <th>Description</th>					
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                @foreach($groupList as $group)
                	<tr style="text-align: center">
                        <td>{{$group->getId()}}</td>
                        <td>
	                        <form method="POST" action="viewGroup" id="viewGroup{{$group->getId()}}" style="vertical-align: middle">
	                        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
	                        	<input type="hidden" name="groupId" value="{{$group->getId()}}">
	                        	<a style="cursor: pointer" onclick="document.getElementById('viewGroup{{$group->getId()}}').submit();">{{$group->getName()}}</a>
	                        </form>
						</td>
                        <td>{{substr($group->getDescription(), 0, 25)}}...</td>
                        
                        <td>
						@if(session()->get('currentUser')->getRole() == 0)
    						<form method="POST" style="display: inline" action="editGroup">
    							<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    							<input type="hidden" name="groupId" value="{{$group->getId()}}">
    							<button type="submit" title="Edit" style="font-size: 10px; border: 0; background-color: transparent">
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
    					@else
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
						@endif
						</td>
                    </tr>
                @endforeach
            	</tbody>
            </table>
	</div> 
</div>

@endsection