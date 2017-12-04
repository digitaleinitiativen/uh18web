<?php 
    $title = $layout['title'] ?? '';
    $description = $layout['description'] ?? '';

    $left = $layout['left'] ?? '';
    $right = $layout['right'] ?? '';
?>

<div class="section--bg clip">
    <section class="section  lc-2">
        <h2 class="section__title">
            <?php echo $title; ?>
        </h2>

        <div class="section__content">
            <div class="grid  grid--2">

                <div class="grid__item">
                    <?php foreach ($left as $key => $leftitem) : ?>
                        <?php if ( !is_array($leftitem) ): ?>
                            <h3 class="h6"><?php echo $leftitem; ?></h3>
                            <div class="wave--container">
                                <img class="wave--seperator" src="<?php echo get_template_directory_uri() . '/img/wave.svg'; ?>" alt="wave">
                            </div>
                        <?php else : ?>
                            <?php foreach ($leftitem as $key => $item) : ?>
                                <div class="info">
                                    <div class="label">
                                        <?php echo $item['title']; ?>
                                    </div>

                                    <div class="value">
                                        <?php echo $item['description']; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="grid__item">
                    <?php foreach ($right as $key => $rightitem) : ?>
                        <?php if ( !is_array($rightitem) ): ?>
                            <h3 class="h6"><?php echo $rightitem; ?></h3>
                            <div class="wave--container">
                                <img class="wave--seperator" src="<?php echo get_template_directory_uri() . '/img/wave.svg'; ?>" alt="wave">
                            </div>
                        <?php else : ?>
                            <?php foreach ($rightitem as $key => $item) : ?>
                                <div class="info">
                                    <div class="label">
                                        <?php echo $item['title']; ?>
                                    </div>

                                    <div class="value">
                                        <?php echo $item['description']; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </section>
</div>