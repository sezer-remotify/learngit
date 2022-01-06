<?php $quote = get_post_meta(get_the_ID(),'quote', true); ?>
<?php $quote_author = get_post_meta(get_the_ID(),'quote_author', true); ?>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="post-block">
        <div class="post-content post-content-innerspace rounded-top">
            <!-- post vertical block -->
            <blockquote class="blockquote-fancy">
                <?php echo esc_html($quote); ?>
                <footer class="post-blockquote-author"><?php echo esc_html($quote_author); ?></footer>
            </blockquote>
            <div class="post-meta mt-5">
                <div class="meta">
                    <?php quanto_post_meta(); ?>
                </div>
            </div>
        </div>
        <!-- post block close -->
    </div>
    <!-- /.post classic block -->
</div>