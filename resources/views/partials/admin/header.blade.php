<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="sidebar-collapse-btn" href="javascript:void(0);"  id="sidebarCollapse">
            <i class="fa fa-bars"></i>
        </a>
        <a class="navbar-brand" href="{{ env('APP_URL') }}">
            the.website
        </a>
        {{--
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <svg class="svg-inline--fa fa-align-justify fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="align-justify" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M0 84V44c0-8.837 7.163-16 16-16h416c8.837 0 16 7.163 16 16v40c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16zm16 144h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0-128h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path></svg><!-- <i class="fas fa-align-justify"></i> -->
        </button>
        --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                {{--<li class="nav-item icon-envelope">
                    <a href="#" class="nav-link"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item icon-bell">
                    <a href="#" class="nav-link"><i class="fa fa-bell-o" aria-hidden="true"></i><span class="badge badge-dot badge-danger"> </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link quickview-collapse-btn" href="javascript:void(0);"><i class="fa fa-slack" aria-hidden="true"></i></a>
                </li>--}}

                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button"><span>{{ Auth::user()->name }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </div>
        <div class="mini-panel">
            <a class="nav-link quickview-collapse-btn" href="javascript:void(0);"><i class="fa fa-slack" aria-hidden="true"></i></a>
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <!-- ALERT BLOCKS -->
    @include('partials.admin.alert')
    <!-- /ALERT BLOCKS -->
</nav>
