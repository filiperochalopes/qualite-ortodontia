<?php 

require("../../config-globals.php");

session_start(); 
session_destroy(); 

header("Location: ".$domain); 

?>