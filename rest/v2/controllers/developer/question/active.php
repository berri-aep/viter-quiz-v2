<?php

require '../../../core/header.php';
require '../../../core/functions.php';
require '../../../models/developer/Question.php';

$conn = null;
$conn = checkDbConnection();
$question = new Question($conn);
$response = new Response();

$body = file_get_contents("php://input");
$data = json_decode($body, true);

$error = [];
$returnData = [];

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkApiKey();
    if (array_key_exists("questionid", $_GET)) {

        checkPayload($data);
        $question->question_aid = $_GET['questionid'];
        $question->question_is_active = trim($data["isActive"]);
        $question->question_datetime = date("Y-m-d H:i:s");

        checkId($question->question_aid);
        $query = checkActive($question);
        http_response_code(200);
        returnSuccess($question, "question", $query);
    }

    checkEndpoint();
}

http_response_code(200);
checkAccess();