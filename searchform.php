<form action="<?php echo get_site_url() ?>" method="get" role="search" class="nav__search-form">
    <input type="search" name="s" class="nav__search-field" placeholder="Search" value="<?php the_search_query(); ?>" />
    <input type="submit" class="nav__search-submit" value="">
</form>

