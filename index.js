const newHog_name = document.getElementById('newHog-name');
const newHog_btag = document.getElementById('newHog-btag');
const newHog_region = document.getElementById('newHog-region');
const newHog_rating = document.getElementById('newHog-rating');
const newHog_rank = document.getElementById('newHog-rank');

const rateHog_rating = document.getElementById('rateHog-rating');
const rateHog_rank = document.getElementById('rateHog-rank');

let hogRateId = 0;

function submitNewHog() {
    console.log(newHog_name.value);
    console.log(newHog_btag.value);
    console.log(newHog_region.value);
    console.log(newHog_rating.value);
    console.log(newHog_rank.value);
    if (newHog_name.value !== ''){
        $.ajax({
            dataType: 'json',
            data: ({
                'newHog_name':newHog_name.value,
                'newHog_btag':newHog_btag.value,
                'newHog_region':newHog_region.value,
                'newHog_rating':newHog_rating.value,
                'newHog_rank':newHog_rank.value,
            }),
            type: 'post',
            url: 'new.php',
            success: function (result) {
                console.log(result);
                console.log('success: ' + result['data']);
                if (result['status'] === 4){
                    alert('This player is already in the database')
                } else {
                    location.reload();
                }
            },
            error: function (result){
                console.log(result);
                console.log('error: ' + result['data']);
            }
        })
    }
}

function modalUpdate(hogId, hogName) {
    document.getElementById('rateHog-title').innerText = 'Rate: ' + hogName
    hogRateId = hogId;
}

function rateHog() {
    console.log(hogRateId)
    console.log(rateHog_rating.value);
    console.log(rateHog_rank.value);
    $.ajax({
        dataType: 'json',
        data: ({
            'rateHog_id':hogRateId,
            'rateHog_rating':rateHog_rating.value,
            'rateHog_rank':rateHog_rank.value
        }),
        type: 'post',
        url: 'rate.php',
        success: function (result) {
            console.log(result);
            console.log('success: ' + result['data']);
            if (result['status'] === 2){
                alert('You have already voted on this player')
            } else {
                location.reload();
            }
        },
        error: function (result){
            console.log(result);
            console.log('error: ' + result['data']);
        }
    })
}

$(document).ready(function () {
    $('#hog-players').DataTable({
        paging: false,
        order: [[5, 'desc'],[3, 'desc']],
    });
});