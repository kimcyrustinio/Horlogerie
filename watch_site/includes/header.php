<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= html_escape($title) ?> | Horlogerie</title>
    <meta name="description" content="<?= html_escape($description) ?>">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Josefin+Sans:wght@300;400;600&display=swap">
    <link rel="shortcut icon" type="image/png" href="img/favicon.ico">
  </head>
  <body>
    <header>
      <div class="container">
        <a class="skip-link" href="#content">Skip to content</a>
        <div class="logo">
          <a href="index.php">
            <div class="logo-mark" aria-hidden="true"></div>
            <span class="logo-text">Horlogerie</span>
          </a>
        </div>
        <nav>
          <button id="toggle-navigation" aria-expanded="false">
            <span class="icon-menu">&#9776;</span><span class="hidden">Menu</span>
          </button>
          <ul id="menu">
            <li><a href="watches.php"<?= (!isset($section) || $section === '') ? ' class="on" aria-current="page"' : '' ?>>Collection</a></li>
            <?php foreach ($navigation as $link) { ?>
            <li><a href="category.php?id=<?= $link['id'] ?>"
              <?= (isset($section) && $section == $link['id']) ? 'class="on" aria-current="page"' : '' ?>>
              <?= html_escape($link['name']) ?>
            </a></li>
            <?php } ?>
            <li><a href="search.php">
              <span class="icon-search">&#9906;</span><span class="search-text">Search</span>
            </a></li>
          </ul>
        </nav>
      </div><!-- /.container -->
    </header>
