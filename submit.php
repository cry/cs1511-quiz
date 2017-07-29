<?php

    require_once 'classes/db.php';

    $db = new database('quiz.db');

    if (!isset($_POST['zid']) || !isset($_POST['answers']) || !isset($_GET['q'])) {
        die(json_encode([
            "err" => "Invalid paramaters"
        ]));
    }

    $res = $db->executeQuery("INSERT INTO results (qid, zid, choices) VALUES (:canonical, :zid, :choices)", [
        ":zid" => $_POST['zid'],
        ":choices" => json_encode($_POST['answers']),
        ":canonical" => $_GET['q']
    ]);

    $score = 0;

    $questions = $db->executeQuery("SELECT questions, name FROM quizes WHERE canonical=:canonical", [
        ":canonical" => $_GET['q']
    ])->fetch();

    $answers = [];

    foreach (json_decode($questions['questions']) as $question) {
        $answers[] = $question->correct;
    }

    foreach ($_POST['answers'] as $idx => $answer) {
        if ($answers[$idx] == $answer) $score++;
    }

    if (!$res) {
        die(json_encode([
            "err" => "Insert failed!"
        ]));
    } else {
        die(json_encode([
            "success" => 1,
            "score" => $score,
            "total" => count($answers)
        ]));
    }
