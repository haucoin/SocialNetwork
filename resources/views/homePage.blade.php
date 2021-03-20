@extends('layouts.appmaster')
@section('title', 'Social Network: Home Page')
@section('content')

<div align="center" style="padding-top: 25px">
    <h2>Home Page</h2>
</div>

<table style="width: 70%; align: center; border-spacing: 0.5rem;">
	<tr>
		<td style="padding: 0.5rem; width: 40%">
			<div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05);">
				<div style="padding-bottom: 30px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0; display: flex; justify-content: space-between">
					<h4>Account & Profile</h3>
					<a style="cursor: pointer; color: white" href="profile"><i class="material-icons">arrow_forward</i></a>
				</div>
				<table style="margin-top: 20px">
					<tr>
						<td style="padding-right: 10px">
							<p>Name: </p>
						</td>
						<td>
							<p id="name" name="name" style="color: grey">{{session()->get('currentUser')->getFirstName()}} {{session()->get('currentUser')->getLastName()}}</p>
						</td>
					</tr>
					<tr>
						<td style="padding-right: 10px">
							<p>Username: </p>
						</td>
						<td>
							<p id="username" name="username" style="color: grey">{{session()->get('currentUser')->getUsername()}}</p>
						</td>
					</tr>
					<tr>
						<td style="padding-right: 10px">
							<p>Email: </p>
						</td>
						<td>
							<p id="email" name="email" style="color: grey">{{session()->get('currentUser')->getEmail()}}</p>
						</td>
					</tr>
					<tr>
						<td style="padding-right: 10px">
							<p>City: </p>
						</td>
						<td>
							<p id="city" name="city" style="color: grey">{{$userProfile->getCity()}}</p>
						</td>
					</tr>
					<tr>
						<td style="padding-right: 10px">
							<p>State: </p>
						</td>
						<td>
							<p id="state" name="state" style="color: grey">{{$userProfile->getState()}}</p>
						</td>
					</tr>
					<tr>
						<td style="padding-right: 10px">
							<p>Skills: </p>
						</td>
						<td>
							<p id="skills" name="skills" style="color: grey">{{substr($userProfile->getSkills(), 0, 150)}}</p>
						</td>
					</tr>
					<tr>
						<td style="padding-right: 10px" valign="top">
							<p>Biography: </p>
						</td>
						<td valign="top">
							<p id="bio" name="bio" style="color: grey">{{substr($userProfile->getBio(), 0, 150)}}...</p>
						</td>
					</tr>
				</table>
			</div>
		</td>
		<td style="padding: 0.5rem; width: 60%">
			<div style="font-size: 13px; background: #fff; padding: 10px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 100%">
				<div style="padding-bottom: 30px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0; display: flex; justify-content: space-between">
					<h4>Top Job Postings</h3>
					<a style="cursor: pointer; color: white" href="jobPostings"><i class="material-icons">arrow_forward</i></a>
				</div>
				<form method="GET" action="jobPostings" id="jobPostings">
					<table style="text-align: center; width: 100%; margin-top: 20px">
						<tr>
							<td width="50%">
								<a style="cursor: pointer; font-size: 16px" onclick="document.getElementById('jobPostings').submit();">
									<p>{{substr($postList[0]->getCompanyName(), 0, 75)}}  -  {{substr($postList[0]->getJobTitle(), 0, 75)}}</p>
								</a>
							</td>
	                        <td width="50%"><p style="color: grey">{{$postList[0]->getLocation()}}</p></td>
	                    </tr>
	                    <tr>
							<td width="50%">
								<a style="cursor: pointer; font-size: 16px" onclick="document.getElementById('jobPostings').submit();">
									<p>{{substr($postList[1]->getCompanyName(), 0, 75)}}  -  {{substr($postList[1]->getJobTitle(), 0, 75)}}</p>
								</a>
							</td>
	                        <td><p style="color: grey">{{$postList[1]->getLocation()}}</p></td>
	                    </tr>
	                    <tr>
							<td width="50%">
								<a style="cursor: pointer; font-size: 16px" onclick="document.getElementById('jobPostings').submit();">
									<p>{{substr($postList[2]->getCompanyName(), 0, 75)}}  -  {{substr($postList[2]->getJobTitle(), 0, 75)}}</p>
								</a>
							</td>
	                        <td><p style="color: grey">{{$postList[2]->getLocation()}}</p></td>
	                    </tr>
					</table>
				</form>
			</div>
			<div style="font-size: 13px; background: #fff; padding: 10px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0, 0, 0, .05); width: 100%">
				<div style="padding-bottom: 30px; background: #14A3B8; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0; display: flex; justify-content: space-between">
					<h4>Top Groups</h3>
					<a style="cursor: pointer; color: white" href="groups"><i class="material-icons">arrow_forward</i></a>
				</div>
				<form method="GET" action="groups" id="groups">
					<table style="text-align: center; width: 100%; margin-top: 20px">
						<tr>
							<td width="50%">
								<a style="cursor: pointer; font-size: 16px" onclick="document.getElementById('groups').submit();">
									<p>{{substr($groups[0]->getName(), 0, 50)}}</p>
								</a>
							</td>
	                        <td width="50%"><p style="color: grey">{{substr($groups[0]->getDescription(), 0, 50)}}</p></td>
	                    </tr>
						<tr>
							<td width="50%">
								<a style="cursor: pointer; font-size: 16px" onclick="document.getElementById('groups').submit();">
									<p>{{substr($groups[1]->getName(), 0, 50)}}</p>
								</a>
							</td>
	                        <td width="50%"><p style="color: grey">{{substr($groups[1]->getDescription(), 0, 50)}}</p></td>
	                    </tr>
						<tr>
							<td width="50%">
								<a style="cursor: pointer; font-size: 16px" onclick="document.getElementById('groups').submit();">
									<p>{{substr($groups[2]->getName(), 0, 50)}}</p>
								</a>
							</td>
	                        <td width="50%"><p style="color: grey">{{substr($groups[2]->getDescription(), 0, 50)}}</p></td>
	                    </tr>
					</table>
				</form>
			</div>
		</td>
	</tr>
	

</table>

@endsection