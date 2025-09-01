<?php
// Script to fix all remaining .php links

$files_to_fix = [
    'src/controllers/index.php',
    'src/helpers/footer.php'
];

foreach ($files_to_fix as $file) {
    $content = file_get_contents($file);
    
    // Fix cart.php links
    $content = str_replace('href="cart.php', 'href="/cart', $content);
    $content = str_replace('href="wishlist.php', 'href="/wishlist', $content);
    $content = str_replace('href="products.php', 'href="/products', $content);
    $content = str_replace('href="profile.php', 'href="/profile', $content);
    $content = str_replace('href="login.php', 'href="/login', $content);
    $content = str_replace('href="register.php', 'href="/register', $content);
    $content = str_replace('href="logout.php', 'href="/logout', $content);
    $content = str_replace('href="admin.php', 'href="/admin', $content);
    $content = str_replace('href="payment.php', 'href="/payment', $content);
    
    // Fix action URLs
    $content = str_replace('cart.php?', '/cart?', $content);
    $content = str_replace('wishlist.php?', '/wishlist?', $content);
    
    file_put_contents($file, $content);
    echo "Fixed: $file\n";
}

echo "All .php links have been updated!\n";
?>
