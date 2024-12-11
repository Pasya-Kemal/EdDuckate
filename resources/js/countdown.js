/**
 * @param {Date} endsAt
 * @param {string} id
 */
function startCountdown(endsAt, id) {
    const elem = document.getElementById(id);
    setInterval(function () {
        const diff = endsAt.getTime() - Date.now();
        elem.innerText = formatTimeToCountdown(diff / 1000);
    }, 500)
}

function formatTimeToCountdown(timestamp) {
    let totalSeconds = timestamp;
    let hours = Math.floor(totalSeconds / 3600);
    totalSeconds %= 3600;
    let minutes = Math.floor(totalSeconds / 60);
    let seconds = Math.floor(totalSeconds % 60);

    if (hours < 10) {
        hours = "0" + hours;
    }

    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    if (seconds < 10) {
        seconds = "0" + seconds;
    }

    return hours + ":" + minutes + ":" + seconds;
}
