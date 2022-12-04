<html>
    <?php
        $not_is_logged_in_str = $is_logged_in_str == 'style=display:none' ? '' : 'style=display:none'
    ?>
    <header>
        <div style="display: inline">
            <h1 style='display: inherit'>Plant Care Helper</h1>
            <a href='?action=register' <?php echo $is_logged_in_str?> style='display: inherit; padding-left: 2em'>Register</a>
            <a href='?action=login' <?php echo $is_logged_in_str?> style='display: inherit; padding-left: 2em'>Log In</a>
            <a href='?action=landing' <?php echo $not_is_logged_in_str?> style='display: inherit; padding-left: 2em'>Home</a>
            <a href='?action=my_list' <?php echo $not_is_logged_in_str?> style='display: inherit; padding-left: 2em'>My List</a>
            <a href='?action=logout' <?php echo $not_is_logged_in_str?> style='display: inherit; padding-left: 2em'>Log Out</a>
        </div>
    </header>
</html>