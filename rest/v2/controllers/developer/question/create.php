<?php
$conn = null;
$conn = checkDbConnection();
$question = new Question($conn);

if (array_key_exists("questionid", $_GET)) {
    checkEndpoint();
} 

checkPayload($data);

$question->question_title = checkIndex($data, "question_title");
$question->question_choices = json_encode($data["question_choices"]);

$question->question_is_active = 1;
$question->question_created = date("Y-m-d H:i:s");
$question->question_datetime = date("Y-m-d H:i:s");


isNameExist($question, $question->question_title);

$query = checkCreate($question);
returnSuccess($question, "question", $query);