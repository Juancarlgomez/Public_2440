window.onload = function () {
    var password = document.getElementById("password");
    var verifyPassword = document.getElementById("verifyPassword");
    var submitButton = document.querySelector("input[type='submit']");


    function validate() {
        var feedback = "";
        var valid = true;


        if (password.value.length < 8) {
            feedback += "Password must be 8 characters long\n";
            valid = false;
        }

        if (!/\d/.test(password.value)) {
            feedback += "Password must contain a number\n";
            valid = false;
        }

        if (password.value !== verifyPassword.value) {
            feedback += "Password and 'Verify Password' do not match\n";
            valid = false;
        }

        document.getElementById("feedback").innerText = feedback;
        submitButton.disabled = !valid;
    }

    password.oninput = validate;
    verifyPassword.oninput = validate;
}