<?php if (THEME_DEBUG) { ?>
  <?php
    // Number of columns we want to create
    $columns = 12;
  ?>
  <div class="debug">
    <div class="container">
      <div class="row">
        <?php for ($i = 0; $i < $columns; ++$i) { ?>
          <div class="col col--1"></div>
        <?php } ?>
      </div>
    </div>
  </div>
<?php } ?>
