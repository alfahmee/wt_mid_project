<!DOCTYPE htm<!DOCTYPE html>
<html>
<head>
    <title>Request for Booh</title>
</head>
<body>

    <?php

    $bname=$aname= $pname=$edition="";
    $bnameErr=$anameErr=$pnameErr=$editionErr="";

    if($_SERVER['REQUEST_METHOD'] == "POST") {


        if (empty($_POST['bname'])) {

            $bnameErr="Please full Book Name";
            
        }
        else {
            $bname=$_POST['bname'];
        }

        if (empty($_POST['aname'])) {

            $anameErr="Please Enter your your author name";
            
        }
        else {
            $aname=$_POST['aname'];
        }


        if (empty($_POST['pname'])) {

            $pnameErr="Please Enter publisher name";
            
        }
        else {
            $pname=$_POST['pname'];
        }


       


        if (empty($_POST['edition'])) {

            $editionErr="Please Enter book edition";
            
        }
        else {
            $edition=$_POST['edition'];
        }


       

        if ($bnameErr=="" && $anameErr=="" && $pnameErr== "" && $editionErr== "") {
            echo "Success" .$bname;
            
            $formdata=array(
                'bname'=> $bname,
                'aname'=> $aname,
                'pname'=> $pname,
                'edition'=> $edition,
                
        );

        $existingdata=file_get_contents('brequest.txt');
        $tempJSONdata=json_decode($existingdata);
        $tempJSONdata[]=$formdata;

        $jsondata=json_encode($tempJSONdata,JSON_PRETTY_PRINT);

        if(file_put_contents("brequest.txt","$jsondata")){
            echo "Data Successfully saved <br>";
        }


           
        }

      

    }


      ?>
    <h1>Request for Book </h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">



    	    <fieldset>
                <legend><b>Request for Book</b></legend>

    
    

    <label for="bname">Book name: </label>
    <input type="text" id="bname" name="bname" value="<?php echo $bname ?>">

    <?php echo $bnameErr; ?>
    <br>

    <br>

    <!-- LName  -->
        <label for="aname">Author Name : </label>
        <input type="text" name="aname" id="aname" value="<?php echo $aname ?>">
        <p><?php echo $anameErr; ?></p>
    <br>

      

     <!-- Email  -->
        <label for="pname">Publisher Name : </label>
        <input type="text" name="pname" id="pname" value="<?php echo $pname ?>">
        <p><?php echo $pnameErr; ?></p>
    <br>

    

        <!-- User Name  -->
        <label for="edition">Edition : </label>
        <input type="text" name="edition" id="edition" value="<?php echo $edition ?>">
        <p><?php echo $editionErr; ?></p>
        <br>


          </fieldset>
       
        
    


    <input type="submit" name="submit">


    </form>

</body>
</html>

           

                
               
         <h5>Back to the <a href="profile.php">profile</a></h5>       

                <br>

            
        
    </body>
</html>


