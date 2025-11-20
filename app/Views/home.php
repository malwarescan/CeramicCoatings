<?php $this->layout('layouts/base', ['title' => 'Ceramic Coatings Naples | Luxury Auto Spa', 'bodyClass' => 'home']); ?>
<section class="hero" style="
  min-height: 90vh;
  display: flex;
  align-items: center;
  background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/assets/Why-Ceramic-Coating-Is-Essential-for-Your-Car-980x653.jpeg') center/cover no-repeat;
  margin-top: -80px; /* Offset header height */
  padding-top: 80px;
">
  <div class="container">
    <div style="max-width: 800px;">
      <h1 style="color: var(--color-text); margin-bottom: 1.5rem;">
        The Art of <span style="color: var(--color-primary);">Perfection</span>.<br>
        Naples' Premier Auto Spa.
      </h1>
      <p style="font-size: 1.25rem; color: var(--color-text-muted); margin-bottom: 2.5rem; max-width: 600px;">
        Experience the pinnacle of automotive protection. We specialize in high-grade ceramic coatings and paint correction for luxury vehicles.
      </p>
      <div class="flex">
        <a href="/contact" class="btn btn-primary">Book Appointment</a>
        <a href="/ceramic-coating/fl" class="btn" style="border-color: var(--color-text); color: var(--color-text);">Explore Services</a>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="flex-center" style="flex-direction: column; text-align: center; margin-bottom: var(--spacing-lg);">
      <span class="badge" style="color: var(--color-primary); border-color: var(--color-primary);">Our Expertise</span>
      <h2>Curated Services</h2>
      <p style="color: var(--color-text-muted); max-width: 600px;">
        Tailored solutions for the discerning owner. We use only the finest products to ensure your vehicle looks better than new.
      </p>
    </div>

    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
      <!-- Service 1 -->
      <div style="background: var(--color-surface); padding: var(--spacing-md); border: 1px solid var(--color-border);">
        <h3 style="color: var(--color-primary);">Ceramic Coating</h3>
        <p style="color: var(--color-text-muted);">
          Long-term protection against UV rays, chemical stains, and water spots. Creates a deep, hydrophobic gloss.
        </p>
        <a href="/ceramic-coating/fl" style="color: var(--color-text); text-decoration: underline; font-size: 0.9rem;">Learn More</a>
      </div>

      <!-- Service 2 -->
      <div style="background: var(--color-surface); padding: var(--spacing-md); border: 1px solid var(--color-border);">
        <h3 style="color: var(--color-primary);">Paint Correction</h3>
        <p style="color: var(--color-text-muted);">
          Restoring your paint's clarity by removing swirls, scratches, and oxidation before coating application.
        </p>
        <a href="/guides" style="color: var(--color-text); text-decoration: underline; font-size: 0.9rem;">View Guides</a>
      </div>

      <!-- Service 3 -->
      <div style="background: var(--color-surface); padding: var(--spacing-md); border: 1px solid var(--color-border);">
        <h3 style="color: var(--color-primary);">Marine & Gelcoat</h3>
        <p style="color: var(--color-text-muted);">
          Specialized protection for boats and yachts, fighting against the harsh Florida saltwater environment.
        </p>
        <a href="/guides/marine-gelcoat" style="color: var(--color-text); text-decoration: underline; font-size: 0.9rem;">Marine Services</a>
      </div>
    </div>
  </div>
</section>

<section class="section" style="background: var(--color-surface);">
  <div class="container">
    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: var(--spacing-lg); align-items: center;">
      <div>
        <span class="badge">Why Choose Us</span>
        <h2>Uncompromising Quality</h2>
        <p style="color: var(--color-text-muted); margin-bottom: var(--spacing-md);">
          We don't just wash cars; we preserve investments. Our studio in Naples is equipped with state-of-the-art lighting and climate control to ensure perfect results every time.
        </p>
        <ul style="list-style: none; padding: 0; color: var(--color-text-muted);">
          <li style="margin-bottom: 1rem; display: flex; align-items: center; gap: 1rem;">
            <span style="color: var(--color-primary);">✓</span> Certified Installers
          </li>
          <li style="margin-bottom: 1rem; display: flex; align-items: center; gap: 1rem;">
            <span style="color: var(--color-primary);">✓</span> Climate Controlled Studio
          </li>
          <li style="margin-bottom: 1rem; display: flex; align-items: center; gap: 1rem;">
            <span style="color: var(--color-primary);">✓</span> Fully Insured
          </li>
        </ul>
      </div>
      <div style="position: relative;">
        <div style="
          position: absolute;
          top: -20px;
          left: -20px;
          width: 100px;
          height: 100px;
          border-top: 2px solid var(--color-primary);
          border-left: 2px solid var(--color-primary);
        "></div>
        <img src="/assets/Why-Ceramic-Coating-Is-Essential-for-Your-Car-980x653.jpeg" alt="Detailing Studio" style="width: 100%; filter: grayscale(20%) contrast(110%);">
        <div style="
          position: absolute;
          bottom: -20px;
          right: -20px;
          width: 100px;
          height: 100px;
          border-bottom: 2px solid var(--color-primary);
          border-right: 2px solid var(--color-primary);
        "></div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container" style="text-align: center;">
    <h2>Ready to Protect Your Investment?</h2>
    <p style="color: var(--color-text-muted); margin-bottom: var(--spacing-md);">
      Contact us today for a consultation and quote.
    </p>
    <a href="/contact" class="btn btn-primary">Get a Quote</a>
  </div>
</section>