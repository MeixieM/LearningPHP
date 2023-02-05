<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./css/zephyr.css">
  <title>Inventory Management System</title>
</head>

<body>
  <div class="container mt-3">
    <h2>Inventory</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-end mb-3" data-bs-toggle="modal"
      data-bs-target="#addProductModal">
      Add Product
    </button>
  </div>

  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add new product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- The product form -->
          <form action="add_product.php" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="productImage">Product Image</label>
                  <input name="productImage" type="file" class="form-control-file" id="productImage">
                </div>
                <div class="form-group">
                  <label for="productName">Product Name</label>
                  <input name="name" type="text" class="form-control" id="productName"
                    aria-describedby="productNameHelp" placeholder="Enter product name">
                  <!-- <small id="productNameHelp" class="form-text text-muted">Enter a unique name for the product.</small> -->
                </div>
                <div class="form-group">
                  <label for="productDescription">Product Description</label>
                  <textarea name="description" class="form-control" id="productDescription" rows="3"
                    placeholder="Enter product description"></textarea>
                </div>

                <div class="form-group">
                  <label for="productPrice">Product Price</label>
                  <input name="price" type="number" class="form-control" id="productPrice"
                    placeholder="Enter product price">
                </div>
                <div class="form-group">
                  <label for="productPrice">Product Stock</label>
                  <input name="stock" type="number" class="form-control" id="productStock"
                    placeholder="Enter product stock">
                </div>
              </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button name="submit" type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  
  <div class="container">
    <table id="example" class="table table-hover table-striped" style="width:100%">
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Product Image</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include_once "db.php";
        $result = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td><img src='images/" . $row['image'] . "' width='100px' height='100px'></td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . "&#8369;" . $row['price'] . "</td>";
          echo "<td>" . $row['stock'] . "</td>";
          echo '<td><a href=\'#updateProductModal?updateID=' . $row['id'] .'\'><button class="btn btn-primary"><i class="bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#updateProductModal"></i></button></a>
         
          <a href=\'delete_product.php?deleteID=' . $row['id'] . '\' onClick=\'return confirm("Are you sure you want to delete?")\'"><button class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button></a>
        </td>';

          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>


<!-- Update Product Modal -->
<div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="updateProductModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- The product form -->
          <form action="update_product.php" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col">
                <?php
                include_once 'db.php';
                
                if (isset($_GET['updateID'])) {
                  $productId = $_GET['updateID'];
                  
                  // fetch product data from database
                  $sql = "SELECT * FROM products WHERE id='$productId'";
                  $result = mysqli_query($conn, $sql);
                  $product = mysqli_fetch_assoc($result);

                  $productImage = $product['updateProductImage'];
                  $productName = $product['updateName'];
                  $productDescription = $product['updateDescription'];
                  $productPrice = $product['updatePrice'];      
                  $productStock = $product['updateStock'];
          
                }
                ?>
                <input type="hidden" id="product_id" name="product_id" value="<?php echo $productId; ?>">
                <div class="form-group">
                  <label for="productImage">Product Image</label>
                   <img src="images/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid w-50 h-50">
                  <input name="updateProductImage" type="file" class="form-control-file" id="updateProductImage">
                </div>
                <div class="form-group">
                  <label for="productName">Product Name</label>
                  <input name="updateName" type="text" class="form-control" id="productName"
                    aria-describedby="productNameHelp" placeholder="Enter product name" value="<?php echo $productName; ?>">
                </div>
                <div class="form-group">
                  <label for="productDescription">Product Description</label>
                  <textarea name="updateDescription" class="form-control" id="productDescription" rows="3"
                    placeholder="Enter product description"><?php echo $productDescription; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="productPrice">Product Price</label>
                  <input name="updatePrice" type="number" class="form-control" id="productPrice"
                    placeholder="Enter product price" value="<?php echo $productPrice; ?>">
                </div>
                <div class="form-group">
                  <label for="productPrice">Product Stock</label>
                  <input name="updateStock" type="number" class="form-control" id="productStock"
                    placeholder="Enter product stock" value="<?php echo $productStock; ?>">
                </div>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button name="update" type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>

</html>