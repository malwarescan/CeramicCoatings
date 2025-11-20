<?php $this->layout('layouts/base', ['title' => $page_title ?? 'Florida Ceramic Coatings', 'metaDesc' => $page_description ?? 'Professional ceramic coating services across Florida', 'jsonLd' => $jsonld ?? []]); ?>

<section class="section" style="padding-top: 120px;">
  <div class="container">
    <div style="max-width: 800px; margin: 0 auto;">
      <span class="badge">Guide</span>
      <h1 style="margin-bottom: var(--spacing-md);"><?= htmlspecialchars($guide['title']) ?></h1>
      
      <div class="content" style="color: var(--color-text-muted); line-height: 1.8;">
        <?= $guide['content'] ?>
      </div>

      <div style="margin-top: var(--spacing-lg); padding-top: var(--spacing-md); border-top: 1px solid var(--color-border);">
        <a href="/guides" class="btn">← Back to Guides</a>
      </div>
    </div>
  </div>
</section>

<section class="section" style="background: var(--color-surface);">
  <div class="container">
    <h2 style="text-align: center; margin-bottom: var(--spacing-md);">Related Guides</h2>
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
      <div style="padding: var(--spacing-md); border: 1px solid var(--color-border);">
        <h3 style="color: var(--color-primary); font-size: 1.2rem;"><a href="/guides/water-spot-removal">Water Spot Removal</a></h3>
        <p class="small">Safe removal techniques for Florida's hard water.</p>
      </div>
      <div style="padding: var(--spacing-md); border: 1px solid var(--color-border);">
        <h3 style="color: var(--color-primary); font-size: 1.2rem;"><a href="/guides/lovebug-season">Lovebug Season</a></h3>
        <p class="small">Protection strategies for bug season.</p>
      </div>
      <div style="padding: var(--spacing-md); border: 1px solid var(--color-border);">
        <h3 style="color: var(--color-primary); font-size: 1.2rem;"><a href="/guides/marine-gelcoat">Marine Gelcoat</a></h3>
        <p class="small">Preventing oxidation on boats.</p>
      </div>
    </div>
  </div>
</section>
