<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quanto
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>



    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) : ?>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class=" comments-block border">
            <div id="comments" class="comments-area">
            <h4 class="comment-block-header"><?php comments_number( esc_html__('(0) Comment', 'quanto'), esc_html__('(1) Comment', 'quanto'), esc_html__(  '(%) Comments', 'quanto') ); ?></h4>

        
            <?php wp_list_comments('callback=quanto_comment_list'); ?>
            <!-- .comment-list -->

            <?php
            the_comments_navigation();

            // If comments are closed and there are comments, let's leave a little note, shall we?
            if ( ! comments_open() ) :
                ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'quanto' ); ?></p>
            <?php
            endif; ?>

            </div>
        </div>
    </div>
    <?php endif; // Check for have_comments().
    // Custom comments_args here: https://codex.wordpress.org/Function_Reference/comment_form
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $comments_args = array(
        'class_form' => 'reply-form form-row', 
        'title_reply'   => esc_html__('Write A Comment', 'quanto'),
        'comment_field' => '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><div class="form-group">
                        <label class="control-label"> ' . esc_attr__('Your Comments','quanto') . ' </label>
                        <textarea class="form-control" id="comment" name="comment" cols="45" rows="4" aria-required="true" required></textarea></div></div>',

        'fields'        => apply_filters( 'comment_form_default_fields', array(
            'author' =>
                '<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group">
                <label class="control-label"> ' . esc_attr__('Name','quanto') . ' <span class="form-remark">*</span></label>
                <input class="form-control " id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30" required /></div></div>',

            'email' =>
                '<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group">
                <label class="control-label">' . esc_attr__('E-mail','quanto') . '<span class="form-remark">*</span></label>
                <input class="form-control " id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30" required /></div></div>',

            'url'  =>
                '<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12"><div class="form-group">
                <label class="control-label">' . esc_attr__('Website','quanto') . ' <span class="form-remark">*</span> </label>
                <input class="form-control " id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
                '" size="30" /></div></div>',
        )),
        'class_submit' => 'btn btn-brand btn-rounded',
        'format'       => 'xhtml'
    );
    
    ?>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <?php comment_form( $comments_args ); ?>
        </div>
    </div>
</div>
<!-- #comments -->