<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
    </head>
    <body>
        <?php

            $firstname = $lastname = $email = $location=$phone= "";
            $emptyerr = $passerr = $notavailable =$locationerr=$phoneerr= "";

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Submit") {

                $firstname = $_POST['fname'];
                $lastname = $_POST['lname'];
                $email = $_POST['e-mail'];
                 $location = $_POST['location'];
                 $phone = $_POST['phone'];
                

                if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['gender']) || empty($_POST['e-mail'])  || empty($_POST['pass']) || empty($_POST['cpass'])  || empty($_POST['location'])  || empty($_POST['phone'])) {
                    $emptyerr = "Please Fill up the form properly!";
                }

                else if($_POST['pass'] != $_POST['cpass']) {
                    $passerr="Password doesn't Match";
                }

                else if(strlen($_POST['pass']) <= 7) {
                    $passerr="Password Must be minimum 8 character!";
                }

                else {

                    $gender = $_POST['gender'];
                    
                    $password = $_POST['pass'];

                    $log_file = fopen("Login.txt", "r");
                    
                    $data = fread($log_file, filesize("Login.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);

                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);

                        if( $json_decode['username'] == $email) 
                        {
                            $notavailable = "You have already an Account!! Go to Login Page and LOGIN with your password!";
                        }
                        
                        }
                        if($notavailable == "")      
                        {             
                            $details = array('firstname' => $firstname, 'lastname' => $lastname, 'gender' => $gender, 'email' => $email,  'location' => $location ,'phone' => $phone);
                            $details_encoded = json_encode($details);

                            $filepath = "Registration.txt";

                            $reg_file = fopen($filepath, "a");
                            fwrite($reg_file, $details_encoded . "\n");	
                            fclose($reg_file);

                            $usertable = array('username' => $email, 'password' => $password);
                            $usertable_encoded = json_encode($usertable);

                            $log_filepath = "Login.txt";

                            $log_file = fopen($log_filepath, "a");
                            fwrite($log_file, $usertable_encoded . "\n");	
                            fclose($log_file);

                            $_SESSION['message'] = "You have clicked on Submit button successfully";

                            header('Location: login.php');
                        }
                    }
            }
        ?>

        <h1>Registration Form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
                <legend><b>Basic Information:</b></legend>
            
                <label for="firstname">First Name:</label>
                <input type="text" name="fname" id="firstname" value="<?php echo $firstname; ?>">

                <br>

                <label for="lastname"> LastName:</label>
                <input type="text" name="lname" id="lastname" value="<?php echo $lastname; ?>">

                <br>

                <label for="gender">Gender:  </label>
                <input type="radio" name="gender" id="male" value="male">  
                <label for="gender">Male </label>
                <input type="radio" name="gender" id="female" value="female">
                <label for="gender">Female </label>
                <input type="radio" name="gender" id="other" value="other">
                <label for="gender">Other </label>

                <br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="e-mail" value="<?php echo $email; ?>">


                 <br>

                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">

                <br>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?php echo $location; ?>">

                <br>

                

            </fieldset>

            <fieldset>
                <legend><b>Account Information:</b></legend>

                <label for="password">Password:</label>
                <input type="password" name="pass" id="password">

                <br>

                <label for="cpassword">Confirm Password:</label>
                <input type="password" name="cpass" id="cpassword">
                <?php echo $passerr; ?>

                <br>

                
                
                </fieldset>

                <?php echo $emptyerr; ?>
                <?php echo $notavailable; ?>
                

                <br>

            <input type="submit" value="Submit" name="button"> 
        </form>

        <form action="<?php if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Back") header("Location: login.php"); ?>" method="POST">
        <input type="submit" value="Back" name="button">
        </form>

        <br>


         <h5>Have yoy already account ?</h5>
        
    <h5>Go to <a href="login.php">login</a></h5>
        
    </body>
</html>


