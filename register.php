<?php
// Include the oauth setup file
require_once 'includes/oauth.php';

// If we are POSTing, create a new consumer
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = 1; // this should not be hardcoded, of course
    $key   = $store->updateConsumer($_POST, $user_id, true);

    $c = $store->getConsumer($key, $user_id);
    echo 'Your consumer key is: <strong>' . $c['consumer_key'] . '</strong><br />';
    echo 'Your consumer secret is: <strong>' . $c['consumer_secret'] . '</strong><br />';
    exit();
}

// Otherwise, create a basic registration form
?>
<form action="http://<?php echo $_SERVER['SERVER_NAME'];?>/register.php" method="post">
    <fieldset>
        <legend>Register</legend>

        <div>
            <label for="requester_name">Name</label>
            <input type="text" id="requester_name" name="requester_name" value="" />
        </div>

        <div>
            <label for="requester_email">Email</label>
            <input type="text" id="requester_email" name="requester_email" value="" />
        </div>

        <div>
            <label for="application_uri">Url</label>
            <input type="text" id="application_uri" name="application_uri" value="" />
        </div>

        <div>
            <label for="callback_uri">Callback Url</label>
            <input type="text" id="callback_uri" name="callback_uri" value="" />
        </div>
    </fieldset>

    <input type="submit" value="Register" />
</form>