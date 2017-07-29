<?php

if (!isset($_GET['qid'])) {
    echo "no qid provided pls";
    die();
}

$quiz = $db->executeQuery("SELECT * FROM quizes WHERE canonical=:canonical", [
    ":canonical" => $_GET['qid']
])->fetch();

if (!$quiz) {
    echo "invalid quiz pls go away";
    die();
}

if (isset($_GET['success']) && $_GET['success']) {
    echo '<div class="alert alert-success" role="alert">Changes written!</div>';
}

?>

<h3><strong> <?= htmlspecialchars($quiz['name']) ?></strong> <a href="c2b64.html" target="_blank"><small>code -> base64 encoder</small></a></h3> <br>

<form class="" action="?p=update" method="post" id="form">

    <div class="row">
        <input type="hidden" name="qid" value="<?= $quiz['qid'] ?>">
        <div class="col-md-6">
            <div class="form-group">
                <label for="canonical">Canonical ID</label>
                <input type="text" name="canonical" value="<?= htmlspecialchars($quiz['canonical']) ?>" class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($quiz['name']) ?>" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="questions">Question JSON</label>
        <textarea name="questions" class="form-control" id="code" rows="15"><?= htmlspecialchars(json_encode(json_decode($quiz['questions']), JSON_PRETTY_PRINT)) ?></textarea>
    </div>

    <div class="form-group">
        <button type="button" name="button" class="btn btn-success" style="width: 100%" onclick="save()">Validate & Save</button>
    </div>
</form>

<script type="text/javascript">
    document.getElementById("code").addEventListener("keydown", (e) => {
        if (e.code != "Tab") return;

        e.preventDefault();

        let start = document.getElementById("code").selectionStart;

        document.getElementById("code").value = document.getElementById("code").value.slice(0, document.getElementById("code").selectionStart) + "    " + document.getElementById("code").value.slice(document.getElementById("code").selectionStart)

        document.getElementById("code").setSelectionRange(start + 4, start + 4);
    });

    function save() {
        // Validate the json

        try {
            JSON.parse(document.getElementById("code").value);
        } catch (e) {
            alert("Invalid JSON, verify it with json validator.");
            return;
        }

        document.getElementById("form").submit();

    }
</script>
