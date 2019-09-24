<?php
    class Images extends Model
    {
        public function create()
        {
            $sql = "INSERT INTO images() VALUES()";
           
            $req = Database::getBdd()->prepare($sql);
            
            $req->execute([

                ]);
            
            return $req;
        }
        
        public function showImages()
        {
            $sql = "SELECT * FROM images";
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetch();
        }
        public function showAllImagess()
        {
            $sql = "SELECT * FROM imagess";
            $req = $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        }

        public function delete()
        {
            $sql = "DELETE FROM images WHERE id = ?";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute(); 
        }
    }
?>