<?php

require LUCID . 'view.php';

class PageController {
	public function index() {
		view('Page/home.php');
	}

	public function about() {
		view('Page/about.php');
	}
}
