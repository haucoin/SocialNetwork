@if(session()->has('currentUser'))
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	    <a class="navbar-brand" href="home"><img src="resources/logo.png" alt="logo" width="220px" style="padding: 8px" /></a>-->
	    <!--<a class="navbar-brand" href="home"><img src="https://cst256-socialnetwork.scm.azurewebsites.net/api/vfs/site/wwwroot/SocialNetwork/resources/logo.png" alt="logo" width="220px" style="padding: 8px"/></a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        	<span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02" >
        	<ul class="navbar-nav mr-auto mt-2 mt-lg-8">
            	<li class="nav-item active">
                	<a class="nav-link" href="profile">Profile</a>
                </li>
                @if(session()->get('currentUser')->getRole() == 0)
                <li class="nav-item active">
                    <a class="nav-link" href="manageUserAccounts">Users</a>
                </li>
                @endif
                <li class="nav-item active">
                	<a class="nav-link" href="jobPostings">Job Postings</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="groups">Groups</a>
                </li>
                <li class="nav-item active">
                	<a class="nav-link" href="settings">Settings</a>
                </li>
                <li class="nav-item active">
                	<a class="nav-link" href="logout">Logout</a>
                </li>
            </ul>
        </div>
	</nav>
@else
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
		<a class="navbar-brand" href="/SocialNetwork"><img src="resources/logo.png" alt="logo" width="220px" style="padding: 8px"/></a>
		<!--<a class="navbar-brand" href="/"><img src="https://cst256-socialnetwork.scm.azurewebsites.net/api/vfs/site/wwwroot/SocialNetwork/resources/logo.png" alt="logo" width="220px" style="padding: 8px"/></a> -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        	<span class="navbar-toggler-icon"></span>
      	</button>
      	<div class="collapse navbar-collapse" id="navbarTogglerDemo02" style="display: flex">
        	<ul class="navbar-nav mr-auto mt-2 mt-lg-8">
          		<li class="nav-item active">
            		<a class="nav-link" href="login">Login</a>
          		</li>
          		<li class="nav-item active">
            		<a class="nav-link" href="registration">Registration</a>
          		</li>
        	</ul>
      	</div>
    </nav>
@endif