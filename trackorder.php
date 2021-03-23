<!DOCTYPE html>
 <html>
 <head>
     <title>Track Order</title>
 </head>
 <body>
     <?php  
 $mydata=file_get_contents("trackorder.txt");
        $data=json_decode($mydata);
        $s= count($data);        

        for($i = 0; $i< $s; $i++) {

             echo "<fieldset>


                <legend><b>Order Track:</b></legend>";

             echo "Book Id : ".$data[$i]->bid."<br>";
             echo "Book Title : ".$data[$i]->bookName."<br>";
             echo "Order Status : ".$data[$i]->ostatus."<br>";
             echo "</fieldset>";


        }

         ?>


  

        
         <h5>Back to the <a href="profile.php">profile</a></h5>  

 
 </body>
 </html>
      