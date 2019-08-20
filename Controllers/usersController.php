<?php
    class UsersController extends Controller
    {

        public function index()
        {
            require(ROOT . 'Models/User.php');

        $users= new User();

            $d['users'] = $users->showAllUsers();
            $this->set($d);
           // $this->render("index");
        }
     
        public function home()
        {

        }
        public function create()
        {
            // $passwd = "";
            if (isset($_POST["Nom"]) && isset($_POST["Prenom"]) && isset($_POST["Address"]) && isset($_POST["Ville"]) && isset($_POST["Zipcode"]) && isset($_POST["Email"]) && isset($_POST["Password"]) && isset($_POST["Password2"]))
	        {
                require(ROOT . 'Models/User.php');

                $user = new User();

                $nom = htmlspecialchars($_POST["Nom"]);
		        $prenom = htmlspecialchars($_POST["Prenom"]);
		        $address = htmlspecialchars($_POST["Address"]);
		        $ville = htmlspecialchars($_POST["Ville"]);
		        $zipcode = htmlspecialchars($_POST["Zipcode"]);
		        $email = htmlspecialchars($_POST["Email"]);
		        $passwd1 = htmlspecialchars($_POST["Password"]);
		        $passwd2 = htmlspecialchars($_POST["Password2"]);

                if(preg_match("/^.+@.+\..+$/", $email) && $passwd1 === $passwd2)
                {
                    if (isset($passwd1) && $passwd1 === $passwd2)
                    {
                        // $passwd = hash("whirlpool", $passwd1);
                        if ($user->create($nom, $prenom, $address, $ville, $zipcode, $email, hash("whirlpool", $passwd1)))
                        {
                           // header("Location: " . WEBROOT . "users/home");
                            //echo "Utilisateur créé avec succès !\n";
                             $this->render("home");
                        }
                    }
                }
  
	            if (!isset($user))
	            {
		            echo "<title>Echec de la création</title>";
		            echo "<meta charset='utf-8'>";
		            echo "Echec de la création de l'utilisateur. Cliquez <a href='create.php'>ici</a> pour revenir à la page de création de compte.";
                    header("Location: " . WEBROOT . "users/create");
                    exit;
                }
            }
        }
        public function login()
        {
             var_dump("login triggered !");
          
            if(isset($_POST["login_btn"]))
            {
                //var_dump("login triggered !");
                $email = $_POST["Email"];
                $passwd = hash("whirlpool", $_POST["Password"]);
                $sql = "SELECT Email, Password, User_id FROM users /*WHERE Email=?, Password=?*/";
                $req = Database::getBdd()->query($sql);
                $res = $req->fetchAll();
                //$req->execute(array($email,$passwd));
                // var_dump($res[0]['Email']);
                //  exit;
                foreach ($res as $k => $v)
                {
                    var_dump($res[$k][$k]);
                    if($res[$k]['Email'] === $email && $res[$k]['Password'] === $passwd)
                    {
                        var_dump($res[$k]['Email']);
       
                        $_SESSION['User_id'] = $res[$k]['User_id'];
                         var_dump($_SESSION['User_id']);
                         header("location: home");
                    } 
                    
                     else
                     {
                         $message = "Username/Password is wrong";
                    }
                }
            }
    
        }
        function isLoggedIn()
        {
	        if (isset($_SESSION['User_id'])) {
		        return true;
            }       
            else{
		        return false;
	        }
        }
        // return user array from their id
        function getUserById($id){
	    
	    $sql = "SELECT * FROM users WHERE id=" . $id;
	    $req = Database::getBdd()->prepare($sql);
	    
	    return $req->execute($sql);
}
        public function edit($id)
        {
            require(ROOT . 'Models/User.php');

            $user = new User();
            
            $d["user"] = $user ->showUser($id);
        }
       public function delete($id)
       {
           $sql= "DELETE FROM users WHERE id = ?";
           $req = Database::getBdd()->prepare($sql);
           return $req->execute($id);
       }
    }
?>