<?php



if (true){
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

session_start();

include 'includes/autoloader.inc.php';

use Hog\HogSet;

$HogSelect = new \Hog\HogSelect();
$HogSet = new \Hog\HogSet();

$rank = $_POST['newHog_rank'] ?? null;
$btag = $_POST['newHog_btag'] ?? null;
$name = $_POST['newHog_name'] ?? null;;
$region = $_POST['newHog_region'] ?? 0;
$rating = $_POST['newHog_rating'] ?? 0;
if (preg_match('/^\w*$/',$name)){
    if (preg_match('/^[\w#]*$/',$btag) && preg_match('/^[1-5]$/',$region)){
        if (preg_match('/^\d$|^10$/',$rating) && preg_match('/^[1-7]$/',$rank)){
            if (!$HogSelect->getIfBanned($name, $_SERVER['REMOTE_ADDR'], new HogSet()) && !$HogSelect->getIfNameUsed($name)){
                $hogId = $HogSet->addNewHog($btag, $name, $region);
                $HogSet->addNewHogRating($rating, $rank, $_SERVER['REMOTE_ADDR'], $hogId);
                echo json_encode(['status' => 1,'data'=>$hogId]);
            } else {echo json_encode(['status' => 5,'data'=>'banned']);}
        } else{echo json_encode(['status' => 0,'data'=>'ratingOrRank']);}
    } else {echo json_encode(['status' => 3,'data'=>'regionOrBtag']);}
} else {echo json_encode(['status' => 4,'data'=>'nameUsedOrInvalid']);}



