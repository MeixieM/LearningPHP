<?php 
include_once "db.php";

if (isset($_GET["deleteID"])) {
    // This is a delete operation
    $id = $_GET["deleteID"];
    $sql = "DELETE FROM products WHERE id='$id'";


    if (mysqli_query($conn, $sql)) {
        echo "Product deleted successfully.";
        header("Location: index.php?upload=success");

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>