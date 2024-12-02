<?php
$conn = null;
$conn = checkDbConnection();
$question = new Question($conn);
// $error = [];
// $returnData = [];
if (array_key_exists("questionid", $_GET)) {
    $question->question_aid = $_GET['questionid'];
    checkId($question->question_aid);
    $query = checkReadById($question);
    http_response_code(200);
    getQueriedData($query);
}

if (empty($_GET)) {
    $query = checkReadAll($question);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();