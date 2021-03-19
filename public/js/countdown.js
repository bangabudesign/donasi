const recentDonateAmount = localStorage.getItem('recentDonateAmount') || 0;
const hourText = document.getElementById('hourText');
const minuteText = document.getElementById('minuteText');
const secondText = document.getElementById('secondText');

// Update the count down every 1 second
if (hourText && minuteText && secondText) {
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        hourText.innerHTML = hours;
        minuteText.innerHTML = minutes;
        secondText.innerHTML = seconds;

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            hourText.innerHTML = 00;
            minuteText.innerHTML = 00;
            secondText.innerHTML = 00;
        }
    }, 1000);
}

var x = setInterval(function() {
    location.reload();
}, 120000);

function copyText(e, target) {
    e.preventDefault();

    var copyText = target;
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");

    alert("Copied: " + copyText);
}