<?php $this->layout('layouts/base', ['title' => $page_title, 'metaDesc' => $page_description]); ?>

<section class="section" style="padding-top: 120px;">
  <div class="container">
    <div style="text-align: center; margin-bottom: var(--spacing-lg);">
      <span class="badge">Knowledge Base</span>
      <h1>Auto Care Guides</h1>
      <p style="color: var(--color-text-muted); max-width: 600px; margin: 0 auto;">
        Expert advice on maintaining your vehicle's finish, from ceramic coating care to dealing with Florida's unique environmental challenges.
      </p>
    </div>

    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
      <?php foreach($guides as $slug => $guide): ?>
        <div style="background: var(--color-surface); border: 1px solid var(--color-border); display: flex; flex-direction: column;">
          <div style="padding: var(--spacing-md); flex: 1;">
            <h3 style="color: var(--color-primary); margin-bottom: 0.5rem;">
              <a href="/guides/<?= $slug ?>"><?= htmlspecialchars($guide['title']) ?></a>
            </h3>
            <p style="color: var(--color-text-muted); font-size: 0.9rem;">
              <?= htmlspecialchars($guide['description']) ?>
            </p>
          </div>
          <div style="padding: var(--spacing-md); border-top: 1px solid var(--color-border);">
            <a href="/guides/<?= $slug ?>" class="btn" style="width: 100%; font-size: 0.8rem; padding: 0.5rem;">Read Guide</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
