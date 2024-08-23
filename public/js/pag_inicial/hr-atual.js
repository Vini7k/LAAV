const hr = document.querySelector('.hr');
const min = document.getElementById('min');

document.addEventListener('DOMContentLoaded', function() {
    const data = new Date();

    if (data.getHours() < 10) {
        hr.value = '0' + data.getHours();
    }
    else {
        hr.value = data.getHours();
    }

    if (data.getMinutes() < 10) {
        min.value = '0' + data.getMinutes();
    }
    else {
        min.value = data.getMinutes();
    }
});

function formaterTime(element) {
    let hrInput = hr.valueAsNumber;
    let minInput = min.valueAsNumber;

    if (element.id == 'arrow') {
        if (hrInput < 10) {
            hr.value = '0' + hrInput;
        }
        if (minInput < 10) {
            min.value = '0' + minInput;
        }
    }
}