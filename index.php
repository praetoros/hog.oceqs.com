<?php
include "includes/includes.inc.php";

$HogSelect = new \Hog\HogSelect();

$ranks = $HogSelect->getRankListWithId();


?>
    <title>Hog Players</title>
    <script src="index.js" defer></script>
    </head>
    <body>
    <?php
    include "includes/menu.inc.php";
    ?>
    <div class="container">
        <h1>Hog Ratings</h1>
        <br>
        <h3>Add New Hog Player</h3>
        <table class="display table">
            <thead>
            <tr>
                <th>Name: (0-9a-Z)</th>
                <th>Battletag (optional):</th>
                <th>Region:</th>
                <th>Rating (0 to 10):</th>
                <th>Rank:</th>
                <th></th>
                <th>Add new</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input value="" name="hogname" id="newHog-name" type="text" class="form-control"></td>
                <td><input value="" name="btag" id="newHog-btag" type="text" class="form-control"></td>
                <td>
                    <select name="region" id="newHog-region" class="form-control">
                        <?php foreach ($HogSelect->getRegionListWithId() as $region) {
                            echo '<option value="' . $region['id'] . '">' . $region['region'] . '</option>';
                        } ?>
                    </select>
                </td>
                <td>
                    <select name="rating" id="newHog-rating" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </td>
                <td>
                    <select name="rank" id="newHog-rank" class="form-control">
                        <?php foreach ($ranks as $rank) {
                            echo '<option value="' . $rank['id'] . '">' . $rank['name'] . '</option>';
                        } ?>
                    </select>
                </td>
                <td>
                    <button class="btn btn-success" onclick="submitNewHog()">Add New Hog Player</button>
                </td>
            </tr>
            </tbody>
        </table>
        <h3>Rate/View Existing Hog Players</h3>
        <h4>You can rate a player once every 24 hours</h4>
        <table id="hog-players" class="display table table-hover">
            <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Btag (optional)</th>
                <th>Region</th>
                <th>Avg Rating (out of 10)</th>
                <th>Rank</th>
                <th>Number of Ratings</th>
                <th>Add Rating</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $counter = 1;
            foreach ($HogSelect->getAllHogPlayers() as $hogPlayer) {
                echo '<tr>';
                echo '<td onclick="detailUpdateShow(' . $hogPlayer['id'] . ", '" . $hogPlayer['name'] . "'" . ')">' . $counter . '</td>';
                echo '<td onclick="detailUpdateShow(' . $hogPlayer['id'] . ", '" . $hogPlayer['name'] . "'" . ')">' . $hogPlayer['name'] . '</td>';
                echo '<td onclick="detailUpdateShow(' . $hogPlayer['id'] . ", '" . $hogPlayer['name'] . "'" . ')">' . $hogPlayer['bTag'] . '</td>';
                echo '<td onclick="detailUpdateShow(' . $hogPlayer['id'] . ", '" . $hogPlayer['name'] . "'" . ')">' . $hogPlayer['region'] . '</td>';
                echo '<td onclick="detailUpdateShow(' . $hogPlayer['id'] . ", '" . $hogPlayer['name'] . "'" . ')">' . (float)$hogPlayer['rating'] . '</td>';
                echo '<td onclick="detailUpdateShow(' . $hogPlayer['id'] . ", '" . $hogPlayer['name'] . "'" . ')">' . $HogSelect->getSrRangeName((float)$hogPlayer['avgSrRange']) . '</td>';
                echo '<td onclick="detailUpdateShow(' . $hogPlayer['id'] . ", '" . $hogPlayer['name'] . "'" . ')">' . $hogPlayer['countHog'] . '</td>';
                echo '<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rateHog" 
                    onclick="modalUpdate(' . $hogPlayer['id'] . ", '" . $hogPlayer['name'] . "'" . ')">Rate</button></td>';
                echo '</tr>';
                $counter++;
            }
            ?>
            </tbody>
        </table>
        <br>
    </div>
    <div class="modal" id="rateHog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rateHog-title">Rate: </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rateHog-rating" class="form-label">Rating (0-10) Higher is better</label>
                        <select name="rateHog-rating" class="form-control" id="rateHog-rating">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rateHog-rank" class="form-label">Current Rank:</label>
                        <select name="rateHog-rank" class="form-control" id="rateHog-rank">
                            <?php foreach ($ranks as $rank) {
                                echo '<option value="' . $rank['id'] . '">' . $rank['name'] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="rateHog()">Submit Rating</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="hogDetails" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hogDetails-title">Ratings History For: </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Latest entries first</h6>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Entry</th>
                            <th>Rating</th>
                            <th>Rank</th>
                            <th>Submitted</th>
                        </tr>
                        </thead>
                        <tbody id="hogDetails-content">

                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
<?php
include "includes/footer.inc.php";