@if(session()->has('currentUser'))
	@if(session()->get('currentUser')->getRole() == 0)
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="home">Social Network</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            	<span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                    	<a class="nav-link" href="profile">Profile <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                    	<a class="nav-link" href="admin">Admin<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                    	<a class="nav-link" href="logout">Logout <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
	@else
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="home">Social Network</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            	<span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                    	<a class="nav-link" href="profile">Profile <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                    	<a class="nav-link" href="logout">Logout <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    @endif
@else
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="/SocialNetwork">Social Network</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="login">Login <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="registration">Registration <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>
@endif