<?php

define('LUCID', __DIR__ . '/');
define('APP', $lucid_app . '/');

$routes = require APP . '/routes.php';

require_once LUCID . 'casing.php';

$resource = '';
$action = NULL;
$args = [];

if (isset($USE_RELATIVE_PATH_INFO)) {
    $url = $_SERVER['PATH_INFO'] ?? '/';
} else {
    $url = $_SERVER['REQUEST_URI'] ?? '/';
}

foreach ($routes as $route => $target) {
    if (preg_match($route, $url, $match_args)) {
		$target_segment = explode('@', $target);
		$resource = $target_segment[0];
		$action = $target_segment[1] ?? NULL;
        $args = $match_args;
	}
}

// Only keep named args
$args = array_filter($args, fn($k) => !is_numeric($k), ARRAY_FILTER_USE_KEY);

$controller_path = APP . '/controllers/' . $resource . '_controller.php';
if (file_exists($controller_path)) {
	require $controller_path;

	$controller_name = Casing::snake_to_pascal($resource).'Controller';
	$controller = new $controller_name();

	if (!isset($action)) {
		$action = 'index';
    }

	$controller->$action(...$args);
} else {
	header('HTTP/1.1 404 Not Found');
	die('404 — ' . $_SERVER['PATH_INFO'] . ' not found');
}
