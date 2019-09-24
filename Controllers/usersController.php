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
            // require(ROOT . 'Controllers/emailController.php');
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
                $verified = false; 
                $token = rand( 1, 100);
                
                if(preg_match("/^.+@.+\..+$/", $email) && $passwd1 === $passwd2)
                {
                    if (isset($passwd1) && $passwd1 === $passwd2)
                    {
                        $user->create($nom, $prenom, $address, $ville, $zipcode, $email, hash("whirlpool", $passwd1), $verified, $token);
                       //verifyEmail($email, $token); 
                        header("location: /email/index");
                        exit;
                        
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
            if(isset($_POST["login_btn"]))
            {
                require(ROOT . 'Models/User.php');

                //var_dump("login triggered !");
                $email = htmlspecialchars($_POST["Email"]);
                $passwd = htmlspecialchars(hash("whirlpool", $_POST["Password"]));
                $sql = "SELECT Email, Password, User_id, Nom, Prenom, verified FROM users";
                $req = Database::getBdd()->query($sql);
                $res = $req->fetchAll();
                // $verified = $res[$k]['verified'];
                foreach ($res as $k => $v)
                { 
                    // $verified = $res[$k]['verified'];
                    if($res[$k]['Email'] === $email && $res[$k]['Password'] === $passwd && $res[$k]['verified'] > 0)
                    {
                        // if ($res[$k]['verified'] === 1)
                        
                        session_start();
                        $user = $res[$k];
                        // var_dump($user);
                        // exit;
                        $_SESSION['verified'] = $res[$k]['verified'];
                        $_SESSION['User_id'] = $res[$k]['User_id'];
                        $_SESSION['Email'] = $res[$k]['Email'];
                        $_SESSION['Nom'] = $res[$k]['Nom'];
                        $_SESSION['Prenom'] = $res[$k]['Prenom'];
                    
                         if(isset($_SESSION['User_id']))
                        { 
                            header("Location: " . WEBROOT . "users/home");
                            exit;
                        }
                    } 
                    
                     else
                     {
                         $messag = "Username/Password is wrong";
                    }
                }
            }
    
        }
       
        public function logout()
        {
            // var_dump("ici");
            // die();
            // session_destroy();
            session_destroy();
            // session_unset('User_id');
            $_SESSION['User_id'] = '';
            $_SESSION['Nom'] = '';
            $_SESSION['Email'] = '';
            $_SESSION['Prenom'] = '';
            $_SESSION = NULL;
          
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
        function getUserById(){
	    
	    $sql = "SELECT * FROM users WHERE User_id=" . $User_id;
	    $req = Database::getBdd()->prepare($sql);
	    
	    return $req->execute($sql);
}
        public function edit()
        {
            require(ROOT . 'Models/User.php');
            // if (isset($_SESSION['verified']))
            // {
                $user = new User();
                $d["user"] = $user ->showUser($User_id);
                // var_dump($user);
                // var_dump($_SESSION);
            // }
        }
       public function delete($id)
       {
           $sql= "DELETE FROM users WHERE id = ?";
           $req = Database::getBdd()->prepare($sql);
           return $req->execute($id);
       }
    }
?>0