<?php
    class imagessController extends Controller
    {

        public function index()
        {
            require(ROOT . 'Models/Image.php');

            $images = new Images();

            $d['images'] = $images->showAllImages();
            $this->set($d);
        }
     
  
        public function create()
        {
            require(ROOT . 'Models/Image.php');
            $images = new Images();
        }

       public function delete($id)
       {
           $sql= "DELETE FROM Images WHERE id = ?";
           $req = Database::getBdd()->prepare($sql);
           return $req->execute($id);
       }
    }
?>