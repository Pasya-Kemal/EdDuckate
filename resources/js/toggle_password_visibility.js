function onTogglePasswordVisibility(inputID, buttonIconID) {
    // console.log('inputID:', inputID);
    // console.log('buttonIconID:', buttonIconID);
    const passwordInput = document.getElementById(inputID);
    const toggleIcon = document.getElementById(buttonIconID);
    const show = passwordInput.type === 'password';
    toggleIcon.innerText = show ? 'visibility' : 'visibility_off';
    passwordInput.type = show ? 'text' : 'password';
}
