<?php

define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);

function __autoload($classname)
{
		$namespace = substr($classname, 0, strrpos($classname, '\\'));
		$namespace = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
		$classPath = ROOT . str_replace('\\', '/', $namespace) . '.php';

		if(is_readable($classPath))
				require_once $classPath;
}