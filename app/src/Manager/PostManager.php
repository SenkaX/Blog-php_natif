<?php

namespace App\Manager;

use App\Entity\Post;

class PostManager extends BaseManager
{
    /**
     * @return Post[]
     */
    public function getAllPosts(): array
    {
        $query = $this->pdo->query("select * from Post");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new Post($data);
        }

        return $users;
    }

    public function postNewPost($content, $authorId)
    {
        $query = $this->pdo->query('INSERT INTO Post (id, content, author) VALUES (NULL, "' . $content . '", "' . $authorId . '")');

        $query->execute();
    }

    public function deletePost($postId)
    {
        $query = $this->pdo->query('DELETE FROM Post WHERE id = ' . $postId . ";");

        $query->execute();
    }

    public function editPost($postId, $content)
    {
        $query = $this->pdo->query('UPDATE Post SET content = "' . $content . '" WHERE id = ' . $postId . ';');

        $query->execute();
    }
}
