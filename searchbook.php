<!DOCTYPE html>
<html>
    <head>
        <title>Search Book</title>
    </head>
    <body>


        <?php

            $bookName = "";
            $bookNameerr = "";
             $berr = "";
             $Avilable="";
           

            $bookid=$bookn=$editin=$price="";

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Search") {

                $mydata=file_get_contents("Book.txt");
            $data=json_decode($mydata);
            $s= count($data);

                $n=$s-2;



             


            for($i = 0; $i< $s; $i++) {
                

                if($data[$i]->bookName == $_POST['bName']) 
                {
                	$bookn=$data[$i]->bookName;
                	$price=$data[$i]->bprice;

                	$bookid=$data[$i]->bid;



                     
                   echo "Book Id :" .$data[$i]->bid."<br>"; 
                   

                    echo "   Book Name :" .$data[$i]->bookName."<br>"; 
                  

                     echo"   Book Author :". $data[$i]->bauthor."<br>"; 
                     

                      echo "   Book Publisher : " .$data[$i]->bpublisher."<br>"; 
                     

                       echo"   Book Price :". $data[$i]->bprice."<br>";

                       

                    
                }
                else if($i==$n)
                {$Avilable="notavilable";}
                


            }

            if($Avilable=="notavilable")
            {
             echo  "This book Is NOT Avilable";
            }




                
            }
            
            

            
        

        ?>

        <?php


            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "AddToCart") {


            	$mydata=file_get_contents("Book.txt");
            $data=json_decode($mydata);
            $s= count($data);





             


            for($i = 0; $i< $s; $i++) {
                

                if($data[$i]->bid == $_POST['bId']) 
                {
                	$bookn=$data[$i]->bookName;
                	$price=$data[$i]->bprice;

                	$bookid=$data[$i]->bid;



                     
                   echo "Book Id :" .$data[$i]->bid."<br>"; 
                   $formdata=array( 'bookName'=> $bookn, 'bid'=> $bookid,
		   	       					    		'bprice'=> $price,
		   	       					           );

		   	                                    $existingdata=file_get_contents('Cart.txt');
		   	       								$tempJSONdata=json_decode($existingdata);
		   	       								$tempJSONdata[]=$formdata;
		   	       
		   	       								$jsondata=json_encode($tempJSONdata,JSON_PRETTY_PRINT);
		   	       
		   	       								file_put_contents("Cart.txt","$jsondata");


		   	       								echo "Add Successfully";




          

                    
                }


                else if($data[$i]->bid !== $_POST['bId'])  {
                   $berr = "This book Is NOT Avilable";
                }


           

            }
            
                
      


                
                        


}

          

                    

        ?>
        
        <h1>Welcome to Digital E-Book</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
                <legend><b>Search Book</b></legend><br>
                 
            
                <label for="bookName">Book Name:</label>
                <input type="text" name="bName" id="bookName"><br>

                <input type="submit" value="Search" name="button"> <br>
                <?php echo $bookNameerr; ?>
                
                

                
                <br>

               

               
                
                </fieldset>

                

                <br>







                      <fieldset> 
                         <legend><b>Add TO Card Book</b></legend><br>
           
            <label for="booId">Book Id:</label>
                <input type="text" name="bId" id="bookId"><br>
            <input type="submit" value="AddToCart" name="button"><br>

       </fieldset>


            <h5>Back to the <a href="profile.php">profile</a></h5>  
            <h5>Go to the <a href=" ViewCart.php">View Cart</a></h5>  
        </form>

        <br>

       