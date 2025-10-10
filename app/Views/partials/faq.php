<?php
// $faqs = [['q'=>'Question?','a'=>'Answer...'], ...]
// Also emits FAQPage JSON-LD when $emitJsonLd === true.
$emitJsonLd = $emitJsonLd ?? false;
if (!empty($faqs)):
?>
<section class="section" aria-labelledby="faq-heading">
  <div class="container">
    <h2 id="faq-heading">Florida Ceramic Coating FAQs</h2>
    <?php foreach ($faqs as $pair): ?>
      <details class="details">
        <summary><?= htmlspecialchars($pair['q'], ENT_QUOTES) ?></summary>
        <div class="details__content"><?= nl2br(htmlspecialchars($pair['a'], ENT_QUOTES)) ?></div>
      </details>
    <?php endforeach; ?>
    <?php if ($emitJsonLd): 
      $json = [
        '@context'=>'https://schema.org',
        '@type'=>'FAQPage',
        'mainEntity'=>array_map(function($p){
          return [
            '@type'=>'Question',
            'name'=>$p['q'],
            'acceptedAnswer'=>['@type'=>'Answer','text'=>$p['a']]
          ];
        }, $faqs)
      ];
    ?>
      <script type="application/ld+json"><?= json_encode($json, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>