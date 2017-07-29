<?php

    if (!isset($_GET['qid'])) {
        die("No qid provided");
    }

    $results = $db->executeQuery("SELECT * FROM results WHERE qid=:canonical", [
        ":canonical" => $_GET['qid']
    ])->fetchAll();

    if (!$results) {
        die("Either no results or invalid quiz id.");
    }

    $questions = $db->executeQuery("SELECT questions, name FROM quizes WHERE canonical=:canonical", [
        ":canonical" => $_GET['qid']
    ])->fetch();

    $answers = [];

    foreach (json_decode($questions['questions']) as $question) {
        $answers[] = $question->correct;
    }

?>

<h2>Results for <?= htmlspecialchars($questions['name']) ?></h2> <br>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>zID</th>
                <th>Score</th>
                <th>Incorrect question numbers</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $idx => $result): ?>
                <tr>
                    <td><?= htmlspecialchars($result['zid']) ?></td>
                    <td><?php

                        $total = 0;

                        foreach (json_decode($result['choices']) as $idx => $choice) {
                            if ($answers[$idx] == $choice) $total++;
                        }

                        echo $total . "/" . count($answers);

                    ?></td>
                    <td><?php

                    foreach (json_decode($result['choices']) as $idx => $choice) {
                        if ($answers[$idx] != $choice) echo "$idx ";
                    }

                    ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
