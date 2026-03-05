-- ============================================================
-- Luxury Watches Database
-- Run this in phpMyAdmin or MySQL to set up the database
-- ============================================================

CREATE DATABASE IF NOT EXISTS `luxury_watches`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `luxury_watches`;

-- --------------------------------------------------------
-- Table: category
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `category` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(24)  COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` VARCHAR(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `navigation`  TINYINT(1)   NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`id`, `name`, `description`, `navigation`) VALUES
(1, 'Sport',          'High-performance sports timepieces',     1),
(2, 'Dress',          'Elegant dress watches for every occasion', 1),
(3, 'Complications',  'Extraordinary horological complications', 1),
(4, 'Dive',           'Professional underwater watches',         1);

-- --------------------------------------------------------
-- Table: watches
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `watches` (
  `id`             INT(11)        NOT NULL AUTO_INCREMENT,
  `brand`          VARCHAR(80)    COLLATE utf8mb4_unicode_ci NOT NULL,
  `model`          VARCHAR(80)    COLLATE utf8mb4_unicode_ci NOT NULL,
  `description`    TEXT           COLLATE utf8mb4_unicode_ci NOT NULL,
  `movement`       VARCHAR(100)   COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_diameter`  VARCHAR(20)    COLLATE utf8mb4_unicode_ci NOT NULL,
  `material`       VARCHAR(60)    COLLATE utf8mb4_unicode_ci NOT NULL,
  `water_resistance` VARCHAR(20)  COLLATE utf8mb4_unicode_ci NOT NULL,
  `price`          DECIMAL(10,2)  NOT NULL,
  `image`          VARCHAR(120)   COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id`    INT(11)        NOT NULL,
  `badge`          VARCHAR(40)    COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published`      TINYINT(1)     NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `watches` (`brand`, `model`, `description`, `movement`, `case_diameter`, `material`, `water_resistance`, `price`, `image`, `category_id`, `badge`) VALUES
('Rolex',                 'Submariner Date',               'The benchmark of dive watches. Ceramic Cerachrom bezel, 300m water resistance, and Oystersteel construction define this icon of underwater exploration.',   'Cal. 3235 · Automatic',      '41mm', 'Oystersteel',    '300m', 14100.00,  'submariner.jpg',   1, 'New Arrival'),
('Patek Philippe',        'Nautilus 5711/1A',              'The most coveted sports watch in history. Horizontally embossed dial in Calatrava blue and the integrated bracelet are hallmarks of this Gerald Genta design icon.', 'Cal. 26-330 S C · Auto',     '40mm', 'Stainless Steel','120m', 145000.00, 'nautilus.jpg',     2, 'Rare'),
('Audemars Piguet',       'Royal Oak Offshore',            'Bold, avant-garde chronograph with an oversized octagonal bezel. The enfant terrible of haute horlogerie since 1993.',                                             'Cal. 4401 · Chronograph',    '43mm', 'Forged Carbon',  '100m', 38600.00,  'royal-oak.jpg',    1, NULL),
('Jaeger-LeCoultre',      'Reverso Grande Complication',   'The ultimate reversible case housing three dials: a tourbillon, minute repeater, and perpetual calendar. 373 components in a single wrist piece.',               'Cal. 179 · Manual Wind',     '45.6mm','18k Rose Gold', '30m',  320000.00, 'reverso.jpg',      3, 'Limited'),
('Vacheron Constantin',   'Patrimony Perpetual Calendar',  'Ultra-thin perpetual calendar in rose gold requiring no manual correction until 2100. The 3.9mm movement represents four decades of refinement.',                 'Cal. 3500 · Automatic',      '41mm', '18k Rose Gold',  '30m',  68000.00,  'patrimony.jpg',    2, NULL),
('Patek Philippe',        'Aquanaut 5168G',                'White gold contemporary sport watch with tropical composite strap in khaki green. A modern icon bridging technical performance and Patek refinement.',            'Cal. 324 S C · Automatic',   '42.2mm','18k White Gold','120m', 58000.00,  'aquanaut.jpg',     4, 'In Stock'),
('A. Lange & Söhne',      'Lange 1 Tourbillon',            'Asymmetric dial philosophy meets flying tourbillon in this German masterpiece. Each component is handfinished to absolute perfection.',                           'Cal. L961.1 · Manual Wind',  '38.5mm','18k White Gold','30m',  187500.00, 'lange1.jpg',       3, 'Rare'),
('Rolex',                 'Daytona Cosmograph',            'Motorsport legend with tachymetric scale and integrated chronograph pushers. The updated 4130 movement makes this the most reliable Daytona ever produced.',      'Cal. 4130 · Automatic',      '40mm', 'Oystersteel',    '100m', 22800.00,  'daytona.jpg',      1, NULL),
('Breguet',               'Tradition Répétition Minutes',  'The inventor of the modern watch at his purest. Skeleton movement exposes the flying tourbillon and minute repeater in an open-worked dial of extraordinary beauty.','Cal. 569 · Manual Wind',    '44mm', '18k Rose Gold',  '30m',  290000.00, 'breguet.jpg',      3, 'Limited');
