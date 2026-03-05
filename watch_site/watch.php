<?php
declare(strict_types = 1);
require_once 'includes/database-connection.php';
require_once 'includes/functions.php';

// Get navigation categories
$sql        = "SELECT id, name FROM category WHERE navigation = 1 ORDER BY id;";
$navigation = pdo($pdo, $sql)->fetchAll();

// Get watch ID from query string
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch single watch
$sql   = "SELECT w.*, c.name AS category_name
          FROM watches w
          JOIN category c ON w.category_id = c.id
          WHERE w.id = :id AND w.published = 1;";
$watch = pdo($pdo, $sql, [':id' => $id])->fetch();

// Redirect to 404 if not found
if (!$watch) {
    include 'page-not-found.php';
    exit;
}

$section     = $watch['category_id'];
$title       = $watch['brand'] . ' ' . $watch['model'];
$description = $watch['description'];

// Fetch related watches from same category
$sql_related = "SELECT id, brand, model, price, image, badge
                FROM watches
                WHERE published = 1 AND category_id = :cat AND id != :id
                ORDER BY RAND()
                LIMIT 3;";
$related = pdo($pdo, $sql_related, [':cat' => $watch['category_id'], ':id' => $id])->fetchAll();
?>
<?php require_once 'includes/header.php'; ?>

  <main class="container" id="content">

    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="watches.php">Collection</a>
      <span aria-hidden="true">&rsaquo;</span>
      <a href="watches.php?category=<?= (int)$watch['category_id'] ?>"><?= html_escape($watch['category_name']) ?></a>
      <span aria-hidden="true">&rsaquo;</span>
      <span aria-current="page"><?= html_escape($watch['model']) ?></span>
    </nav>

    <div class="watch-detail">

      <div class="watch-detail-image">
        <img src="uploads/watches/<?= html_escape($watch['image']) ?>"
             alt="<?= html_escape($watch['brand'] . ' ' . $watch['model']) ?>"
             onerror="this.src='uploads/blank.png'">
        <?php if (!empty($watch['badge'])) { ?>
          <span class="watch-card-badge"><?= html_escape($watch['badge']) ?></span>
        <?php } ?>
      </div>

      <div class="watch-detail-body">
        <p class="watch-brand"><?= html_escape($watch['brand']) ?></p>
        <h1><?= html_escape($watch['model']) ?></h1>
        <p class="watch-detail-desc"><?= html_escape($watch['description']) ?></p>

        <div class="watch-specs">
          <div class="spec-item">
            <label>Movement</label>
            <span><?= html_escape($watch['movement']) ?></span>
          </div>
          <div class="spec-item">
            <label>Case Diameter</label>
            <span><?= html_escape($watch['case_diameter']) ?></span>
          </div>
          <div class="spec-item">
            <label>Material</label>
            <span><?= html_escape($watch['material']) ?></span>
          </div>
          <div class="spec-item">
            <label>Water Resistance</label>
            <span><?= html_escape($watch['water_resistance']) ?></span>
          </div>
          <div class="spec-item">
            <label>Category</label>
            <span><?= html_escape($watch['category_name']) ?></span>
          </div>
        </div>

        <div class="watch-detail-price-row">
          <span class="watch-price">$<?= number_format((float)$watch['price'], 0) ?></span>
          <button class="btn-enquire">Enquire Now</button>
        </div>

        <a href="watches.php" class="btn-back">&larr; Back to Collection</a>
      </div>

    </div><!-- /.watch-detail -->

    <?php if (count($related) > 0) { ?>
      <section class="related-section">
        <div class="section-header">
          <span class="section-eyebrow">From the same category</span>
          <h2>You May Also Like</h2>
          <div class="section-rule"></div>
        </div>
        <div class="watches-grid watches-grid--related">
          <?php foreach ($related as $r) { ?>
            <div class="watch-card">
              <div class="watch-card-image">
                <img src="uploads/watches/<?= html_escape($r['image']) ?>"
                     alt="<?= html_escape($r['brand'] . ' ' . $r['model']) ?>"
                     onerror="this.src='uploads/blank.png'">
                <div class="watch-card-overlay" aria-hidden="true"></div>
                <?php if (!empty($r['badge'])) { ?>
                  <span class="watch-card-badge"><?= html_escape($r['badge']) ?></span>
                <?php } ?>
              </div>
              <div class="watch-card-body">
                <p class="watch-brand"><?= html_escape($r['brand']) ?></p>
                <h3><?= html_escape($r['model']) ?></h3>
                <div class="watch-card-footer">
                  <span class="watch-price">$<?= number_format((float)$r['price'], 0) ?></span>
                  <a href="watch.php?id=<?= (int)$r['id'] ?>" class="btn-detail">View Details</a>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </section>
    <?php } ?>

  </main>

<?php require_once 'includes/footer.php'; ?>
