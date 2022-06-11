<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');


if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(400);
    die(json_encode(array('code' => 4, 'message' => 'API only support POST request')));
}

$input = json_decode(file_get_contents('php://input'));

if (is_null($input)) {
    die(json_encode(array('code' => 2, 'message' => 'Only support Json format')));
}

if (!property_exists($input, 'username') ||
    !property_exists($input, 'password')
) {
    http_response_code(400);
    die(json_encode(array('code' => 1, 'message' => 'Missing parameter')));
}

if (empty($input->username) ||
    empty($input->password)
) {
    die(json_encode(array('code' => 1, 'message' => 'Invalid information')));
}

// HANDLE
http_response_code(200);

$query = "SELECT * FROM `users` WHERE username = '$input->username'";

if (!is_null(executeResult($query, true))) {

    //$userInfo = executeResult($query, true);
    $userInfo = json_decode(json_encode(executeResult($query, true)), FALSE);
    $username = $userInfo->username;
    $phone = $userInfo->phone;
    $full_name = $userInfo->full_name;
    $wrong_time = $userInfo->wrong_time;
    $password = $input->password;
    $_SESSION['username'] = $username;

    //
    // cancel
    if ($userInfo->isVerification == 2) {
        die(json_encode(array('response' => 'This account has been disabled, please contact the hotline 18001008', 'code' => 400)));
    }
    //

    $isWarming = $userInfo->warming;

    $query = "SELECT * FROM `users` WHERE username = '$username' and password = '" . md5(
            $phone .
            $full_name .
            $password
        ) . "'";

    $response = executeResult($query, true);

    if (is_null($response)) {
        if (isTemporarilyLocked($username)) {
            die(
            json_encode(array(
                'response' => 'Account has been locked due to incorrect input password multiple times, please contact administrator for assistance', 'code' => 400
            ))
            );
        } elseif (isWarming($username)) {
            if (!isPass1Minus($username)) {
                die(json_encode(array('response' => 'Account is temporarily locked, please try again in 1 minute', 'code' => 400)));
            } else {
                if (isWrongThreeTime($username)) {
                    lockTemporarily($username);
                } else {
                    passwordIncorrect($username);
                }

                die(json_encode(array('response' => 'Sign in Fail', 'code' => 400)));
            }
        } else {
            if (isWrongThreeTime($username)) {
                lock1Minus($username);
            } else {
                passwordIncorrect($username);
            }

            die(json_encode(array('response' => 'Sign in Fail', 'code' => 400)));
        }
    } elseif (isTemporarilyLocked($username)) {
        die(
        json_encode(array(
            'response' => 'Account has been locked due to incorrect input password multiple times, please contact administrator for assistance', 'code' => 400
        ))
        );
    } else {

        passwordCorrect($username);
        die(json_encode(array('response' => 'Sign in Success', 'data' => $response, 'code' => 200)));
    }
} else {
    die(json_encode(array('response' => 'Sign in Fail', 'code' => 400)));
}
