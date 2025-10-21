<?php
// Expect $cities (array) optionally, and $topFaqs
$this->layout('layouts/base', [
  'title' => 'Ceramic Coatings in Florida — Auto & Marine',
  'metaDesc' => 'Resource-first guide to ceramic coatings for Florida\'s UV, salt air, humidity, rain, and lovebug seasons. City pages, marine guides, and maintenance FAQs.',
  'breadcrumbs' => [['href'=>'/','label'=>'Home']],
  'jsonLd' => [
    [
      '@context'=>'https://schema.org','@type'=>'WebSite',
      'url'=>'https://ceramiccoatings.us/','name'=>'Ceramic Coatings Florida',
      'potentialAction'=>[
        '@type'=>'SearchAction',
        'target'=>'https://ceramiccoatings.us/search?q={search_term_string}',
        'query-input'=>'required name=search_term_string'
      ]
    ]
  ]
]);
?>

<section class="hero container">
  <h1>Ceramic Coatings in Florida — Auto & Marine Protection</h1>
  <p>Independent resource covering UV, salt air, humidity, frequent rain, and lovebug seasons. No hype, just practical guidance.</p>
  <form action="/search" method="get" style="display:flex; gap:8px; margin-top:12px" role="search" aria-label="Find service in your city">
    <input class="input" type="text" name="q" placeholder="Search your city or service…" aria-label="Search your city or service">
    <button class="btn" type="submit">Find Service</button>
  </form>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="grid grid--3">
      <div class="card">
        <h3>UV & Heat</h3>
        <p class="small">Florida sun accelerates fading and oxidation. Coatings resist UV better than wax when maintained.</p>
        <a href="/guides/uv-heat">Read guide</a>
      </div>
      <div class="card">
        <h3>Salt Air & Marine</h3>
        <p class="small">Coastal owners: coatings ease rinse-downs and slow gelcoat oxidation.</p>
        <a href="/guides/marine-gelcoat">Read guide</a>
      </div>
      <div class="card">
        <h3>Lovebugs & Water Spots</h3>
        <p class="small">Coatings make bug cleanup easier; hard-water minerals can still spot without proper drying.</p>
        <a href="/guides/water-spot-removal">Read guide</a>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Browse Cities</h2>
    <p class="small">Coverage includes 150+ Florida cities and coastal towns.</p>
    <div class="grid grid--3">
      <?php foreach (array_slice($cities ?? [], 0, 12) as $city): ?>
        <a class="card" href="/ceramic-coating/<?= urlencode(strtolower(str_replace(' ','-',$city['city']))) ?>/">
          <strong><?= htmlspecialchars($city['city'],ENT_QUOTES) ?></strong><br>
          <span class="small"><?= htmlspecialchars($city['county'],ENT_QUOTES) ?> County <?= !empty($city['coastal'])?'• Coastal':'' ?></span>
        </a>
      <?php endforeach; ?>
    </div>
    <p style="margin-top:12px"><a class="btn btn--ghost" href="/cities">See all Florida cities</a></p>
  </div>
</section>

<?php
echo $this->partial('partials/faq', ['faqs'=>$topFaqs ?? [], 'emitJsonLd'=>true]);
?>