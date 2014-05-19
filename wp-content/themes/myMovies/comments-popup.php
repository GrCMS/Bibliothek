<div class="modal-dialog">

    <div class="modal-content">

        <form role="form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Comments</h4>
            </div>

            <div class="modal-body">


                <?php
                /* Don't remove these lines. */
                add_filter('comment_text', 'popuplinks');
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        ?>

                        <?php if ('open' == $post->ping_status) { ?>
                            <p>The <abbr title="Universal Resource Locator">URL</abbr> to TrackBack this entry is: <em><?php trackback_url() ?></em></p>
                        <?php } ?>

                        <?php
// this line is WordPress' motor, do not delete it.
                        echo 'ID = '.$id;
                        $commenter = wp_get_current_commenter();
                        extract($commenter);
                        $comments = get_approved_comments($id);
                        $post = get_post($id);
                        if (post_password_required($post)) {  // and it doesn't match the cookie
                            echo(get_the_password_form());
                        } else {
                            ?>

                            <?php if ($comments) { ?>
                                <ol id="commentlist">
                                    <?php foreach ($comments as $comment) { ?>
                                        <li id="comment-<?php comment_ID() ?>">
                                            <?php comment_text() ?>
                                            <p><cite><?php comment_type('Comment', 'Trackback', 'Pingback'); ?> by <?php comment_author_link() ?> &#8212; <?php comment_date() ?> @ <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a></cite></p>
                                        </li>

                                    <?php } // end for each comment  ?>
                                </ol>
                            <?php } else { // this is displayed if there are no comments so far  ?>
                                <p>No comments yet.</p>
                            <?php } ?>

                            <?php if ('open' == $post->comment_status) { ?>
                                <h2>Leave a comment</h2>
                                <p>Line and paragraph breaks automatic, e-mail address never displayed, <acronym title="Hypertext Markup Language">HTML</acronym> allowed: <pre><code><?php echo allowed_tags(); ?></code></pre></p>


                                <?php if ($user_ID) : ?>
                                    <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
                                <?php else : ?>
                                    <div class="form-group">
                                        <label for="author">Name</label>
                                        <input type="text" name="author" id="author" class="form-control" value="<?php echo $comment_author; ?>" size="28" tabindex="1" />

                                    </div>

                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $comment_author_email; ?>" size="28" tabindex="2" />

                                    </div>

                                    <div class="form-group">
                                        <label for="url"><abbr title="Universal Resource Locator">URL</abbr></label>
                                        <input type="text" name="url" id="url" class="form-control" value="<?php echo $comment_author_url; ?>" size="28" tabindex="3" />

                                    </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="comment">Your Comment</label>
                                    <br />
                                    <textarea name="comment" id="comment" class="form-control" cols="70" rows="4" tabindex="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
                                    <input type="hidden" name="redirect_to" value="<?php echo attribute_escape($_SERVER["REQUEST_URI"]); ?>" />
                                </div>
                                <?php do_action('comment_form', $post->ID); ?>
                            <?php } else { // comments are closed  ?>
                                <p>Sorry, the comment form is closed at this time.</p>
                                <?php
                            }
                        } // end password check
                        ?>

                        <?php
                    // if you delete this the sky will fall on your head
                    endwhile; //endwhile have_posts()
                else: //have_posts()
                    ?>
                    <p>Sorry, no posts matched your criteria.</p>
                <?php endif; ?>
            </div>

            <div class="modal-footer">
                <input name="submit" type="submit" class="btn btn-primary" tabindex="5" value="Say It!" />
            </div>

        </form>
        <?php timer_stop(1); ?>

    </div>

</div>










