// const handleChange = (isChecked) => {
//     localStorage.setItem('theme', isChecked);
//     theme();
//     // if (isChecked) {
//     //     document.body.setAttribute('dark', '');
//     //     const nav = document.querySelector('nav');
//     //     nav.classList.add('navbar-dark')
//     // } else {
//     //     document.body.removeAttribute('dark');
//     //     const nav = document.querySelector('nav');
//     //     nav.classList.remove('navbar-dark');
//     // }
// }

// theme();

// function theme() {
//     const nav = document.querySelector('nav');

//     if (localStorage.getItem('theme') === 'true') {
//         document.querySelector('#flexSwitchCheckDefault').checked = true;
//         document.body.setAttribute('dark', '');
//         nav.classList.add('navbar-dark')
//     } else {
//         document.body.removeAttribute('dark');
//         nav.classList.remove('navbar-dark');
//     }
// }