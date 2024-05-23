const password = document.getElementById("password");
const passwordMessage = document.getElementById("password-message");

var passwordIsValid = false;

const passwordValidation = () => {
    const passwordValue = password.value;
    const hasNumber = /\d/.test(passwordValue);
    const hasLetter = /[a-zA-Z]/.test(passwordValue);

    passwordIsValid = hasNumber && hasLetter;

    if (hasNumber) {
        passwordMessage.children[0].classList.remove("text-red-500");
        passwordMessage.children[0].classList.add("text-green-500");
        passwordMessage.children[0].children[0].src =
            "/images/icons/Check-one.svg";
    } else {
        passwordMessage.children[0].classList.add("text-red-500");
        passwordMessage.children[0].classList.remove("text-green-500");
        passwordMessage.children[0].children[0].src = "/images/icons/Close.svg";
    }
    if (hasLetter) {
        passwordMessage.children[1].classList.remove("text-red-500");
        passwordMessage.children[1].classList.add("text-green-500");
        passwordMessage.children[1].children[0].src =
            "/images/icons/Check-one.svg";
    } else {
        passwordMessage.children[1].classList.add("text-red-500");
        passwordMessage.children[1].classList.remove("text-green-500");
        passwordMessage.children[1].children[0].src = "/images/icons/Close.svg";
    }
};
password.addEventListener("keyup", passwordValidation);
passwordValidation();
