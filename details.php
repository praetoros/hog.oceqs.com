<?php

if (!isset($_POST['rateHog_id']) && is_numeric($_POST['rateHog_id'])){
    exit();
} else {
    include 'includes/autoloader.inc.php';

    $HogSelect = new \Hog\HogSelect();
    $counter = 1;
    foreach($HogSelect->getPlayerRatingsHistory($_POST['rateHog_id']) as $rating){
        echo '<tr>';
        echo '<td>' . $counter . '</td>';
        echo '<td>' . $rating['rating']. '</td>';
        echo '<td>' . $rating['rank'] . '</td>';
        echo '<td>' . $rating['time'] . '</td>';
        echo '</tr>';
        $counter++;
    }
}
