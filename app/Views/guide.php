<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->escape($page_title ?? 'Florida Ceramic Coatings') ?></title>
    <meta name="description" content="<?= $this->escape($page_description ?? 'Professional ceramic coating services across Florida') ?>">
    
    <!-- Critical CSS inline -->
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .header { background: #667eea; color: white; padding: 1rem 0; }
        .nav { display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: bold; }
        .nav-links { display: flex; gap: 2rem; list-style: none; }
        .nav-links a { color: white; text-decoration: none; }
        .main { padding: 2rem 0; }
        .footer { background: #333; color: white; padding: 2rem 0; text-align: center; }
        .btn { display: inline-block; padding: 0.75rem 1.5rem; background: #667eea; color: white; text-decoration: none; border-radius: 5px; }
        .btn:hover { background: #5a6fd8; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .faq-item { margin-bottom: 1rem; padding: 1rem; background: #f8f9fa; border-radius: 5px; }
        .faq-question { font-weight: bold; margin-bottom: 0.5rem; }
        .faq-answer { color: #666; }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .container { padding: 0 15px; }
        }
    </style>
    
    <!-- JSON-LD Schema -->
    <?php if (isset($jsonld)): ?>
        <?php foreach ($jsonld as $schema): ?>
            <script type="application/ld+json">
                <?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
            </script>
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>

<div class="hero" style="background: #667eea; color: white; padding: 3rem 0; text-align: center;">
    <div class="container">
        <h1 style="font-size: 2.5rem; margin-bottom: 1rem; font-weight: bold;">
            <?= $this->escape($guide['title']) ?>
        </h1>
        <p style="font-size: 1.1rem; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            <?= $this->escape($guide['description']) ?>
        </p>
    </div>
</div>

<section class="guide-content" style="padding: 3rem 0;">
    <div class="container">
        <div class="card" style="max-width: 900px; margin: 0 auto;">
            <div class="content" style="line-height: 1.8; color: #555;">
                <?= $guide['content'] ?>
            </div>
        </div>
    </div>
</section>

<section class="related-guides" style="padding: 2rem 0; background: #f8f9fa;">
    <div class="container">
        <h2 style="text-align: center; margin-bottom: 2rem; color: #333;">
            Related Guides
        </h2>
        <div class="grid">
            <div class="card">
                <h3 style="color: #667eea; margin-bottom: 1rem;">
                    <a href="/guides/water-spot-removal" style="color: #667eea; text-decoration: none;">
                        Water Spot Removal
                    </a>
                </h3>
                <p>Learn how to safely remove water spots from ceramic coated vehicles in Florida's hard water conditions.</p>
            </div>
            <div class="card">
                <h3 style="color: #667eea; margin-bottom: 1rem;">
                    <a href="/guides/wash-routine" style="color: #667eea; text-decoration: none;">
                        Wash Routine
                    </a>
                </h3>
                <p>Step-by-step guide to maintaining ceramic coatings with the right wash routine in Florida.</p>
            </div>
            <div class="card">
                <h3 style="color: #667eea; margin-bottom: 1rem;">
                    <a href="/guides/lovebug-season" style="color: #667eea; text-decoration: none;">
                        Lovebug Season
                    </a>
                </h3>
                <p>Protect your ceramic coated vehicle during Florida's lovebug season with proper prevention and cleanup.</p>
            </div>
            <div class="card">
                <h3 style="color: #667eea; margin-bottom: 1rem;">
                    <a href="/guides/gelcoat-oxidation" style="color: #667eea; text-decoration: none;">
                        Gelcoat Oxidation
                    </a>
                </h3>
                <p>How ceramic coatings help prevent gelcoat oxidation on boats in Florida's marine environment.</p>
            </div>
        </div>
    </div>
</section>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> Florida Ceramic Coatings. All rights reserved.</p>
            <p>Professional ceramic coating services across Florida</p>
        </div>
    </footer>
</body>
</html>
