<?php 
    $field_group_json = get_acf_json_by_name('hero');
    $field_group_file = get_stylesheet_directory() . "/acf-json/{$field_group_json}";
    if (file_exists($field_group_file)) {
        $config = json_decode( file_get_contents( $field_group_file ), true );
    }

    if ( !empty($config) ) {
        $meta = get_all_custom_field_meta( get_the_ID(), $config );
    }

    $imageId = $meta['image'] ?? '';
    $image = $imageId ? wp_get_attachment_image( $imageId, 'hd', false, ["class" => "img-cover"] ) : '';

    $title = $meta['title'] ?? '';
    $date = $meta['date'] ?? '';
    $url = $meta['call2action']['url'] ?? '';
    $target = $meta['call2action']['target'] ?? '';
    $button = $meta['call2action']['title'] ?? '';
?>

<article class="hero">
    <div>
        <div class="hero__image">
            <?php echo $image; ?>
        </div>

        <div class="hero__content  lc">
            <header class="hero__header  ">
                <div class="slogan">
                    <h1 class="h0  slogan__title">
                        <span class="slogan__content">
                            <span class="slogan--item  slogan--top">UH18</span>
                        </span>

                        <span class="slogan__content">
                            <span class="slogan--item  slogan--middle">HACKA</span>
                        </span>

                        <span class="slogan__content">
                            <span class="slogan--item  slogan--bottom">THON</span>
                        </span>
                    </h1>
                </div>

                <div class="hero__date ">
                    <div class="h2"><?php echo $date; ?></div>
                </div>
            </header>

            <?php if (!empty($url)) : ?>
                <div class="hero__button">
                    <a href="<?php echo $url; ?>" class="btn  btn--alt-2" target="<?php echo $target; ?>">
                        <?php echo $button; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>
