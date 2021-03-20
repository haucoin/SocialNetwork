@extends('layouts.appmaster')
@section('title', 'Social Network: Job Postings')
@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
    crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css%22%3E">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js%22%3E"></script>


<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div style="padding-bottom: 30px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Job Postings</h2>
	</div>
    <div style="font-size: 13px">
    
    	 <table style="width: 100%">
    	 	<tr>
	    	 	<td align="left">
		    		<form class="form-inline" method="post" action="searchJobPostings">
		            	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
		            	<input class="form-control mr-sm-2" type="search" name="searchParam" placeholder="Search">
		            	<button class="btn btn-info" style="color: white !important" type="submit">Search</button>
		            </form>
	    		</td>
	    		@if(session()->get('currentUser')->getRole() == 0)	
	    		<td align="right">
	    			<form method="GET" action="addPosting">
						<button type="submit" style="font-size: 10px; border: 0; background-color: transparent">
	                		<i class="material-icons">add_box</i>
	                	</button>
	            	</form>
	            </td>
	            @endif
            </tr>
        </table>

            <table id="postings" class="display table table-striped table-hover" >
                <thead>
                    <tr style="text-align: center">
	                    <th style="padding-bottom: 0">
	                    	<form method="POST" action="sortJobPostings" id="sortById" style="vertical-align: middle">
								<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
	                    	    <input type="hidden" name="sortBy" value="id">
	                    	    @php
	                    	    	$array = base64_encode(serialize($postList))
	                    	    @endphp
	                    	    <input type="hidden" name="postList" value="{{$array}}">
	                    		<a style="cursor: pointer" onclick="document.getElementById('sortById').submit();"># <i class="tiny material-icons">arrow_drop_down</i></a>
	                    	</form>
	                    </th>
	                    <th style="padding-bottom: 0">
	                    	<form method="POST" action="sortJobPostings" id="sortByCompanyName" style="vertical-align: middle">
	                    		<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
	                    	    <input type="hidden" name="sortBy" value="companyName">
		                    	@php
	                    	    	$array = base64_encode(serialize($postList))
	                    	    @endphp
	                    	    <input type="hidden" name="postList" value="{{$array}}">
	                    		<a style="cursor: pointer" onclick="document.getElementById('sortByCompanyName').submit();">Company Name <i class="tiny material-icons">arrow_drop_down</i></a>
	                        </form>	
                        </th>
                        <th style="padding-bottom: 0">
	                        <form method="POST" action="sortJobPostings" id="sortByJobTitle" style="vertical-align: middle">
	                        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
	                    	    <input type="hidden" name="sortBy" value="jobTitle">
	                    	    @php
	                    	    	$array = base64_encode(serialize($postList))
	                    	    @endphp
	                    	    <input type="hidden" name="postList" value="{{$array}}">
	                    		<a style="cursor: pointer" onclick="document.getElementById('sortByJobTitle').submit();">Title <i class="tiny material-icons">arrow_drop_down</i></a>
							</form>
						</th>
						<th style="padding-bottom: 0">
							<form method="POST" action="sortJobPostings" id="sortByLocation" style="vertical-align: middle">
								<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
	                    	    <input type="hidden" name="sortBy" value="location">
	                    	    @php
	                    	    	$array = base64_encode(serialize($postList))
	                    	    @endphp
	                    	    <input type="hidden" name="postList" value="{{$array}}">
	                    		<a style="cursor: pointer" onclick="document.getElementById('sortByLocation').submit();">Location <i class="tiny material-icons">arrow_drop_down</i></a>
							</form>
						</th>
						@if(session()->get('currentUser')->getRole() == 0)
							<th></th>
						@endif
                    </tr>
                </thead>
                <tbody>
    
                @foreach($postList as $post)
                    <tr style="text-align: center">
                        <td>{{$post->getId()}}</td>
                        <td>
                        <form method="POST" action="viewPost" id="viewJob{{$post->getId()}}" style="vertical-align: middle">
                        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                        	<input type="hidden" name="postId" value="{{$post->getId()}}">
                        	<a style="cursor: pointer" onclick="document.getElementById('viewJob{{$post->getId()}}').submit();">{{$post->getCompanyName()}}</a>
                        </form>
                        </td>
                        <td>{{$post->getJobTitle()}}</td>
                        <td>{{$post->getLocation()}}</td>
                        
                        @if(session()->get('currentUser')->getRole() == 0)
						<td>
    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this job posting?')">
    							<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    							<input type="hidden" name="postId" value="{{$post->getId()}}">
    							<button formaction="deletePost" title="Delete" style="font-size: 10px; border: 0; background-color: transparent">
    								<i class="material-icons">clear</i>
    							</button>
    						</form>
						</td>
						@endif
                    </tr>
                @endforeach 
                </tbody>
            </table>
	</div> 
</div>

@endsection