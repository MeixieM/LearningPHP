<?php
include_once "db.php";

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $description = $_POST["description"];
    $image = $_FILES["productImage"]["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    // Save the image
    $target = "images/" . basename($image);
    move_uploaded_file($_FILES["productImage"]["tmp_name"], $target);

    // Insert the product into the database
    $sql = "INSERT INTO products (name, description, image, price, stock)
    VALUES ('$name', '$description', '$image', '$price', '$stock')";

    if (mysqli_query($conn, $sql)) {
        echo "Product added successfully.";
        header("Location: index.php?upload=success");

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


//     $errors= array();
//     $file_name = $_FILES['image']['name'];
//     $file_size = $_FILES['image']['size'];
//     $file_tmp = $_FILES['image']['tmp_name'];
//     $file_type = $_FILES['image']['type'];
//     $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

//   $extensions= array("jpeg","jpg","png");

//   if(in_array($file_ext,$extensions)=== false){
//      $errors[]="extension not allowed, please choose a JPEG or PNG file.";
//   }

//   if($file_size > 1000000) {
//      $errors[]='File size must be less than 100 MB';
//   }

//   if(empty($errors)==true) {
//     // Save the image
//      move_uploaded_file($file_tmp,"images/".$file_name);
//      // Insert the product into the database
//         $sql = "INSERT INTO products (name, description, image, price, stock)
//         VALUES ('$name', '$description', '$file_name', '$price', '$stock')";
//         if (mysqli_query($conn, $sql)) {
//             echo "Product added successfully.";
//         } else {
//             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//         }
//   }else{
//      print_r($errors);
//   }
// }

// Close the database connection
mysqli_close($conn);

?>