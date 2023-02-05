<form id="register-form">
  <label>Username:</label>
  <input type="text" name="username" id="username" required>

  <label>Email:</label>
  <input type="email" name="email" id="email" required>

  <label>Password:</label>
  <input type="password" name="password" id="password" required>

  <input type="submit" value="Submit">
</form>


$(document).ready(function() {
  $("#register-form").submit(function(e) {
    e.preventDefault();

    var username = $("#username").val();
    var email = $("#email").val();
    var password = $("#password").val();

    $.ajax({
      type: "POST",
      url: "register.php",
      data: { username: username, email: email, password: password },
      success: function(data) {
        alert(data);
      }
    });
  });
});


<?php
  if (CRYPT_BLOWFISH != 1) {
    die("This server does not support Argon2.");
  }

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $options = [
    'memory_cost' => 1<<17,
    'time_cost' => 4,
    'threads' => 2
  ];
  $hash = password_hash($password, PASSWORD_ARGON2ID, $options);

  $conn = mysqli_connect("localhost", "root", "", "registration");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hash')";
  if (mysqli_query($conn, $sql)) {
    echo "Record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  mysqli_close($conn);
?>

</br>

$(document).ready(function() {
  $("#login-form").submit(function(e) {
    e.preventDefault();

    var username = $("#username").val();
    var password = $("#password").val();

    $.ajax({
      type: "POST",
      url: "login.php",
      data: { username: username, password: password },
      success: function(data) {
        alert(data);
      }
    });
  });
});

<?php
  $username = $_POST['username'];
  $password = $_POST['password'];

  $conn = mysqli_connect("localhost", "root", "", "registration");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT password FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hash = $row['password'];
    if (password_verify($password, $hash)) {
      echo "Login successful";
    } else {
      echo "Incorrect username or password";
    }
  } else {
    echo "Incorrect username or password";
  }
  mysqli_close($conn);
?>


<div class="container">
  <h2 class="text-center">Login</h2>
  <form id="login-form" class="form-horizontal">
    <div class="form-group">
      <label class="control-label col-sm-2" for="username">Username:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="username" id="username" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="password">Password:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="password" id="password" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-default" value="Submit">
      </div>
    </div>
  </form>
</div>


