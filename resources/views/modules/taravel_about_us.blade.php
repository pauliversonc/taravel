@extends('admin.layouts.taravel2')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about_responsive.css')}}">
@endsection

@section('content')
<div class="home">
        {{-- <img class="mySlides" src="{{asset('storage/hdpics/Maskara.jpg')}}"> --}}
    <div class="background_image" style="background-image:url({{url('storage/hdpics/Maskara.jpg')}})"></div>
</div>
<!-- Search -->
{{-- @include('partials.search-bar'); --}}
<!-- About -->

<div class="about">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_subtitle">simply amazing places</div>
                <div class="section_title"><h2>A few words about us</h2></div>
            </div>
        </div>
        <div class="row about_row">
            <div class="col-lg-6">
                <div class="about_content">
                    <div class="text_highlight">The planet is a vast and beautiful place, full of exciting and wonderful people.
                            </div>
                    <div class="about_text">
                        <p> Our developers came up with the idea of showing off the beautiful scenery of Cavite to the tourist that wanted to visit. Taravel enables to help the travelers to find the perfect restaurant and hotel for them. Taravel can give free advertisement for new business owners that wanted to be known for their services or product by using our website.</p>
                    </div>
                    {{-- <div class="button about_button"><a href="#">read more</a></div> --}}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about_image"><img src="{{url('theme/images/peace.jpg')}}" alt=""></div>
            </div>
        </div>
    </div>
</div>

<!-- Milestones -->

<div class="milestones">
    <div class="container">
        {{-- <div class="row">

            <!-- Milestone -->
            <div class="col-lg-3 milestone_col">
                <div class="milestone text-center">
                    <div class="milestone_icon"><img src="images/mountain.svg" alt=""></div>
                    <div class="milestone_counter" data-end-value="17">0</div>
                    <div class="milestone_text">Online Courses</div>
                </div>
            </div>

            <!-- Milestone -->
            <div class="col-lg-3 milestone_col">
                <div class="milestone text-center">
                    <div class="milestone_icon"><img src="images/island.svg" alt=""></div>
                    <div class="milestone_counter" data-end-value="213">0</div>
                    <div class="milestone_text">Students</div>
                </div>
            </div>

            <!-- Milestone -->
            <div class="col-lg-3 milestone_col">
                <div class="milestone text-center">
                    <div class="milestone_icon"><img src="images/camera.svg" alt=""></div>
                    <div class="milestone_counter" data-end-value="11923">0</div>
                    <div class="milestone_text">Teachers</div>
                </div>
            </div>

            <!-- Milestone -->
            <div class="col-lg-3 milestone_col">
                <div class="milestone text-center">
                    <div class="milestone_icon"><img src="images/boat.svg" alt=""></div>
                    <div class="milestone_counter" data-end-value="15">0</div>
                    <div class="milestone_text">Countries</div>
                </div>
            </div>

        </div> --}}

    </div>
</div>

<!-- Why Choose Us -->

<div class="why">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{url('theme/images/why.jpg')}}" data-speed="0.8"></div>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_subtitle">simply amazing places</div>
                <div class="section_title"><h2>Why choose us?</h2></div>
            </div>
        </div>
        <div class="row why_row">

            <!-- Why item -->
            <div class="col-lg-4 why_col">
                <div class="why_item">
                    <div class="why_image">
                        <img src="{{url('theme/images/why_1.jpg')}}" alt="">
                        <div class="why_icon d-flex flex-column align-items-center justify-content-center">
                            <img src="{{url('theme/images/why_1.svg')}}" alt="">
                        </div>
                    </div>
                    <div class="why_content text-center">
                        <div class="why_title">Fast Services</div>
                        <div class="why_text">
                            <p>"Well done is better than well said."
                                    Benjamin Franklin</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why item -->
            <div class="col-lg-4 why_col">
                <div class="why_item">
                    <div class="why_image">
                        <img src="{{url('theme/images/why_2.jpg')}}" alt="">
                        <div class="why_icon d-flex flex-column align-items-center justify-content-center">
                            <img src="{{url('theme/images/why_2.svg')}}" alt="">
                        </div>
                    </div>
                    <div class="why_content text-center">
                        <div class="why_title">Great Team</div>
                        <div class="why_text">
                            <p>"Strive not to be a success, but rather to be of value."
                                    Albert Einstein</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why item -->
            <div class="col-lg-4 why_col">
                <div class="why_item">
                    <div class="why_image">
                        <img src="{{url('theme/images/why_3.jpg')}}" alt="">
                        <div class="why_icon d-flex flex-column align-items-center justify-content-center">
                            <img src="{{url('theme/images/why_3.svg')}}" alt="">
                        </div>
                    </div>
                    <div class="why_content text-center">
                        <div class="why_title">Best Deals</div>
                        <div class="why_text">
                            <p>"To keep a customer demands as much skill as to win one."
                                    American Proverb</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Team -->

<div class="team">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_subtitle">simply amazing places</div>
                <div class="section_title"><h2>Meet the Team</h2></div>
            </div>
        </div>
        <div class="row team_row">



            <!-- Team Item -->
            <div class="col-xl-6 col-md-6 team_col">
                <div class="team_item d-flex flex-column align-items-center justify-content-start text-center">
                    <div class="team_image"><img src="{{url('/storage/pat.jpg')}}" alt=""></div>
                    <div class="team_content">
                        <div class="team_title"><a href="#">Van Patrick Sergio</a> <br> <b>Documentator</b></div>
                        <div class="team_text">
                            <p>Patrick is a fourth year student in Lyceum of the Philippines University and currently taking a Bachelor of Science in Information Technology. Patrick is responsible for the documentation of this capstone project.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Item -->
            <div class="col-xl-6 col-md-6 team_col">
                <div class="team_item d-flex flex-column align-items-center justify-content-start text-center">
                    <div class="team_image"><img src="{{url('/storage/mark.jpg')}}" alt=""></div>
                    <div class="team_content">
                        <div class="team_title"><a href="#">Mark Kristofer Merto</a> <br><b>Database Administrator</b></div>
                        <div class="team_text">
                            <p>Mark is a fourth year student in Lyceum of the Philippines University and currently taking a Bachelor of Science in Information Technology. Mark is our database administrator and created a database for the user of Taravel Website.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row team_row">

                <!-- Team Item -->
                <div class="col-xl-4 col-md-6 team_col">
                    <div class="team_item d-flex flex-column align-items-center justify-content-start text-center">
                        <div class="team_image"><img src="{{url('/storage/mac.jpg')}}" alt=""></div>
                        <div class="team_content">
                            <div class="team_title"><a href="#">John Michael Laxamana</a> <br><b>Project Manager/Documentator</b></div>
                            <div class="team_text">

                                <p>John is a fourth year student in Lyceum of the Philippines University and currently taking a Bachelor of Science in Information Technology. John is our project manager of the website Taravel and also helps with the documentation of this project.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Item -->
                <div class="col-xl-4 col-md-6 team_col">
                    <div class="team_item d-flex flex-column align-items-center justify-content-start text-center">
                        <div class="team_image" style="background-color:blanchedalmond"><img width="500" height="200" src="{{url('/storage/paul.jpg')}}" alt=""></div>
                        <div class="team_content">
                            <div class="team_title"><a href="#">Paul Iverson Cortez</a> <br> <b>Programmer</b></div>
                            <div class="team_text">
                                <p>Paul is a fourth year student in Lyceum of the Philippines University and currently taking a Bachelor of Science in Information Technology. Paul is our programmer and created the system of Taravel.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Item -->
                <div class="col-xl-4 col-md-6 team_col">
                    <div class="team_item d-flex flex-column align-items-center justify-content-start text-center">
                        <div class="team_image"><img src="{{url('/storage/jc.jpg')}}" alt=""></div>
                        <div class="team_content">
                            <div class="team_title"><a href="#">Johnrich Carl Magbanua</a> <br> <b>User Interface Design</b></div>
                            <div class="team_text">
                                <p>Carl is a fourth year student in Lyceum of the Philippines University and currently taking a Bachelor of Science in Information Technology. Carl is our user interface designer of Taravel website.</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
    </div>
</div>

@endsection
@section('footer')
<script src="{{url('theme/js/about.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?AIzaSyB5-r89NnLCwkmYEr-otFPRQ2qE60ZOxEw&callback=initMap" async defer></script>

@endsection
