<?php
// $trail = [['href'=>'/','label'=>'Home'], ['href'=>'/ceramic-coating/fl','label'=>'Florida'], ...]
if (empty($trail)) return;
$last = count($trail)-1;
?>
<ol style="list-style:none; padding:0; margin:0; display:flex; flex-wrap:wrap; gap:8px">
  <?php foreach($trail as $i=>$item): ?>
    <?php if($i!==0): ?><span aria-hidden="true">/</span><?php endif; ?>
    <?php if($i===$last): ?>
      <li aria-current="page"><?= htmlspecialchars($item['label'],ENT_QUOTES) ?></li>
    <?php else: ?>
      <li><a href="<?= htmlspecialchars($item['href'],ENT_QUOTES) ?>"><?= htmlspecialchars($item['label'],ENT_QUOTES) ?></a></li>
    <?php endif; ?>
  <?php endforeach; ?>
</ol>