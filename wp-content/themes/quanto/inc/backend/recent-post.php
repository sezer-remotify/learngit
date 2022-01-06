<?php
/**
 * Recent_Posts widget class
 *
 * @since 4.4.2
 */
class quanto_widget_recent_posts extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_recent_entries', 'description' => esc_html__( "The most recent posts on your site", 'quanto') );
        parent::__construct('recent-posts', esc_html__('quanto Recent Posts', 'quanto'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';
    }

    function widget($args, $instance) {

        ob_start();
        extract($args);

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
        if ( ! $number )
            $number = 10;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) :
?>
        <?php echo wp_specialchars_decode( $before_widget ); ?>

        <?php if ( $title ){ echo wp_specialchars_decode( $before_title ) . esc_attr( $title ) . wp_specialchars_decode( $after_title ); } ?>

            <ul>
                <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                <li>
                   <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-5 col-sm-12 col-12">
                        <div class="recent-post-img zoomimg">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( array(90, 90) ); ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-7 col-sm-12 col-12 pl-xl-0">
                        <div class="recent-post-content">
                            <h4 class="recent-title"><a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a></h4>
                            <p class="meta"><?php the_time( get_option( 'date_format' ) ); ?></p>
                        </div>
                    </div>
                  </div>
                </li>              
                    
                <?php endwhile; wp_reset_postdata(); ?>   
            </ul> 
                      
		
        <?php echo wp_specialchars_decode( $after_widget ); ?>
        <?php        
        wp_reset_postdata();

        endif;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = (bool) $new_instance['show_date'];

        return $instance;
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
        <p><label for="<?php echo wp_specialchars_decode( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'quanto' ); ?></label>
        <input class="widefat" id="<?php echo wp_specialchars_decode( $this->get_field_id( 'title' ) ); ?>" name="<?php echo wp_specialchars_decode( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

        <p><label for="<?php echo wp_specialchars_decode( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'quanto' ); ?></label>
        <input id="<?php echo wp_specialchars_decode( $this->get_field_id( 'number' ) ); ?>" name="<?php echo wp_specialchars_decode( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo wp_specialchars_decode( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo wp_specialchars_decode( $this->get_field_name( 'show_date' ) ); ?>" />
        <label for="<?php echo wp_specialchars_decode( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?', 'quanto' ); ?></label></p>
<?php
    }
}

function quanto_register_custom_widgets() {
    register_widget( 'quanto_widget_recent_posts' );
}
add_action( 'widgets_init', 'quanto_register_custom_widgets' );	