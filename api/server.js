#!/usr/bin/env node
var mysql = require('mysql');
const WebSocket = require('ws');
const uuid = require('uuid');
require('dotenv').config()
const wss = new WebSocket.Server({ port: 3000 });
var CLIENTS = [];

var connectionDB = mysql.createConnection({
    host     : process.env.DB_HOST,
    user     : process.env.DB_USER,
    password : process.env.DB_PASS,
    database : process.env.DB_NAME
});
connectionDB.connect();

var dbQuery = function (sql) {
    return new Promise(function (resolve,reject) {
        connectionDB.query(sql, function (error, results) {
            if (error) {
                reject(error);
            }
            else {
                resolve(results);
            }
        })
    })
}

var checkUserInConv = (user) => {
    request = mysql.format(sql, user)
}

var getArticles = async function (sql,values) {
    request = mysql.format(sql, values)
    console.log(request)
    let response = await dbQuery(request)
    return JSON.stringify(response)
}

wss.on('connection', function connection(ws) {

    ws.send(JSON.stringify({info:'Successfully synced with the WS server ✅'}));
    
    // console.log(wss.clients);
    ws.id = uuid.v4();

    
    
    ws.on('message', function incoming(data) {
        data = JSON.parse(data);
        
        if (data.request == 'initialise') {
            wss.clients.forEach(function each(client) {
                CLIENTS.push(JSON.stringify({client: client.id, conversation: data.conversation}));
            })
        }
        else if (data.request == 'refresh') {
            console.log('refresh')
            CLIENTS.forEach(client => {
                client = JSON.parse(client)
                if (JSON.stringify(client.conversation) == JSON.stringify(data.conversation)) {
                    wss.clients.forEach(wsClient => {
                        if (JSON.stringify(wsClient.id) == JSON.stringify(client.client)) {
                            wsClient.send(JSON.stringify({hello: 'lol'}))
                        }
                    })
                }
            })
            console.log(wss.clients);
            wss.clients.forEach(client => {
                console.log(client.id)
            })
        }
        else {
            CLIENTS = []
        }

        // console.log(CLIENTS)
    })
    ws.on('close',() => {
        CLIENTS = []
    })
});