const express = require('express');
const app = express();

const axios = require('axios');
const os = require("os");
// Socket.io
const server = require('http').Server(app);
const io = require('socket.io')(server);

let chat = io.of('/test')
chat.on('connection', function (socket) {
    console.log('Socket Connected!')
    console.log(server.address().port)

    socket.on('load', function (data) {
        console.log(data + ' >>> load.')
    })

    socket.on('appendMsg', function (data) {
        let {user, msg} = data
        console.log('appendMsg / Data => ' + msg)
        axios
            .post('http://127.0.0.1:80/socket/newMsg',{
                user, msg
            })
            .then(res => {
                // console.log(`statusCode: ${res.statusCode}`)
                console.log(res)
            })
            .catch(error => {
                console.error(error)
            })
    })

    socket.on('disconnect', () => {
        console.log('disconnect')
    });

})

server.listen(6001, () => { // 掛上 6001 port
    console.log("Server Started. http://localhost:6001");
});
