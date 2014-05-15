<?php
/*
Template Name: Login Form
*/
get_header();

$args = array(
    'redirect' => get_permalink(get_page(163)),
    'id_username' => 'id_username',
    'id_password' => 'id_password',
    'form_id' => 'form_id'
);
if (isset($_GET['login']) && $_GET['login'] == 'failed') {
    ?>
    <div style="background-color: #FFEBE8;border:1px solid #C00;padding:5px;">
        <p>Login failed: You have entered an incorrect Username or password, please try again.</p>
    </div>
<?php } ?>

<?php if (!is_user_logged_in()) { ?>
    <div id="login-form">
        <form role="form" action="<?php echo wp_login_url(get_permalink(get_page(163))); ?>" method="post">
            <h1>Login</h1>
            <div class="form-group">
                <label class="sr-only" for="log">User</label>
                <input placeholder="User" class="form-control" type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" />
            </div>
            <div class="form-group">
                <label class="sr-only" for="pwd">Password</label>
                <input placeholder="Password" class="form-control" type="password" name="pwd" id="pwd" />
            </div>
            <div class="form-group">
                <div class="checkbox text-left">
                    <label>
                        <input name="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me
                    </label>
                </div>
            </div>
            <?php wp_register('', ''); ?>

            <input class="btn btn-default" type="submit" name="submit" value="Login" class="button" />
        </form>
    </div>
<?php
}
get_footer();
?>
