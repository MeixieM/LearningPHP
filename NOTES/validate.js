<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // form validation
    $("#updateForm").submit(function(e) {
      e.preventDefault();
      
      // validate the form fields
      var productId = $("#productId").val();
      var productName = $("#productName").val();
      var productDescription = $("#productDescription").val();
      var productPrice = $("#productPrice").val();
      var productImage = $("#productImage").val();
      var isValid = true;
      
      if (productId == "") {
        $("#productIdError").text("Product ID is required");
        isValid = false;
      } else {
        $("#productIdError").text("");
      }
      
      if (productName == "") {
        $("#productNameError").text("Product name is required");
        isValid = false;
      } else {
        $("#productNameError").text("");
      }
      
      if (productDescription == "") {
        $("#productDescriptionError").text("Product description is required");
        isValid = false;
      } else {
        $("#productDescriptionError").text("");
      }
      
      if (productPrice == "") {
        $("#productPriceError").text("Product price is required");
        isValid = false;
      } else {
        $("#productPriceError").text("");
      }
      
      if (productImage == "") {
        $("#productImageError").text("Product image is required");
        isValid = false;
      } else {
        $("#productImageError").text("");
      }
      
      // if the form is valid, submit it to the server
      if (isValid) {
        $.ajax({
          type: "POST",
          url: "update-product.php",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            alert(data);
          },
          error: function() {
            alert("Error updating product");
          }
        });
      }
    });
  });
</script>
