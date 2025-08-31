<?php
require_once __DIR__ . '/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo isset($page_title) ? $page_title . ' • ' : ''; ?><?php echo APP_NAME; ?></title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <a class="logo" href="/">Nova<span>Shop</span></a>
    <nav class="nav">
      <a href="/products">Products</a>
      <?php if (is_logged_in()): ?>
        <a href="/wishlist">Wishlist</a>
        <a href="/cart">Cart</a>
        <a href="/profile">Profile</a>
        <?php if (is_admin()): ?>
          <a href="/admin">Admin Panel</a>
        <?php endif; ?>
        <a href="/logout" class="btn btn-ghost">Logout</a>
      <?php else: ?>
        <a href="/login" class="btn btn-ghost">Login</a>
        <a href="/register" class="btn btn-primary">Create Account</a>
      <?php endif; ?>
    </nav>
  </div>
  <?php if (isset($show_search) && $show_search): ?>
  <form class="searchbar container" action="/products" method="get">
    <input type="text" name="q" placeholder="Search for products, brands and more…" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" />
    <button type="submit" class="btn btn-dark">Search</button>
  </form>
  <?php endif; ?>
</header>
<main class="page">
