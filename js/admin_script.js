// console.log('Hello');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = ()=>{
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = ()=>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}

window.onscroll = ()=>{
    navbar.classList.remove('active');
    profile.classList.remove('active');
}


let subImg = document.querySelectorAll('.update-product .image-container .sub-images img');
let mainImg = document.querySelector('.update-product .image-container .main-image img');
subImg.forEach(image =>{
    image.onclick = ()=>{
        let src = image.getAttribute('src');
        mainImg.src = src;
    }
});