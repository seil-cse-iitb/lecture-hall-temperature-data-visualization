<?php
echo "ddss";

var MongoClient = require('mongodb').MongoClient
  , format = require('util').format;

MongoClient.connect('mongodb://10.129.23.41:27017/data', function(err, db) {
  if(err) {echo "dddaered"; throw err;}
  db.collectionNames(function(err, collections){
      console.log(collections);
  });
});


#$connection = new MongoClient("Beauty@10.129.23.41", 27017);
#$connection = new MongoClient("mongodb://10.129.23.41:27017");

echo "<br>";
echo "success";
echo $connection;
#$collection = $connection->data->temp_k_fck;
#$cursor = $collection->find({$where: "this.TS==1487079073"});
#foreach ( $cursor as $id => $value )
#{
#    echo "id: ";
#    #var_dump( $value );
#}
?>