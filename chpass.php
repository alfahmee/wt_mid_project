<!DOCTYPE html>
<html>
    <head>
        <title>Account Recovery</title>
    </head>
    <body>
        <?php

            $ques = $name = $usernameerr = $password  = "";

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Check") {

                if(empty($_POST['gmail'])) {                    
                    $usernameerr = "Please Fill up your Email!";
                }
                
                else {

                    $log_file = fopen("registration.txt", "r");
                    
                    $data = fread($log_file, filesize("registration.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                    
                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);
                        if($json_decode['email'] == ($_POST['gmail'])) 
                        {
                            session_start();
                            $_SESSION['gmail'] = $json_decode['email'];
                            $_SESSION['name'] = $json_decode['lastname'];
                            $_SESSION['pass'] = $json_decode['pass'];
                            
                            header("Location: chpass3.php");
                        }                        
                    }
                     if($json_decode['email'] !== ($_POST['gmail'])) {
                        $usernameerr = "Email doesn't Match!!!";
                    }               
                }
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Back to Login") {
                unset($_SESSION['gmail']);
                unset($_SESSION['name']); 
                unset($_SESSION['pass']);  
                 
                header('Location: login.php');
            }
        ?>
        
        <h3>Chsngr your Password</h3>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            
                <label for="gmail">Enter Your Email:</label>
                <input type="text" name="gmail" id="g-mail">
                <input type="submit" value="Check" name="button"> 
                <?php echo $usernameerr; ?>

                <br>
                <?php echo $ques; ?>
                <br>
                <input type="submit" value="Back to Login" name="button">
            
        </form>

        <br>



        
    </body>
</html>