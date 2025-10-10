<?php
// $city,$county,$coastal(bool),$lat,$lng
?>
<aside class="card" aria-labelledby="local-heading">
  <h3 id="local-heading">Local Signals</h3>
  <p class="small">City: <?= htmlspecialchars($city??'',ENT_QUOTES) ?> • County: <?= htmlspecialchars($county??'',ENT_QUOTES) ?> <?= !empty($coastal)?'• Coastal':'' ?></p>
  <?php if(isset($lat,$lng)): ?>
    <img alt="Map of <?= htmlspecialchars($city??'',ENT_QUOTES) ?>" 
         src="https://maps.googleapis.com/maps/api/staticmap?center=<?= urlencode("$lat,$lng") ?>&zoom=11&size=640x300&markers=color:blue|<?= urlencode("$lat,$lng") ?>&key=YOUR_STATIC_MAPS_KEY">
  <?php endif; ?>
  <p class="small">Tip: indoor application is preferred in Florida heat/humidity. Ask for a climate-controlled bay.</p>
</aside>