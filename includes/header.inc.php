<?php
$baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$siteName = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/secure/settings.ini',true)['site']['name'];
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <link rel="icon" href="/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/resources/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/resources/jquery.dropdown.css">
    <link rel="stylesheet" type="text/css" href="/resources/animate.css">
    <link rel="stylesheet" type="text/css" href="/resources/datatables/datatables.min.css"/>

    <script type="text/javascript" src="/resources/popper.min.js"></script>
    <script type="text/javascript" src="/resources/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/resources/bootstrap.min.js"></script>
    <script type="text/javascript" src="/resources/jquery.ticker.js"></script>
    <script type="text/javascript" src="/resources/datatables/datatables.min.js"></script>

    <meta content="<?php echo $siteName; ?>" property="og:title"/>
    <meta content="A tracker for rating and ranking hog players. Open for community submissions!" property="og:description"/>
    <meta content="<?php echo $baseURL; ?>" property="og:url"/>
    <meta content="<?php echo $baseURL; ?>/favicon.ico" property="og:image"/>
    <meta content="#ff4c00" data-react-helmet="true" name="theme-color"/>



