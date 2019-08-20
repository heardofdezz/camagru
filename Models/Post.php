<?php
    class Post extends Model
    {
        public function create()
        {
            $sql = "INSERT INTO posts() VALUES()";
           
            $req = Database::getBdd()->prepare($sql);
            
            $req->execute([

                ]);
            
            return $req;
        }
        
        public function showPost()
        {
            $sql = "SELECT * FROM posts";
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetch();
        }
        public function showAllPosts()
        {
            $sql = "SELECT * FROM posts";
            $req = $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        }

        public function delete()
        {
            $sql = "DELETE FROM posts WHERE id = ?";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute(); 
        }
    }
?>