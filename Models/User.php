<?php
    class User extends Model
    {
        public function create($nom, $prenom, $address, $ville, $zipcode,$email, $passwd1)
        {
            $sql = "INSERT INTO users(Nom, Prenom, Address, Ville, Zipcode, Email, Password) VALUES(:nom, :prenom, :address, :ville, :zipcode, :email, :password)";
           
            $req = Database::getBdd()->prepare($sql);
            
            $req->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'address' => $address,
                'ville' => $ville,
                'zipcode' => $zipcode,
                'email' => $email,
                'password' => $passwd1
                ]);
            
            return $req;
        }
        
        public function showUser($id)
        {
            $sql = "SELECT * FROM users";
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetch();
        }
        public function showAllUsers()
        {
            $sql = "SELECT * FROM users";
            $req = $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        }
        public function edit($id, $nom, $prenom, $address, $ville, $email, $passwd1, $passwd2)
        {
            
            $sql = "UPDATE users nom = :nom, prenom = :prenom, address = :address, ville = :ville, email = :email, passwd1 = :passwd1, passwd2 = :passwd2";
            //, updated_at = :updated_at WHERE id = :id in case colunm updated is added tom model
            $req = Database::getBdd()->prepare($sql);

            return $req->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'address' => $address,
                'ville' => $ville,
                'email' => $email,
                'passwd1' => $passwd1,
                'passwd2' => $passwd2
            ]);
        }
        public function delete($id)
        {
            $sql = "DELETE FROM users WHERE id = ?";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute($id); 
        }
    }
?>