<?php 
    $faq = $layout['faq'] ?? '';

    $style = $layout['style'] ?? '';
    $stylecolor = '';

    switch ($style) {
        case 'gelb':
            $stylecolor = 'section--bg  clip';
            break;
        case 'blau':
            $stylecolor = 'section--bg2  clip';
            break;
        default:
            $stylecolor = '';
            break;
    }
?>

<div class="<?php echo $stylecolor; ?>">

    <section class="section  section--left  lc">

        <?php foreach ($faq as $key => $item) : ?>
            <?php 
                $title = $item['title'] ?? '';
                $description = $item['description'] ?? ''; 
            ?>

            <div class="faq">
                <h2 class="faq__title  medium  h5">
                    <?php echo $title; ?>
                </h2>

                <div class="faq__description">
                    <?php echo wpautop($description); ?>
                </div>

                <!-- <div class="section__seperator">
                    <img src="<?php echo get_template_directory_uri() . '/img/wave.svg'; ?>" alt="wave">
                </div> -->
            </div>

        <?php endforeach; ?>

    </section>

</div>