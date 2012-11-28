<?php
// Include the oauth setup file
require_once 'includes/oauth.php';

// check if we are posting
if ($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists('requester_email', $_POST)) {
    // check if the email exists in our users table
    $sql = "SELECT `id` FROM `users` WHERE `email` = '" . $_POST['requester_email'] . "'";
    $res = $database->Execute($sql);
    if ($res) {
        $row = $res->fetch_assoc();
        $user_id = $row['id'];
    }
}

if (isset($user_id)) {
    // Check if there is a valid request token in the current request
    // Returns an array with the consumer key, consumer secret, token, token secret and token type.
    $rs = $server->authorizeVerify();

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // See if the user clicked the 'allow' submit button (or whatever you choose)
        $authorized = array_key_exists('allow', $_POST);

        // Set the request token to be authorized or not authorized
        // When there was a oauth_callback then this will redirect to the consumer
        $server->authorizeFinish($authorized, $user_id);
    }
}

// otherwise, display login form
?>
<form action="http://<?php echo $_SERVER['SERVER_NAME'];?>/login.php?oauth_token=<?php echo $_GET['oauth_token'];?>&oauth_callback=<?php echo urlencode($_GET['oauth_callback']);?>" method="post">
    <input type="hidden" name="allow" value="1" />

    <fieldset>
        <legend>Login</legend>
        <div>
            <label for="requester_email">Email</label>
            <input type="text" id="requester_email" name="requester_email" value="" />
        </div>
    </fieldset>

    <input type="submit" value="Login" />
</form>