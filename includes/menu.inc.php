<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a class="navbar-brand" href="/">
        <img src="/favicon.ico" width="30" height="30" class="d-inline-block align-top" alt="" style="margin-left: 15px">
    </a>
    <a class="navbar-brand mx-auto" href="<?php echo $actual_link;?>"><b>Oce Hog Players</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100 order-1 order-md-0 dual-collapse2" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $actual_link;?>">
                    Home
                </a>
            </li>
        </ul>
    </div>
</nav>
