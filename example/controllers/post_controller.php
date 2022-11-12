<?php

require LUCID . 'view.php';
require ROOT . '/models/Post.php';

class PostController {
    public function index() {
        $posts = Post::all();
        view('Post/index.php', ['posts' => $posts]);
    }

    public function show(int $post_id) {
        $post = Post::find(['post_id' => $post_id]);
        view('Post/show.php', ['post' => $post]);
    }

    public function new() {
        view('Post/new.php');
    }

    public function edit(int $post_id) {
        view('Post/edit.php');
    }

    public function create() {
        $title = $_POST['title'];
        $text = $_POST['text'];

        $post = Post::new(['title' => $title, 'text' => $text]);
        $post_id = $post->post_id;

        header("Location: $post_id");
    }

    public function update(int $post_id) {
        $title = $_POST['title'];
        $text = $_POST['text'];

        $post = Post::find(['post_id' => $post_id]);
        $post->update(['title' => $title, 'text' => $text]);

        header("Location: ../$post_id");
    }

    public function destroy(int $post_id) {
        Post::delete(['post_id' => $post_id]);

        header("Location: ../../post");
    }
}
