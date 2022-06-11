<?php
const HOST = 'localhost';
const USER = 'root';
const PASSWORD = '';
const DATABASE = 'galaxy';
const DEFAULT_TIME = '0000-01-01 00:00:00';

// INSERT, UPDATE, DELETE
function execute($query)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

    //    $responseResult = mysqli_query($connect, fixSQLInjection($query));
    $responseResult = mysqli_query($connect, $query);
    //    $responseArray = mysqli_fetch_array($responseResult, MYSQLI_ASSOC);
    mysqli_close($connect);

    return array('response' => $responseResult ? 'success' : 'fail');
}

// SELECT
function executeResult($query, $isSingle = false)
{
    $responseData = null;
    $connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

    //    $responseResult = mysqli_query($connect, fixSQLInjection($query));
    $responseResult = mysqli_query($connect, $query);

    if ($isSingle) {
        $responseArray = mysqli_fetch_array($responseResult, MYSQLI_ASSOC);
        $responseData = $responseArray;
    } else {
        if (mysqli_num_rows($responseResult) != 1) {
            $data = [];
            while ($row = mysqli_fetch_array($responseResult, MYSQLI_ASSOC)) {
                $data[] = $row;
            }
            $responseData = $data;
        } else {
            $responseArray = mysqli_fetch_array($responseResult, MYSQLI_ASSOC);
            $responseData = $responseArray;
        }
    }

    mysqli_close($connect);
    return $responseData;
}

// CHECK
function isValue($table, $columnName, $value = '')
{
    $sql = "SELECT * from $table WHERE $columnName='$value'";
    $responseResult = executeResult($sql, true);
    return $responseResult ? true : false;
    //    return array('response' => $responseResult);
}


// when password incorrect
function passwordIncorrect($username)
{
    if ($username != 'root') {
        //     decrease wrong_count
        $query = "UPDATE `users`
                SET wrong_count = wrong_count - 1
                WHERE username = '$username'";

        //     echo $query;
        execute($query);
    }
}

// when password incorrect
function isWrongThreeTime($username)
{
    $query = "SELECT wrong_count FROM `users` WHERE username = '$username'";
    $response = json_decode(json_encode(executeResult($query, true)), FALSE);
    $wrong_count = $response->wrong_count;

    return $wrong_count == 0;
}

function isWarming($username)
{
    $query = "SELECT warming FROM `users` WHERE username = '$username'";
    $response = json_decode(json_encode(executeResult($query, true)), FALSE);
    $warming = $response->warming;

    return $warming == 1;
}

function isTemporarilyLocked($username)
{
    $query = "SELECT * FROM `users` WHERE username = '$username'";
    $response = json_decode(json_encode(executeResult($query, true)), FALSE);
    $wrong_count = $response->wrong_count;
    $warming = $response->warming;
    $wrong_time = $response->wrong_time;

    return $wrong_count == 0 && $warming == 1 && dateDifference(date("Y-m-d h:i:s"), $wrong_time) >= 1;
}

function isPass1Minus($username)
{
    $query = "SELECT wrong_time FROM `users` WHERE username = '$username'";
    $response = json_decode(json_encode(executeResult($query, true)), FALSE);
    $wrong_time = $response->wrong_time;

    return dateDifference(date("Y-m-d h:i:s"), $wrong_time) >= 1;
}

function lock1Minus($username)
{
    //        lock user
    $query = "UPDATE `users`
                SET wrong_time = '" . date("Y-m-d h:i:s") . "',
                    warming = 1,
                    wrong_count = DEFAULT
                WHERE username = '$username'";

    execute($query);
}

function lockTemporarily($username)
{
    //        lock Temporarily user
    $query = "UPDATE `users`
                SET wrong_time = '" . date("Y-m-d h:i:s") . "',
                    warming = 1,
                    wrong_count = 0
                WHERE username = '$username'";

    execute($query);
}

// when password correct
function passwordCorrect($username)
{
    //        rest wrong_count
    $query = "UPDATE `users`
                SET wrong_time = '" . DEFAULT_TIME . "',
                    wrong_count = DEFAULT,
                    warming = DEFAULT
                WHERE username = '$username'";

    //        echo $query;
    execute($query);
}

// other
//date("Y-m-d h:i:s") = current date
function dateDifference($date_1, $date_2, $differenceFormat = '%i')
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return (int)$interval->format($differenceFormat);

}

function firstVisit($username)
{
    $query = "SELECT isFirst FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
//    print_r($response);
    return $response['isFirst'];
}

function getSrcFrontImage($username)
{
    $query = "SELECT front_image FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
    //    print_r($response);
    return $response['front_image'];
}

function getSrcBackImage($username)
{
    $query = "SELECT back_image FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
    //    print_r($response);
    return $response['back_image'];
}

function getSrcFrontImageById($id)
{
    $query = "SELECT front_image FROM `users` WHERE id = '$id'";
    $response = executeResult($query, true);
    //    print_r($response);
    return $response['front_image'];
}

function getSrcBackImageById($id)
{
    $query = "SELECT back_image FROM `users` WHERE id = '$id'";
    $response = executeResult($query, true);
    //    print_r($response);
    return $response['back_image'];
}

function getFullname($username)
{
    $query = "SELECT full_name FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
    //    print_r($response);
    return $response['full_name'];
}

function getFullnameByPhone($phone)
{
    if (is_null($phone)) {
        return '';
    }
    $query = "SELECT full_name FROM `users` WHERE phone = '$phone'";
    $response = executeResult($query, true);
    //    print_r($response);
    return empty($response['full_name']) ? '' : $response['full_name'];
}

function getFullnameById($id)
{
    if (is_null($id)) {
        return '';
    }
    $query = "SELECT id FROM `users` WHERE id = '$id'";
    $response = executeResult($query, true);
    //    print_r($response);
    return empty($response['id']) ? '' : $response['id'];
}

function getEmailByPhone($phone)
{
    if (is_null($phone)) {
        return '';
    }
    $query = "SELECT email FROM `users` WHERE phone = '$phone'";
    $response = executeResult($query, true);
    //    print_r($response);
    return empty($response['email']) ? '' : $response['email'];
}

function getMoneyByUsername($username)
{
    if (is_null($username)) {
        return '';
    }
    $query = "SELECT money FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
    //    print_r($response);
    return empty($response['money']) ? '' : $response['money'];
}

function getMoney($username)
{
    $query = "SELECT money FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
    //    print_r($response);
    return number_format($response['money'], '0', '', ',');
}

function formatMoney($amount)
{
    return number_format($amount, '0', '', ',');
}

function getIsVerification($username)
{
    $query = "SELECT isVerification FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
    //    print_r($response);
    return $response['isVerification'];
}

function getEmail($username)
{
    $query = "SELECT email FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
    //    print_r($response);
    return $response['email'];
}

function getPhone($username)
{
    $query = "SELECT phone FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
    //    print_r($response);
    return $response['phone'];
}

function getBirthday($username)
{
    $query = "SELECT birthday FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
    //    print_r($response);
    return $response['birthday'];
}

function getAddress($username)
{
    $query = "SELECT address FROM `users` WHERE username = '$username'";
    $response = executeResult($query, true);
    //    print_r($response);
    return $response['address'];
}

// fixSQLInjection
function fixSQLInjection($string)
{
    $string = str_replace('\\', '\\\\', $string);
    $string = str_replace('\'', '\\\'', $string);
    return $string;
}

// return null if variable not in _GET
function getGet($variable)
{
    $result = null;
    if (isset($_GET[$variable])) {
        $result = $_GET[$variable];
    }
    return $result;
}

// return null if variable not in _POST
function getPost($variable)
{
    $result = null;
    if (isset($_POST[$variable])) {
        $result = $_POST[$variable];
    }
    return $result;
}

// return null if variable not in _COOKIE
function getCookie($variable)
{
    $result = null;
    if (isset($_COOKIE[$variable])) {
        $result = $_COOKIE[$variable];
    }
    return $result;
}

// return null if variable not in _SESSION
function getSession($variable)
{
    $result = null;
    if (isset($_SESSION[$variable])) {
        $result = $_SESSION[$variable];
    }
    return $result;
}

// return new username
function getNewUsername($time = 10)
{
    $data = '';
    $i = $time;
    while ($i > 0) {
        $data = $data . rand(0, 9);
        $i--;
    }
    return $data;
}

// return new password
function getNewPassword($time = 6)
{
    $data = '';
    $i = $time;
    while ($i > 0) {
        $data = $data . chr(rand(33, 126));
        $i--;
    }
    return $data;
}

// return new password
function otpCorrect($otp, $user)
{
    return md5($user['phone'] . $user['full_name'] . $otp) == $user['otp']
        && dateDifference(date("Y-m-d h:i:s"), $user['otp_time']) <= 1;
}

// return new password
function setIsFirst($user)
{
    $username = $user['username'];
    $query = "UPDATE users 
                SET isFirst = 0
                WHERE username = '$username'";
    execute($query);
}


function getUser($username)
{
    return executeResult("SELECT * FROM users WHERE username = '$username'", true);
}

function getUserByPhone($phone)
{
    return executeResult("SELECT * FROM users WHERE phone = '$phone'", true);
}

function getUserById($id)
{
    return executeResult("SELECT * FROM users WHERE id = '$id'", true);
}


function dateTimeNow()
{
    return date("Y-m-d h:i:s");
}

// return top up
function topUp($username, $amount, $credit)
{
    $user = getUser($username);
    $user_id = $user['id'];

    // update amount
    $query = "
                UPDATE users 
                SET money = money + '$amount'
                WHERE username = '$username'
    ";

    execute($query);
    // save to purchase
    $query = "
                INSERT INTO `purchases`(`create_at`, `update_at`, `money`, `user_root`, `type`, `fee`, `status`) 
                VALUES ('" . dateTimeNow() . "',
                        '" . dateTimeNow() . "',
                        '$amount',
                        '$user_id',
                        '1',
                        '0',
                        '1')
    ";

//    echo $query;
    execute($query);
}

// return with draw
function withDraw($username, $amount, $fee)
{
    $user = getUser($username);
    $user_id = $user['id'];

    if ($amount < 5000000) {
        // update amount
        $query = "
                UPDATE users 
                SET money = money - '$amount' - '$fee'
                WHERE username = '$username'
    ";
        execute($query);

        // save to purchase
        $query = "
                INSERT INTO `purchases`(`create_at`, `update_at`, `money`, `user_root`, `type`, `fee`, `status`) 
                VALUES ('" . dateTimeNow() . "',
                        '" . dateTimeNow() . "',
                        '$amount',
                        '$user_id',
                        '2',
                        '$fee',
                        '1')
    ";

        execute($query);
    } else {
        // save to purchase
        $query = "
                INSERT INTO `purchases`(`create_at`, `update_at`, `money`, `user_root`, `type`, `fee`, `status`) 
                VALUES ('" . dateTimeNow() . "',
                        '" . dateTimeNow() . "',
                        '$amount',
                        '$user_id',
                        '2',
                        '$fee',
                        '2')
    ";
        execute($query);
    }
}

// return sent
function sent($username, $phone_receiver, $sender_money, $fee_sender, $fee_receiver)
{
    $user_sent = getUser($username);
    $user_recive = getUserByPhone($phone_receiver);
    $user_id_sent = $user_sent['id'];
    $user_id_recive = $user_recive['id'];

    if ($sender_money < 5000000) {
        // update amount sent
        $query = "
                UPDATE users 
                SET money = money - '$sender_money' - '$fee_sender'
                WHERE username = '" . $user_sent['username'] . "'
                ";
        execute($query);
        // update amount recive
        $query = "
                UPDATE users 
                SET money = money + '$sender_money' - '$fee_receiver'
                WHERE username = '" . $user_recive['username'] . "'
                ";
        execute($query);

        // save to purchase
        $query = "
                INSERT INTO `purchases`(`create_at`, `update_at`, `money`, `user_root`, `user_des`, `type`, `fee`, `status`) 
                VALUES ('" . dateTimeNow() . "',
                        '" . dateTimeNow() . "',
                        '$sender_money',
                        '$user_id_sent',
                        '$user_id_recive',
                        'e',
                        '" . $fee_receiver + $fee_receiver . "',
                        '1')
    ";

        execute($query);
    } else {
        // save to purchase
        $query = "
                INSERT INTO `purchases`(`create_at`, `update_at`, `money`, `user_root`, `user_des`, `type`, `fee`, `status`) 
                VALUES ('" . dateTimeNow() . "',
                        '" . dateTimeNow() . "',
                        '$sender_money',
                        '$user_id_sent',
                        '$user_id_recive',
                        'e',
                        '" . $fee_receiver + $fee_receiver . "',
                        '2')
    ";

        execute($query);
    }
}

// return buy phone card
function buyCard($username, $internet_provider, $recharge_card, $amount)
{
    $user = getUser($username);
    $user_id = $user['id'];

    $card_codes = [];

    for ($i = 0; $i < $amount; $i++) {
        // update amount
        $query = "
                UPDATE users 
                SET money = money - '$recharge_card'
                WHERE username = '$username'
        ";
        execute($query);


        $card_code = getNewPhoneCard($internet_provider);
        $card_codes[] = array('card_code' => $card_code, 'internet_provider' => getInternetProvider($internet_provider), 'recharge_card' => $recharge_card);

        // save to purchase
        $query = "
                INSERT INTO `purchases`(`create_at`, `update_at`, `money`, `user_root`, `type`, `fee`, `status`, `internet_provider`, `recharge_card`, `card_code`) 
                VALUES ('" . dateTimeNow() . "',
                        '" . dateTimeNow() . "',
                        '$amount',
                        '$user_id',
                        '4',
                        '0',
                        '1',
                        '$internet_provider',
                        '$recharge_card',
                        '$card_code')
        ";
        execute($query);
        $_SESSION['card_codes'] = $card_codes;
    }
}


function getNewPhoneCard($internet_provider)
{
    $query = "SELECT card_code FROM purchases";
    $response = executeResult($query);
    $card_code = $internet_provider . rand(10000, 99999);
    while (in_array($card_code, $response)) {
        $card_code = $internet_provider . rand(10000, 99999);
    }
    return $card_code;
}

function getInternetProvider($internet_provider)
{
    if ($internet_provider == '11111') {
        return 'Viettel';
    }
    if ($internet_provider == '22222') {
        return 'Mobifone';
    }
    return 'Vinaphone';
}

function verification2Text($type)
{
    if ($type == '0') {
        return 'Not verified';
    }
    if ($type == '1') {
        return 'Waiting';
    }
    if ($type == '2') {
        return 'Cancel';
    }
    return 'Verified';
}

function getClassRow($type)
{
    if ($type == '0') {
        return 'table-light';
    }
    if ($type == '1') {
        return 'table-info';
    }
    if ($type == '2') {
        return 'table-danger';
    }
    return 'table-success';
}

function getFilms()
{
    $query = "SELECT * FROM `film`";

    $response = executeResult($query);
    return count($response) == count($response, COUNT_RECURSIVE) ? empty($response) ? array() : array($response) : $response;
}

function getFilmById($id)
{
    $query = "SELECT * FROM `film` WHERE id = $id";

    $response = executeResult($query);
    return count($response) == count($response, COUNT_RECURSIVE) ? empty($response) ? array() : array($response) : $response;
}

function getList1()
{
    $query = "    SELECT * FROM `users`
                  WHERE `username` NOT LIKE 'root'
                  ORDER BY `isVerification` ASC";

    $response = executeResult($query);
    return count($response) == count($response, COUNT_RECURSIVE) ? empty($response) ? array() : array($response) : $response;
}

function getList2()
{
    $query = "    SELECT * FROM `users`
                  WHERE `username` NOT LIKE 'root' AND `isVerification` = 3
                  ORDER BY `create_at` DESC";

    $response = executeResult($query);
    return count($response) == count($response, COUNT_RECURSIVE) ? empty($response) ? array() : array($response) : $response;
}

function getList3()
{
    $query = "    SELECT * FROM `users`
                  WHERE `username` NOT LIKE 'root' AND `isVerification` = 2
                  ORDER BY `create_at` DESC";

    $response = executeResult($query);
    return count($response) == count($response, COUNT_RECURSIVE) ? empty($response) ? array() : array($response) : $response;
}

function getList4()
{
    $query = "    SELECT * FROM `users`
                  WHERE `username` NOT LIKE 'root' AND `warming` = 1 AND TIMESTAMPDIFF(MINUTE,`wrong_time`,NOW()) > 1 AND `wrong_count` = 0
                  ORDER BY `wrong_time` DESC";

    $response = executeResult($query);
    return count($response) == count($response, COUNT_RECURSIVE) ? empty($response) ? array() : array($response) : $response;
}

function getPurchases($id)
{
    $query = "SELECT * FROM `purchases` WHERE `user_root` = '$id' ORDER BY `create_at` DESC";

    $response = executeResult($query);
    return count($response) == count($response, COUNT_RECURSIVE) ? empty($response) ? array() : array($response) : $response;
}

function purchasesType2Text($type)
{
    if ($type == 1) {
        return 'Top Up';
    }
    if ($type == 2) {
        return 'Withdraw';
    }
    if ($type == 3) {
        return 'Transfer';
    }
    return 'Top up card';
}

