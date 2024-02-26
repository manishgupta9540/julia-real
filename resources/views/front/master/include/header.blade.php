{{-- <style>
  #google_translate_element .goog-te-gadget-simple {
    background-color: #cc1d24;
    border-left: none;
    border-top: none;
    border-bottom: none;
    border-right: none;
    padding-top: 10px;
    padding-bottom: 14px;
    cursor: pointer;
    padding-right: 20px;
    padding-left: 20px;
    font-size: 15px;
    text-transform: uppercase;
    font-weight: 400;
    color: #fff;
    border-radius: initial;
    margin-top: 16px;
}
#google_translate_element .goog-te-gadget-simple a span{
  color: #fff !important; 
  font-weight: 600;
}
.goog-te-gadget-icon{
  display: none;
}
.goog-te-gadget-simple,   #google_translate_element{
  border-radius: 10px !important;
}
iframe{
  width: 223px !important;
  background-color: #fff;
  border: none !important;

}
iframe html body .VIpgJd-ZVi9od-vH1Gmf {
  width: 223px !important;
  background-color: #fff;
  border: 1px solid #6b90da00 !important;

}
html body .VIpgJd-ZVi9od-vH1Gmf {
    background-color: #FFF;
    text-decoration: none;
    border: 1px solid #6b90da00 !important; 
    overflow: hidden;
    padding: 4px;
}
</style> --}}
<header class="header-nav nav-homepage-style at-home3 stricky main-menu">
    <!-- Ace Responsive Menu -->
    <nav class="posr"> 
      <div class="container posr menu_bdrt1">
        <div class="row align-items-center justify-content-between header-julia-row">
          <div class="col-auto col-md-4">
            <div class="d-flex align-items-center justify-content-between">
              <div class="logos mr40 mr10-lg">
                <a class="header-logo logo2" href="{{route('home')}}"><img src="{{asset('front/images/House-for-Sale-logo1.png')}}" alt="Header Logo"></a>
                <a class="header-logo logo1" href="{{route('home')}}"><img src="{{asset('front/images/House-for-Sale-logo1.png')}}" alt="Header Logo"></a>
              </div>
              
            </div>
          </div>
          <div class="col-auto col-md-8">
            <div class="d-flex align-items-center justify-content-end">
              {{-- <a href="{{route('faq')}}" class="faq-ps">FAQ</a> --}}
              <i class="far fa-user-circle fz16 user-icons me-2"></i> 
              @if(Auth::user())
                    {{Auth::user()->name}}
                <div class="dropdown">
                  <button type="button" class="bg-transparent   border-0 dropdown-toggle" data-bs-toggle="dropdown">
                    
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('sell')}}">My Dashboard</a></li>
                    <li><a class="dropdown-item" href="{{route('my-profile')}}">My Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('user.logout')}}">Logout</a></li>
                  </ul>
                </div>
              @else
                <span class="d-none d-xl-block">
                  <a href="javascript:" data-bs-toggle="modal" data-bs-target="#login">Login </a>/ 
                  <a href="javascript:" data-bs-toggle="modal" data-bs-target="#register"> Register</a>
                  {{-- <li id="google_translate_element"></li> --}}
                </span>
              @endif
              <ul>
                <li id="google_translate_element" ></li>
              </ul>
              @if (Auth::check()) 
                <a class="ud-btn btn-thm mx-2 mx-xl-4 sell-btns" href="{{route('sell')}}">SELL<i class="fal fa-arrow-right-long"></i></a>
                <a class="sidemenu-btn filter-btn-right" href="#"><img src="{{asset('front/images/icon/nav-icon-dark.svg')}}" alt=""></a>
              @else
                <a class="ud-btn btn-thm mx-2 mx-xl-4 sell-btns" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#login">SELL<i class="fal fa-arrow-right-long"></i></a>
                {{-- <li id="google_translate_element"></li> --}}
                {{-- <select class="form-select reals-language">
                    <option>Language</option>
                    <option>English</option>
                    <option>Hindi</option>
                    <option>French</option>
                    <option>Spanish</option>
                </select> --}}
                <a class="sidemenu-btn filter-btn-right" href="#"><img src="{{asset('front/images/icon/nav-icon-dark.svg')}}" alt=""></a>
                @endif
               
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <script>

  </script>