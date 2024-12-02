<?php
$conn = null;
$conn = checkDbConnection();
$question = new Question($conn);
// $error = [];
// $returnData = [];
if (array_key_exists("questionid", $_GET)) {
    checkPayload($data);

    $question->question_aid = $_GET['questionid'];
    $question->question_title = checkIndex($data, "question_title");
    $question->question_choices = json_encode($data["question_choices"]);


    $question->question_datetime = date("Y-m-d H:i:s");
    $question_title_old = strtolower($data["question_title_old"]);
    // checkId($question->question_aid);
    compareName($question, $question_title_old, $question->question_title);

    $query = checkUpdate($question);
    returnSuccess($question, "question", $query);
}

checkEndpoint();