@extends('layout.home_master')

@section('css') 
@stop
@section('body') 

    <!-- ===========Header Search=========== -->
    <div class="header-form">
        <div class="bg-lay">
            <div class="cross">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <form class="form-container">
            <input type="text" placeholder="Input Your Search" name="name">
            <button type="submit">Search</button>
        </form>
    </div>
    <!-- ===========Header Search=========== -->

    <!-- ===========Header Cart=========== -->
    <div class="cart-sidebar-area">
        <div class="top-content">
            <a href="index.html" class="logo">
                <img src="assets/images/logo/logo.png" alt="logo">
            </a>
            <span class="side-sidebar-close-btn"><i class="fas fa-times"></i></span>
        </div>
        <div class="bottom-content">
            <div class="cart-products">
                <h4 class="title">Shopping cart</h4>
                <div class="single-product-item">
                    <div class="thumb">
                        <img src="assets/images/shop/shop01.png" alt="shop">
                    </div>
                    <div class="content">
                        <h4 class="title">Color Pencil</h4>
                        <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                        <a href="#" class="remove-cart">Remove</a>
                    </div>
                </div>
                <div class="single-product-item">
                    <div class="thumb">
                        <img src="assets/images/shop/shop02.png" alt="shop">
                    </div>
                    <div class="content">
                        <h4 class="title">Water Pot</h4>
                        <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                        <a href="#" class="remove-cart">Remove</a>
                    </div>
                </div>
                <div class="single-product-item">
                    <div class="thumb">
                        <img src="assets/images/shop/shop03.png" alt="shop">
                    </div>
                    <div class="content">
                        <h4 class="title">Art Paper</h4>
                        <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                        <a href="#" class="remove-cart">Remove</a>
                    </div>
                </div>
                <div class="single-product-item">
                    <div class="thumb">
                        <img src="assets/images/shop/shop04.png" alt="shop">
                    </div>
                    <div class="content">
                        <h4 class="title">Stop Watch</h4>
                        <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                        <a href="#" class="remove-cart">Remove</a>
                    </div>
                </div>
                <div class="single-product-item">
                    <div class="thumb">
                        <img src="assets/images/shop/shop05.png" alt="shop">
                    </div>
                    <div class="content">
                        <h4 class="title">Comics Book</h4>
                        <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                        <a href="#" class="remove-cart">Remove</a>
                    </div>
                </div>
                <div class="btn-wrapper text-center">
                    <a href="#" class="custom-button"><span>Checkout</span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- ===========Header Cart=========== -->

    <!-- ==========Banner Section Starts Here========== -->
    <section class="banner-section bg_img" data-background="assets/images/banner/banner01.png">
        <div class="container">
            <div class="banner-content cl-white">
                <h3 class="cate">Our School is Best</h3>
                <h1 class="title">For Your Childs</h1>
                <p>Prescholer for the apcation testing and enrollment process for
                    publc and private schools the city of alo abu mal kita kores vai</p>
                <a href="#" class="custom-button"><span>Get Started Now</span></a>
            </div>
        </div>
    </section>
    <!-- ==========Banner Section Ends Here========== -->


    <!-- ==========About Section Starts Here========== -->
    <section class="about-section section-right-shape padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-video mr-lg-4">
                        <img src="assets/images/about/about01.jpg" alt="about">
                        <a href="https://www.youtube.com/embed/6E9J8biF8RE" class="video-button popup"><i
                                class="flaticon-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-header left-style">
                            <span class="cate mt-0">About Our kittons</span>
                            <h3 class="title">A Friendly School Having Proud of Their Students</h3>
                            <p>Dolor ame consectetur elite eusmod tempor dunt aliqua utas enim veniam
                                tempore quis ipsum nostrud ipsume amet consectetur adpisicing elit sedo
                                eiusmod tempo incdidunt labore dolore magna aliquat enim minim veniam
                                nostrud abori nisut alquip exea commodo consequat duis aute irure aliqua
                                enim minim veniam quis nostrud ullamco laboris nisiut aliquip</p>
                        </div>
                        <ul class="nulla-list">
                            <li>
                                <div class="thumb">
                                    <img src="assets/images/about/icon01.png" alt="about">
                                </div>
                                <div class="content">
                                    Learning Environment
                                </div>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="assets/images/about/icon02.png" alt="about">
                                </div>
                                <div class="content">
                                    Professional Teachers
                                </div>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="assets/images/about/icon03.png" alt="about">
                                </div>
                                <div class="content">
                                    Programs For Everyone
                                </div>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="assets/images/about/icon04.png" alt="about">
                                </div>
                                <div class="content">
                                    Professional Teaching
                                </div>
                            </li>
                        </ul>
                        <div class="about-contact">
                            <div class="call-item">
                                <div class="thumb">
                                    <img src="assets/images/about/call.png" alt="about">
                                </div>
                                <div class="content">
                                    <span class="info">Call to ask any question</span>
                                    <h5 class="subtitle"><a href="Tel:25451245452315">+0123-4056-7890</a></h5>
                                </div>
                            </div>
                            <div class="sign">
                                <img src="assets/images/about/sign.png" alt="about">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========About Section Ends Here========== -->


    <!-- ==========Counter Section Starts Here========== -->
    <div class="counter-section padding-top padding-bottom bg_img"
        data-background="assets/images/counter/counter-bg.jpg">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="counter-item">
                        <div class="counter-thumb">
                            <img src="assets/images/counter/counter1.png" alt="counter">
                        </div>
                        <div class="counter-content">
                            <div class="counter-header">
                                <h2 class="title odometer" data-odometer-final="830">0</h2>
                            </div>
                            <span class="cate">Students Enrolled</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="counter-item">
                        <div class="counter-thumb">
                            <img src="assets/images/counter/counter2.png" alt="counter">
                        </div>
                        <div class="counter-content">
                            <div class="counter-header">
                                <h2 class="title odometer" data-odometer-final="26">0</h2>
                                <h2 class="title">+</h2>
                            </div>
                            <span class="cate">Certified Trainer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="counter-item">
                        <div class="counter-thumb">
                            <img src="assets/images/counter/counter3.png" alt="counter">
                        </div>
                        <div class="counter-content">
                            <div class="counter-header">
                                <h2 class="title odometer" data-odometer-final="100">0</h2>
                                <h2 class="title">%</h2>
                            </div>
                            <span class="cate">Yearly Success Rate</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========Counter Section Ends Here========== -->


    <!-- ==========Class Section Starts Here========== -->
    <section class="class-section padding-top padding-bottom pos-rel">
        <div class="top-shape-center">
            <img src="assets/css/img/gallery1.png" alt="css">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header">
                        <span class="cate">Our School Classes</span>
                        <h3 class="title">Most Popular School Classes</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-4 col-md-6">
                    <div class="class-item">
                        <div class="class-thumb">
                            <a href="class-schedule.html"><img src="assets/images/class/class01.jpg" alt="class"></a>
                        </div>
                        <div class="class-content">
                            <h5 class="title">
                                <a href="class-schedule.html">Art And Color Management</a>
                            </h5>
                            <div class="class-meta">
                                <div class="class-author">
                                    <div class="thumb">
                                        <a href="teacher-single.html"><img src="assets/images/class/teacher02.jpg"
                                                alt="class"></a>
                                    </div>
                                    <div class="content">
                                        <h6 class="subtitle"><a href="teacher-single.html">Joly Smith</a></h6>
                                        <a href="teacher-single.html" class="info">View Profile</a>
                                    </div>
                                </div>
                                <div class="cost-area">
                                    <h6 class="subtitle">$12.96</h6>
                                    <span class="info">Per Month</span>
                                </div>
                            </div>
                            <div class="schedule-area">
                                <div class="schedule-item">
                                    <h6 class="sub-title">24 - 30</h6>
                                    <span class="info">Class Size</span>
                                </div>
                                <div class="schedule-item">
                                    <h6 class="sub-title">09:30 -12:00</h6>
                                    <span class="info">Class Time</span>
                                </div>
                                <div class="schedule-item">
                                    <h6 class="sub-title">06 - 08</h6>
                                    <span class="info">Years Old</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="class-item">
                        <div class="class-thumb">
                            <a href="class-schedule.html"><img src="assets/images/class/class02.jpg" alt="class"></a>
                        </div>
                        <div class="class-content">
                            <h5 class="title">
                                <a href="class-schedule.html">Music And Performance</a>
                            </h5>
                            <div class="class-meta">
                                <div class="class-author">
                                    <div class="thumb">
                                        <a href="teacher-single.html"><img src="assets/images/class/teacher01.jpg"
                                                alt="class"></a>
                                    </div>
                                    <div class="content">
                                        <h6 class="subtitle"><a href="teacher-single.html">Mrs. Labonno</a></h6>
                                        <a href="teacher-single.html" class="info">View Profile</a>
                                    </div>
                                </div>
                                <div class="cost-area">
                                    <h6 class="subtitle">$12.96</h6>
                                    <span class="info">Per Month</span>
                                </div>
                            </div>
                            <div class="schedule-area">
                                <div class="schedule-item">
                                    <h6 class="sub-title">24 - 30</h6>
                                    <span class="info">Class Size</span>
                                </div>
                                <div class="schedule-item">
                                    <h6 class="sub-title">09:30 -12:00</h6>
                                    <span class="info">Class Time</span>
                                </div>
                                <div class="schedule-item">
                                    <h6 class="sub-title">06 - 08</h6>
                                    <span class="info">Years Old</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="class-item">
                        <div class="class-thumb">
                            <a href="class-schedule.html"><img src="assets/images/class/class03.jpg" alt="class"></a>
                        </div>
                        <div class="class-content">
                            <h5 class="title">
                                <a href="class-schedule.html">Religion And History</a>
                            </h5>
                            <div class="class-meta">
                                <div class="class-author">
                                    <div class="thumb">
                                        <a href="teacher-single.html"><img src="assets/images/class/teacher03.jpg"
                                                alt="class"></a>
                                    </div>
                                    <div class="content">
                                        <h6 class="subtitle"><a href="teacher-single.html">Robot Smith</a></h6>
                                        <a href="teacher-single.html" class="info">View Profile</a>
                                    </div>
                                </div>
                                <div class="cost-area">
                                    <h6 class="subtitle">$12.96</h6>
                                    <span class="info">Per Month</span>
                                </div>
                            </div>
                            <div class="schedule-area">
                                <div class="schedule-item">
                                    <h6 class="sub-title">24 - 30</h6>
                                    <span class="info">Class Size</span>
                                </div>
                                <div class="schedule-item">
                                    <h6 class="sub-title">09:30 -12:00</h6>
                                    <span class="info">Class Time</span>
                                </div>
                                <div class="schedule-item">
                                    <h6 class="sub-title">06 - 08</h6>
                                    <span class="info">Years Old</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="load-more">
                <a href="classes.html" class="custom-button"><span>Get Started Now</span></a>
            </div>
        </div>
    </section>
    <!-- ==========Class Section Ends Here========== -->


    <!-- ==========Facilities Section Starts Here========== -->
    <section class="facilities-section">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-lg-7 col-xl-6 px-0">
                    <div class="facility-area padding-bottom padding-top bg_img"
                        data-background="assets/images/facilities/facility-bg2.jpg">
                        <div class="facility-container">
                            <div class="cl-white section-header left-style">
                                <span class="cate">School Facilities</span>
                                <h3 class="title">EveryDay Care For Your Children.</h3>
                                <p>Dolor ame consectetur elite eusmod tempor dunt aliqua utas enim veniam minim veniam
                                    quis nostrud ullamco laboris nisiut aliquip</p>
                            </div>
                            <div class="facility-wrapper">
                                <div class="facility-item">
                                    <div class="facility-inner">
                                        <div class="facility-thumb">
                                            <img src="assets/images/facilities/facility1.png" alt="facility">
                                        </div>
                                        <h6 class="title">Clean Playgrounds</h6>
                                    </div>
                                </div>
                                <div class="facility-item">
                                    <div class="facility-inner">
                                        <div class="facility-thumb">
                                            <img src="assets/images/facilities/facility2.png" alt="facility">
                                        </div>
                                        <h6 class="title">Private School Bus</h6>
                                    </div>
                                </div>
                                <div class="facility-item">
                                    <div class="facility-inner">
                                        <div class="facility-thumb">
                                            <img src="assets/images/facilities/facility3.png" alt="facility">
                                        </div>
                                        <h6 class="title">Modern Canteen</h6>
                                    </div>
                                </div>
                                <div class="facility-item">
                                    <div class="facility-inner">
                                        <div class="facility-thumb">
                                            <img src="assets/images/facilities/facility4.png" alt="facility">
                                        </div>
                                        <h6 class="title">Colorful Classes</h6>
                                    </div>
                                </div>
                                <div class="facility-item">
                                    <div class="facility-inner">
                                        <div class="facility-thumb">
                                            <img src="assets/images/facilities/facility5.png" alt="facility">
                                        </div>
                                        <h6 class="title">Positive Learning</h6>
                                    </div>
                                </div>
                                <div class="facility-item">
                                    <div class="facility-inner">
                                        <div class="facility-thumb">
                                            <img src="assets/images/facilities/facility6.png" alt="facility">
                                        </div>
                                        <h6 class="title">Fun With Games</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-6 px-0 bg_img" data-background="assets/images/facilities/facility-bg.jpg">
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Facilities Section Ends Here========== -->


    <!-- ==========Gallery Section Starts Here========== -->
    <section class="gallery-section padding-top padding-bottom pos-rel">
        <div class="top-shape-center">
            <img src="assets/css/img/gallery1.png" alt="css">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header">
                        <span class="cate">Photo Gallery</span>
                        <h3 class="title">Our All School Photos Gallery</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb--40--50">
                <div class="col-xl-4 col-md-6 col-sm-10">
                    <div class="gallery-item">
                        <div class="gallery-inner">
                            <div class="gallery-thumb">
                                <a href="assets/images/gallery/gallery1.jpg" class="img-pop">
                                    <img src="assets/images/gallery/gallery1.jpg" alt="gallery">
                                </a>
                            </div>
                            <div class="gallery-content">
                                <h6 class="title">Infants Learnings 2017</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-sm-10">
                    <div class="gallery-item">
                        <div class="gallery-inner">
                            <div class="gallery-thumb">
                                <a href="assets/images/gallery/gallery2.jpg" class="img-pop">
                                    <img src="assets/images/gallery/gallery2.jpg" alt="gallery">
                                </a>
                            </div>
                            <div class="gallery-content">
                                <h6 class="title">Art And Design Event 2018</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-sm-10">
                    <div class="gallery-item">
                        <div class="gallery-inner">
                            <div class="gallery-thumb">
                                <a href="assets/images/gallery/gallery3.jpg" class="img-pop">
                                    <img src="assets/images/gallery/gallery3.jpg" alt="gallery">
                                </a>
                            </div>
                            <div class="gallery-content">
                                <h6 class="title">Painting Course 2019</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-sm-10">
                    <div class="gallery-item">
                        <div class="gallery-inner">
                            <div class="gallery-thumb">
                                <a href="assets/images/gallery/gallery4.jpg" class="img-pop">
                                    <img src="assets/images/gallery/gallery4.jpg" alt="gallery">
                                </a>
                            </div>
                            <div class="gallery-content">
                                <h6 class="title">Early Years Math 2020</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-sm-10">
                    <div class="gallery-item">
                        <div class="gallery-inner">
                            <div class="gallery-thumb">
                                <a href="assets/images/gallery/gallery5.jpg" class="img-pop">
                                    <img src="assets/images/gallery/gallery5.jpg" alt="gallery">
                                </a>
                            </div>
                            <div class="gallery-content">
                                <h6 class="title">Letters Matching 2021</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-sm-10">
                    <div class="gallery-item">
                        <div class="gallery-inner">
                            <div class="gallery-thumb">
                                <a href="assets/images/gallery/gallery6.jpg" class="img-pop">
                                    <img src="assets/images/gallery/gallery6.jpg" alt="gallery">
                                </a>
                            </div>
                            <div class="gallery-content">
                                <h6 class="title">Advance Learning 2022</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Gallery Section Ends Here========== -->


    <!-- ==========Teacher Section Starts Here========== -->
    <section class="teacher-section padding-bottom padding-top bg_img"
        data-background="assets/images/teacher/teacher-bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header">
                        <span class="cate">Meet Our Stuffy</span>
                        <h3 class="title">Our Best Popular Teachers</h3>
                    </div>
                </div>
            </div>
            <div class="row mb-30-none justify-content-center">
                <div class="col-lg-6">
                    <div class="teacher-item">
                        <div class="teacher-inner">
                            <div class="teacher-thumb">
                                <div class="thumb-inner">
                                    <a href="teacher-single.html"><img src="assets/images/teacher/teacher01.jpg"
                                            alt="teacher"></a>
                                </div>
                            </div>
                            <div class="teacher-content">
                                <h6 class="title"><a href="teacher-single.html">Steve Jobs</a></h6>
                                <span class="info">Spanish Teacher</span>
                                <p>Samet consectetuer apiscing elitsed diam nonumy nibh euismod nciduns awesome team
                                    mumber</p>
                                <ul class="teacher-social">
                                    <li>
                                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="pinterest"><i class="fab fa-pinterest-p"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="vimeo"><i class="fab fa-vimeo-v"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="behance"><i class="fab fa-behance"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="teacher-item">
                        <div class="teacher-inner">
                            <div class="teacher-thumb">
                                <div class="thumb-inner">
                                    <a href="teacher-single.html"><img src="assets/images/teacher/teacher02.jpg"
                                            alt="teacher"></a>
                                </div>
                            </div>
                            <div class="teacher-content">
                                <h6 class="title"><a href="teacher-single.html">Mark Jukar</a></h6>
                                <span class="info">Spanish Teacher</span>
                                <p>Samet consectetuer apiscing elitsed diam nonumy nibh euismod nciduns awesome team
                                    mumber</p>
                                <ul class="teacher-social">
                                    <li>
                                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="pinterest"><i class="fab fa-pinterest-p"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="vimeo"><i class="fab fa-vimeo-v"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="behance"><i class="fab fa-behance"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="teacher-item">
                        <div class="teacher-inner">
                            <div class="teacher-thumb">
                                <div class="thumb-inner">
                                    <a href="teacher-single.html"><img src="assets/images/teacher/teacher03.jpg"
                                            alt="teacher"></a>
                                </div>
                            </div>
                            <div class="teacher-content">
                                <h6 class="title"><a href="teacher-single.html">Jesse Lingard</a></h6>
                                <span class="info">Spanish Teacher</span>
                                <p>Samet consectetuer apiscing elitsed diam nonumy nibh euismod nciduns awesome team
                                    mumber</p>
                                <ul class="teacher-social">
                                    <li>
                                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="pinterest"><i class="fab fa-pinterest-p"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="vimeo"><i class="fab fa-vimeo-v"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="behance"><i class="fab fa-behance"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="teacher-item">
                        <div class="teacher-inner">
                            <div class="teacher-thumb">
                                <div class="thumb-inner">
                                    <a href="teacher-single.html"><img src="assets/images/teacher/teacher04.jpg"
                                            alt="teacher"></a>
                                </div>
                            </div>
                            <div class="teacher-content">
                                <h6 class="title"><a href="teacher-single.html">Alison Tylor</a></h6>
                                <span class="info">Spanish Teacher</span>
                                <p>Samet consectetuer apiscing elitsed diam nonumy nibh euismod nciduns awesome team
                                    mumber</p>
                                <ul class="teacher-social">
                                    <li>
                                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="pinterest"><i class="fab fa-pinterest-p"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="vimeo"><i class="fab fa-vimeo-v"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="behance"><i class="fab fa-behance"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Teacher Section Ends Here========== -->


    <!-- ==========Schedule Section Starts Here========== -->
    <section class="schedule-section padding-top padding-bottom">
        <div class="top-shape-center">
            <img src="assets/css/img/gallery1.png" alt="css">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header">
                        <span class="cate">Classes Timetable</span>
                        <h3 class="title">Our Classes Timetable</h3>
                    </div>
                </div>
            </div>
            <div class="row mb--20--50 justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <div class="schedule-item-2 bg_img bg_contain" data-background="assets/images/schedule/monday.png">
                        <ul>
                            <li>
                                <h6 class="title painting">Painting</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title">English</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title fitness">Power Fitnes</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="schedule-item-2 bg_img bg_contain" data-background="assets/images/schedule/tuesday.png">
                        <ul>
                            <li>
                                <h6 class="title painting">Painting</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title fitness">Power Fitnes</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title">English</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="schedule-item-2 bg_img bg_contain"
                        data-background="assets/images/schedule/wednesday.png">
                        <ul>
                            <li>
                                <h6 class="title">English</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title painting">Painting</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title fitness">Power Fitnes</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="schedule-item-2 bg_img bg_contain"
                        data-background="assets/images/schedule/thursday.png">
                        <ul>
                            <li>
                                <h6 class="title painting">Painting</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title">English</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title fitness">Power Fitnes</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="schedule-item-2 bg_img bg_contain" data-background="assets/images/schedule/friday.png">
                        <ul>
                            <li>
                                <h6 class="title">English</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title painting">Painting</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title fitness">Power Fitnes</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="schedule-item-2 bg_img bg_contain"
                        data-background="assets/images/schedule/saturday.png">
                        <ul>
                            <li>
                                <h6 class="title painting">Painting</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title fitness">Power Fitnes</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                            <li>
                                <h6 class="title">English</h6>
                                <span class="time">07:30am - 08:30am</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Schedule Section Ends Here========== -->


    <!-- ==========Client Section Starts Here========== -->
    <section class="client-section padding-top padding-bottom bg_img"
        data-background="assets/images/client/client-bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header cl-white">
                        <span class="cate">Parents Say</span>
                        <h3 class="title">What Students Parents Say</h3>
                    </div>
                </div>
            </div>
            <div class="client-slider oh">
                <div class="client-item">
                    <div class="client-header">
                        <div class="author">
                            <div class="thumb">
                                <img src="assets/images/client/client1.png" alt="client">
                            </div>
                            <div class="content">
                                <h6 class="title">Angel Witicker</h6>
                                <span>UX Designer</span>
                            </div>
                        </div>
                        <div class="company">
                            <img src="assets/images/client/logo2.png" alt="client">
                        </div>
                    </div>
                    <div class="client-body">
                        <p>Rapidiously buildcollaboration anden deas sharing viaing bleeding and
                            edge nterfaces Energstcally plagiarize team anbuilding and paradgmis
                            whereas goingi forward process mproveents and monetze fully tested
                            ergstcally plariarize team whereas goingi forward process an services
                            whereas going forward process</p>
                        <div class="ratings">
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                        </div>
                    </div>
                </div>
                <div class="client-item">
                    <div class="client-header">
                        <div class="author">
                            <div class="thumb">
                                <img src="assets/images/client/client2.png" alt="client">
                            </div>
                            <div class="content">
                                <h6 class="title">Witicker Alex</h6>
                                <span>Founder & CEO</span>
                            </div>
                        </div>
                        <div class="company">
                            <img src="assets/images/client/logo1.png" alt="client">
                        </div>
                    </div>
                    <div class="client-body">
                        <p>Rapidiously buildcollaboration anden deas sharing viaing bleeding and
                            edge nterfaces Energstcally plagiarize team anbuilding and paradgmis
                            whereas goingi forward process mproveents and monetze fully tested
                            ergstcally plariarize team whereas goingi forward process an services
                            whereas going forward process</p>
                        <div class="ratings">
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                        </div>
                    </div>
                </div>
                <div class="client-item">
                    <div class="client-header">
                        <div class="author">
                            <div class="thumb">
                                <img src="assets/images/client/client1.png" alt="client">
                            </div>
                            <div class="content">
                                <h6 class="title">Angel Witicker</h6>
                                <span>UX Designer</span>
                            </div>
                        </div>
                        <div class="company">
                            <img src="assets/images/client/logo2.png" alt="client">
                        </div>
                    </div>
                    <div class="client-body">
                        <p>Rapidiously buildcollaboration anden deas sharing viaing bleeding and
                            edge nterfaces Energstcally plagiarize team anbuilding and paradgmis
                            whereas goingi forward process mproveents and monetze fully tested
                            ergstcally plariarize team whereas goingi forward process an services
                            whereas going forward process</p>
                        <div class="ratings">
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                        </div>
                    </div>
                </div>
                <div class="client-item">
                    <div class="client-header">
                        <div class="author">
                            <div class="thumb">
                                <img src="assets/images/client/client2.png" alt="client">
                            </div>
                            <div class="content">
                                <h6 class="title">Witicker Alex</h6>
                                <span>Founder & CEO</span>
                            </div>
                        </div>
                        <div class="company">
                            <img src="assets/images/client/logo1.png" alt="client">
                        </div>
                    </div>
                    <div class="client-body">
                        <p>Rapidiously buildcollaboration anden deas sharing viaing bleeding and
                            edge nterfaces Energstcally plagiarize team anbuilding and paradgmis
                            whereas goingi forward process mproveents and monetze fully tested
                            ergstcally plariarize team whereas goingi forward process an services
                            whereas going forward process</p>
                        <div class="ratings">
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Client Section Ends Here========== -->




    <!-- ==========Blog Section Starts Here========== -->
    <section class="blog-section padding-top padding-bottom pos-rel">
        <div class="top-shape-center">
            <img src="assets/css/img/gallery1.png" alt="css">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header">
                        <span class="cate">our blog post</span>
                        <h3 class="title">Our most popular posts</h3>
                    </div>
                </div>
            </div>
            <div class="row mb-30-none justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <div class="post-item">
                        <div class="post-thumb">
                            <a href="blog-single.html"><img src="assets/images/blog/blog01.jpg" alt="blog"></a>
                        </div>
                        <div class="post-content">
                            <div class="post-top">
                                <h5 class="title"><a href="blog-single.html">How Kids make sense of Life Experiences</a>
                                </h5>
                                <div class="post-meta cate">
                                    <a href="#"><i class="far fa-calendar"></i> April 04, 2022</a>
                                    <a href="#"><i class="fas fa-user"></i> Robot Smith</a>
                                </div>
                                <p>Enthusiastically morph magnetic scenarios Uniquelly synthesize strategic theme areas
                                    vis parallel customer service.</p>
                            </div>
                            <div class="post-bottom">
                                <a href="blog-single.html" class="read">Read More</a>
                                <a href="#" class="comments"><i class="far fa-comments"></i> <span
                                        class="comment-number">2</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="post-item">
                        <div class="post-thumb">
                            <a href="blog-single.html"><img src="assets/images/blog/blog02.jpg" alt="blog"></a>
                        </div>
                        <div class="post-content">
                            <div class="post-top">
                                <h5 class="title"><a href="blog-single.html">Why do aerobicay fit children have
                                        better?</a></h5>
                                <div class="post-meta cate">
                                    <a href="#"><i class="far fa-calendar"></i> April 04, 2022</a>
                                    <a href="#"><i class="fas fa-user"></i> Robot Smith</a>
                                </div>
                                <p>Enthusiastically morph magnetic scenarios Uniquelly synthesize strategic theme areas
                                    vis parallel customer service.</p>
                            </div>
                            <div class="post-bottom">
                                <a href="blog-single.html" class="read">Read More</a>
                                <a href="#" class="comments"><i class="far fa-comments"></i> <span
                                        class="comment-number">2</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="post-item">
                        <div class="post-thumb">
                            <a href="blog-single.html"><img src="assets/images/blog/blog03.jpg" alt="blog"></a>
                        </div>
                        <div class="post-content">
                            <div class="post-top">
                                <h5 class="title"><a href="blog-single.html">Why do aerobically have better Math
                                        Skills</a></h5>
                                <div class="post-meta cate">
                                    <a href="#"><i class="far fa-calendar"></i> April 04, 2022</a>
                                    <a href="#"><i class="fas fa-user"></i> Robot Smith</a>
                                </div>
                                <p>Enthusiastically morph magnetic scenarios Uniquelly synthesize strategic theme areas
                                    vis parallel customer service.</p>
                            </div>
                            <div class="post-bottom">
                                <a href="blog-single.html" class="read">Read More</a>
                                <a href="#" class="comments"><i class="far fa-comments"></i> <span
                                        class="comment-number">2</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Blog Section Ends Here========== -->



@stop