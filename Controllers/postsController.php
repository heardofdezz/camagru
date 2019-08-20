<?php
    class postsController extends Controller
    {

        public function index()
        {
            require(ROOT . 'Models/Post.php');

            $posts = new Post();

            $d['posts'] = $posts->showAllPosts();
            $this->set($d);
        }
     
  
        public function create()
        {
            require(ROOT . 'Models/Post.php');
            $post = new Post();
        }

       public function delete($id)
       {
           $sql= "DELETE FROM posts WHERE id = ?";
           $req = Database::getBdd()->prepare($sql);
           return $req->execute($id);
       }
    }
?>