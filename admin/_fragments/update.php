<?php

    if (!isset($_POST['questions'])) {
        die("Missing parameters");
    }

    try {
        json_decode($_POST['questions']);
    } catch (Exception $e) {
        die("Invalid JSON");
    }

    $res = $db->executeQuery("UPDATE quizes SET canonical=:canonical, name=:name, questions=:questions, background=:background WHERE qid=:qid", [
        ":canonical" => $_POST['canonical'],
        ":name" => $_POST['name'],
        ":questions" => $_POST['questions'],
        ":qid" => $_POST['qid'],
        ":background" => $_POST['background']
    ]);

    if (!$res) {
        die("FAILED TO WRITE UPDATE!!!!!");
    } else {
        header("Location: ?p=edit&qid=" . $_POST['canonical'] . "&success=true");
    }
