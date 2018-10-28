<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        @if (Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset("img/users/unknown.png") }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Guest</p>
                    <a href="#"><i class="fa fa-circle text-danger"></i> Offline</a>
                </div>
            </div>
        @else
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset("bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <search-component></search-component>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li id="auction">
                    <a href="{{ url('/')  }}">
                        <i class="fa fa-home"></i> <span>Home</span>
                    </a>
                </li>
                <li id="dashboard">
                    <a href="{{ url('dashboard')  }}">
                        <i class="fa fa-chart-bar"></i> <span>Dashboard</span>
                    </a>
                </li>
                @can('view_products')
                    <li id="products">
                        <a href="{{ url('products')  }}">
                            <i class="fa fa-paragraph"></i> <span>Products</span>
                        </a>
                    </li>
                @endcan
                @can('view_users')
                <li id="users">
                    <a href="{{ url('users')  }}">
                        <i class="fa fa-user"></i> <span>Users</span>
                    </a>
                </li>
                @endcan
                @can('view_roles')
                <li id="roles">
                    <a href="{{ url('roles')  }}">
                        <i class="fa fa-lock"></i> <span>Roles & Permissions</span>
                    </a>
                </li>
                @endcan

            </ul>

            <category-component />

        @endif

    </section>
    <!-- /.sidebar -->
</aside>
