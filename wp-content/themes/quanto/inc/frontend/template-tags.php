<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Quanto
 */

if ( ! function_exists( 'quanto_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function quanto_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><!--<time class="updated" datetime="%3$s">%4$s</time>-->';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'quanto' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'quanto_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function quanto_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'quanto' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'quanto_posted_in' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function quanto_posted_in() {
        $categories_list = get_the_category_list( esc_html__( ', ', 'quanto' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            $posted_in = sprintf( esc_html__( '%1$s', 'quanto' ), $categories_list ); // WPCS: XSS OK.
        }

        echo '' . $posted_in . ''; // WPCS: XSS OK.

    }
endif;

if ( ! function_exists( 'quanto_post_meta' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function quanto_post_meta() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><!--<time class="updated" datetime="%3$s">%4$s</time>-->';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x( '%s', 'post date', 'quanto' ),
            '' . $time_string . ''
        );

        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x( 'By %s', 'post author', 'quanto' ),
            '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
        );

        $categories_list = get_the_category_list( esc_html__( ', ', 'quanto' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            $posted_in = sprintf( esc_html__( '%1$s', 'quanto' ), $categories_list ); // WPCS: XSS OK.
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'quanto' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            $tag_with = sprintf( '<span class="tags-links">' . esc_html__( '%1$s', 'quanto' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }

        $metas = quanto_get_option( 'post_entry_meta' );
        if ( ! empty( $metas ) ) :
            if( in_array('date', $metas) ) echo '<span class="meta-date">' . $posted_on . '</span>';
            if( in_array('author', $metas) ) echo '<span class="meta-posted-by">' . $byline . '</span>';
            if (  ( comments_open() || get_comments_number() ) ) {
             echo '<span class="meta-comments">';
                comments_number( esc_html__('0 Comment', 'quanto'), esc_html__('1 Comment', 'quanto'), esc_html__('% Comments', 'quanto') );
             echo '</span>';
         }
        endif;
    }
endif;

if ( ! function_exists( 'quanto_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function quanto_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'quanto' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links">' . esc_html__( '%1$s', 'quanto' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
            if ( is_single() && quanto_get_option( 'post_sharing' ) && ( $socials = quanto_get_option( 'post_sharing_socials' ) ) ) {
                $visible_socials = array_splice( $socials, 0, 3 );
                echo '<div class="post-sharing social-share">';
                echo '<p><strong>Share:</strong></p>';
                foreach ( $visible_socials as $social ) {
                    echo quanto_social_share_link( $social );
                }

                if ( $socials ) {

                    foreach ( $socials as $social ) {
                        echo quanto_social_share_link( $social );
                    }
                }

                echo '</div>';
            }
		}

	}
endif;

/** Posts Navigation **/
if ( ! function_exists( 'quanto_posts_navigation' ) ) :
    function quanto_posts_navigation($prev = 'Previous', $next = 'Next', $pages='') {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        if($pages==''){
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }
        $pagination = array(
            'base'          => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
            'format'        => '',
            'current'       => max( 1, get_query_var('paged') ),
            'total'         => $pages,
            'prev_text'     => $prev,
            'next_text'     => $next,
            'type'          => 'list',
            'end_size'      => 3,
            'mid_size'      => 3
        );
        $return =  paginate_links( $pagination );
        echo str_replace( "<ul class='page-numbers'>", '<ul class="pagination">', $return );
    }
endif;

/**** Change length of the excerpt ****/
if ( ! function_exists( 'quanto_excerpt_length' ) ) :
    function quanto_excerpt_length() {

        if(quanto_get_option('excerpt_length')){
            $limit = quanto_get_option('excerpt_length');
        }else{
            $limit = 30;
        }
        $excerpt = explode(' ', get_the_excerpt(), $limit);

        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return $excerpt;

    }
endif;

if ( ! function_exists( 'quanto_excerpt' ) ) :
/** Excerpt Section Blog Post **/
function quanto_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
endif;

//Custom comment list
if ( ! function_exists( 'quanto_comment_list' ) ) :
    function quanto_comment_list($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment; ?>
    <ul class="comment-list list-unstyled">    
        <li id="comment-<?php comment_ID(); ?>" class="comment">
            <div class="comment-body">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
                        <div class="comment-author"><?php echo get_avatar( $comment, 80 ); ?> </div>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12">
                        <div class="comment-info">
                            <div class="comment-header">
                                <h4 class="user-title"><?php printf(__('%s','quanto'), get_comment_author()) ?> <span class="comment-meta"><?php the_time('G:i:s a '); ?><?php the_time( get_option( 'date_format' ) ); ?></span></h4>
                            </div>
                            <div class="comment-content">
                                <?php if ($comment->comment_approved == '0'){ ?>
                                    <em><?php esc_html_e('Your comment is awaiting moderation.','quanto') ?></em>
                                <?php }else{ ?>
                                    <?php comment_text() ?>
                                <?php } ?>
                                <div><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
        <?php
    }
endif;

//Generate custom search form
function quanto_search_form( $form ) {
    $form = '<form role="search" method="get" id="search-form" class="input-group mb-3 search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    <input type="search" class="form-control search-field" placeholder="' . esc_html__( 'Search Here &hellip;', 'quanto' ) . '" value="' . get_search_query() . '" name="s" aria-label="search here" aria-describedby="button-addon2" />
    <div class="input-group-append">
	   <button type="submit" class="btn btn-brand search-submit" id="button-addon2">' . esc_html__( 'Go', 'quanto' ) . '</button>
    </div>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'quanto_search_form' );

function quanto_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'quanto_mime_types');