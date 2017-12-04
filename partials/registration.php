<?php 
    $title = $layout['title'] ?? '';
    $description = $layout['description'] ?? '';
    $url = $layout['call2action']['url'] ?? '';
    $target = $layout['call2action']['target'] ?? '';
    $button = $layout['call2action']['title'] ?? '';
?>

<div class="section--bg2  clip">
    <section class="section lc">
        <div class="lc-2">

            <h2 class="section__title"><?php echo $title; ?></h2>

            <div class="section__content">
                <?php echo wpautop($description); ?>
            </div>

            <?php if (!empty($url)) : ?>
                <div class="section__more">
                    <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="uppercase btn  btn--invert">
                        <?php echo $button; ?>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </section>
</div>