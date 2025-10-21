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

  <!-- Critical CSS (optional): inline above-the-fold -->
  <?php if(!empty($criticalCss)): ?>
    <style><?= $criticalCss ?></style>
  <?php endif; ?>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Main CSS -->
  <link rel="preload" href="/assets/css/main.css" as="style">
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
      <img src="/assets/ceramic coatings logo.png" alt="Ceramic Coatings" style="height:48px; width:auto">
      <span>Ceramic Coatings Naples</span>
    </a>
    <nav class="nav" aria-label="Primary">
      <a href="/guides">Guides</a>
      <a href="/ceramic-coating/fl">Naples Services</a>
      <a href="/contact">Contact</a>
    </nav>
  </div>
</header>

<main class="main" id="content">
  <div class="container">
    <?php if (!empty($breadcrumbs)): ?>
      <nav class="breadcrumbs" aria-label="Breadcrumb"><?= $this->partial('partials/breadcrumbs', ['trail'=>$breadcrumbs]) ?></nav>
    <?php endif; ?>
  </div>
  <?= $content ?? '' ?>
</main>

<footer class="footer section" role="contentinfo">
  <div class="container footer__grid">
    <div>
      <h3 style="margin-top:0">Business</h3>
      <p class="small">
        Ceramic Coatings Naples<br>
        Atelier: 123 Fifth Avenue South, Naples, FL 34102<br>
        Tel: <a href="tel:+1-239-555-0101">+1 (239) 555-0101</a><br>
        By Appointment Only
      </p>
    </div>
    <div>
      <h3 style="margin-top:0">Explore</h3>
      <ul class="small" style="margin:0; padding-left:18px">
        <li><a href="/guides/water-spot-removal">Water Spot Removal</a></li>
        <li><a href="/guides/lovebug-season">Lovebug Season Guide</a></li>
        <li><a href="/guides/marine-gelcoat">Marine & Gelcoat</a></li>
      </ul>
    </div>
    <div>
      <h3 style="margin-top:0">Trust</h3>
      <p class="small">Where science meets sophistication. Crafted protection for Naples' finest automobiles.</p>
      <span class="badge">Naples</span>
      <span class="badge">Luxury</span>
      <span class="badge">Atelier</span>
    </div>
  </div>
</footer>
</body>
</html>