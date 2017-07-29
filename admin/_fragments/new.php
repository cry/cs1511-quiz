<?php

    // Create a new quiz from template
    $id = bin2hex(random_bytes(10));

    $res = $db->executeQuery("INSERT INTO quizes (canonical, name, questions) VALUES ('$id', 'New Quiz', '" . '[{"question":"What is the value of f(4)?","code":"aW50IGYoaW50IG4pCnsKICAgaWYgKG4gPT0gMCkKICAgICAgcmV0dXJuIDA7CiAgIGVsc2UKICAgICAgcmV0dXJuIG4gKyBmKG4tMSk7Cn0=","choices":["0","None of the rest","10","24"],"correct":0},{"question":"What is the final value of a?","code":"aW50IGEgPSA1OyAgCmludCAqcDsKcCA9ICZhOwoqcCA9ICpwICsgMTsKYSsrOw==","choices":["5","6","7","None of the rest"],"correct":0},{"question":"What is the meaning of life?","code":null,"choices":["Pizza","Memes","LGs","42"],"correct":3}]' . "')");

    if (!$res) {
        die("Failed to add new quiz!");
    } else {
        header("Location: ?p=edit&qid=$id");
    }
