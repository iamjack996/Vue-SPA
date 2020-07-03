const express = require('express');
const app = express();
const http = require('http');
const router = express.Router()

const axios = require('axios');
const os = require("os");
// Socket.io
const server = require('http').Server(app);
const io = require('socket.io')(server);

app.all("*", function (req, res, next) {
    //设置允许跨域的域名，*代表允许任意域名跨域
    res.header("Access-Control-Allow-Origin", "http://vue.test/");
    //允许的header类型
    res.header("Access-Control-Allow-Headers", "content-type");
    //跨域允许的请求方式
    res.header("Access-Control-Allow-Methods", "DELETE,PUT,POST,GET,OPTIONS");
    if (req.method.toLowerCase() == 'options')
        res.send(200);  //让options尝试请求快速结束
    else
        next();
})

app.get('/test', function (req, res) {
    res.send('hello world');
});

http.createServer(app)

let chat = io.of('/test')
chat.on('connection', function (socket) {
    console.log('Socket Connected!')
    // console.log(server.address().port)
    // console.log('hostname -> ' + os.hostname())

    socket.on('load', function () {
        console.log('--- >>> load.')
        socket.join('socketBlade')
    })

    socket.on('saveMsg', function (data) {
        let {user, msg} = data
        console.log('saveMsg / Data => ' + msg)

        // https 會失敗
        axios.post('http://cardjack.shiftpaydata.cc/socket/newMsg', {
            user, msg
        })
            .then((res) => {
                // console.log(`statusCode: ${res.statusCode}`)
                console.log(res.data)
            })
            .catch((error) => {
                console.error(error)
            })

        socket.to('socketBlade').emit("updateMsg", data)
    })

    socket.on('disconnect', () => {
        console.log('disconnect')
    });

})

server.listen(6001, () => { // 掛上 6001 port
    console.log("Server Started. http://localhost:6001");
});
