<?php 
    $title = $layout['title'] ?? '';
    $description = $layout['description'] ?? '';
?>
<section class="section  lc">
    <div class="lc-2">
            
        <h2 class="section__title"><?php echo $title; ?></h2>

        <div class="section__content">
            <?php echo wpautop($description); ?>
        </div>

        <div class="section__seperator">
            <img src="<?php echo get_template_directory_uri() . '/img/wave.svg'; ?>" alt="wave">
        </div>

    </div>
</section>