<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Route\Route;
use http\Env\Response;

class PostController extends AbstractController
{
    #[Route('/', name: "homepage", methods: ["GET"])]
    public function home()
    {
        $manager = new PostManager(new PDOFactory());
        $posts = $manager->getAllPosts();

        $this->render("home.php", [
            "posts" => $posts,
            "manager" => $manager,
            "trucs" => "je suis une string",
            "machin" => 42
        ], "Tous les posts");
    }

    /**
     * @param $id
     * @param $truc
     * @param $machin
     * @return void
     */
    #[Route('/post/{id}/{truc}/{machin}', name: "francis", methods: ["GET"])]
    public function showOne($id, $truc, $machin)
    {
        var_dump($id, $truc);
    }

    #[Route('/editPost', name: "editPost", methods: ["POST"])]
    public function editPost()
    {
        $content = $_POST["content"];
        $authorId = $_POST["authorId"];
        $postId = $_POST["authorId"];
        $action = $_POST["action"];

        $manager = new PostManager(new PDOFactory());
        
        if ($action === "post") {
            $manager->postNewPost($content, $authorId);
        } elseif ($action === "edit") {
            $manager->deletePost($postId);
        } elseif ($action === "delete") {
            $manager->editPost($postId, $content);
        } else {
            return "invalid action";
        }

        return "ok";
    }
}
