// console.log(document.querySelector('.email'));
//_____________________all___________________________//
// const backgroundColor = 'rgb(246, 221, 221)';
noRuExp = eval(noRuExp);
console.log(noRuExp);
// __________________fname_lname_____________________//
// const minNum = 2;
// const maxNum = 12;
// const errName = `Количество символов не может быть менее ${minNum} и более ${maxNum}`;
// const regExpName = /[a-z0-9]+/i;
regExpName = eval(regExpName);
console.log(regExpName);
// const errRegExpName = 'Некорректный ввод!';
//____________________login__________________________//
// const minLogin = 4;
// const maxLogin = 12;
// const regExpLogin = /[a-z0-9]+/i;
regExpLogin = eval(regExpLogin);
// const errRegExpLogin = 'Такой логин невозможно использовать!';
// const errLogin = `Количество символов не может быть менее ${minLogin} и более ${maxLogin}`;
//_______________________email______________________//
// const minEmail = 6; // минимум символов
// const maxEmail = 128; // максимум символов
// const errEmail = `Количество символов не может быть менее ${minEmail} и более ${maxEmail}`;
// const regExpEmail = /\S+@\S+\.\S+/g;
// const regExpEmail = /[a-z0-9]+@[a-z0-9]+\.[a-z0-9]+/i;
regExpEmail = eval(regExpEmail);
// const errRegExpEmail = 'Адрес электронной почты введен в неверном формате!';
//_________________________password________________//
// const minPassword = 8; // минимум символов
// const maxPassword = 128; // максимум символов
// const errPassword = `Количество символов не может быть менее ${minPassword} и более ${maxPassword}`;

let fname = document.querySelector('#fname');
fname.addEventListener('blur', function () {
    let inputUserFnameText = fname.value.trim();
    let inputUserFnameNum = inputUserFnameText.length;
    let fnameE = document.querySelector('#fname-e');
    const result = inputUserFnameText.match(regExpName);
    if (inputUserFnameNum < minNum || inputUserFnameNum > maxNum) {
        fname.style.background = backgroundColor;
        fnameE.textContent = errName;
        return false
    } else if (result === null) {
        fnameE.textContent = errRegExpName;
        fname.style.background = backgroundColor;
        return false
    } else {
        fname.style.background = '';
        fnameE.textContent = '';
    }
})

let lname = document.querySelector('#lname');
lname.addEventListener('blur', function () {
    let inputUserLnameText = lname.value.trim();
    let inputUserLnameNum = inputUserLnameText.length;
    let lnameE = document.querySelector('#lname-e');
    const result = inputUserLnameText.match(regExpName);
    if (inputUserLnameNum < minNum || inputUserLnameNum > maxNum) {
        lname.style.background = backgroundColor;
        lnameE.textContent = errName;
        return false
    } else if (result === null) {
        lnameE.textContent = errRegExpName;
        lname.style.background = backgroundColor;
        return false
    } else {
        lname.style.background = '';
        lnameE.textContent = '';
    }
})

let login = document.querySelector('#lgn');
login.addEventListener('blur', function () {
    let inputUserLoginText = login.value.trim();
    let inputUserLoginNum = inputUserLoginText.length;
    let loginE = document.querySelector('#login-e');
    const result = inputUserLoginText.match(regExpLogin);

    // let str = inputUserLoginText;
    // let ru = /[а-яё]+/gi.test(inputUserLoginText);
    // let en = /[a-z]+/gi.test(str);
    // console.log('ru ',ru); console.log('en ',en);
    // if (!(ru ^ en)) {
    //     console.log("Используйте или кириллицу, или латиницу!");
    // } else {
    //     console.log("Всё ок!");
    // }

    if (inputUserLoginNum < minLogin || inputUserLoginNum > maxLogin) {
        loginE.textContent = errLogin;
        login.style.background = backgroundColor;
        return false
    } else if (result === null) {
        loginE.textContent = errRegExpName;
        login.style.background = backgroundColor;
        return false
    } else if (noRuExp.test(inputUserLoginText)) {
        loginE.textContent = errRegExpName;
        login.style.background = backgroundColor;
        return false
    } else {
        login.style.background = '';
        loginE.textContent = '';
    }
})

let email = document.querySelector('#email');
email.addEventListener('blur', function () {
    let inputUserEmailText = email.value.trim();
    let inputUserEmailNum = inputUserEmailText.length;
    let emailE = document.querySelector('#email-e');
    const result = inputUserEmailText.match(regExpEmail);
    if (inputUserEmailNum < minEmail || inputUserEmailNum > maxEmail) {
        emailE.textContent = errEmail;
        email.style.background = backgroundColor;
        return false
    } else if (result === null) {
        emailE.textContent = errRegExpEmail;
        email.style.background = backgroundColor;
        return false
    } else if (noRuExp.test(inputUserEmailText)) {
        emailE.textContent = errRegExpEmail;
        email.style.background = backgroundColor;
        return false
    } else {
        email.style.background = '';
        emailE.textContent = '';
    }
})

let password = document.querySelector('#password');
password.addEventListener('blur', function () {
    let inputUserPasswordNum = password.value.trim().length;
    let passwordE = document.querySelector('#password-e');
    if (inputUserPasswordNum < minPassword || inputUserPasswordNum > maxPassword) {
        passwordE.textContent = errPassword;
        password.style.background = backgroundColor;
        return false
    } else {
        password.style.background = '';
        passwordE.textContent = '';
    }
})
// let password = document.querySelector('#password');
// password.addEventListener('blur', function () {
//     let inputUserPasswordNum = password.value.trim().length;
//     let passwordE = document.querySelector('#password-e');
//     if (inputUserPasswordNum < minPassword || inputUserPasswordNum > maxPassword) {
//         passwordE.textContent = errPassword;
//         password.style.background = backgroundColor;
//         return false
//     } else {
//         password.style.background = '';
//         passwordE.textContent = '';
//     }
// })
