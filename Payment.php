<?php 
   if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Payment") {

   	 session_start();
         $book = $_SESSION['bookName'];
         $bid = $_SESSION['bid'];
         $bprice=$_SESSION['bprice'];

        $Price=$_REQUEST['p'];

        if($bprice==$Price)
        {

        	$formdata=array('bookName'=> $book,'bid'=> $bid,
		   	       					    		'feedback'=> $_REQUEST['feedback'],
		   	       					    		
		   	       					           );

		   	                                    $existingdata=file_get_contents('feedback.txt');
		   	       								$tempJSONdata=json_decode($existingdata);
		   	       								$tempJSONdata[]=$formdata;
		   	       
		   	       								$jsondata=json_encode($tempJSONdata,JSON_PRETTY_PRINT);
		   	       
		   	       								file_put_contents("feedback.txt","$jsondata");
		   	       								header('Location: Profile.php');

        }

        else
        {
        	echo "Enter Price Properly";
        }


   }
 

 ?>

 <?php 
 session_start();
 	echo"Book Name : ". $_SESSION['bookName']."<br>";
        echo "Book Id : ". $_SESSION['bid']."<br>";
        echo "Book Price : ". $_SESSION['bprice']."<br>";

 	 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Buy Book</title>
 </head>
 <body>

 	<h1>Buy Book </h1>
 	


 	<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
 		   <input type="text" name="feedback" placeholder="Enter feedback">

 		    <input type="text" name="p" placeholder="Enter Book Price to complete Payment">

            <input type="submit" value="Payment" name= "button">
            
        </form>
         <h5>Back to the <a href="profile.php">profile</a></h5>
 
 </body>
 </html>