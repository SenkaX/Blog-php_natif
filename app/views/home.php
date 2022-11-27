<?php /** @var App\Entity\User $user */ ?>
<h1><?= $trucs; ?></h1>

<?php
var_dump($posts);
/** @var App\Entity\Post[] $posts */
foreach ($posts as $post) {
    echo $post->getContent();
}
/** @var \App\Manager\PostManager $manager */
$manager->postNewPost("okay","1");


