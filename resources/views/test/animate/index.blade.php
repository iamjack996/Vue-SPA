@extends('test.template')

@section('head')
    <style>

    </style>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
@stop

@section('content')
    <span class="page">

        <div class="test-animate">123123456</div>


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
    <script src="{{ asset('/js/animate.js') }}"></script>
    <script>
        $(document).ready(function() {
            anime({
                targets: '.test-animate',
                scale: [
                    {value: .1, easing: 'easeOutSine', duration: 500},
                    {value: 1, easing: 'easeInOutQuad', duration: 1200}
                ],
                delay: anime.stagger(200, {grid: [14, 5], from: 'center'})
            });
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
