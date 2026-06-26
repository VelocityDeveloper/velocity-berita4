<?php

/**
 * The template for displaying search forms
 *
 * @package velocity
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="visually-hidden" for="s"><?php esc_html_e('Search', 'justg'); ?></label>
    <div class="input-group">
        <input class="field form-control rounded-start p-1" id="s" name="s" type="text" placeholder="Search" value="<?php the_search_query(); ?>" required>
        <button type="submit" class="submit btn h-100 p-0 px-2 btn-sm rounded-end">
            <?php echo velocitychild_svg_icon('search', 'text-white'); ?>
        </button>
    </div>
</form>
