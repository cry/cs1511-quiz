<?php session_start();

// quiz thing written for cs1511 - 2017s2
// Carey Li <cse@carey.li>

    require_once 'classes/db.php';

    $db = new database('quiz.db');

    if (!isset($_GET['q'])) {
        die("No quiz id provided >:(");
    }

    $quiz = $db->executeQuery("SELECT * FROM quizes where canonical=:canonical", [
        ":canonical" => $_GET['q']
    ])->fetch();

    if (!$quiz) {
        die("Invalid quiz id.");
    }

    $questions = json_decode($quiz['questions']);

?>
<!--
cs1511 party quiz application thing
Carey Li <cse@carey.li>

hi stop looking at my html pls.
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>cs1511 Quizes | <?= htmlspecialchars($quiz['name']) ?></title>

    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/codehighlight.css">

    <style media="screen">
    body {
        background-color: <?php if ($quiz['background']) echo htmlspecialchars($quiz['background']); else echo "#262626"; ?>;
    }

    .panel {
        margin-top: 2em;
    }

    .panel-body {
        padding-bottom: 25px;
    }

    #memery, #success {display: none;}
    </style>
</head>
<body>

    <div class="container">

        <div class="panel panel-default">
            <div class="panel-body">

                <h3 id="title">Hi, who are you?</h3>

                <div class="row" id="zidholder">
                    <div class="col-md-12"> <br>
                        <input type="text" class="form-control" placeholder="Your zID" id="zid"> <br>
                        <button type="button" name="button" class="btn btn-success" style="width: 100%;" onclick="letmein()">Let me in</button>
                    </div>
                </div>

                <div class="row" id="memery">

                    <?php foreach ($questions as $idx => $question): ?>
                        <div class="col-md-12">

                            <h3>Question <?= $idx?></h3>

                            <p><?= htmlspecialchars($question->question) ?></p>

                            <?php
                                if ($question->code !== null) {
                                    $code = htmlspecialchars(base64_decode($question->code));
                                    echo "<pre><code>$code</code></pre>";
                                }
                            ?>

                            <select class="form-control" name="<?= $idx ?>">
                                <?php foreach ($question->choices as $cidx => $choice): ?>
                                    <option value="<?= $cidx ?>"><?= htmlspecialchars($choice) ?></option>
                                <?php endforeach; ?>
                            </select>

                            <hr>

                        </div>
                    <?php endforeach; ?>

                    <div class="col-md-12"> <br>
                        <button type="button" name="button" class="btn btn-success" style="width: 100%" onclick="submit()">Submit</button>
                    </div>
                </div>

                <div class="row" id="success">
                    <div class="col-md-12">
                        <h3 id="msg">Submitted successfully! You got </h3> <br>

                        <!--<marquee><img src="assets/mark.jpg" alt=""></marquee>-->
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="assets/jquery-3.2.1.min.js" charset="utf-8"></script>
    <script src="assets//bootstrap.min.js" charset="utf-8"></script>
    <script src="assets/codehighlight.js" charset="utf-8"></script>

    <script src="assets/quiz.js" charset="utf-8"></script>

    <script>
        hljs.initHighlightingOnLoad();

        const qid = "<?= htmlspecialchars($_GET['q'], ENT_QUOTES) ?>";
    </script>
</body>
</html>
