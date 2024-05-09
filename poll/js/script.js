window.onload = function() {
    let radios = document.getElementsByName('color');
    for(let i = 0; i < radios.length; i++) {
        radios[i].addEventListener('change', customColor);
    }
}

function customColor() {
    let customColorInput = document.getElementById('customColor');
    let otherOption = document.getElementById('customColorOption');

    // Enable the color input if the custom color option is selected
    if (otherOption.checked) {
        customColorInput.disabled = false;
    } else {
        customColorInput.disabled = true;
    }
}