<?php
if (true){
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

session_start();

include 'includes/autoloader.inc.php';

$hogId = $_POST['rateHog_id'] ?? null;
if (isset($hogId)){
    $HogSelect = new \Hog\HogSelect();
    $HogSet = new \Hog\HogSet();

    $rank = $_POST['rateHog_rank'] ?? null;
    $rating = $_POST['rateHog_rating'] ?? null;

    if (is_numeric($rating) && is_numeric($rank) && is_numeric($hogId) && $rating >= 0 && $rating <= 10 && $rank > 0 && $rank <= 7){
        if (!$HogSelect->getIfIpUsed($_SERVER['REMOTE_ADDR'], $hogId)){
            $HogSet->addNewHogRating($rating, $rank, $_SERVER['REMOTE_ADDR'], $hogId);
            echo json_encode(['status' => 1,'data'=>$hogId]);
        } else {
            echo json_encode(['status' => 2,'data'=>'alreadyvoted']);
        }
    } else {
        echo json_encode(['status' => 0,'data'=>[$rating,$rank,$hogId]]);
    }


}

