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
    
    ws.id = uuid.v4();

    
    
    ws.on('message', function incoming(data) {
        data = JSON.parse(data);
        
        if (data.request == 'initialise') {
            // console.log(data);

            ws.send(JSON.stringify({info:`connected to discussion ${data.discussion}`}))

            CLIENTS.push({"client": ws.id, "discussion": data.discussion});
            
            // console.clear()
            // console.log(CLIENTS);
            // console.log('indic 2', CLIENTS)

        }
        else if (data.request == 'refresh') {
            // console.log('refresh')
            // console.log(ws.id)

            wss.clients.forEach(client => {
                // console.log(CLIENTS[index],client.id)
                // console.log(CLIENTS[CLIENTS.map(x => x.client).indexOf(ws.id)].discussion)

                if (CLIENTS[CLIENTS.map(x => x.client).indexOf(client.id)].discussion == CLIENTS[CLIENTS.map(x => x.client).indexOf(ws.id)].discussion) {
                    // console.log(CLIENTS[CLIENTS.map(x => x.client).indexOf(client.id)])
                    client.send(JSON.stringify({request: "refresh"}))
                }
                ws.send(JSON.stringify({info:`refreshing discussion : ${CLIENTS[CLIENTS.map(x => x.client).indexOf(ws.id)].discussion}`}))
            });
        }
    })
    
    ws.on('close', () => {
        CLIENTS.splice(CLIENTS.map(x => x.client).indexOf(ws.id),1)
    })
});
