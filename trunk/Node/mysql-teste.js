var Client = require('/usr/lib/node/mysql').Client;
var client = new Client();

client.host     = 'localhost';
client.user     = 'root';
client.password = 'root';

var TEST_DATABASE = 'mysql';
var TEST_TABLE    = 'user';

client.connect();

client.query('USE '+TEST_DATABASE);

client.query('SELECT * FROM '+TEST_TABLE, function (error, results, fields) {
    if(error){
      throw error;
    }
    console.log(results);
    //console.log(fields);
  }
);

client.end();
