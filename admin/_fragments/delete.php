<?php

if (!isset($_GET['qid'])) {
    echo "<h1>No id provided!</h1>";
    die();
}

if (isset($_GET['confirm'])) {
    $res = $db->executeQuery("DELETE FROM quizes WHERE canonical=:canonical", [
        ":canonical" => $_GET['qid']
    ]);

    if ($res) {
        header("Location: ?p=quizes");
        die();
    } else {
        echo "lol something went wrong";
    }
}

?>

<h1>Are you sure you want to delete <?= htmlspecialchars($_GET['qid']) ?></h1>

<a href="?p=delete&qid=<?= htmlspecialchars($_GET['qid'])?>&confirm=1"><button type="button" name="button" class="btn btn-danger">Yes I'm sure</button></a>
