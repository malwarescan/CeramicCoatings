<?php $this->layout('layouts/base', ['title' => $title, 'metaDesc' => $metaDesc]); ?>

<section class="section" style="padding-top: 120px;">
  <div class="container">
    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: var(--spacing-lg);">
      <div>
        <span class="badge">Get in Touch</span>
        <h1>Contact Us</h1>
        <p style="color: var(--color-text-muted); margin-bottom: var(--spacing-md);">
          Ready to elevate your vehicle's protection? Fill out the form below or visit our studio in Naples.
        </p>
        
        <div style="margin-bottom: var(--spacing-md);">
          <h3 style="color: var(--color-primary);">Studio Location</h3>
          <p style="color: var(--color-text-muted);">
            123 Fifth Avenue South<br>
            Naples, FL 34102
          </p>
        </div>

        <div style="margin-bottom: var(--spacing-md);">
          <h3 style="color: var(--color-primary);">Contact Info</h3>
          <p style="color: var(--color-text-muted);">
            <a href="tel:+12392145060" style="color: var(--color-text); display: block; margin-bottom: 0.5rem;">+1 (239) 214-5060</a>
            <a href="mailto:info@ceramiccoatingsnaples.com">info@ceramiccoatingsnaples.com</a>
          </p>
        </div>

        <div>
          <h3 style="color: var(--color-primary);">Hours</h3>
          <p style="color: var(--color-text-muted);">
            Mon - Fri: 8:00 AM - 6:00 PM<br>
            Sat: 9:00 AM - 4:00 PM<br>
            Sun: Closed
          </p>
        </div>
      </div>

      <div style="background: var(--color-surface); padding: var(--spacing-md); border: 1px solid var(--color-border);">
        <form action="/contact/submit" method="POST">
          <div style="margin-bottom: var(--spacing-sm);">
            <label for="name" style="display: block; margin-bottom: 0.5rem; color: var(--color-text-muted);">Name</label>
            <input type="text" id="name" name="name" required style="width: 100%; padding: 0.75rem; background: var(--color-bg); border: 1px solid var(--color-border); color: var(--color-text);">
          </div>
          
          <div style="margin-bottom: var(--spacing-sm);">
            <label for="email" style="display: block; margin-bottom: 0.5rem; color: var(--color-text-muted);">Email</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 0.75rem; background: var(--color-bg); border: 1px solid var(--color-border); color: var(--color-text);">
          </div>

          <div style="margin-bottom: var(--spacing-sm);">
            <label for="phone" style="display: block; margin-bottom: 0.5rem; color: var(--color-text-muted);">Phone</label>
            <input type="tel" id="phone" name="phone" style="width: 100%; padding: 0.75rem; background: var(--color-bg); border: 1px solid var(--color-border); color: var(--color-text);">
          </div>

          <div style="margin-bottom: var(--spacing-sm);">
            <label for="service" style="display: block; margin-bottom: 0.5rem; color: var(--color-text-muted);">Interested Service</label>
            <select id="service" name="service" style="width: 100%; padding: 0.75rem; background: var(--color-bg); border: 1px solid var(--color-border); color: var(--color-text);">
              <option value="ceramic">Ceramic Coating</option>
              <option value="correction">Paint Correction</option>
              <option value="marine">Marine/Gelcoat</option>
              <option value="maintenance">Maintenance Wash</option>
            </select>
          </div>

          <div style="margin-bottom: var(--spacing-md);">
            <label for="message" style="display: block; margin-bottom: 0.5rem; color: var(--color-text-muted);">Message</label>
            <textarea id="message" name="message" rows="4" style="width: 100%; padding: 0.75rem; background: var(--color-bg); border: 1px solid var(--color-border); color: var(--color-text);"></textarea>
          </div>

          <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</section>
