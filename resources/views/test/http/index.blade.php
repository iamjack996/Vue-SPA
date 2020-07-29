@extends('test.template')

@section('head')
    <style>

    </style>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
                <div class="row d-flex no-gutters">

                    <div class="col-md-12 pl-md-5">
                        <div class="row justify-content-start py-5">
                            <div class="col-md-12 heading-section ftco-animate pl-md-4 py-md-4">
                                <span class="subheading title-text" style="color: grey">Yahoo!</span>
                                <h2 class="mb-4 type-title" style="width: 220px;">熱門 分類新聞</h2>
                                <p>時下最熱門的 時事、運動、娛樂、新奇、生活、影音類新聞文章</p>
                                <div class="tabulation-2 mt-4">
                                    <ul class="nav nav-pills nav-fill d-md-flex d-block">
                                        <li v-for="(row, index) in tabs" class="nav-item mb-md-0 mb-2 px-lg-2">
                                            <a class="nav-link py-2 y-tab-title" data-toggle="tab" :href="index | setTab" :class="{active: !index}">@{{ row.title }}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content bg-light rounded mt-2">
                                        <div v-for="(row, index) in pageNews" class="tab-pane container p-0" :class="{active : !index, fade : index}" :id="index | setId">
                                            <p>
                                                <div class="row">
                                                    <div v-for="(row, index) in row" :class="{'col-7' : !index, 'col-5' : index}">
                                                        <div class="row" v-if="!index">
                                                            <div v-for="(news, index2) in row" :class="{'col-12' : !index2, 'col-6' : index2}">
                                                                <a :href="news.href">
                                                                    <img :src="news.img" width="100%">
                                                                    <h4 class="hover-a">@{{ news.title }}</h4>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-else>
                                                            <div v-for="(news, index2) in row" class="col-12">
                                                                <a :href="news.href">
                                                                    <h4 class="hover-a">@{{ news.title }}</h4>
                                                                    <p>@{{ news.desc }}</p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container">
                <!-- 時事top6 -->
                <h2 class="title-text" style="color: #00d130;font-weight:500;">時事 <span class="title-text" style="color: #00c52e;">Top 6</span></h2>
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

                <div class="row" style="margin-bottom: 35px;margin-top: 35px;">
                    <div class="col-md-3 d-flex services align-self-stretch p-4 py-md-5 ftco-animate white" style="background: #a717ff;">
                        <div class="media block-6 d-block text-center pt-md-4">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="flaticon-stairs"></span>
                            </div>
                            <div class="media-body p-2 mt-3">
                                <h3 class="heading">Yahoo!關鍵搜尋</h3>
                                <br>
                                <p v-for="(row, index) in yahooHot">
                                    @{{ (index+1) + '. ' }}<a :href="row.href" class="hover-a white">@{{ row.text }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex services align-self-stretch p-4 py-md-5 ftco-animate">
                        <div class="media block-6 d-block text-center pt-md-4">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="flaticon-hook"></span>
                            </div>
                            <div class="media-body p-2 mt-3">
                                <h3 class="heading">時尚網紅聲量</h3>
                                <br>
                                <p v-for="(row, index) in netFamous">
                                    <span class="limit-text-len">@{{ (index+1) + '. ' + row.name }} (@{{ row.sound }})</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 py-md-5 py-4 pl-lg-5" style="background-color: #ffc107">
                        <h2 class="footer-heading">台鐵時刻查詢</h2>
                        <form action="{{ route('test.http.testSubmit') }}" method="post" class="contact-form">
                            @csrf

                            <div class="form-group">
{{--                                <input type="text" name="from" class="form-control" placeholder="出發站名" value="臺中">--}}
                                <input type="hidden" id="from-input" name="from" class="form-control" value="臺中">
                                <select class="form-control select2-multiple city-select-from">
                                    <option value="臺中">臺中</option>
                                </select>
                            </div>
                            <div class="form-group">
{{--                                <input type="text" name="to" class="form-control" placeholder="抵達站名" value="臺北">--}}
                                <input type="hidden" id="to-input" name="to" class="form-control" value="臺北">
                                <select class="form-control select2-multiple city-select-to">
                                    <option value="臺北">臺北</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="date" class="form-control" placeholder="日期" value="{{ date('Y/m/d', time()) }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control submit px-3">查詢</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2" style="background-color: #ffc107"></div>

                </div>

                <h2 class="title-text" style="color: #4dc8ff;font-weight:500;">熱門新聞 <span class="title-text" style="color: #3cafff">Top 6</span>
                    @foreach($hotNews as $new)
                        <a href="{{ $new['href'] }}" target="_blank">
                            <img src="{{ $new['img'] }}" title="{{ $new['title'] }}" style="height: 77px;">
                        </a>
                    @endforeach
                </h2>
                <div class="row no-gutters">
                    @foreach($hotNews as $new)
                        <div class="col-md-12 col-lg-4 services-2 p-4 py-5 d-flex ftco-animate hover-opacity">
                            <div class="py-3 d-flex">
                                <div class="row">
                                    <a href="{{ $new['href'] }}" style="color: unset;" target="_blank">
                                        <div class="text">
                                            <h3>{{ $new['from'] }}</h3>
                                            <p class="mb-0">{{ mb_substr($new['title'], 0, 59, 'utf-8') }} ...</p>
                                            <br>
                                            <span style="font-size: 10px;">人氣 {{ $new['count'] }}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
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

        <h2 class="text-center" style="color: #fdbf33;font-weight:500;margin-bottom: 0px;">Today <span style="color: #ffc107bd">看世界</span></h2>
        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container-fluid px-md-0">
                <div class="row no-gutters">

                    @foreach($todayVideos as $video)
                        <div class="col-md-4 ftco-animate">
                            <div class="work img d-flex align-items-end" style="background-image: url('{{ asset('package/homebuilder/images/work-'. (string)((int)$loop->index + 1).'.jpg') }}');">
                                <div class="desc w-100 px-4">
                                    <div class="text w-100 mb-3">
                                        <h2><a href="{{ $video['url'] }}" target="_blank">{{ $video['title'] }}</a></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

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

    </span>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            $(function(){
                $(".city-select-from").select2({
                    ajax: {
                        url: '{{ route('test.http.getCityData') }}',
                        dataType: 'json',
                        data: function (params) {
                            let query = {
                                search: params.term,
                                type: 'public'
                            }
                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function (data) {
                            page.selectFrom = data.results;
                            return {
                                results: data.results
                            };
                        }
                    }
                });
                $(".city-select-to").select2({
                    ajax: {
                        url: '{{ route('test.http.getCityData') }}',
                        dataType: 'json',
                        data: function (params) {
                            let query = {
                                search: params.term,
                                type: 'public'
                            }
                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function (data) {
                            page.selectTo = data.results;
                            return {
                                results: data.results
                            };
                        }
                    }
                });
            });

            $('.city-select-from').change(() => {
                let cityId = $('.city-select-from').val();

                $('#from-input').val(page.selectFrom[cityId-1].text);
            })
            $('.city-select-to').change(() => {
                let cityId = $('.city-select-to').val();

                $('#to-input').val(page.selectTo[cityId-1].text);
            })
        });

        let page = new Vue({
            el: '.page',
            data: {
                news: [],
                yahooHot: [],
                netFamous: [],
                hotNews: [],
                tabs: [],
                pageNews: [],
                selectFrom: [],
                selectTo: [],
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

                            self.$nextTick(function(){
                                self.tabs = rep.data.tabs;
                                self.pageNews = rep.data.pageNews;
                            });

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
                },
                setTab(index) {
                    return '#home' + index;
                },
                setId(index) {
                    return 'home' + index;
                },
            }
        })
    </script>
@stop
