/**
 * Created by ai on 2016/10/03.
 * Hello World を表示する
 * http://localhost:1111/
 */
var http = require('http');
var fs = require('fs');

var server = http.createServer();
server.on('request', doRequest);




// start
server.listen(1111);
console.log('Server running!');
console.log('http://localhost:1111/');

// リクエストの処理
function doRequest(req, res) {
    res.writeHead(200, {'Content-Type': 'text/html'});

    fs.readFile('./public/index.html', 'UTF-8', function(err, data) {
        var date = new Date();
        var contents = data.replace(/DATETIME/g, date.toDateString());
        res.write(contents);
        res.end();
    });
}