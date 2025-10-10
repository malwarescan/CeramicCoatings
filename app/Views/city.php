<?php
// Inputs expected: $service,$city,$county,$coastal(bool),$lat,$lng,$tokens(array),$faqs(array)
// Breadcrumbs and JSON-LD assembled here for self-containment.
$trail = [
  ['href'=>'/','label'=>'Home'],
  ['href'=>"/$service/fl",'label'=>'Florida'],
  ['href'=>"/$service/".urlencode(strtolower(str_replace(' ','-',$city)))."/",'label'=>"$city"]
];

$localBusiness = [
  '@context'=>'https://schema.org','@type'=>'LocalBusiness',
  'name'=>'Florida Ceramic Coatings Resource',
  'url'=>"https://example.com/$service/".urlencode(strtolower(str_replace(' ','-',$city)))."/",
  'telephone'=>'+1-844-555-0101',
  'address'=>[
    '@type'=>'PostalAddress','addressLocality'=>$city,'addressRegion'=>'FL','addressCountry'=>'US'
  ],
  'geo'=>isset($lat,$lng)?['@type'=>'GeoCoordinates','latitude'=>$lat,'longitude'=>$lng]:null
];

$serviceSchema = [
  '@context'=>'https://schema.org','@type'=>'Service',
  'serviceType'=>ucwords(str_replace('-',' ', $service)).' (Florida)',
  'areaServed'=>['@type'=>'AdministrativeArea','name'=>"$city, FL"],
  'provider'=>$localBusiness
];

$breadcrumbsLd = [
  '@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[
    ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>'https://example.com/'],
    ['@type'=>'ListItem','position'=>2,'name'=>'Florida','item'=>"https://example.com/$service/fl"],
    ['@type'=>'ListItem','position'=>3,'name'=>"$service in $city",'item'=>"https://example.com/$service/".urlencode(strtolower(str_replace(' ','-',$city)))."/"]
  ]
];

$this->layout('layouts/base', [
  'title' => ucfirst($service).' in '.$city.', Florida',
  'metaDesc' => ucfirst($service)." for $city, FL — coverage of UV, salt air, humidity, rain, and lovebug season. Application environment, care routine, and local signals.",
  'breadcrumbs' => $trail,
  'jsonLd' => array_values(array_filter([$localBusiness, $serviceSchema, $breadcrumbsLd]))
]);
?>

<section class="section container">
  <h1><?= htmlspecialchars(ucfirst($service)." in $city, Florida", ENT_QUOTES) ?></h1>
  <p class="small">Evidence-based guidance for Florida conditions. No hype, just what works.</p>
  <div class="grid grid--2">
    <article class="card">
      <h2>Why it matters in <?= htmlspecialchars($city,ENT_QUOTES) ?></h2>
      <ul>
        <li>UV & heat: reduce fading and oxidation when maintained.</li>
        <li>Salt air<?= $coastal ? ' (coastal)' : '' ?>: faster rinse-downs; slower corrosion on coated surfaces.</li>
        <li>Humidity & rain: correct curing environment is crucial; avoid outdoor application.</li>
        <?php if (!empty($tokens['lovebugs'])): ?>
          <li>Lovebug season: coating eases removal; prompt cleanup still required.</li>
        <?php endif; ?>
        <li>Hard water: coatings can still spot — dry promptly and use SiO2 toppers.</li>
      </ul>

      <h2>Application & Curing</h2>
      <p>Prefer a climate-controlled bay. Surface prep (wash, decon, clay, polish) affects outcome more than brand choice.</p>

      <h2>Maintenance (Baseline)</h2>
      <table class="table" aria-label="Maintenance plan">
        <thead><tr><th>Task</th><th>Frequency</th><th>Notes</th></tr></thead>
        <tbody>
          <tr><td>pH-safe wash</td><td>2–3 weeks</td><td>Two-bucket; soft mitt; avoid direct sun</td></tr>
          <tr><td>Drying</td><td>Every wash</td><td>Blower + microfiber; minimize spotting</td></tr>
          <tr><td>SiO2 topper</td><td>2–3 months</td><td>Boosts beading & slickness</td></tr>
          <tr><td>Annual check</td><td>12 months</td><td>Decon/light polish if needed</td></tr>
        </tbody>
      </table>

      <?php if (!empty($tokens['marine'])): ?>
        <h2>Marine & Gelcoat</h2>
        <p>Coatings ease salt removal and slow oxidation on gelcoat. Rinse after each outing; top every few months.</p>
      <?php endif; ?>

      <hr class="sep">
      <p class="small">Limits: coatings are not "scratch-proof." Minerals and bugs can etch if left on the surface.</p>
    </article>

    <div>
      <?php
        echo $this->partial('partials/local_signals', [
          'city'=>$city,'county'=>$county,'coastal'=>$coastal??false,'lat'=>$lat??null,'lng'=>$lng??null
        ]);
      ?>
      <div class="card" style="margin-top:20px">
        <h3>Next Step</h3>
        <p class="small">Looking for an installer in <?= htmlspecialchars($city,ENT_QUOTES) ?>? Request a short list of verified shops.</p>
        <a class="btn" href="/contact?city=<?= urlencode($city) ?>&service=<?= urlencode($service) ?>">Request List</a>
      </div>
    </div>
  </div>
</section>

<?php
echo $this->partial('partials/faq', ['faqs'=>$faqs ?? [], 'emitJsonLd'=>true]);
?>