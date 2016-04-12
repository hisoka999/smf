<?php
function autoloader($class) {
	if (file_exists('models/' . strtolower($class) . '.php'))
		include 'models/' . strtolower($class) . '.php';
	else
		include 'classes/' . strtolower($class) . '.php';
}

spl_autoload_register('autoloader');