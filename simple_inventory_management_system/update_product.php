<?php
include_once "db.php";

if (isset($_POST["update"])) {

    $name = $_POST["updateName"];
    $description = $_POST["updateDescription"];
    $image = $_FILES["updateProductImage"]["name"];
    $price = $_POST["updatePrice"];
    $stock = $_POST["updateStock"];

    // Save the image
    $target = "images/" . basename($image);
    move_uploaded_file($_FILES["updateProductImage"]["tmp_name"], $target);

     // Check if this is an update or insert operations
 
     if (isset($_POST["productId"]) && isset($_POST["updateName"]) && isset($_POST["updateDescription"]) && isset($_POST["updatePrice"])) {
        // This is an update operation

        $id = $_POST["product_id"];
        $sql = "UPDATE products SET name='$name', description='$description', image='$image', price='$price', stock='$stock' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "Product updated successfully.";
            header("Location: index.php?upload=success");
    
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } 

    
}

// Close the database connection
mysqli_close($conn);

?>