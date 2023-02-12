<button class="btn btn-danger" id="deleteBtn" data-id="<?php echo $product['id']; ?>">Delete</button>
          <button class="btn btn-danger" id="deleteBtn" data-id=' .$row['id']; ?>">Delete</button>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // show confirmation message when delete button is clicked
    $("#deleteBtn").click(function() {
      var productId = $(this).data("id");
      
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.value) {
          // send product ID to server for deletion
          $.ajax({
            type: "POST",
            url: "delete-product.php",
            data: { productId: productId },
            success: function(data) {
              Swal.fire("Deleted!", "The product has been deleted.", "success");
              
              // refresh the page
              location.reload();
            },
            error: function() {
              Swal.fire("Error", "Failed to delete the product.", "error");
            }
          });
        }
      });
    });
  });
</script>
