<?php 
include 'connect.php'; 

if (isset($_POST['register'])) {
    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass  = mysqli_real_escape_string( $conn, $_POST['pass']);

    $check = "SELECT * FROM Create_Acc WHERE email = '$email' ";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        echo "❌ This email already exists. Please use another.";
    } else {
        $sql = "INSERT INTO Create_Acc (name, email, pass) VALUES ('$name', '$email', '$pass')";
        $data = mysqli_query($conn, $sql);

        if ($data) {
            echo "✅ Account created successfully!";
        } else {
            echo "❌ Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Account • NovaShop</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <a class="logo" href="index.html">Nova<span>Shop</span></a>
    <nav class="nav">
      <a href="products.html">Products</a>
      <a href="wishlist.html">Wishlist</a>
      <a href="cart.html">Cart</a>
      <a href="payment.html">Payment</a>
      <a href="login.html" class="btn btn-ghost">Login</a>
    </nav>
  </div>

</header>
<main class="page">

<section class="container section">
  <div class="auth card">
    <h2>Create Account</h2>
    <form class="form" action="" method="POST">
      <label>Full Name</label>
      <input type="text" placeholder="Your name" name="name" required>
      <label>Email</label>
      <input type="email" placeholder="you@email.com" name="email" required>
      <label>Password</label>
      <input type="password" placeholder="Choose a password" name="pass" required>
      <button class="btn btn-primary" type="submit" name="register" value="register">Create Account</button>
    </form>
  </div>
</section>

</main>
<footer class="site-footer">
  <div class="container footer-grid">
    <div>
      <div class="logo small">Nova<span>Shop</span></div>
      <p>Beautiful products. Simple checkout. No JavaScript demo.</p>
    </div>
    <div>
      <h4>Shop</h4>
      <a href="products.html">All Products</a>
      <a href="wishlist.html">Wishlist</a>
      <a href="cart.html">Cart</a>
      <a href="payment.html">Payment</a>
    </div>
    <div>
      <h4>Account</h4>
      <a href="login.html">Login</a>
      <a href="register.html">Create Account</a>
      <a href="profile.html">Profile</a>
      <a href="admin.html">Admin Panel</a>
    </div>
  </div>
  <p class="copyright">© 2025 NovaShop. For demo use only.</p>
</footer>
</body>
</html>