<!DOCTYPE html>
    <html lang="en">
      <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
        <title>Login</title>
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="theme-color" content="#ffffff">
        <!-- Vendors styles-->
        <link rel="stylesheet" href="{{asset('admin/vendors/simplebar/css/simplebar.css')}}">
        <link rel="stylesheet" href="{{asset('admin/css/vendors/simplebar.css')}}">
        <!-- Main styles for this application-->
        <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
        <!-- We use those styles to show code examples, you should remove them in your application.-->
        <link href="{{asset('admin/css/examples.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
      </head>
      <style>
       .invalid-feedback {
            display:inline-block;
        }
        span.show-hide-password {
          position: absolute;
          top: 7px;
          right: 3%;
          font-size: 16px;
          color: #748a9c;
          cursor: pointer;
          z-index: 6;
        }
      </style>
      <body>
        <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4">
                
            
                @if(Session::has('error'))
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>{{ Session::get('error') }}
                  </div>
                @endif
                

                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                      <h4><i class="icon fa fa-ban"></i> Error!</h4>{{ Session::get('success') }}
                    </div>
                @endif

                <div class="card-group d-block d-md-flex row">
                  <div class="card col-md-12 p-4 mb-0">
                    <form action="{{ route('admin.authenticate') }}" method="post">
                        @csrf
                        <div class="card-body">
                        <h1>Login</h1>
                        <p class="text-medium-emphasis">Sign In to your account</p>
                        
                        <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon"></svg></span>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" style="display-none: block" placeholder="Email">
                        </div>

                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror

                        <div class="input-group mb-4">
                          <span class="input-group-text"><svg class="icon"></svg></span>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            <span class="show-hide-password js-show-hide has-show-hide"><i class="bi bi-eye-slash"></i></span>
                        </div>
                       

                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-4 submit" type="button">Login</button>
                            </div>
                            {{-- <div class="col-6 text-end">
                                <button class="btn btn-link px-0" type="button">Forgot password?</button>
                            </div> --}}
                        </div>
                        </div>
                    </form>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- CoreUI and necessary plugins-->
        <script src="{{asset('admin/vendors/simplebar/js/simplebar.min.js')}}"></script>
      
        <script src="{{ asset('admin/jquery/jquery.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).on('click','.js-show-hide',function (e) {
                e.preventDefault();
                var _this = $(this);

                if (_this.hasClass('has-show-hide'))
                {
                    _this.parent().find('input').attr('type','text');
                    _this.html('<i class="fa fa-eye" aria-hidden="true"></i>');
                    _this.removeClass('has-show-hide');
                }
                else
                {
                    _this.addClass('has-show-hide');
                    _this.parent().find('input').attr('type','password');
                    _this.html('<i class="bi bi-eye-slash"></i>');
                }


            });
            
        </script>
    
      </body>
    </html>