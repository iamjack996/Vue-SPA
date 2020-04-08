@extends('test.template')

@section('head')
    <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
@stop

@section('content')
    <span class="page">


        <section class="ftco-section" style="padding: 50px 0">
            <div class="container" style="border: 2px solid grey">
                <div class="row">
                    <div class="col-md-12" style="height: 500px;overflow:scroll">
                        <h5 class="font-weight-bold">Home Builder</h5>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                        <h5 class="font-weight-bold">Home Builder</h5>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                        <h5 class="font-weight-bold">Home Builder</h5>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                        <h5 class="font-weight-bold">Home Builder</h5>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                        <h5 class="font-weight-bold">Home Builder</h5>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                        <h5 class="font-weight-bold">Home Builder</h5>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                        <h5 class="font-weight-bold">Home Builder</h5>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                        <h5 class="font-weight-bold">Home Builder</h5>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section ftco-no-pb ftco-no-pt mb-5">
            <div class="container">
                <div class="row">
                    <div v-if="!user" class="col-md-12">
                        <div class="bg-primary w-100 rounded px-md-0 px-4">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8 py-4">
                                    <div class="row">
                                        <div class="col-md-4 d-flex align-items-center">
                                            <h5 class="mb-0" style="color:white; font-size: 24px;">輸入暱稱</h5>
                                        </div>
                                        <div class="col-md-8 d-flex align-items-center">
                                            <form class="subscribe-form" @submit.prevent="addUser">
                                                <div class="form-group d-flex">
                                                    <input type="text" class="form-control" placeholder="暱稱" id="user_name">
                                                    <input type="submit" value="使用" class="submit px-3" @click="addUser">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="col-md-12">
                        <div class="bg-primary w-100 rounded px-md-0 px-4">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-10 py-4">
                                    <div class="row">
                                        <div class="col-md-4 d-flex align-items-center">
                                            <h5 class="mb-0" style="color:white; font-size: 24px;">@{{ user }}</h5>
                                        </div>
                                        <div class="col-md-8 d-flex align-items-center">
                                            <form action="#" class="subscribe-form">
                                                <div class="form-group d-flex">
                                                    <input type="text" class="form-control" id="new_msg" placeholder="想說什麼">
                                                    <input type="submit" value="送出" class="submit px-3" @click="sendMsg">
                                                </div>
                                            </form>
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

@section('afterJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js"></script>
{{--    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>--}}
{{--    <script src="/socket.io/socket.io.js"></script>--}}
{{--    <script src="{{ asset('/js/socket.io/lib/socket.js') }}"></script>--}}
    <script>
        const socket = io('ws://'+ location.host +':6001/test')

        $(document).ready(function() {
            socket.on("connect", () => {
                setTimeout(function () {
                    console.log('連線中')
                    socket.emit("load", '123123')
                }, 2000)
            })
        });

        let page = new Vue({
            el: '.page',
            data: {
                user: null
            },
            methods: {
                addUser() {
                    this.user = $('#user_name').val()
                },
                sendMsg() {
                    let msgData = {
                        user: this.user,
                        msg: $('#new_msg').val()
                    }
                    if (!msgData.msg) {
                        alert('empty')
                    }
                    socket.emit("appendMsg", msgData)
                }
            },
            filters: {
            }
        })
    </script>
@stop
