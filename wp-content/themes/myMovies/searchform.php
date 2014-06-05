<div id="mm-search-form-container" role="search">

	<form role="search" action="<?php echo site_url('/'); ?>" method="get">

		<input id="mm-search-input" type="search" name="s" placeholder="<?php echo __('Search', 'myMovies'); ?>"/>

		<input type="hidden" name="post_type" value="movies" /><!-- // hidden 'movie' value in order to search only for posts with cpt movies -->

		<input id="mm-search-button" type="image" alt="Search" src="<?php bloginfo('template_url'); ?>/images/layout/search-icon.png" />

	</form>

</div><!-- .search -->