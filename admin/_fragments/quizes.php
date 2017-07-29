<?php

    $quizes = $db->executeQuery("SELECT * FROM quizes")->fetchAll();

?>
<h1>Quizes <small><a href="?p=new">[+]</a></small></h1> <br>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Canonical URL</th>
                <th>Name</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quizes as $quiz): ?>
                <tr>
                    <th><?= htmlspecialchars($quiz['qid']) ?></th>
                    <td><a href="../?q=<?= htmlspecialchars($quiz['canonical']) ?>"><?= htmlspecialchars($quiz['canonical']) ?></a></td>
                    <td><?= htmlspecialchars($quiz['name']) ?></td>
                    <td><a href="?p=edit&qid=<?= htmlspecialchars($quiz['canonical']) ?>"><button type="button" name="button" class="btn btn-info">Edit</button></a>
                        <a href="?p=results&qid=<?= htmlspecialchars($quiz['canonical']) ?>"><button type="button" name="button" class="btn btn-success">Results</button></a>
                        <a href="?p=delete&qid=<?= htmlspecialchars($quiz['canonical']) ?>"><button type="button" name="button" class="btn btn-danger">Delete</button></a></td>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
