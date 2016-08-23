<?php
define('DB_NAME','troDevelopment');
define('DB_USER','troDev');
define('DB_PASSWORD','7d3yrq^Rwi2~Pgu');
define('DB_HOST','localhost');


// Create connection
@mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die ("Could not connect to MySQL");
// Select database
@mysql_select_db(DB_NAME) or die ("No database");

?>