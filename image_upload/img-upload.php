<?php
if (isset($_POST['submit'])) {

    $newFileName = $_POST['filename'];
    if (empty($newFileName)) {
        $newFileName = "image";
    } else {
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $imageTitle = $_POST['filetitle'];
    $imageDesc = $_POST['filedesc'];

    $file = $_FILES['file'];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 2000000) {
                $imageFullName = $newFileName . ".". uniqid('', true) . ".". $fileActualExt;
                $fileDestination = 'img/' . $imageFullName;
                move_uploaded_file($fileTmpName, $fileDestination);
                include_once "db.php";

                if(empty($imageTitle) || empty($imageDesc)){
                    header("Location: index.php?upload=empty");
                    exit();
                } else {
                    $sql = "SELECT * FROM image;";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL Statement failed!";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOrder = $rowCount + 1;

                        $sql = "INSERT INTO image(titleImg, descImg, fullNameImg, orderImg) VALUES (?, ?, ?, ?);";
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL Statement failed!";
                        } else {
                            mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName, $fileDestination);
                            header("Location: index.php?upload=success");

                        }

                    }
                }

            } else {
                echo "Your file is too big!";
                exit();
            }
        } else {
            echo "There was an error uploading your file!";
            exit();
        }
    } else {
        echo "You cannot upload files of this type!";
        exit();

    }

}




?>