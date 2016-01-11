<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="defaultblock">
  <?php if ($block->subject): ?>
    <h2><?php print $block->subject ?></h2>
  <?php endif;?>
  <div class="blockcontent"><?php print $block->content; ?></div>
</div>