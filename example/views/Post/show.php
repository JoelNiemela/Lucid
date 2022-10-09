<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1><?= $post->title ?></h1>
<p><?= $post->text ?></p>
<a href=<?="./{$post->post_id}/destroy"?>>Delete</a>
<a href="../post">Back to all posts</a>
</body>
</html>
