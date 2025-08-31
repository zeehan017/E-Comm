<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login • NovaShop</title>
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
      <a href="register.html" class="btn btn-primary">Create Account</a>
    </nav>
  </div>
</header>
<main class="page">

<section class="container section">
  <div class="auth card">
    <h2>Login</h2>
    <form class="form" action="profile.html">
      <label>Email</label>
      <input type="email" placeholder="you@email.com" required>
      <label>Password</label>
      <input type="password" placeholder="••••••••" required>
      <button class="btn btn-primary" type="submit">Login</button>
      <p class="muted">No account? <a class="link" href="register.html">Create one</a>.</p>
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