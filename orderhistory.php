
<!DOCTYPE html>
 <html>
 <head>
 	<h3>Order History</h3>>
     <title>Order History</title>
 </head>
 <body>
     <?php  
 $mydata=file_get_contents("feedback.txt");
        $data=json_decode($mydata);
        $s= count($data);        

        for($i = 0; $i< $s; $i++) {

             echo "<fieldset>


                <legend><b>Book:</b></legend>";

             echo "Book Id : ".$data[$i]->bid."<br>";
             echo "Book Title : ".$data[$i]->bookName."<br>";
            
             echo "</fieldset>";


        }

         ?>


  
        
         <h5>Back to the <a href="profile.php">profile</a></h5>  

 
 </body>
 </html>
      