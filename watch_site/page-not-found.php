<?php
declare(strict_types = 1);
http_response_code(404);
require_once 'includes/database-connection.php';
require_once 'includes/functions.php';

$sql        = "SELECT id, name FROM category WHERE navigation = 1;";
$navigation = pdo($pdo, $sql)->fetchAll();
$section    = '';
$title       = 'Page Not Found';
$description = '';
?>
<?php require_once 'includes/header.php'; ?>
  <main class="container" id="content">
    <h1>Sorry! We cannot find that page.</h1>
    <p>Try the <a href="watches.php">collection</a> or email us at
      <a href="mailto:hello@horlogerie.com">hello@horlogerie.com</a></p>
  </main>
<?php require_once 'includes/footer.php'; ?>
