<?php
// $title, $metaDesc, $jsonLd (array[]), $breadcrumbs (array), $bodyClass, $criticalCss (string|null)
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'Ceramic Coatings Florida', ENT_QUOTES) ?></title>
  <?php if(!empty($metaDesc)): ?>
    <meta name="description" content="<?= htmlspecialchars($metaDesc, ENT_QUOTES) ?>">
  <?php endif; ?>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
  
  <!-- Main CSS -->
  <link rel="stylesheet" href="/assets/css/main.css">

  <!-- JSON-LD blocks -->
  <?php if(!empty($jsonLd) && is_array($jsonLd)): foreach($jsonLd as $block): ?>
    <script type="application/ld+json"><?= json_encode($block, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
  <?php endforeach; endif; ?>
</head>
<body class="<?= htmlspecialchars($bodyClass ?? '', ENT_QUOTES) ?>">
<header class="header" role="banner">
  <div class="container header__inner">
    <a class="brand" href="/" aria-label="Home">
      <span>Ceramic Coatings Naples</span>
    </a>
    <nav class="nav" aria-label="Primary">
      <a href="/guides">Guides</a>
      <a href="/ceramic-coating/fl">Naples Services</a>
      <a href="/contact">Contact</a>
      <a href="/contact" class="btn btn-primary" style="padding: 0.5rem 1.5rem; font-size: 0.8rem;">Book Now</a>
    </nav>
  </div>
</header>

<main class="main" id="content">
  <?php if (!empty($breadcrumbs)): ?>
    <div class="container" style="padding-top: var(--spacing-md);">
      <nav class="breadcrumbs" aria-label="Breadcrumb"><?= $this->partial('partials/breadcrumbs', ['trail'=>$breadcrumbs]) ?></nav>
    </div>
  <?php endif; ?>
  <?= $content ?? '' ?>
</main>

<footer class="footer section" role="contentinfo">
  <div class="container footer__grid">
    <div>
      <h3>Ceramic Coatings Naples</h3>
      <p class="small">
        Atelier: 123 Fifth Avenue South, Naples, FL 34102<br>
        Tel: <a href="tel:+1-239-214-5060">+1 (239) 214-5060</a><br>
        By Appointment Only
      </p>
    </div>
    <div>
      <h3>Explore</h3>
      <ul class="small" style="list-style: none; padding: 0;">
        <li style="margin-bottom: 0.5rem;"><a href="/guides/water-spot-removal">Water Spot Removal</a></li>
        <li style="margin-bottom: 0.5rem;"><a href="/guides/lovebug-season">Lovebug Season Guide</a></li>
        <li style="margin-bottom: 0.5rem;"><a href="/guides/marine-gelcoat">Marine & Gelcoat</a></li>
      </ul>
    </div>
    <div>
      <h3>Excellence</h3>
      <p class="small">Where science meets sophistication. Crafted protection for Naples' finest automobiles.</p>
      <div style="margin-top: 1rem;">
        <span class="badge">Naples</span>
        <span class="badge">Luxury</span>
        <span class="badge">Atelier</span>
      </div>
    </div>
  </div>
</footer>
</body>
</html>