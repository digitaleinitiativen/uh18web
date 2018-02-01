<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package uh18
 */

get_header(); ?>

	<?php include(locate_template('partials/hero.php')); ?>


	<!-- MEDIUM FEED -->
	<div class="section  section--left  lc">
		<?php
		$url = "https://medium.com/feed/voralberg-digital/tagged/uh18";

		$invalidurl = false;
		if(@simplexml_load_file($url)){
			$feeds = simplexml_load_file($url);
		}else{
			$invalidurl = true;
			echo "<h2>Invalid RSS feed URL. DAMN</h2>";
		}

		$i=0;
		if(!empty($feeds)){

			$site = $feeds->channel->title;
			$sitelink = $feeds->channel->link;

			foreach ($feeds->channel->item as $item) {
				$title = $item->title;
				$link = $item->link;
				$description = $item->children("content", true);
				$postDate = $item->pubDate;
				$pubDate = date('D, d M Y',strtotime($postDate));
				$author = $item->children("dc", true);


				// if($i>=5) break;
				?>
				<div class="feed">
					<div class="feed__head">
						<div class="feed__subtitle  h8"><?php echo $pubDate; ?> | <?php echo $author; ?></div>
						<h2><a class="feed__title" href="<?php echo $link; ?>" target="_blank"><?php echo $title; ?></a></h2>
					</div>
					<div class="feed__description">
						<?php echo implode(' ', array_slice(explode(' ', $description), 0, 20)) . "..."; ?> <a target="_blank" href="<?php echo $link; ?>">weiterlesen</a>
					</div>

					<div class="feed__seperator">
						<img src="<?php echo get_template_directory_uri() . '/img/wave.svg'; ?>" alt="wave">
					</div>
				</div>

				<?php
				$i++;
			}
		} else{
			if(!$invalidurl){
				echo "<h2>No item found</h2>";
			}
		}
		?>

	</div>

<?php
get_sidebar();
get_footer();
