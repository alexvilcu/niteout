<nav class="navbar navbar-expand-lg navbar-dark fixed-top navigation">
      <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">NiteOut</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon stripes"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          @guest
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('index') }}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Sign In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
            </li>
          </ul>
          @else
          <ul class="navbar-nav ml-auto">
            <a class="btn btn-default" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="avatar" style="background-image: url({{ asset(Auth::user()->avatar) }})"></div>
          </a>
            <div class="dropdown show">
                <a class="btn btn-default" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                  {{ Auth::user()->name }}
                </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            Logout
                    </a>
                    <a class="dropdown-item" href="{{ route('locations.create') }}">Add new location</a>
                    <a class="dropdown-item" href="{{ route('users.show', ['slug' => Auth::user()->slug]) }}">Profile</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                    </form>

                </div>
            </div>
          </ul>
          @endguest
        </div>
      </div>
  </nav>