let searchBtn = document.querySelector('#search-btn')
let searchBar = document.querySelector('.search-bar-container');
let formBtn = document.querySelector('#login-btn');
let loginForm = document.querySelector('.login-form-container');
let formClose = document.querySelector('#form-close');
let menu = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');
let changeImageButton = document.getElementById('change-image-btn');
let homeImage = document.getElementById('homeImage');
let registerLink = document.querySelector('a[href="#register"]');
let registerForm = document.querySelector('.register-form-container');
let registerFormClose = document.querySelector('#register-form-close');


window.onscroll = () => {
    searchBtn.classList.remove('fa-times');
    searchBar.classList.remove('active');
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
    loginForm.classList.remove('active');

}

menu.addEventListener('click', () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});

searchBtn.addEventListener('click', () => {
    searchBtn.classList.toggle('fa-times');
    searchBar.classList.toggle('active');
});

formBtn.addEventListener('click', () => {
    loginForm.classList.add('active');
});

formClose.addEventListener('click', () => {
    loginForm.classList.remove('active');
});

document.querySelector('a[href="#register"]').addEventListener('click', () => {

});

registerLink.addEventListener('click', () => {
    loginForm.classList.remove('active');
    registerForm.classList.add('active');
});

registerFormClose.addEventListener('click', () => {
    registerForm.classList.remove('active');
});

document.getElementById('package').addEventListener('change', function () {
    var selectedPackage = this.value;
    var packages = document.querySelectorAll('.package');
    packages.forEach(function (package) {
        package.classList.remove('show-package');
    });
    document.getElementById(selectedPackage).classList.add('show-package');
});
function showPackagesSection() {
    document.getElementById("packageSection").style.display = "block";
    document.getElementById("packageSection").scrollIntoView({ behavior: 'smooth' });
}



var swiper = new Swiper(".review-slider", {
    spaceBetween: 20,
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});

var swiper = new Swiper(".brand-slider", {
    spaceBetween: 20,
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnIneraction: false,
    },
    breakpoints: {
        450: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 4,
        },
        1200: {
            slidesPerView: 5,
        },
    },
});

function showLoginContainer() {
    var userType = document.getElementById("userType").value;
    var loginContainer = document.getElementById("login-form-container");

    if (userType === "user" || userType === "system") {
        loginContainer.style.display = "block";
    } else {
        alert("Please select a user type");
    }
}


document.getElementById("bookingForm").addEventListener("submit", function (event) {
    event.preventDefault();
    alert("Booking submitted!");
});


function toggleDescription(x) {
    var descriptionBox = document.getElementById('descriptionBox' + x);
    if (descriptionBox.style.display === 'none') {
        descriptionBox.style.display = 'block';
    } else {
        descriptionBox.style.display = 'none';
    }
}

function loadPackage() {
    var hotel = document.getElementById('hotel').selectedIndex;
    // alert(hotel)
    if (hotel == 0) {
        document.getElementById('package').setAttribute('disabled', true);
    } else {

        var request = new XMLHttpRequest();
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) {
                var text = request.responseText;
                document.getElementById('package').removeAttribute('disabled');
                document.getElementById('package').innerHTML = text;
            }
        }
        request.open("GET", "loadPackageProcess.php?id=" + hotel, true);
        request.send();
    }
}

function bookNow(id) {
    document.getElementById('hotel').value = id;
    loadPackage();
    scrollToTop();
}


function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function checkPassword() {
    var password1_rg = document.getElementById('password1_rg').value;
    var password2_rg = document.getElementById('password2_rg').value;

    if (password1_rg != password2_rg) {
        document.getElementById('msgBox').innerHTML = "Passwords not match";
    } else {
        document.getElementById('msgBox').innerHTML = "";

    }
}

function userRegistration() {
    var email_rg = document.getElementById('email_rg').value;
    var password1_rg = document.getElementById('password1_rg').value;
    var password2_rg = document.getElementById('password2_rg').value;

    var form = new FormData();
    form.append("email_rg", email_rg);
    form.append("password1_rg", password1_rg);
    form.append("password2_rg", password2_rg);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            alert(text);
            if (text == "Success") {
                registerFormClose.click();
                formBtn.click();
            }
        }
    }
    request.open("POST", "userRegistrationProcess.php", true);
    request.send(form);
}

function userLogin() {

    var userType = document.getElementById('userType').selectedIndex;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var remember = document.getElementById('remember').checked;

    var form = new FormData();
    form.append("email", email);
    form.append("password", password);
    form.append("remember", remember);

    if (userType == 0) {
        alert("Please select system user type");
    } else if (userType == 1) {

        var request = new XMLHttpRequest();
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) {
                var text = request.responseText;
                alert(text);
                if (text == "Success") {
                    window.location.reload();
                }
            }
        }
        request.open("POST", "userLoginProcess.php", true);
        request.send(form);

    } else if (userType == 2) {

        var request = new XMLHttpRequest();
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) {
                var text = request.responseText;
                alert(text);
                if (text == "Success") {
                    window.location.replace('hotelDashboard.php');
                }
            }
        }
        request.open("POST", "hoteLoginProcess.php", true);
        request.send(form);

    }

}

function bookingSubmit() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email1').value;
    var contactNo = document.getElementById('contactNo').value;
    var guests = document.getElementById('guests').value;
    var days = document.getElementById('days').value;
    var hotel = document.getElementById('hotel').selectedIndex;
    var package = document.getElementById('package').value;
    var paymentMethod = document.getElementById('paymentMethod').selectedIndex;

    var form = new FormData();
    form.append("name", name);
    form.append("email", email);
    form.append("contactNo", contactNo);
    form.append("guests", guests);
    form.append("days", days);
    form.append("hotel", hotel);
    form.append("package", package);
    form.append("paymentMethod", paymentMethod);
    // alert(package)
    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            alert(text);
            if (text == "Booking done successfully") {
                window.location.reload();
            }
            if (text == "Please Login First") {
                formBtn.click();
            }

        }
    }
    request.open("POST", "bookingProcess.php", true);
    request.send(form);

}

function logOut() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            alert(text);
            if (text == "Success") {
                window.location.reload();
            }
        }
    }
    request.open("GET", "logOutProcess.php", true);
    request.send();
}

function responseForBooking(id, x) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            alert(text);
            if (text == "Success") {
                window.location.reload();
            }
        }
    }
    request.open("GET", "updateBookingResponseProcess.php?id=" + id + "&status=" + x, true);
    request.send();
}


function hotelLogout() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            alert(text);
            if (text == "Success") {
                window.location.reload();
            }
        }
    }
    request.open("GET", "hotelLogOutProcess.php", true);
    request.send();
}

