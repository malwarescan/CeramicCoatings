<?php
// Expect $cities (array) optionally, and $topFaqs
$this->layout('layouts/base', [
  'title' => 'Ceramic Coatings Naples — Preserve Brilliance. Protect Legacy.',
  'metaDesc' => 'Luxury ceramic coating atelier in Naples, Florida. Engineered protection for discerning automotive collectors. Where science meets sophistication.',
  'breadcrumbs' => [['href'=>'/','label'=>'Home']],
  'jsonLd' => [
    [
      '@context'=>'https://schema.org','@type'=>'WebSite',
      'url'=>'https://ceramiccoatings.us/','name'=>'Ceramic Coatings Naples',
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
  <h1>Ceramic Protection for the Discerning Owner</h1>
  <p>Engineered for the Gulf Coast, our coatings form a permanent barrier—reflecting UV, resisting salt, and preserving brilliance long after ordinary wax fades.</p>
  <form action="/search" method="get" style="display:flex; gap:12px; margin-top:24px; justify-content:center" role="search" aria-label="Find service in your city">
    <input class="input" type="text" name="q" placeholder="Search your city or service…" aria-label="Search your city or service" style="max-width:400px">
    <button class="btn" type="submit">Request Consultation</button>
  </form>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="grid grid--3">
      <div class="card">
        <h3>Beyond Shine—Preservation</h3>
        <p class="small">Our coatings are applied with precision under Naples' most controlled conditions, creating a permanent molecular bond that resists UV degradation.</p>
        <a href="/guides/uv-heat">Learn More</a>
      </div>
      <div class="card">
        <h3>Crafted Protection</h3>
        <p class="small">Coastal refinement demands superior defense. Our marine-grade formulations protect against salt corrosion while maintaining optical clarity.</p>
        <a href="/guides/marine-gelcoat">Explore</a>
      </div>
      <div class="card">
        <h3>Surface Perfection</h3>
        <p class="small">Every application is a meticulous process—from surface preparation to final inspection. Excellence in every detail.</p>
        <a href="/guides/water-spot-removal">Discover</a>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Service Areas</h2>
    <p class="small">Serving Naples and surrounding communities with the highest standards of automotive preservation.</p>
    <div class="grid grid--3">
      <?php foreach (array_slice($cities ?? [], 0, 12) as $city): ?>
        <a class="card" href="/ceramic-coating/<?= urlencode(strtolower(str_replace(' ','-',$city['city']))) ?>/">
          <strong><?= htmlspecialchars($city['city'],ENT_QUOTES) ?></strong><br>
          <span class="small"><?= htmlspecialchars($city['county'],ENT_QUOTES) ?> County <?= !empty($city['coastal'])?'• Coastal':'' ?></span>
        </a>
      <?php endforeach; ?>
    </div>
    <p style="margin-top:24px; text-align:center"><a class="btn btn--ghost" href="/cities">View All Service Areas</a></p>
  </div>
</section>

<?php
echo $this->partial('partials/faq', ['faqs'=>$topFaqs ?? [], 'emitJsonLd'=>true]);
?>