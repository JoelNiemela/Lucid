<?php

require LUCID . 'view.php';

class PageController {
	function index() {
		view('Page/home.php');
	}
}
