<?php
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "premergency");


$db = new mysqli(HOST, USER, PASSWORD, DB);

if($db->connect_error) {
  die("Could not connect: " . $db->connect_error);
}
