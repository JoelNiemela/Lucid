<!DOCTYPE html>
<html>
<head>
</head>
<body>
<a href=<?="./post/new"?>>Make a new post</a>
<?php foreach ($posts as $post): ?>
    <h1><?= $post->title ?></h1>
    <p><?= $post->text ?></p>
    <a href=<?="./post/{$post->post_id}"?>>View</a>
<?php endforeach ?>
</body>
</html>
