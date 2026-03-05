<?php
declare(strict_types = 1);
require_once 'includes/database-connection.php';
require_once 'includes/functions.php';

// Get navigation categories
$sql        = "SELECT id, name FROM category WHERE navigation = 1 ORDER BY id;";
$navigation = pdo($pdo, $sql)->fetchAll();

// Get active category filter from query string
$category_id = isset($_GET['category']) ? (int) $_GET['category'] : 0;
$section     = $category_id ?: '';

// Fetch watches — filtered by category if one is selected
if ($category_id > 0) {
    $sql     = "SELECT w.*, c.name AS category_name
                FROM watches w
                JOIN category c ON w.category_id = c.id
                WHERE w.published = 1 AND w.category_id = :category_id
                ORDER BY w.brand, w.model;";
    $watches = pdo($pdo, $sql, [':category_id' => $category_id])->fetchAll();
} else {
    $sql     = "SELECT w.*, c.name AS category_name
                FROM watches w
                JOIN category c ON w.category_id = c.id
                WHERE w.published = 1
                ORDER BY w.brand, w.model;";
    $watches = pdo($pdo, $sql)->fetchAll();
}

$title       = 'Luxury Watches Collection';
$description = "Discover our curated collection of luxury timepieces from the world's finest watchmakers.";
?>
<?php require_once 'includes/header.php'; ?>

  <section class="hero">
    <div class="hero-bg" aria-hidden="true">
      <div class="ring ring--1"></div>
      <div class="ring ring--2"></div>
      <div class="ring ring--3"></div>
    </div>
    <div class="hero-content">
      <p class="hero-eyebrow">Est. 1892 &middot; Master Horology</p>
      <h2 class="hero-headline">Time is the only<br><em>true</em> luxury</h2>
      <p class="hero-sub">Each timepiece in our collection represents the pinnacle of craftsmanship &mdash; mechanisms born from decades of tradition and hundreds of hours of artistry.</p>
      <a href="#content" class="btn-hero">Explore Collection &darr;</a>
    </div>
  </section>

  <div class="ticker" aria-hidden="true">
    <div class="ticker-track">
      <?php
      $brands = ['Rolex','Patek Philippe','Audemars Piguet','A. Lange &amp; S&ouml;hne','Vacheron Constantin','Jaeger-LeCoultre','IWC Schaffhausen','Breguet'];
      for ($t = 0; $t < 2; $t++) {
          foreach ($brands as $brand) {
              echo '<span class="ticker-item">' . $brand . '<span class="ticker-dot"> &loz; </span></span>';
          }
      }
      ?>
    </div>
  </div>

  <main id="content">

    <div class="section-header">
      <span class="section-eyebrow">Curated Selection</span>
      <h1>Luxury Watches Collection</h1>
      <div class="section-rule"></div>
    </div>

    <nav class="filter-bar" aria-label="Filter by category">
      <a href="watches.php" class="filter-btn<?= ($category_id === 0) ? ' active' : '' ?>">All</a>
      <?php foreach ($navigation as $link) { ?>
        <a href="watches.php?category=<?= (int)$link['id'] ?>"
           class="filter-btn<?= ($category_id === (int)$link['id']) ? ' active' : '' ?>">
          <?= html_escape($link['name']) ?>
        </a>
      <?php } ?>
    </nav>

    <div class="watches-grid">
      <?php if (count($watches) > 0) { ?>
        <?php foreach ($watches as $watch) { ?>
          <div class="watch-card">
            <div class="watch-card-image">
              <img src="uploads/watches/<?= html_escape($watch['image']) ?>"
                   alt="<?= html_escape($watch['brand'] . ' ' . $watch['model']) ?>"
                   onerror="this.src='uploads/blank.png'">
              <div class="watch-card-overlay" aria-hidden="true"></div>
              <?php if (!empty($watch['badge'])) { ?>
                <span class="watch-card-badge"><?= html_escape($watch['badge']) ?></span>
              <?php } ?>
            </div>
            <div class="watch-card-body">
              <p class="watch-brand"><?= html_escape($watch['brand']) ?></p>
              <h3><?= html_escape($watch['model']) ?></h3>
              <p><?= html_escape($watch['description']) ?></p>
              <div class="watch-card-footer">
                <span class="watch-price">$<?= number_format((float)$watch['price'], 0) ?></span>
                <a href="watch.php?id=<?= (int)$watch['id'] ?>" class="btn-detail">View Details</a>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } else { ?>
        <p class="no-watches">No watches found in this category.</p>
      <?php } ?>
    </div>

  </main>

<?php require_once 'includes/footer.php'; ?>
