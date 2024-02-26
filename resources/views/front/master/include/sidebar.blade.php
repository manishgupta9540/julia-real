<div class="dashboard__sidebar d-none d-lg-block">
  <div class="dashboard_sidebar_list">
    <p class="fz15 fw400 ff-heading mt30">MANAGE LISTINGS</p>
    <div class="sidebar_list_item ">
      <a href="{{route('sell')}}" class="items-center {{ request()->is('sell*') ? '-is-active' : '' }}"><i class="flaticon-new-tab mr15"></i>Add New Property</a>
    </div>
    <div class="sidebar_list_item ">
      <a href="{{route('my-property')}}" class="items-center {{ request()->is('my-property*') ? '-is-active' : '' }}"><i class="flaticon-home mr15"></i>My Properties</a>
    </div>
    <div class="sidebar_list_item ">
      <a href="{{route('my-favorites')}}" class="items-center {{ request()->is('my-favorites*') ? '-is-active' : '' }}"><i class="flaticon-like mr15"></i>My Favorites</a>
    </div>
    <div class="sidebar_list_item ">
      <a href="{{route('advertisment-list')}}" class="items-center"><i class="flaticon-search-2 mr15"></i>Advertisement</a>
    </div>
   
    <p class="fz15 fw400 ff-heading mt30">MANAGE ACCOUNT</p>
    
    <div class="sidebar_list_item ">
      <a href="{{route('my-profile')}}" class="items-center {{ request()->is('my-profile*') ? '-is-active' : '' }}"><i class="flaticon-user mr15"></i>My Profile</a>
    </div>
    <div class="sidebar_list_item ">
      <a href="{{route('my-account')}}" class="items-center {{ request()->is('my-account*') ? '-is-active' : '' }}"><i class="flaticon-user mr15"></i>Change Password</a>
    </div>
    <div class="sidebar_list_item ">
      <a href="{{route('user.logout')}}" class="items-center "><i class="flaticon-logout mr15"></i>Logout</a>
    </div>
  </div>
</div>