@extends('layouts.appmaster')
@section('title', 'Social Network: Job Postings')

@section('content')

<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 70%">
	<div style="padding-bottom: 30px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
		<h2>Job Postings</h2>
	</div>
    <div style="font-size: 13px">

            <table class="table table-striped table-hover" >
                <thead>
                    <tr style="text-align: center">
                        <th>#</th>
                        <th>Company Name</th>						
						<th>Title</th>
						<th>Location</th>
                    </tr>
                </thead>
                <tbody>
    
                @foreach($postList as $post)
                    <tr style="text-align: center">
                        <td>{{$post->getId()}}</td>
                        <td>
                        <form method="POST" action="viewPosting" id="viewJob{{$post->getId()}}" style="vertical-align: middle">
                        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                        	<input type="hidden" name="postId" value="{{$post->getId()}}">
                        	<a style="cursor: pointer" onclick="document.getElementById('viewJob{{$post->getId()}}').submit();">{{$post->getCompanyName()}}</a>
                        </form>
                        </td>
                        <td>{{$post->getJobTitle()}}</td>
                        <td>{{$post->getLocation()}}</td>
                    </tr>
                  @endforeach 
                </tbody>
            </table>
	</div> 
</div>

@endsection