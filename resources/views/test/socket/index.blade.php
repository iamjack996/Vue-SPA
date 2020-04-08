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
        .text_r {
            text-align: right;
        }
    </style>
@stop

@section('content')
    <span class="page">

        <h4 style="margin-left: 80px;">留言板</h4>
        <section class="ftco-section" style="padding: 20px 0;">
            <div class="container" style="border: 2px solid grey">
                <div class="row">
                    <div class="col-md-12 msgBox" style="height: 500px;overflow:scroll">
                        <span v-for="(msg, index) in messages">
                            <h5 class="font-weight-bold" :class="{ text_r: msg.local }">@{{ msg.user }}</h5>
                            <p :class="{ text_r: msg.local }">@{{ msg.content }}
                                <span style="padding-left: 20px">(
                                    <span v-if="msg.local">now.</span>
                                    <span v-else>@{{ msg.timeAt }}</span>
                                )</span>
                            </p>
                        </span>

{{--                        <h5 class="font-weight-bold text_r">Home Builder</h5>--}}
{{--                        <p class="text_r">Far far away, behind the word mountains, far from the con.</p>--}}

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
                    socket.emit("load")
                }, 2000)
            })

            socket.on('updateMsg', function (msgData) {
                console.log(msgData)
                let today = new Date();
                page.messages.push({
                    user: msgData.user,
                    content: msgData.msg,
                    local: false,
                    timeAt: (today.getMonth()+1) + '/' + today.getDate() + ' ' + today.getHours() + ':' + today.getMinutes()
                })
                $(".msgBox").animate({ scrollTop: $(document).height()+9999 }, "fast");
            })
        });

        let page = new Vue({
            el: '.page',
            data: {
                user: null,
                messages: []
            },
            beforeMount(){
                this.getCreateData()
            },
            methods: {
                getCreateData() {
                    let self = this;
                    axios.get("{{ route('test.socket.getSocketIndexData') }}")
                        .then(function (rep) {
                            console.log(rep.data);
                            self.$nextTick(function(){
                                self.messages = rep.data.messages;
                                $(".msgBox").animate({ scrollTop: $(document).height()+9999 }, "fast");
                            });
                        })
                        .catch(function (error) {
                            alert('error');
                            console.log(error);
                        })
                },
                addUser() {
                    this.user = $('#user_name').val()
                    $('#user_name').val('')
                },
                sendMsg() {
                    let msg = $('#new_msg').val()
                    let msgData = {
                        user: this.user,
                        msg
                    }
                    if (!msgData.msg) {
                        swal.fire(
                            '內容不可空',
                            '',
                            'error'
                        )
                        return;
                    }
                    socket.emit("saveMsg", msgData)

                    this.messages.push({
                        user: this.user,
                        content: msg,
                        local: true
                    })
                    $('#new_msg').val('')

                    $(".msgBox").animate({ scrollTop: $(document).height()+9999 }, "fast");
                }
            },
            filters: {
            }
        })
    </script>
@stop
