<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Jokr - whats funny?</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- CSS
    ============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bicon.min.css')}}">
    <!-- Flat Icon CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/flaticon.css')}}">
    <!-- audio & video player CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/plyr.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.min.css')}}">
    <!-- nice-select CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nice-select.css')}}">
    <!-- perfect scrollbar css -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/perfect-scrollbar.css')}}">
    <!-- light gallery css -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/lightgallery.min.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- Font-awesome -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" />

    <style type="text/css">
        .timeline-logo-area .tagline {
            color: #5a737e;
            font-size: 16px;
            font-weight: 800;
            padding-left: 70px;
}
    </style>

</head>

<body class="bg-transparent">
    <main>
        <div class="main-wrapper pb-0 mb-0">
            <div class="timeline-wrapper">
                <div class="timeline-header" style="margin: 40px 0px">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters align-items-center">
                            <div class="col-lg-6">
                                <div class="timeline-logo-area d-flex align-items-center">
                                    <div class="timeline-logo">
                                        <a href="index.html">
                                            <img src="assets/images/logo/logo.png" alt="timeline logo">
                                        </a>
                                    </div>
                                    <div class="timeline-tagline">
                                        <h6 class="tagline">Enjoy premium cruise, share funny memes, play games and win cool prizes</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- <div class="login-area">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-sm">
                                            <input type="text" placeholder="Email or Userame" class="single-field">
                                        </div>
                                        <div class="col-12 col-sm">
                                            <input type="password" placeholder="Password" class="single-field">
                                        </div>
                                        <div class="col-12 col-sm-auto">
                                            <button class="login-btn">Login</button>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timeline-page-wrapper bg-img" data-bg="assets/images/timeline/timeline.jpg">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">
                            
                            <div class="col-lg-10 mx-auto d-flex align-items-center justify-content-center">
                                <div class="signup-form-wrapper">
                                    <h1 class="create-acc text-center">Create An Account</h1>
                                    <div class="signup-inner text-center">
                                        <h3 class="title" style="background: #5a737e">Welcome to JOKR</h3>
                                        <form class="signup-inner--form" method="POST" action="{{route('signup.store')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="email" name="email" class="single-field @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" placeholder="Email">
                                                    @error('email')
                                                    <span class="validation-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" name="first_name" id="first-name" class="single-field" placeholder="First Name">
                                                    @error('first_name')
                                                    <span class="validation-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="last_name" id="last-name" class="single-field" placeholder="Last Name">
                                                    @error('last_name')
                                                    <span class="validation-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12">
                                                    <input type="text" readonly hidden  id="name" class="single-field" placeholder="Full Name" name="name">
                                                </div>
                                                

                                                <div class="col-md-12">
                                                    <input type="text" name="display_name" id="display-name" class="single-field" placeholder="Display Name">
                                                    @error('display-name')
                                                    <span class="validation-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="col-6">
                                                    <input type="password" name="password" class="single-field" placeholder="Password">
                                                    @error('password')
                                                    <span class="validation-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="col-6">
                                                    <input type="password" name="password_confirmation" class="single-field" placeholder="Confirm Password">
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="nice-select" name="gender">
                                                        <option value="null">Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="nice-select" name="age">
                                                        <option value="trending">Age</option>
                                                        <option value="18+">18+</option>
                                                        <option value="18-">18-</option>
                                                    </select>
                                                    
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <input type="text" id="location" class="single-field" placeholder="Location" name="location">
                                                    @error('location')
                                                    <span class="validation-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <button class="submit-btn" style="background: #5a737e">Create Account</button>
                                                </div>
                                            </div>
                                            <h6 class="terms-condition">
                                                I have read & accepted the <a href="#">terms of use</a> |
                                                <a href="{{route('signin')}}">signin</a>
                                            </h6>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-lg-6 order-2 order-lg-2">
                                <div class="timeline-bg-content bg-img" >
                                    <h3 class="timeline-bg-title">Let’s see what’s happening to you and your world. Welcome in Adda.</h3>
                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- JS
============================================ -->
   
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <!-- Popper JS -->
    <script src="assets/js/vendor/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <!-- Slick Slider JS -->
    <script src="assets/js/plugins/slick.min.js"></script>
    <!-- nice select JS -->
    <script src="assets/js/plugins/nice-select.min.js"></script>
    <!-- audio video player JS -->
    <script src="assets/js/plugins/plyr.min.js"></script>
    <!-- perfect scrollbar js -->
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <!-- light gallery js -->
    <script src="assets/js/plugins/lightgallery-all.min.js"></script>
    <!-- image loaded js -->
    <script src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>
    <!-- isotope filter js -->
    <script src="assets/js/plugins/isotope.pkgd.min.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

     <script>
        $(document).ready(function(){
            //console.log('init');
            $( "#last-name,#first-name" ).change(function() {
                var lastName = $("#last-name").val();
                var firstName = $("#first-name").val();
                $('#display-name').val(firstName+ ' ' +lastName);
            });
        });
        
    </script>

</body>

</html>