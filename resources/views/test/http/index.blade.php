@extends('test.template')

@section('head')
    <style>
        .services-2:nth-child(4) {
            background: #444ff1;
            color: #ffffff;
        }
        .services-2:nth-child(5) {
            background: #55e63e;
            color: #d6f774;
        }
        .services-2:nth-child(6) {
            background: #fe7aff;
            color: #360050;
        }
        .services-2:nth-child(4) h3 {
            color: #bbf5ff;
        }
        .work {
            height: 240px;
        }
        .hover-opacity:hover {
            background-color: rgba(255, 153, 36, 0.5);
        }
    </style>
@stop

@section('content')
    <span class="page">
        <!-- 輪播圖 -->
        <div class="hero-wrap">
            <div class="home-slider owl-carousel">

                @foreach($banners as $banner)
                    <div class="slider-item" style="background-image:url({{ $banner['img'] }});">
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="row no-gutters slider-text align-items-center justify-content-center">
                                <div class="col-md-12 ftco-animate">
                                    <div class="text w-100 text-center">
                                        <a href="{{ $banner['href'] }}">
                                            <h1 class="mb-3" style="font-size: 42px;">{{ $banner['title'] }}</h1>
                                            <h2>{{ date_format(date_create($banner['date']),"m/d") }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 25px;">{{ $banner['count'] }}</span>點閱</h2>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container">

                <form action="{{ route('test.http.testSubmit') }}" method="post">
                    @csrf
                    <button>Submit</button>
                </form>
                <!-- 時事top6 -->
                <h2 style="color: #4dc8ff;font-weight:500;">時事 <span style="color: #3cafff">Top 6</span></h2>
                <section class="ftco-section ftco-no-pt ftco-no-pb">
                    <div class="container-fluid px-md-0">
                        <div class="row no-gutters">

                            @foreach($news as $data)
                                <a href="{{ $data['href'] }}">
                                    <div class="col-md-4 ftco-animate">

                                        <div class="work img d-flex align-items-end" style="background-image: url({{ $data['img'] }});
                                            background-repeat: no-repeat;background-size: 100% 100%;cursor: pointer;">
                                            <div class="desc w-100 px-4">
                                                <div class="text w-100 mb-3">
                                                    <span>{{ date_format(date_create($data['date']), 'm月d日') }}</span>
                                                    <h2><a href="{{ $data['href'] }}" target="blank">{{ $data['title'] }}</a></h2>
                                                    <span>人氣 {{ $data['count'] }}</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </section>


                <div class="row">
                    <div class="col-md-3 d-flex services align-self-stretch p-4 py-md-5 ftco-animate">
                        <div class="media block-6 d-block text-center pt-md-4">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="flaticon-stairs"></span>
                            </div>
                            <div class="media-body p-2 mt-3">
                                <h3 class="heading">Yahoo!即時熱門搜尋</h3>
                                <p v-for="(row, index) in yahooHot">
                                    @{{ (index+1) + '. ' + row.text }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex services align-self-stretch p-4 py-md-5 ftco-animate">
                        <div class="media block-6 d-block text-center pt-md-4">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="flaticon-hook"></span>
                            </div>
                            <div class="media-body p-2 mt-3">
                                <h3 class="heading">時尚網紅聲量</h3>
                                <p v-for="(row, index) in netFamous">
                                    @{{ (index+1) + '. ' + row.name }} <span>(@{{ row.sound }})</span>
                                </p>
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-md-6 d-flex services align-self-stretch p-4 py-md-5 ftco-animate">--}}
{{--                        <div class="media block-6 d-block text-center pt-md-4">--}}
{{--                            <div class="icon d-flex justify-content-center align-items-center">--}}
{{--                                <span class="flaticon-skyline"></span>--}}
{{--                            </div>--}}
{{--                            <div class="media-body p-2 mt-3">--}}
{{--                                <h3 class="heading">熱門新聞</h3>--}}
{{--                                <p v-for="(row, index) in hotNews">--}}
{{--                                    <a :href="row.href">@{{ row.title }}</a>(@{{ row.from }})--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>


                <h2 style="color: #4dc8ff;font-weight:500;">熱門新聞 <span style="color: #3cafff">Top 6</span></h2>
                <div class="row no-gutters">

                    @foreach($hotNews as $new)
                        <div class="col-md-12 col-lg-4 services-2 p-4 py-5 d-flex ftco-animate hover-opacity">
                            <div class="py-3 d-flex">
                                <div class="row">
                                    <a href="{{ $new['href'] }}" style="color: unset;">
                                        <div class="text">
                                            <h3>{{ $new['from'] }}</h3>
                                            <p class="mb-0">{{ mb_substr($new['title'], 0, 29, 'utf-8') }} ...</p>
                                            <br>
                                            <span style="font-size: 10px;">人氣 {{ $new['count'] }}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

{{--                    <div class="col-md-12 col-lg-4 services-2 p-4 py-5 d-flex ftco-animate">--}}
{{--                        <div class="py-3 d-flex">--}}
{{--                            <div class="icon">--}}
{{--                                <span class="flaticon-engineer"></span>--}}
{{--                            </div>--}}
{{--                            <div class="text">--}}
{{--                                <h3>Expert &amp; Professional</h3>--}}
{{--                                <p class="mb-0">Separated they live in. A small river named Duden flows</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 col-lg-4 services-2 p-4 py-5 d-flex ftco-animate">--}}
{{--                        <div class="py-3 d-flex">--}}
{{--                            <div class="icon">--}}
{{--                                <span class="flaticon-engineer-1"></span>--}}
{{--                            </div>--}}
{{--                            <div class="text">--}}
{{--                                <h3>High Quality Work</h3>--}}
{{--                                <p class="mb-0">Separated they live in. A small river named Duden flows</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 col-lg-4 services-2 p-4 py-5 d-flex ftco-animate">--}}
{{--                        <div class="py-3 d-flex">--}}
{{--                            <div class="icon">--}}
{{--                                <span class="flaticon-engineer-2"></span>--}}
{{--                            </div>--}}
{{--                            <div class="text">--}}
{{--                                <h3>24/7 Help Support</h3>--}}
{{--                                <p class="mb-0">Separated they live in. A small river named Duden flows</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 col-lg-4 services-2 p-4 py-5 d-flex ftco-animate">--}}
{{--                        <div class="py-3 d-flex">--}}
{{--                            <div class="icon">--}}
{{--                                <span class="flaticon-engineer-1"></span>--}}
{{--                            </div>--}}
{{--                            <div class="text">--}}
{{--                                <h3>High Quality Work</h3>--}}
{{--                                <p class="mb-0">Separated they live in. A small river named Duden flows</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 col-lg-4 services-2 p-4 py-5 d-flex ftco-animate">--}}
{{--                        <div class="py-3 d-flex">--}}
{{--                            <div class="icon">--}}
{{--                                <span class="flaticon-engineer"></span>--}}
{{--                            </div>--}}
{{--                            <div class="text">--}}
{{--                                <h3>Expert &amp; Professional</h3>--}}
{{--                                <p class="mb-0">Separated they live in. A small river named Duden flows</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 col-lg-4 services-2 p-4 py-5 d-flex ftco-animate">--}}
{{--                        <div class="py-3 d-flex">--}}
{{--                            <div class="icon">--}}
{{--                                <span class="flaticon-engineer"></span>--}}
{{--                            </div>--}}
{{--                            <div class="text">--}}
{{--                                <h3>Expert &amp; Professional</h3>--}}
{{--                                <p class="mb-0">Separated they live in. A small river named Duden flows</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>


            </div>
        </section>

        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container">
                <div class="row d-flex no-gutters">
                    <div class="col-md-6 d-flex">
                        <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-end"
                             style="background-image:url({{ asset('package/homebuilder/images/about.jp') }});">
                            <a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
                                <span class="icon-play"></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 pl-md-5">
                        <div class="row justify-content-start py-5">
                            <div class="col-md-12 heading-section ftco-animate pl-md-4 py-md-4">
                                <span class="subheading">Welcome to Home Builder</span>
                                <h2 class="mb-4">We create and turn into reality</h2>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                                <div class="tabulation-2 mt-4">
                                    <ul class="nav nav-pills nav-fill d-md-flex d-block">
                                        <li class="nav-item mb-md-0 mb-2">
                                            <a class="nav-link active py-2" data-toggle="tab" href="#home1">Our Mission</a>
                                        </li>
                                        <li class="nav-item px-lg-2 mb-md-0 mb-2">
                                            <a class="nav-link py-2" data-toggle="tab" href="#home2">Our Vision</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link py-2 mb-md-0 mb-2" data-toggle="tab" href="#home3">Our Value</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content bg-light rounded mt-2">
                                        <div class="tab-pane container p-0 active" id="home1">
                                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                                        </div>
                                        <div class="tab-pane container p-0 fade" id="home2">
                                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                                        </div>
                                        <div class="tab-pane container p-0 fade" id="home3">
                                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-counter" id="section-counter">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 d-flex">
                            <div class="text d-flex align-items-center">
                                <strong class="number" data-number="50">0</strong>
                            </div>
                            <div class="text-2">
                                <span>Years of <br>Experienced</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 d-flex">
                            <div class="text d-flex align-items-center">
                                <strong class="number" data-number="8500">0</strong>
                            </div>
                            <div class="text-2">
                                <span>Project <br>Done</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 d-flex">
                            <div class="text d-flex align-items-center">
                                <strong class="number" data-number="378">0</strong>
                            </div>
                            <div class="text-2">
                                <span>Professional <br>Expert</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 d-flex">
                            <div class="text d-flex align-items-center">
                                <strong class="number" data-number="1200">0</strong>
                            </div>
                            <div class="text-2">
                                <span>Machineries <br>Equipments</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container-fluid px-md-0">
                <div class="row no-gutters">
                    <div class="col-md-4 ftco-animate">
                        <div class="work img d-flex align-items-end" style="background-image: url({{ asset('package/homebuilder/images/work-1.jpg') }});">
                            <a href="images/work-1.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
                                <span class="icon-expand"></span>
                            </a>
                            <div class="desc w-100 px-4">
                                <div class="text w-100 mb-3">
                                    <span>Building</span>
                                    <h2><a href="work-single.html">College Health Profession</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ftco-animate">
                        <div class="work img d-flex align-items-end" style="background-image: url({{ asset('package/homebuilder/images/work-2.jpg') }});">
                            <a href="images/work-2.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
                                <span class="icon-expand"></span>
                            </a>
                            <div class="desc w-100 px-4">
                                <div class="text w-100 mb-3">
                                    <span>Building</span>
                                    <h2><a href="work-single.html">College Health Profession</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ftco-animate">
                        <div class="work img d-flex align-items-end" style="background-image: url({{ asset('package/homebuilder/images/work-3.jpg') }});">
                            <a href="images/work-3.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
                                <span class="icon-expand"></span>
                            </a>
                            <div class="desc w-100 px-4">
                                <div class="text w-100 mb-3">
                                    <span>Building</span>
                                    <h2><a href="work-single.html">College Health Profession</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 ftco-animate">
                        <div class="work img d-flex align-items-end" style="background-image: url({{ asset('package/homebuilder/images/work-4.jpg') }});">
                            <a href="images/work-4.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
                                <span class="icon-expand"></span>
                            </a>
                            <div class="desc w-100 px-4">
                                <div class="text w-100 mb-3">
                                    <span>Building</span>
                                    <h2><a href="work-single.html">College Health Profession</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ftco-animate">
                        <div class="work img d-flex align-items-end" style="background-image: url({{ asset('package/homebuilder/images/work-5.jpg') }});">
                            <a href="images/work-5.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
                                <span class="icon-expand"></span>
                            </a>
                            <div class="desc w-100 px-4">
                                <div class="text w-100 mb-3">
                                    <span>Building</span>
                                    <h2><a href="work-single.html">College Health Profession</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ftco-animate">
                        <div class="work img d-flex align-items-end" style="background-image: url({{ asset('package/homebuilder/images/work-6.jpg') }});">
                            <a href="images/work-6.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
                                <span class="icon-expand"></span>
                            </a>
                            <div class="desc w-100 px-4">
                                <div class="text w-100 mb-3">
                                    <span>Building</span>
                                    <h2><a href="work-single.html">College Health Profession</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="ftco-section testimony-section bg-primary">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                        <span class="subheading">Testimonial</span>
                        <h2 class="mb-4">Happy Clients</h2>
                    </div>
                </div>
                <div class="row ftco-animate">
                    <div class="col-md-12">
                        <div class="carousel-testimony owl-carousel ftco-owl">
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                    <div class="text">
                                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                        <div class="d-flex align-items-center">
                                            <div class="user-img" style="background-image: url({{ asset('package/homebuilder/images/person_1.jpg') }})"></div>
                                            <div class="pl-3">
                                                <p class="name">Roger Scott</p>
                                                <span class="position">Marketing Manager</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                    <div class="text">
                                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                        <div class="d-flex align-items-center">
                                            <div class="user-img" style="background-image: url({{ asset('package/homebuilder/images/person_2.jpg') }})"></div>
                                            <div class="pl-3">
                                                <p class="name">Roger Scott</p>
                                                <span class="position">Marketing Manager</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                    <div class="text">
                                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                        <div class="d-flex align-items-center">
                                            <div class="user-img" style="background-image: url({{ asset('package/homebuilder/images/person_3.jpg') }})"></div>
                                            <div class="pl-3">
                                                <p class="name">Roger Scott</p>
                                                <span class="position">Marketing Manager</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                    <div class="text">
                                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                        <div class="d-flex align-items-center">
                                            <div class="user-img" style="background-image: url({{ asset('package/homebuilder/images/person_1.jpg') }})"></div>
                                            <div class="pl-3">
                                                <p class="name">Roger Scott</p>
                                                <span class="position">Marketing Manager</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                                    <div class="text">
                                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                        <div class="d-flex align-items-center">
                                            <div class="user-img" style="background-image: url({{ asset('package/homebuilder/images/person_2.jpg') }})"></div>
                                            <div class="pl-3">
                                                <p class="name">Roger Scott</p>
                                                <span class="position">Marketing Manager</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center mb-5 pb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <span class="subheading">Our Blog</span>
                        <h2>Recent Blog</h2>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch">
                            <a href="blog-single.html" class="block-20 rounded" style="background-image: url('{{ asset('package/homebuilder/images/image_1.jpg') }}');">
                            </a>
                            <div class="text mt-3 text-center">
                                <div class="meta mb-2">
                                    <div><a href="#">January 30, 2020</a></div>
                                    <div><a href="#">Admin</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch">
                            <a href="blog-single.html" class="block-20 rounded" style="background-image: url('{{ asset('package/homebuilder/images/image_2.jpg') }}');">
                            </a>
                            <div class="text mt-3 text-center">
                                <div class="meta mb-2">
                                    <div><a href="#">January 30, 2020</a></div>
                                    <div><a href="#">Admin</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch">
                            <a href="blog-single.html" class="block-20 rounded" style="background-image: url('{{ asset('package/homebuilder/images/image_3.jpg') }}');">
                            </a>
                            <div class="text mt-3 text-center">
                                <div class="meta mb-2">
                                    <div><a href="#">January 30, 2020</a></div>
                                    <div><a href="#">Admin</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </span>
@stop

@section('script')
    <script>
        let page = new Vue({
            el: '.page',
            data: {
                news: [],
                yahooHot: [],
                netFamous: [],
                hotNews: [],
            },
            beforeMount(){
                this.getCreateData()
            },
            methods: {
                getCreateData() {
                    let self = this;
                    axios.get("{{ route('test.http.getHttpIndexData') }}")
                        .then(function (rep) {
                            console.log(rep.data);
                            self.news = rep.data.news;
                            self.yahooHot = rep.data.yahooHot;
                            self.netFamous = rep.data.netFamous;
                            self.hotNews = rep.data.hotNews;

                            // self.$nextTick(function(){
                            //     self.banners = rep.data.banners;
                            // });

                        })
                        .catch(function (error) {
                            alert('error');
                            console.log(error);
                        })
                }
            },
            filters: {
                setBkImg(img) {
                    console.log(img)
                    return "background-image: url(" + img + ")";
                }
            }
        })
    </script>
@stop
