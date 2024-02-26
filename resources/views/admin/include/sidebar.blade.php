<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <img class="w-100" src="{{asset('admin/image/House-for-Sale-logo1.png')}}" style="max-width: 100px;
            margin-top: -8px;" alt="">
            <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="{{asset('admin/image/House-for-Sale-logo1.png')}}"></use>
            </svg>
            <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="{{asset('admin/image/House-for-Sale-logo1.png')}}"></use>
            </svg>
    </div>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg> Dashboard
            </a>
        </li>

           
        {{-- <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                </svg> User Management
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('roles.index')}}"><span class="nav-icon"></span>
                        Manage Role</a>
                    </li>
            </ul>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user-roles.index')}}"><span class="nav-icon"></span>
                        Manage User</a>
                    </li>
            </ul>
        </li> --}}

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Customer Management
                </a>
            </li>
        </ul>

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('banners.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Banner Management
                </a>
            </li>
        </ul>
        
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('blogs.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Blog Management
                </a>
            </li>
        </ul>

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('categoryes.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Category Management
                </a>
            </li>
        </ul>

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('aminities.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Amenities Management
                </a>
            </li>
        </ul>

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('property.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Property Management
                </a>
            </li>
        </ul>

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('cms.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Cms Management
                </a>
            </li>
        </ul>

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('contact.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Contact Management
                </a>
            </li>
        </ul>

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('about-listing')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> About Management
                </a>
            </li>
        </ul>

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('faq.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> FAQs Management
                </a>
            </li>
        </ul>

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('oure-pertner.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Our Partner Management
                </a>
            </li>
        </ul>

        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('cities.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Cities Management
                </a>
            </li>
        </ul>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('why-choose.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Why Choose Management
                </a>
            </li>
        </ul>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('find-sell.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg>Find Selling Management
                </a>
            </li>
        </ul>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('address.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg>Address Management
                </a>
            </li>
        </ul>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('package.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg>Package Management
                </a>
            </li>
        </ul>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('howwork.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg>How Does It Works
                </a>
            </li>
        </ul>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('userspackage.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg>User package listing
                </a>
            </li>
        </ul>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="{{route('getyourdream.index')}}"><span class="nav-icon"></span>
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg>Get Your Dream
                </a>
            </li>
        </ul>
        {{-- <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                </svg> FAQ Management
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('faq.index')}}"><span class="nav-icon"></span>
                        FAQS Selling</a>
                    </li>
            </ul>
            {{-- <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('faq-rent.index')}}"><span class="nav-icon"></span>
                        FAQS Rent</a>
                    </li>
            </ul> 
        </li> --}}
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                </svg>
            </button><a class="header-brand d-md-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="assets/brand/coreui.svg#full"></use>
                </svg></a>
            <ul class="header-nav d-none d-md-flex">
                <li class="nav-item"><a class="nav-link" href="{{route('admin.dashboard')}}">Dashboard</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Settings</a></li> --}}
            </ul>
            <ul class="header-nav ms-auto">
               
            </ul>
            <ul class="header-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link py-0" data-coreui-toggle="dropdown"
                        href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-md">
                            
                            <img class="avatar-img" src="{{ asset('admin/assets/img/avatars/8.jpg') }}" alt="user@email.com">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <div class="dropdown-header bg-light py-2">
                            <div class="fw-semibold">Settings</div>
                        </div>
                       
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item">
                                <svg class="icon me-2"></svg> 
                                {{ucfirst(Auth::user()->name)}}
                            </a>
                            <a class="dropdown-item" href="{{url('admin/logout')}}">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                                </svg> Logout
                            </a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="header-divider"></div>
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item">
                        <!-- if breadcrumb is single--><span>Home</span>
                    </li>
                    <li class="breadcrumb-item active"><span>Dashboard</span></li>
                </ol>
            </nav>
        </div>
    </header>