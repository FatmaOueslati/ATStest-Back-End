<?php

$connect = mysqli_connect("localhost", "root", "", "testATStest"); //Connect PHP to MySQL Database
$opts = array(
    'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en\r\n" .
            "Cookie: foo=bar\r\n"
    )
);


$context = stream_context_create($opts);
$file = file_get_contents('http://internal.ats-digital.com:30000/products?size=500', false, $context);
$array = json_decode($file, true);
var_dump($array);

foreach($array as $row) //Extract the Array Values by using Foreach Loop
{
    $sql = "INSERT INTO Produittt(color , category , productName , price , description ,tag , productMaterial , createdAt, ImageUrl)
		   VALUES ('".$row["color"]."', '".$row["category"]."', '".$row["productName"]."','".$row["price"]."','".$row["description"]."','".$row["tag"]."','".$row["productMaterial"]."','".$row["createdAt"]."','".$row["productMaterial"]."','".$row["imageUrl"]."');";

 //foreach()
   /* $sql1 = "INSERT INTO Review(product_id, rating, content)
VALUES ('".$row[""]."', '".$row["rating"]."', '".$row["content"] ."');";
*/

    mysqli_query($connect, $sql);
    }
		  
		  
     

?>


