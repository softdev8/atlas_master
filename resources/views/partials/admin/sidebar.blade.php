<nav id="sidebar">
    <div class="sidebar-header">
        <span class="admin-title"><a href="/admin">the.admin</a></span>
    </div>

    <ul class="list-unstyled components">
        <!--<p>Dummy Heading</p>-->

        @can('AccessToAdminSidebar')
        <li>
            <a href="{{ url('/admin/users ') }}">
                @if(isset($reports_counter))
                    @if($reports_counter != 0)
                        <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                    @endif
                @endif
                <span>Users</span>
                <span class="icon-thumbnail">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </span>
            </a>
        </li>

        <li>
            <a href="{{ url('/admin/companies ') }}">
                @if(isset($reports_counter))
                    @if($reports_counter != 0)
                        <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                    @endif
                @endif
                <span>Companies</span>
                <span class="icon-thumbnail">
                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                </span>
            </a>
        </li>

        <li>
            <a href="{{ url('/admin/roles ') }}">
                @if(isset($reports_counter))
                    @if($reports_counter != 0)
                        <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                    @endif
                @endif
                <span>Roles</span>
                <span class="icon-thumbnail">
                    <i class="fa fa-shield" aria-hidden="true"></i>
                </span>
            </a>
        </li>

        <li>
            <a href="#regionsSubmenu" data-toggle="collapse" aria-expanded="false">Regions</a>
            <ul class="collapse list-unstyled submenu" id="regionsSubmenu">

                <li>
                    <a href="{{ url('/admin/countries') }}">
                        @if(isset($reports_counter))
                            @if($reports_counter != 0)
                                <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                            @endif
                        @endif
                        <span>Countries</span>
                        <span class="icon-thumbnail">
                            <i class="fa fa-globe" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/regions') }}">
                        @if(isset($reports_counter))
                            @if($reports_counter != 0)
                                <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                            @endif
                        @endif
                        <span>Regions</span>
                        <span class="icon-thumbnail">
                            <i class="fa fa-map-signs" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/cities ') }}">
                        @if(isset($reports_counter))
                            @if($reports_counter != 0)
                                <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                            @endif
                        @endif
                        <span>Cities</span>
                        <span class="icon-thumbnail">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#filtersSubmenu" data-toggle="collapse" aria-expanded="false">Filters</a>
            <ul class="collapse list-unstyled submenu" id="filtersSubmenu">

                <li>
                    <a href="{{ url('/admin/practices') }}">
                        @if(isset($reports_counter))
                            @if($reports_counter != 0)
                                <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                            @endif
                        @endif
                        <span>Practice Areas</span>
                        <span class="icon-thumbnail">
                            <i class="fa fa-balance-scale" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/specialisms') }}">
                        @if(isset($reports_counter))
                            @if($reports_counter != 0)
                                <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                            @endif
                        @endif
                        <span>Specialisms</span>
                        <span class="icon-thumbnail">
                            <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/subs') }}">
                        @if(isset($reports_counter))
                            @if($reports_counter != 0)
                                <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                            @endif
                        @endif
                        <span>Sub Specialisms</span>
                        <span class="icon-thumbnail">
                            <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/admin/types ') }}">
                        @if(isset($reports_counter))
                            @if($reports_counter != 0)
                                <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                            @endif
                        @endif
                        <span>Firm Types & Rankings</span>
                        <span class="icon-thumbnail">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/pqes') }}">
                        @if(isset($reports_counter))
                            @if($reports_counter != 0)
                                <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                            @endif
                        @endif
                        <span>PQE Levels</span>
                        <span class="icon-thumbnail">
                            <i class="fa fa-area-chart" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </li>

        <hr>

        <li>
            <a href="{{ url('/admin/firms ') }}">
                @if(isset($reports_counter))
                    @if($reports_counter != 0)
                        <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                    @endif
                @endif
                <span>Firms </span>
                <span class="icon-thumbnail">
                    <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                </span>
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/candidates') }}">
                @if(isset($reports_counter))
                    @if($reports_counter != 0)
                        <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                    @endif
                @endif
                <span>Candidates</span>
                <span class="icon-thumbnail">
                    <i class="fa fa-handshake-o" aria-hidden="true"></i>
                </span>
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/searches ') }}">
                @if(isset($reports_counter))
                    @if($reports_counter != 0)
                        <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                    @endif
                @endif
                <span>Searches </span>
                <span class="icon-thumbnail">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </span>
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/searches ') }}">
                @if(isset($reports_counter))
                    @if($reports_counter != 0)
                        <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                    @endif
                @endif
                <span>Projects </span>
                <span class="icon-thumbnail">
                    <i class="fa fa-folder" aria-hidden="true"></i>
                </span>
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/reports ') }}">
                @if(isset($reports_counter))
                    @if($reports_counter != 0)
                        <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                    @endif
                @endif
                <span>Report </span>
                <span class="icon-thumbnail">
                    <i class="fa fa-bug" aria-hidden="true"></i>
                </span>
            </a>
        </li>

        <li>
            <a href="{{ url('/admin/tools') }}">
                @if(isset($reports_counter))
                    @if($reports_counter != 0)
                        <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                    @endif
                @endif
                <span>Export Tools</span>
                <span class="icon-thumbnail">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                </span>
            </a>
        </li>

        @endcan

        <li>
            <a href="{{ url('/admin/activity_logs') }}">
                @if(isset($reports_counter))
                    @if($reports_counter != 0)
                        <span class="badge badge-pill badge-danger">{{ $reports_counter }}</span>
                    @endif
                @endif
                <span>Activity Logs</span>
                <span class="icon-thumbnail">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                </span>
            </a>
        </li>
    </ul>
</nav>


@push('scripts')

@endpush