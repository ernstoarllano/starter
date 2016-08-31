<?php if (THEME_DEBUG) { ?>
    <?php
        // Number of columns we want to create
        $columns = 12;
    ?>
    <div class="o-debug">
        <div class="o-container">
            <div class="o-row">
                <?php for ($i = 0; $i < $columns; ++$i) { ?>
                    <div class="o-col o-col--1"></div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
