@extends('layouts.master')


@section('content')
    <main id="app">
        <div class="main-wrapper pt-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 d-none d-lg-block order-2 order-lg-1">
                        <aside class="widget-area">
                            <!-- widget single item start -->
                            <div class="card card-profile widget-item p-0">
                                <div class="profile-banner">
                                    <figure class="profile-banner-small">
                                        <a href="profile.html">
                                            <img src="{{Auth::user()->profile->cover_photo}}" alt="">
                                        </a>
                                        <a href="profile.html" class="profile-thumb-2">
                                            <img src="{{Auth::user()->profile->photo}}" alt="">
                                        </a>
                                    </figure>
                                    <div class="profile-desc text-center">
                                        <h6 class="author"><a href="{{route('profile')}}">{{Auth::user()->name}}</a></h6>
                                        <p>{{Auth::user()->profile->bio}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- widget single item start -->

                            <!-- widget single item start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">Top Channels</h4>
                                <div class="widget-body">
                                    <ul class="like-page-list-wrapper">
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-33.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">#EB Things</a></h3>
                                                <p class="list-subtitle"><a href="#">4530 posts</a></p>
                                            </div>
                                            <button class="like-button active">
                                                <img class="heart" src="assets/images/icons/heart.png" alt="">
                                                <img class="heart-color" src="assets/images/icons/heart-color.png" alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-30.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Premium Cruise</a></h3>
                                                <p class="list-subtitle"><a href="#">4109 posts</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart" src="assets/images/icons/heart.png" alt="">
                                                <img class="heart-color" src="assets/images/icons/heart-color.png" alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-5.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Akpors TV</a></h3>
                                                <p class="list-subtitle"><a href="#">3802 posts</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart" src="assets/images/icons/heart.png" alt="">
                                                <img class="heart-color" src="assets/images/icons/heart-color.png" alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-29.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Savage TV</a></h3>
                                                <p class="list-subtitle"><a href="#">2609 posts</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart" src="assets/images/icons/heart.png" alt="">
                                                <img class="heart-color" src="assets/images/icons/heart-color.png" alt="">
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- widget single item end -->
                        </aside>
                    </div>

                    <div class="col-lg-6 order-1 order-lg-2">
                        <!-- Page Title -->
                        <div class="card card-small">
                            <h3>Update Profile</h3>
                            @include('partials.flash')
                        </div>
                        <!-- Page Title -->

                        
                        <div class="card">
                            <form class="form" method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="card card-small bg-img" data-bg ="{{asset('storage/covers/'. $profile->cover_photo)}}">
                                    <figure class="mx-auto mb-3 profile-thumb-large">
                                        <img src="{{asset('storage/avatars/'. $profile->photo)}}" alt="profile picture">
                                    </figure>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="btn btn-primary" >
                                                <i class="fa fa-image"></i>Change Photo<input type="file" style="display: none; "  name="photo">
                                            </label>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <label class="btn btn-primary" >
                                                <i class="fa fa-image"></i>Change Cover<input type="file" style="display: none; "  name="cover_photo">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Display Name</span>
                                        </div>
                                        <input type="text" readonly class="form-control" name="display_name" value="{{auth()->user()->display_name}}">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Bio</span>
                                        </div>
                                        <textarea name="bio" class="form-control">{{$profile->bio}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Location</span>
                                        </div>
                                        <input type="text" class="form-control" name="location" value="{{$profile->location}}">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Job Title</span>
                                        </div>
                                        <input type="text" class="form-control" name="job_title" value="{{$profile->job_title}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Gender</span>
                                        </div>
                                        <select name="gender" class="form-control">
                                            @isset($profile->gender)
                                                <option value="{{$profile->gender}}"  style="display:none !important">{{$profile->gender}}</option>
                                            @endisset
                                            @empty($profile->gender)
                                                <option value=""  style="display:none !important">Select Gender</option>
                                            @endempty
                                                <option value="{{'male'}}">{{'Male'}}</option>
                                                <option value="{{'female'}}">{{'Female'}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Facebook</span>
                                        </div>
                                        <input type="text" class="form-control" name="facebook" value="{{$profile->facebook}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Twitter</span>
                                        </div>
                                        <input type="text" class="form-control" name="twitter" value="{{$profile->twitter}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Linkedin</span>
                                        </div>
                                        <input type="text" class="form-control" name="linkedin" value="{{$profile->linkedin}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">Instagram</span>
                                        </div>
                                        <input type="text" class="form-control" name="instagram" value="{{$profile->instagram}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button style="color: white; padding: 10px; background: gray" type="submit" class="btn btn-secondary">Update Profile</button>
                                </div>
                            </form>
                        </div>

    
                    </div>

                    <div class="col-lg-3 d-none d-lg-block order-3">
                        <aside class="widget-area">
                           
                            <!-- widget single item start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">Games Zone</h4>
                                <div class="widget-body">
                                    <ul class="like-page-list-wrapper">
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-33.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Tell-a#Joke</a></h3>
                                                <p class="list-subtitle"><a href="#">Play</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart" src="assets/images/icons/heart.png" alt="">
                                                <img class="heart-color" src="assets/images/icons/heart-color.png" alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-30.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Funny Acronyms</a></h3>
                                                <p class="list-subtitle"><a href="#">Play</a></p>
                                            </div>
                                            <button class="like-button active">
                                                <img class="heart" src="assets/images/icons/heart.png" alt="">
                                                <img class="heart-color" src="assets/images/icons/heart-color.png" alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-5.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Puzzles</a></h3>
                                                <p class="list-subtitle"><a href="#">Join</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart" src="assets/images/icons/heart.png" alt="">
                                                <img class="heart-color" src="assets/images/icons/heart-color.png" alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-29.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Quiz</a></h3>
                                                <p class="list-subtitle"><a href="#">Play</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart" src="assets/images/icons/heart.png" alt="">
                                                <img class="heart-color" src="assets/images/icons/heart-color.png" alt="">
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- widget single item end -->

                            <!-- widget single item start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">Advertizement</h4>
                                <div class="widget-body">
                                    <div class="add-thumb">
                                        <a href="#">
                                            <img src="assets/images/banner/advertise.jpg" alt="advertisement">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- widget single item end -->



                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection



<!-- JS   ================== -->
@section('js')
    <!-- @Include('partials.js') -->
@endsection

