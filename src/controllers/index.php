<?php
// Homepage Controller
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../helpers/session.php';

// Get featured products (products with badges or newest)
$featured_sql = "SELECT p.*, c.name as category_name 
                 FROM products p 
                 LEFT JOIN categories c ON p.category_id = c.id 
                 WHERE p.status = 'active' 
                 ORDER BY p.badge DESC, p.created_at DESC 
                 LIMIT 3";

$featured_products = get_multiple_rows($featured_sql);

// Get all products for the main grid
$products_sql = "SELECT p.*, c.name as category_name 
                 FROM products p 
                 LEFT JOIN categories c ON p.category_id = c.id 
                 WHERE p.status = 'active' 
                 ORDER BY p.created_at DESC 
                 LIMIT 6";

$products = get_multiple_rows($products_sql);

$page_title = 'Home';
$show_search = true;
include __DIR__ . '/../helpers/header.php';
?>

<section class="hero container">
  <div class="hero-copy">
    <h1>Discover your next favorite thing</h1>
    <p>Hand‑picked products, clean design, and a smooth, distraction‑free experience.</p>
    <div class="cta">
      <a class="btn btn-primary" href="/products">Shop New Arrivals</a>
      <?php if (is_logged_in()): ?>
        <a class="btn btn-ghost" href="/wishlist">View Wishlist</a>
      <?php else: ?>
        <a class="btn btn-ghost" href="/login">Login to Wishlist</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="hero-art" aria-hidden="true"></div>
</section>

<section class="container section">
  <div class="section-head">
    <h2>Featured Picks</h2>
    <a href="/products" class="link">See all →</a>
  </div>
  <div class="grid products">
    <?php foreach ($featured_products as $product): ?>
      <article class="card product">
        <div class="media placeholder"></div>
        <?php if (!empty($product['badge'])): ?>
          <div class="badge <?php echo $product['badge']; ?>"><?php echo ucfirst($product['badge']); ?></div>
        <?php endif; ?>
        <div class="card-body">
          <h3><?php echo htmlspecialchars($product['name']); ?></h3>
          <p class="desc"><?php echo htmlspecialchars($product['description']); ?></p>
          <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
          <div class="actions">
            <?php if (is_logged_in()): ?>
              <a class="btn btn-dark" href="/cart?action=add&product_id=<?php echo $product['id']; ?>">Add to Cart</a>
              <a class="btn btn-ghost" href="/wishlist?action=add&product_id=<?php echo $product['id']; ?>">Wishlist</a>
            <?php else: ?>
              <a class="btn btn-dark" href="/login">Login to Buy</a>
              <a class="btn btn-ghost" href="/login">Login for Wishlist</a>
            <?php endif; ?>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="container section">
  <div class="section-head">
    <h2>Latest Products</h2>
    <a href="/products" class="link">Browse all →</a>
  </div>
  <div class="grid products">
    <?php foreach ($products as $product): ?>
      <article class="card product">
        <div class="media placeholder"></div>
        <?php if (!empty($product['badge'])): ?>
          <div class="badge <?php echo $product['badge']; ?>"><?php echo ucfirst($product['badge']); ?></div>
        <?php endif; ?>
        <div class="card-body">
          <h3><?php echo htmlspecialchars($product['name']); ?></h3>
          <p class="desc"><?php echo htmlspecialchars($product['description']); ?></p>
          <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
          <div class="actions">
            <?php if (is_logged_in()): ?>
              <a class="btn btn-dark" href="/cart?action=add&product_id=<?php echo $product['id']; ?>">Add to Cart</a>
              <a class="btn btn-ghost" href="/wishlist?action=add&product_id=<?php echo $product['id']; ?>">Wishlist</a>
            <?php else: ?>
              <a class="btn btn-dark" href="/login">Login to Buy</a>
              <a class="btn btn-ghost" href="/login">Login for Wishlist</a>
            <?php endif; ?>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="container section comments">
  <h2>Customer Comments</h2>
  <form class="comment-form" action="#">
    <label for="cmt">Leave a comment</label>
    <textarea id="cmt" rows="4" placeholder="Share your experience…"></textarea>
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>
  <div class="comment-list">
    <div class="comment"><strong>Raisa</strong><span>• 5★</span><p>Loved the packaging and fast delivery!</p></div>
    <div class="comment"><strong>Arif</strong><span>• 4★</span><p>Great quality for the price.</p></div>
  </div>
</section>

<?php include __DIR__ . '/../helpers/footer.php'; ?>
