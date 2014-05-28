<div class="modal-dialog">

    <div class="modal-content">

        <form role="form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php __("Rate it!", "myMovies"); ?></h4>
            </div>

            <div class="modal-body">

                <?php comment_form(); ?>
                
            </div>

            <div class="modal-footer">
                
            </div>

        </form>

    </div>

</div>










