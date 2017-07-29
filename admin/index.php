<?php session_start();

    // quiz thing written for cs1511 - 2017s2
    // Carey Li <cse@carey.li>

    require '../classes/db.php';

    $db = new database("../quiz.db");

    const ROUTES = [
        "quizes",
        "login",
        "logout",
        "edit",
        "results",
        "delete",
        "update",
        "new"
    ];

    if (!isset($_GET['p']) || !in_array($_GET['p'], ROUTES)) {
        header("Location: ?p=quizes");
        die();
    }

    if ($_GET['p'] !== "login" && (!isset($_SESSION['auth']) || !$_SESSION['auth'])) {
        header("Location: ?p=login");
        die();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>cs1511 Quiz Admin</title>

        <link rel="stylesheet" href="../assets/bootstrap.min.css">

    </head>
    <body>

        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
                <p class="navbar-text" onclick="window.location.replace('?p=quizes')">cs1511 Quiz Admin</p>
            </div>
          </div>
        </nav>

        <div class="container">

            <?php require_once "_fragments/" . $_GET['p'] . ".php"; ?>

        </div>

        <script src="../assets/jquery-3.2.1.min.js" charset="utf-8"></script>
        <script src="../assets/bootstrap.min.js" charset="utf-8"></script>

    </body>
</html>
