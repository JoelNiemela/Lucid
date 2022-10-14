<?php

function view($view, $args=[]) {
	extract($args);
	unset($args);

	include APP . '/views/' . $view;
}
