@extends('front.master.index')

@section('content')
@include('front.master.include.common_sidebar')
<div class="dashboard_content_wrapper">
    @include('front.master.include.sidebar')
<div class="dashboard__main pl0-md">
        <div class="dashboard__content property-page bgc-f7">
          <div class="row pb40 d-block d-lg-none">
            <div class="col-lg-12">
              <div class="dashboard_navigationbar">
                <div class="dropdown">
                  <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i> Dashboard Navigation</button>
                  <ul id="myDropdown" class="dropdown-content">
                    <li><a href="#"><i class="flaticon-discovery mr10"></i>Dashboard</a></li>
                    
                    <li><p class="fz15 fw400 ff-heading mt30 pl30">MANAGE LISTINGS</p></li>
                    <li class="active"><a href="#"><i class="flaticon-new-tab mr10"></i>Add New Property</a></li>
                    <li><a href="#"><i class="flaticon-home mr10"></i>My Properties</a></li>
                    <li><a href="#"><i class="flaticon-like mr10"></i>My Favorites</a></li>
                    <li><a href="#"><i class="flaticon-search-2 mr10"></i>Saved Search</a></li>
                    <li><a href="#"><i class="flaticon-review mr10"></i>Reviews</a></li>
                    <li><p class="fz15 fw400 ff-heading mt30 pl30">MANAGE ACCOUNT</p></li>
                    <li><a href="#"><i class="flaticon-protection mr10"></i>My Package</a></li>
                    <li><a href="#"><i class="flaticon-user mr10"></i>My Profile</a></li>
                    <li><a class="" href="#"><i class="flaticon-exit mr10"></i>Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center pb40">
            <div class="col-lg-12">
              <div class="dashboard_title_area">
                <h2>Saved Search</h2>
                <p class="text">We are glad to see you again!</p>
              </div>
            </div>
           
          </div>
           <div class="row">
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="packages_table table-responsive">
                  <table class="table-style3 table at-savesearch">
                    <thead class="t-head">
                      <tr>
                        <th scope="col">Listing title</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody class="t-body">
                      <tr>
                        <th scope="row">Equestrian Family Home</th>
                        <td>December 31, 2022</td>
                        <td>
                          <div class="d-flex">
                            
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Luxury villa in Rego Park</th>
                        <td>December 31, 2022</td>
                        <td>
                          <div class="d-flex">
                           
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="active" scope="row">Villa on Hollywood Boulevard</th>
                        <td>December 31, 2022</td>
                        <td>
                          <div class="d-flex">
                           
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Triple Story House for Rent</th>
                        <td>December 31, 2022</td>
                        <td>
                          <div class="d-flex">
                            
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Northwest Office Space</th>
                        <td>December 31, 2022</td>
                        <td>
                          <div class="d-flex">
                            
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">House on the beverly hills</th>
                        <td>December 31, 2022</td>
                        <td>
                          <div class="d-flex">
                            
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Luxury villa called Elvado</th>
                        <td>December 31, 2022</td>
                        <td>
                          <div class="d-flex">
                            
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">House on the Northridge</th>
                        <td>December 31, 2022</td>
                        <td>
                          <div class="d-flex">
                            
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Equestrian Family Home</th>
                        <td>December 31, 2022</td>
                        <td>
                          <div class="d-flex">
                            
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                            <a href="#" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="mbp_pagination text-center mt30">
                    <ul class="page_navigation">
                      <li class="page-item">
                        <a class="page-link" href="#"> <span class="fas fa-angle-left"></span></a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">5</a></li>
                      <li class="page-item"><a class="page-link" href="#">...</a></li>
                      <li class="page-item"><a class="page-link" href="#">20</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#"><span class="fas fa-angle-right"></span></a>
                      </li>
                    </ul>
                    <p class="mt10 pagination_page_count text-center">1 – 20 of 300+ property available</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- The Login Modal -->
{{-- <div class="modal" id="login">
  <div class="modal-dialog">
    <div class="modal-content">

      <!--Login Modal Header -->
      <div class="modal-header">
        <h2 class="modal-title">To Login</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!--Login Modal body -->
      <div class="modal-body">
          <label for="email" class="lab1">Email</label>
          <input type="email" name="email" id="email" class="w-100 rounded-2">
          <label for="password" class="lab1 mt-3">Password</label><br>
          <input type="password" name="password" id="password" class="w-100 rounded-2">
          <input type="checkbox" name="checkbox" id="checkbox" class="rounded-2">
          <label for="checkbox">Keep me login</label>
          <a href="" class="float-end text-decoration-none anc1">Lost your password?</a>
          <a href=""><button class="btn w-100 rounded-4 mt-3"><b>Login</b></button></a>
          <p class="text-center or fortest mt-3">Or</p>
          <a href=""><button class="btn w-100 rounded-pill bt1"><i class="fa-brands fa-google float-start"></i><b>Continue Google</b></button></a>
          <a href=""><button class="btn w-100 mt-3 mb-2 rounded-pill bt2"><i class="fa-brands fa-facebook-f float-start"></i><b>Continue Facebook</b></button></a>
      </div>
      <div class="modal-footer justify-content-center pt-1 pb-0">
          <p class="text-center p1">Not signed up?<a href="" class="anc1"><b> Create an account.</b></a></p>   
      </div>
    </div>
  </div>
</div>

<!-- The Register Modal -->
<div class="modal" id="register">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Register Modal Header -->
      <div class="modal-header">
        <h2 class="modal-title">To Register</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Register Modal body -->
      <div class="modal-body">
          <p class="para">Create your account so that you can log in to House for Sale in business and manage your data.</p>
          <label for="name" class="lab1">First Name</label>
          <input type="text" name="name" id="name" class="w-100 rounded-2">
          <label for="lname" class="lab1 mt-3">Last Name</label><br>
          <input type="text" name="lname" id="lname" class="w-100 rounded-2">
          <label for="email" class="lab1 mt-3">E-mail Address</label><br>
          <input type="email" name="email" id="email" class="w-100 rounded-2">
          <div class="d-flex df">
          <input type="checkbox" name="checkbox" id="checkbox" class="rounded-2 align-self-start m-1"> 
          <label for="" class="para"> I want to register for news and inspiration from House for Sale, partly based on my profile</label>
        </div>
          <a href=""><button class="btn w-100 rounded-4 mt-3"><b>To Register</b></button></a>
          <p class="para m-0">By signing up you agree to our <a href="" class="text-decoration-none">Terms of Use</a>. 
            Our <a href="" class="text-decoration-none">Privacy Policy</a> applies.</p>
      </div>
      <div class="modal-footer justify-content-center pt-1 pb-0">
           <p class="para1 text-center">Already registered with Julia? <a href="" class="text-decoration-none"><b>Log in here.</b></a></p>
      </div>
    </div>
  </div>
</div> --}}

@include('front.master.include.footersell')
@endsection