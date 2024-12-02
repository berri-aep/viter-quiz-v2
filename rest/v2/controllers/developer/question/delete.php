<?php
$conn = null;
$conn = checkDbConnection();
$question = new Question($conn);
// $error = [];
// $returnData = [];
if (array_key_exists("questionid", $_GET)) {
    $question->question_aid = $_GET['questionid'];
    checkId($question->question_aid);
    // isAssociated($question);
    $query = checkDelete($question);
    returnSuccess($question, "question", $query);
}

checkEndpoint();