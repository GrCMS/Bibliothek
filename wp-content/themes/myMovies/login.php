<?php
get_header();

$args = array(
    'redirect' => get_permalink(get_page(163)),
    'id_username' => 'id_username',
    'id_password' => 'id_password',
    'form_id' => 'form_id'
);
?>
<div class="container">
<?php
if (isset($_GET['login']) && $_GET['login'] == 'failed') {
    ?>
    <div id="login-error" style="background-color: #FFEBE8;border:1px solid #C00;padding:5px;">
        <p>Login failed: You have entered an incorrect Username or password, please try again.</p>
    </div>
<?php } ?>

<?php if(!is_user_logged_in()) { ?>
<form role="form" action="<?php echo wp_login_url(get_permalink(get_page($page_id_of_member_area))); ?>" method="post">
    <h1>Login</h1>
    <div class="form-group">
        <label for="log">User</label>
        <input placeholder="User" class="form-control" type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" style="width:200px"/>
    </div>
    <div class="form-group">
        <label for="pwd">Password</label>
        <input placeholder="Password" class="form-control" type="password" name="pwd" id="pwd" style="width:200px"/>
    </div>
    <div class="form-group">
        <div class="checkbox text-left">
            <label>
                <input name="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me
            </label>
        </div>
    </div>

    <input class="btn btn-default" type="submit" name="submit" value="Send" class="button" />
</form>
<?php } ?>
</div>
<?php
get_footer();
?>
