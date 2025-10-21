<?php
// Expect $query (string) and $results (array)
$this->layout('layouts/base', [
  'title' => !empty($query) ? "Search Results for \"$query\"" : 'Search',
  'metaDesc' => !empty($query) ? "Search results for ceramic coating services in Florida: $query" : 'Search ceramic coating services and information in Florida.',
  'breadcrumbs' => [
    ['href'=>'/','label'=>'Home'],
    ['href'=>'/search','label'=>'Search']
  ]
]);
?>

<section class="section container">
  <h1><?= !empty($query) ? "Search Results for \"" . htmlspecialchars($query, ENT_QUOTES) . "\"" : 'Search' ?></h1>
  
  <form action="/search" method="get" style="display:flex; gap:8px; margin-bottom:24px" role="search" aria-label="Search ceramic coating services">
    <input class="input" type="text" name="q" value="<?= htmlspecialchars($query ?? '', ENT_QUOTES) ?>" placeholder="Search your city or service…" aria-label="Search your city or service">
    <button class="btn" type="submit">Search</button>
  </form>

  <?php if (!empty($query)): ?>
    <?php if (empty($results)): ?>
      <div class="card">
        <h2>No Results Found</h2>
        <p>No results found for "<?= htmlspecialchars($query, ENT_QUOTES) ?>". Try searching for:</p>
        <ul>
          <li>City names (e.g., Miami, Tampa, Orlando)</li>
          <li>Services (e.g., ceramic coating, maintenance, water spots)</li>
          <li>Common questions about ceramic coatings</li>
        </ul>
      </div>
    <?php else: ?>
      <div class="card">
        <h2><?= count($results) ?> Result<?= count($results) !== 1 ? 's' : '' ?> Found</h2>
        <p>Showing results for "<?= htmlspecialchars($query, ENT_QUOTES) ?>"</p>
      </div>
      
      <div class="grid" style="margin-top:20px">
        <?php foreach ($results as $result): ?>
          <div class="card">
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px">
              <span class="badge" style="background:<?= $result['type'] === 'city' ? '#e3f2fd' : ($result['type'] === 'service' ? '#f3e5f5' : '#e8f5e8') ?>; color:<?= $result['type'] === 'city' ? '#1976d2' : ($result['type'] === 'service' ? '#7b1fa2' : '#388e3c') ?>">
                <?= ucfirst($result['type']) ?>
              </span>
            </div>
            <h3 style="margin-top:0; margin-bottom:8px">
              <a href="<?= htmlspecialchars($result['url'], ENT_QUOTES) ?>" style="color:inherit; text-decoration:none">
                <?= htmlspecialchars($result['title'], ENT_QUOTES) ?>
              </a>
            </h3>
            <p class="small" style="margin-bottom:12px">
              <?= htmlspecialchars($result['description'], ENT_QUOTES) ?>
            </p>
            <a href="<?= htmlspecialchars($result['url'], ENT_QUOTES) ?>" class="btn btn--ghost" style="font-size:14px; padding:6px 12px">
              View Details
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  <?php else: ?>
    <div class="card">
      <h2>Search Ceramic Coating Services</h2>
      <p>Find information about ceramic coating services in Florida cities, maintenance guides, and answers to common questions.</p>
      
      <h3>Popular Searches</h3>
      <div class="grid grid--2" style="margin-top:16px">
        <div>
          <h4>Cities</h4>
          <ul class="small" style="margin:0; padding-left:18px">
            <li><a href="/search?q=miami">Miami</a></li>
            <li><a href="/search?q=tampa">Tampa</a></li>
            <li><a href="/search?q=orlando">Orlando</a></li>
            <li><a href="/search?q=fort-myers">Fort Myers</a></li>
          </ul>
        </div>
        <div>
          <h4>Services</h4>
          <ul class="small" style="margin:0; padding-left:18px">
            <li><a href="/search?q=ceramic-coating">Ceramic Coating</a></li>
            <li><a href="/search?q=maintenance">Maintenance</a></li>
            <li><a href="/search?q=water-spots">Water Spots</a></li>
            <li><a href="/search?q=lovebugs">Lovebugs</a></li>
          </ul>
        </div>
      </div>
    </div>
  <?php endif; ?>
</section>
