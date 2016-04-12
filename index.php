<?php

// autoload classes
require 'config.php';
require 'autoload.php';

$url = ''; 
if (isset($_GET['url']))
	$url = $_GET['url'];

$bootstrap = new Bootstrap($url);