# Ceramic Coatings Florida — UX/UI Skeleton

- PHP 8.1+ required.
- No frameworks. SSR only. Lightweight CSS.

## Run locally
```bash
composer dump-autoload
php -S localhost:8080 -t public
```

## Extend
- Replace demo data with /data/cities_fl.json and /data/faqs_florida.json.
- Add JSON-LD for FAQPage (already in partial), LocalBusiness, Service, BreadcrumbList, WebSite (already wired).
- Keep copy neutral, evidence-based; avoid exaggerated claims.

## Accessibility/Perf
- `<details>` for FAQs (native a11y).
- Sticky header with clear focus styles.
- No external fonts; inline critical CSS if needed.