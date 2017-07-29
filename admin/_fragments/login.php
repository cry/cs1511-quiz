<?php

    if (isset($_POST['username']) && isset($_POST['password'])) {

        $res = $db->executeQuery("SELECT * FROM users WHERE username=:username AND password=:password", [
            ":username" => $_POST['username'],
            ":password" => hash('sha256', $_POST['password'])
        ]);

        if (!$res->fetch()) {
            echo '<div class="alert alert-danger" role="alert">Invalid username and/or password.</div>';
        } else {
            $_SESSION['auth'] = $_POST['username'];
            header("Location: ?p=quizes");
            die();
        }
    }

?>
<h1>...and who may you be?</h1> <br>

<div class="row">
    <div class="col-md-12">
        <form class="" action="?p=login" method="post">
            <input type="text" name="username" value="" placeholder="Username" required class="form-control"> <br>
            <input type="password" name="password" value="" placeholder="Password" class="form-control" required> <br>
            <input type="submit" name="login" value="Login" class="btn btn-success">
        </form>
    </div>
</div>
