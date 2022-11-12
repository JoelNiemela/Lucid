<?php

require LUCID . 'view.php';
require ROOT . '/models/Post.php';

class PostController {
    function index() {
        $posts = Post::all();
        view('Post/index.php', ['posts' => $posts]);
    }

    function show(int $post_id) {
        $post = Post::find(['post_id' => $post_id]);
        view('Post/show.php', ['post' => $post]);
    }

    function new() {
        view('Post/new.php');
    }

    function edit(int $post_id) {
        view('Post/edit.php');
    }

    function create() {
        $title = $_POST['title'];
        $text = $_POST['text'];

        $post = Post::new(['title' => $title, 'text' => $text]);
        $post_id = $post->post_id;

        header("Location: $post_id");
    }

    function update(int $post_id) {
        $title = $_POST['title'];
        $text = $_POST['text'];

        $post = Post::find(['post_id' => $post_id]);
        $post->update(['title' => $title, 'text' => $text]);

        header("Location: ../$post_id");
    }

    function destroy(int $post_id) {
        Post::delete(['post_id' => $post_id]);

        header("Location: ../../post");
    }
}
