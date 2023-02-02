<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php
        include_once 'db.php';

        $sql = "SELECT * FROM image ORDER BY orderImg DESC";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed!";
        } else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<a href=#>
        <div style="background-image: url(img/'. $row["fullNameImg"] . ');"></div>
        <h3>' . $row["titleImg"] . '</h3>
        <p>' . $row["descImg"] . '</p>
        </a>';

            }
        }
        ?>
    </div>


    <form action="img-upload.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="filename" placeholder="File name">
        <input type="text" name="filetitle" placeholder="Image Title">
        <input type="text" name="filedesc" placeholder="Image Desription">
        <input type="file" name="file">
        <button type="submit" name="submit">UPLOAD</button>
    </form>

</body>

</html>