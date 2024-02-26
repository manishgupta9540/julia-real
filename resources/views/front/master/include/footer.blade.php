<section class="footer-style1 at-home4 pt60 pb-0 footer-section border-top">
    <div class="container footer-containers">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          @foreach ($address as $item)
            <div class="footer-widget light-style mb-4 mb-lg-5">
              <a class="footer-logo" href="{{route('home')}}"><img class="mb20" src="{{asset('front/images/House-for-Sale-logo1.png')}}" alt=""></a>
              <div class="contact-info mb25">
                <p class="text mb5">Address</p>
                <h6 class="info-phone"><a href="%2b(0)-123-050-945-02.html">{{$item->address ?? ''}}</a></h6>
              </div>
              <div class="contact-info mb25">
                <p class="text mb5">Total Free Customer Care</p>
                <h6 class="info-phone"><a href="%2b(0)-123-050-945-02.html">{{$item->contact ?? ''}}</a></h6>
              </div>
              <div class="contact-info">
                <p class="text mb5">Need Live Support?</p>
                <h6 class="info-mail"><a href="mailto:hi@julia.com">{{$item->email ?? ''}}</a></h6>
              </div>
            </div>
          @endforeach
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="footer-widget mb-4 mb-lg-5 ps-0 ps-lg-5">
            <div class="link-style1 light-style mb30">
              <h6 class="mb25">OVER ONS</h6>
              <div class="link-list">
                <a href="{{url('/privacy-policy')}}">Privacybeleid</a>
                <a href="{{url('/terms-conditions')}}">Voorwaarden</a>
                <a href="{{route('contact')}}">Neem contact op</a>
                <a href="{{route('about')}}">Over ons</a>
                <a href="{{route('howwework')}}">Hoe werkt het</a>
              </div>
            </div>
            
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="footer-widget mb-4 mb-lg-5 ps-0 ps-lg-5">
            <div class="link-style1 light-style mb-3">
              <h6 class="mb25">ABOUT US</h6>
              <ul class="ps-0">
                <li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
                <li><a href="{{url('/terms-conditions')}}">Terms & Conditions</a></li>
                <li><a href="{{route('contact')}}">Contact us</a></li>
                <li><a href="{{route('about')}}">About us</a></li>
                <li><a href="{{route('howwework')}}">How Does it Works</a></li>
                
              </ul>
            </div>
          </div>
        </div>
         <div class="col-sm-6 col-lg-3">
          <div class="footer-widget mb-4 mb-lg-5 ps-0 ps-lg-5">
            <div class="link-style1 light-style mb-3">
              <h6 class="mb25">HOUSE FOR SALE</h6>
              <ul class="ps-0">
                <li><a href="{{url('helps-contacts')}}">Help & Contacts</a></li>
                <li><a href="{{url('advertisement-packages')}}">Advertisement Packages</a></li>
                @if (Auth::check())
                  <li><a href="{{route('my-profile')}}">My Profile</a></li>
                @else
                  <li><a href="{{route('my-profile')}}" data-bs-toggle="modal" data-bs-target="#login">My Profile</a></li>
                @endif
                {{-- <li><a href="#">My Ads</a></li> --}}
                <li><a href="{{url('safety')}}">Safety</a></li>
                {{-- <li><a href="#">Payments</a></li> --}}
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container gray-bdrt1 py-4">
      <div class="row">
        <div class="col-sm-6">
          <div class="text-center text-lg-start">
            <p class="copyright-text ff-heading mb-0">© Julia - All rights reserved</p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="social-widget text-center text-sm-end">
            <div class="social-style1 light-style">
              <a class="me-2 fw600 fz15" href="#">Follow us</a>
              <a href="https://www.facebook.com/JuliaSuriname"><i class="fab fa-facebook-f list-inline-item"></i></a>
              <a href="https://www.instagram.com/juliasuriname/"><i class="fab fa-instagram list-inline-item"></i></a>
              {{-- <a href="#"><i class="fab fa-linkedin-in list-inline-item"></i></a>
              <a href="#"><i class="fab fa-twitter list-inline-item"></i></a>  --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>