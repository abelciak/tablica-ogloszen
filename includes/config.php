<?php 
@error_reporting(0);
@session_start();
mysql_connect("loaclhostpl","user","pass");
mysql_select_db("db");
mysql_query ('SET NAMES utf8');
?>