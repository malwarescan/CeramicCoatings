<?php
// Inputs expected: $service,$city,$county,$coastal(bool),$lat,$lng,$tokens(array),$faqs(array)
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
  'title' => ucfirst($service).' in '.$city.', Florida | Ceramic Coatings Naples',
  'metaDesc' => ucfirst($service)." for $city, FL — coverage of UV, salt air, humidity, rain, and lovebug season.",
  'breadcrumbs' => $trail,
  'jsonLd' => array_values(array_filter([$localBusiness, $serviceSchema, $breadcrumbsLd]))
]);
?>

<section class="section" style="padding-top: 120px;">
  <div class="container">
    <div class="grid" style="grid-template-columns: 2fr 1fr; gap: var(--spacing-lg);">
      
      <!-- Main Content -->
      <div>
        <span class="badge">Local Service</span>
        <h1 style="margin-bottom: var(--spacing-sm);"><?= htmlspecialchars(ucfirst($service)." in $city, Florida", ENT_QUOTES) ?></h1>
        <p style="color: var(--color-text-muted); margin-bottom: var(--spacing-md);">
          Evidence-based guidance for Florida conditions. No hype, just what works.
        </p>

        <div style="background: var(--color-surface); padding: var(--spacing-md); border: 1px solid var(--color-border); margin-bottom: var(--spacing-md);">
          <h2 style="color: var(--color-primary);">Why it matters in <?= htmlspecialchars($city,ENT_QUOTES) ?></h2>
          <ul style="color: var(--color-text-muted); padding-left: 1.2rem;">
            <li style="margin-bottom: 0.5rem;"><strong>UV & Heat:</strong> Reduce fading and oxidation when maintained.</li>
            <li style="margin-bottom: 0.5rem;"><strong>Salt Air<?= $coastal ? ' (Coastal)' : '' ?>:</strong> Faster rinse-downs; slower corrosion on coated surfaces.</li>
            <li style="margin-bottom: 0.5rem;"><strong>Humidity & Rain:</strong> Correct curing environment is crucial; avoid outdoor application.</li>
            <?php if (!empty($tokens['lovebugs'])): ?>
              <li style="margin-bottom: 0.5rem;"><strong>Lovebug Season:</strong> Coating eases removal; prompt cleanup still required.</li>
            <?php endif; ?>
            <li style="margin-bottom: 0.5rem;"><strong>Hard Water:</strong> Coatings can still spot — dry promptly and use SiO2 toppers.</li>
          </ul>
        </div>

        <h2 style="color: var(--color-text);">Application & Curing</h2>
        <p style="color: var(--color-text-muted); margin-bottom: var(--spacing-md);">
          Prefer a climate-controlled bay. Surface prep (wash, decon, clay, polish) affects outcome more than brand choice.
        </p>

        <h2 style="color: var(--color-text);">Maintenance (Baseline)</h2>
        <div style="overflow-x: auto;">
          <table style="width: 100%; border-collapse: collapse; margin-bottom: var(--spacing-md); color: var(--color-text-muted);">
            <thead>
              <tr style="border-bottom: 1px solid var(--color-border); text-align: left;">
                <th style="padding: 0.5rem;">Task</th>
                <th style="padding: 0.5rem;">Frequency</th>
                <th style="padding: 0.5rem;">Notes</th>
              </tr>
            </thead>
            <tbody>
              <tr style="border-bottom: 1px solid var(--color-border);">
                <td style="padding: 0.5rem;">pH-safe wash</td>
                <td style="padding: 0.5rem;">2–3 weeks</td>
                <td style="padding: 0.5rem;">Two-bucket; soft mitt; avoid direct sun</td>
              </tr>
              <tr style="border-bottom: 1px solid var(--color-border);">
                <td style="padding: 0.5rem;">Drying</td>
                <td style="padding: 0.5rem;">Every wash</td>
                <td style="padding: 0.5rem;">Blower + microfiber; minimize spotting</td>
              </tr>
              <tr style="border-bottom: 1px solid var(--color-border);">
                <td style="padding: 0.5rem;">SiO2 topper</td>
                <td style="padding: 0.5rem;">2–3 months</td>
                <td style="padding: 0.5rem;">Boosts beading & slickness</td>
              </tr>
              <tr>
                <td style="padding: 0.5rem;">Annual check</td>
                <td style="padding: 0.5rem;">12 months</td>
                <td style="padding: 0.5rem;">Decon/light polish if needed</td>
              </tr>
            </tbody>
          </table>
        </div>

        <?php if (!empty($tokens['marine'])): ?>
          <h2 style="color: var(--color-text);">Marine & Gelcoat</h2>
          <p style="color: var(--color-text-muted);">Coatings ease salt removal and slow oxidation on gelcoat. Rinse after each outing; top every few months.</p>
        <?php endif; ?>
      </div>

      <!-- Sidebar -->
      <div>
        <div style="background: var(--color-surface); padding: var(--spacing-md); border: 1px solid var(--color-border); position: sticky; top: 100px;">
          <h3 style="color: var(--color-primary);">Next Step</h3>
          <p class="small" style="margin-bottom: var(--spacing-sm);">
            Looking for an installer in <?= htmlspecialchars($city,ENT_QUOTES) ?>? Request a short list of verified shops.
          </p>
          <a href="tel:+12392145060" class="btn btn-primary" style="width: 100%;">Call (239) 214-5060</a>
          
          <div style="margin-top: var(--spacing-md); padding-top: var(--spacing-md); border-top: 1px solid var(--color-border);">
            <?php
              echo $this->partial('partials/local_signals', [
                'city'=>$city,'county'=>$county,'coastal'=>$coastal??false,'lat'=>$lat??null,'lng'=>$lng??null
              ]);
            ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?php
echo $this->partial('partials/faq', ['faqs'=>$faqs ?? [], 'emitJsonLd'=>true]);
?>