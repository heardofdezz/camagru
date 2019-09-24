<?php
    class emailController extends Controller
{
    public function index()
    {
        include(ROOT . 'Models/User.php');
               
        $sql = "SELECT Email, token FROM users WHERE verified = 0";
        $req =  tDatabase::geBdd()->query($sql);
        $res = $req->fetchAll();
       // var_dump($res);
        foreach($res as $k => $v)
        {
            $token = $res[$k]['token']; 
            $to = $res[$k]['Email'];
            //var_dump($to);
            //exit;
            $subject = "Camagru Email Verification";
            $message = '<!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <title>Email verification</title>
            </head>
            <body>
            <div class="wrapper">
            <p>
            Thank you for signing up on Camagru Project 42. Please click on the link below to verify your email address and enter the following information.
            </p>
            <p>Email : '. $to . ' </p>
            <p>Token : ' . $token . ' </p>
            <a href="http://localhost:8080/email/verifyemail">Verify your email</a>
            </div>
            </body>
            </html>';
            $headers = "Content-Type: text/html; charset=UTF-8" . "\r \n";
            $headers .= "MIME-Version: 1.0" . "\r \n";

            mail($to, $subject, $message, $headers);
            exit;
        }
    }


    function verifyemail()
        {                 
            if (isset($_POST['verify_btn']))
            {
                include(ROOT . 'Models/User.php');
                $email = htmlspecialchars($_POST["Email"]);
                $token = htmlspecialchars($_POST["token"]);

                $sql = "SELECT verified, token, email FROM users WHERE verified = 0 AND token = '$token' LIMIT 1 ";
                
                $req = Database::getBdd()->query($sql);
                
                $res = $req->fetchAll();
                
                if($res)
                {
                        $update_user = "UPDATE users SET verified = 1 WHERE token = '$token' LIMIT 1";
                        $res2 = Database::getBdd()->query($update_user);
                        if($update_user)
                        {
                            echo "Felicitation votre compte a été verify :)";
                            header("Location: /users/login");
                            exit;
                        }
                        else
                        {
                            die("Hmmm something went wrong buddy");
                        }
                }   
                    else
                    {
                        die("Hmmm something went wrong buddy");
                    }  
            }
        }

        function forgotpassword()
        {
            if (isset($_POST['forgotpass_btn']))
            {
                include(ROOT . 'Models/User.php');
                $email = htmlspecialchars($_POST["Email"]);
                $sql = "SELECT email, token FROM users WHERE email = '$email'";
                $req = Database::getBdd()->query($sql);
                $res = $req->fetchAll();
                // var_dump("YOLO!!");
                $pass = rand(999, 9999);
                $newpassword = hash("whirlpool", $pass);

                $sql2 = "UPDATE users SET Password = '$newpassword' WHERE email = '$email'";
                $res2 = Database::getBdd()->query($sql2);
                if  ($res2)
                {
                   
                    $to = $email;
                    $subject = "Camagru Password Recovery";
                    $message = '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                    <meta charset="UTF-8">
                    <title>Password Reset</title>
                    </head>
                    <body>
                    <div class="wrapper">
                    <p>
                    Your request to reset your password has been received
                    </p>
                    <p>Here is your new password : '. $pass .'</p>
                    <p>Password can be modified within the user settings</p>
                    <a href="http://localhost:8080/users/loging">Click here to login with new password</a>
                    </div>
                    </body>
                    </html>';
                    

                    $headers = "Content-Type: text/html; charset=UTF-8" . "\r \n";
                    $headers .= "MIME-Version: 1.0" . "\r \n";
                    mail($to, $subject, $message, $headers);
               
                    header("Location: /users/login");
                    
                }
                else
                {
                    die("Hmmm something went wrong buddy");
                }

            }
        }
        
        function resetpassword()
        {
            if(isset($_POST['resetpass_btn']))
            {
                include(ROOT . 'Models/User.php');
            }
        }
        
}

?>