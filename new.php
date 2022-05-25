<?php
if (true){
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

session_start();

include 'includes/autoloader.inc.php';

$HogSelect = new \Hog\HogSelect();
$HogSet = new \Hog\HogSet();

$rank = $_POST['newHog_rank'] ?? null;
$btag = $_POST['newHog_btag'] ?? null;
$name = $_POST['newHog_name'] ?? null;;
$region = $_POST['newHog_region'] ?? 0;
$rating = $_POST['newHog_rating'] ?? 0;
if (preg_match('/^\w*$/',$name) && preg_match('/^\w*$/',$btag) && preg_match('/^[1-5]$/',$region)){
    if (isset($rank) && isset($name) && isset($region) && isset($rating)){
        $hogId = $HogSet->addNewHog($btag, $name, $region);
        if (is_numeric($rating) && is_numeric($rank) && $rating >= 0 && $rating <= 10 && $rank > 0 && $rank <= 7) {
            $HogSet->addNewHogRating($rating, $rank, $_SERVER['REMOTE_ADDR'], $hogId);
        }
        echo json_encode(['status' => 1,'data'=>$hogId]);
    } else{
        echo json_encode(['status' => 0,'data'=>'unset']);
    }
} else {
    echo json_encode(['status' => 3,'data'=>'invalid']);
}


