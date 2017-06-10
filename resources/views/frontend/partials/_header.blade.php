<nav id="navbarx" class="navbar navbar-default">
    <div class="container navbar-container">
        
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="btn btn-link navbar-toggle collapsed" data-toggle="modal" data-target="#menuModal">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand churchBrand" href="{{ url('/') }}">
                {{ $setting->church_name }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="{{ isActiveURL('login') }}">
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="{{ isActiveURL('/register') }}">
                        <a href="{{ route('register') }}">Register</a>
                    </li>
                @elseif (Auth::check())
                    @if( Auth::user()->subscriptionStatus === null )

                        <li class="{{ isActiveURL('/user/upgrade') }}">
                            <a href="{{ route('upgradeAccount') }}">Upgrade</a>
                        </li>
                        
                    @endif
                    @if( Auth::user()->subscriptionStatus === "active" )
                        
                    @endif
                    @if( Auth::user()->subscriptionStatus === "cancelled" )

                        <li class="{{ isActiveURL('/user/premium/renew') }}">
                            <a href="{{ route('reactivateSubscription') }}" onclick="event.preventDefault();
                                document.getElementById('reactivate-form').submit();"> Reactivate
                            </a>
                            <form id="reactivate-form" action="{{ route('reactivateSubscription') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        
                    @endif
                    <li class="{{ isActiveURL('/sermons') }}">
                        <a href="{{ route('allSermons') }}">Sermons</a>
                    </li>
                    <li class="{{ isActiveURL('/sermons/favourites') }}">
                        <a href="{{ route('viewFavourite') }}">My Favourites</a>
                    </li> 
                    <li class="{{ isActiveURL('/user/profile') }}">
                        <a href="{{ route('profile') }}">My Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">Logout</a>
                    </li>                  
                @endif
            </ul>

        </div>


        {{-- start --}}

        <div class="modal fade fullscreen" id="menuModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" >
                    <div class="modal-header">
                            <button type="button" class="close btn btn-link" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close fa-lg" style="color:#999;"></i></button> 
                            <h4 class="modal-title text-center"><span class="sr-only">main navigation</span></h4>
                    </div>
                    <div class="modal-body text-center">
                        <ul class="uk-list">
                            @if (Auth::guest())
                                <li class="{{ isActiveURL('/login') }}">
                                    <a href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="{{ isActiveURL('/register') }}">
                                    <a href="{{ route('register') }}">Register</a>
                                </li>
                            @elseif (Auth::check())
                                <li class="{{ isActiveURL('/sermons') }}">
                                    <a href="{{ route('allSermons') }}">Sermons</a>
                                </li>
                                <li class="{{ isActiveURL('/sermons/myfavourites') }}">
                                    <a href="{{ route('viewFavourite') }}">My Favourites</a>
                                </li>
                                <li class="{{ isActiveURL('/user/profile') }}">
                                    <a href="{{ route('profile') }}">My Profile</a>
                                </li> 
                                <li>
                                    <a href="{{ route('logout') }}">Logout</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.fullscreen -->

        {{-- end --}}

    </div>
</nav>
