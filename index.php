<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF - 8">
    <meta http-equiv="X-UA-Compatible" content="IE = edge">
    <meta name="viewport" content="width =device-width, initial-scale = 1.0">
    <title> Hotel Website Design </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css ">


    <link rel="stylesheet" href="style.css">
    <style>
        .gallery_heading {
            text-align: center;
            font-size: 40px;
            color: var(--orange);
            ;
        }

        .end_content {
            text-align: center;
            margin-bottom: 40px;
        }
    </style>
</head>

<body>


    <header>

        <div id="menu-bar" class="fas fa-bars"></div>

        <a href="#" class="logo"><span>V</span>ISIT<span> C</span>ORNER</a>
        <nav class="navbar">
            <a href="#home"> Home</a>
            <a href="#book"> Book</a>
            <a href="#packages"> Packages</a>
            <a href="#services"> Services</a>
            <a href="#gallery"> Gallery</a>
            <a href="#review"> Review</a>
            <a href="#contact"> Contact</a>
        </nav>

        <div class="icons">
            <i class="fas fa-search" id="search-btn"></i>
            <i class="fas fa-user" id="login-btn"></i>
            <?php if (isset($_SESSION['user'])) { ?>
                <span style="color: white; font-size: 16px;"> <?= $_SESSION['user']['email'] ?> </span>
            <?php } else { ?>
                <span></span>
            <?php } ?>

        </div>
        <?php if (isset($_SESSION['user'])) { ?>
            <button class="btn" onclick="logOut();">LogOut</button>
        <?php } ?>


        <form action="" class="search-bar-container">
            <input type="search" id="search-bar" placeholder="SEARCH HERE...">
            <label for="search-bar" class="fas fa-search"></label>
        </form>
    </header>





    <div class="login-form-container">

        <i class="fas fa-times" id="form-close"></i>
        <form action="">
            <h3>login</h3>
            <label for="userType">select user type: <select id="userType">
                    <option value="0" class='check'> Select...</option>
                    <option value="1"> User</option>
                    <option value="2"> Hotel</option>
                </select>
            </label>

            <input type="text" id="email" class="box" placeholder="Enter your email">
            <input type="password" id="password" class="box" placeholder="Enter your password">
            <input type="button" onclick="userLogin();" value="login now" class='btn'>
            <input type="checkbox" id="remember">
            <label for="remember">Remember me</label>
            <p>forgot password? <a href="#">click here</a></p>
            <p>don't have an account?<a href="#register">register now</a></p>
        </form>
    </div>

    <div class="register-form-container">

        <i class="fas fa-times" id="register-form-close"></i>
        <form action="">
            <h3>Registration</h3>
            <input type="text" class="box" id="email_rg" placeholder="Enter your email">
            <input type="password" class="box" id="password1_rg" onkeyup="checkPassword()" placeholder="Enter your password">
            <input type="password" class="box" id="password2_rg" onkeyup="checkPassword()" placeholder="Confirm your password">
            <span id="msgBox" style="color: red; font-size: 16px;"></span><br>
            <input type="button" value="register" onclick="userRegistration()" class='btn'>
        </form>
    </div>



    <!--home section starts-->
    <section class="home" id="home">
        <div class="image-container">
            <img id="homeImage" src="assets/images/Image1.jpg" alt="Hotel Image">
            <div class="container">
                <h3>welcome to A global icon of luxury</h3>
                <p>The tables are set, and we're ready to impress</p>
                <a href="#packages" class="btn">discover more</a>
            </div>
        </div>




    </section>
    <!--home section ends-->

    <!--booking section starts-->
    <section class="book" id="book">
        <h1 class="heading">
            <span>b</span>
            <span>o</span>
            <span>o</span>
            <span>k</span>
            <span class="space"></span>
            <span>n</span>
            <span>o</span>
            <span>w</span>
        </h1>

        <div class="row">
            <div class="img">
                <img src="assets/images/booking forum image.jpg" alt="">
            </div>
            <div class="booking-form-container" id="bookingFormContainer">
                <h2>Booking Form</h2>
                <form id="bookingForm">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <?php if (isset($_SESSION['user'])) { ?>
                            <input type="email" id="email1" name="email" value="<?= $_SESSION['user']['email'] ?>" required>
                        <?php } else { ?>
                            <input type="email" id="email1" name="email" required>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="contactNo">Contact No:</label>
                        <input type="tel" id="contactNo" name="contactNo" required>
                    </div>
                    <div class="form-group">
                        <label for="guests">Number of Guests:</label>
                        <input type="number" id="guests" name="guests" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="days">Number of Days:</label>
                        <input type="number" id="days" name="days" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="hotel">Hotel Name:</label>
                        <select id="hotel" name="hotel" onchange="loadPackage()">
                            <option value="0">Select</option>
                            <?php
                            $rs_hotel = Database::search("SELECT * FROM hotel");
                            while ($h_data = $rs_hotel->fetch_assoc()) {
                            ?>
                                <option value="<?= $h_data['id'] ?>"><?= $h_data['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="package">Package Name:</label>
                        <select id="package" name="package" disabled>
                            <option value="0">Select</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethod">Payment Method:</label>
                        <select id="paymentMethod" name="paymentMethod" required>
                            <option value="0">Select Payment Method</option>
                            <?php
                            $rs_payment = Database::search("SELECT * FROM payment");
                            while ($p_data = $rs_payment->fetch_assoc()) {
                            ?>
                                <option value="<?= $p_data['id'] ?>"><?= $p_data['method'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="button" class="btn" onclick="bookingSubmit()">Submit</button>
                </form>
            </div>





    </section>


    <!--booking section ends-->

    <!--packing section starts-->

    <section class="packages" id="packages">
        <h1 class="heading">
            <span>p</span>
            <span>a</span>
            <span>c</span>
            <span>k</span>
            <span>a</span>
            <span>g</span>
            <span>e</span>
            <span>s</span>


        </h1>

        <div class="box-container">
            <div class="box">

                <?php
                $result = Database::search("SELECT * FROM hotel");
                while ($data = $result->fetch_assoc()) {

                ?>
                    <img src="<?= $data['main_img'] ?>" alt="">
                    <div class="content">
                        <h3><i class="fas fa-map-marker-alt"></i> <?= $data['location'] ?></h3>
                        <p><?= $data['name'] ?></p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>

                        <?php
                        $result1 = Database::search("SELECT * FROM package WHERE hotel_id='" . $data['id'] . "'");
                        ?>
                        <button class="btn" onclick="toggleDescription('<?= $data['id'] ?>')">Show packages</button>

                        <div id="descriptionBox<?= $data['id'] ?>" class="description">

                            <div class="price">
                                <?php
                                while ($data1 = $result1->fetch_assoc()) {
                                ?>
                                    <p><?= $data1['package'] ?> - <?= $data1['details'] ?></p>Rs <?= $data1['price'] ?>.00 <span>Rs <?= ($data1['price'] + ($data1['price'] * (5 / 100))) ?>.00</span>
                                <?php } ?>
                            </div>

                            <a href="#book" class="btn" onclick="bookNow('<?= $data['id'] ?>')">book now</a>
                        </div>
                        <?php ?>

                    </div>
                <?php } ?>

            </div>
        </div>


    </section>
    <!--packaging section ends-->

    <!--service section starts-->
    <section class="services" id="services">
        <h1 class="heading">
            <span>s</span>
            <span>e</span>
            <span>r</span>
            <span>v</span>
            <span>i</span>
            <span>c</span>
            <span>e</span>
            <span>s</span>
        </h1>

        <div class="box-container">
            <div class="box">
                <i class="fas fa-hotel"></i>
                <h3>affordable hotels</h3>
                <p>The charming boutique hotels give the best experience with modern amenities, WiFi facilities and a
                    great food court. Book now and experience comfort without compromise!
                </p>
            </div>

            <div class="box">
                <i class="fas fa-utensils"></i>
                <h3>food and drinks</h3>
                <p>At our hotels, every meal is an opportunity to delight your senses and create unforgettable memories.
                    Join us and embark on this adventure..! </p>
            </div>
            <div class="box">
                <i class="fas fa-bullhorn"></i>
                <h3>safety guide</h3>
                <p>We always prioritize your safety. A responsible usage will offer a secure and enjoyable travel
                    experience. If you have any concerns, please don't hesitate to reach out to our support team for
                    assistance. </p>
            </div>

        </div>
    </section>
    <!--service section ends-->

    <!--gallery section starts-->
    <section class="gallery" id="gallery">
        <h1 class="heading">
            <span>g</span>
            <span>a</span>
            <span>l</span>
            <span>l</span>
            <span>e</span>
            <span>r</span>
            <span>y</span>
        </h1>


        <div class="box-container">
            <?php

            $result = Database::search('SELECT * FROM hotel');
            while ($data = $result->fetch_assoc()) {
                $result1 = Database::search("SELECT * FROM gallery WHERE hotel_id='" . $data['id'] . "'")
            ?>
                <h2 class="gallery_heading"><?= $data['name'] ?></h2>

                <?php while ($data1 = $result1->fetch_assoc()) { ?>
                    <div class="box">
                        <img src="<?= $data1['path'] ?>" alt="">
                    </div>
                <?php } ?>
                <div class="content end_content">
                    <button class="btn">Load More</button>
                </div>
            <?php } ?>

        </div>
    </section>
    <!--gallery section ends-->

    <!--review section starts-->


    <section class="review" id="review">
        <h1 class="heading">
            <span>r</span>
            <span>e</span>
            <span>v</span>
            <span>i</span>
            <span>e</span>
            <span>w</span>

        </h1>

        <div class="review-slider">

            <div class="box">
                <img src="assets/images/review1.jpg" alt="">
                <h3>Otara Gumewardana</h3>
                <p>From the welcoming staff to thoughtful amenities for families, our stay was stress free and highly
                    recommended.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>


            <div class="box">
                <img src="assets/images/review2.jpg" alt="">
                <h3>Ramani Fernando</h3>
                <p>I was blown away from the great experience. Wishing all of you the best..!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>


            <div class="box">
                <img src="assets/images/review3.jpg" alt="">
                <h3>Ishara Nanayakkara</h3>
                <p>From the moment we arrived to the moment we left, their attention to detail and friendly demeanour
                    made us truly pampered.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>


            <div class="box">
                <img src="assets/images/review4.jpg" alt="">
                <h3>Asha De Vos</h3>
                <p>Wish you all the best for an advanced future in hotel industry. It is a best experience to visit
                    there.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>


            </div>
        </div>
    </section>
    <!--review section ends-->

    <!--contain section starts-->
    <section class="contact" id="contact">
        <h1 class="heading">
            <span>c</span>
            <span>o</span>
            <span>n</span>
            <span>t</span>
            <span>a</span>
            <span>c</span>
            <span>t</span>
        </h1>
        <div class="row">
            <div class="img">
                <img src="assets/images/contact.png" alt="">
            </div>
            <form action="">
                <div class="inputBox">
                    <input type="text" placeholder="name">
                    <input type="email" placeholder="email">
                </div>
                <div class="inputBox">
                    <input type="number" placeholder="number">
                    <input type="text" placeholder="subject">
                </div>
                <textarea placeholder="message" name="" cols="30" rows="10"></textarea>
                <input type="submit" class="btn" value="send message">
            </form>
        </div>
    </section>
    <!--contain section ends-->

    <!--brand container section starts-->
    <sectiona class="brand -container">
        <div class="swiper mySwiper brand-slider">
            <div class="swiper-wrapper wrapper">
                <div class="swiper-slide"><img src="assets/images/brd3.jpg" alt=""></div>
                <div class="swiper-slide"><img src="assets/images/brd1.jpg" alt=""></div>
                <div class="swiper-slide"><img src="img/3.jpg" alt=""></div>
                <div class="swiper-slide"><img src="img/4.jpg" alt=""></div>
                <div class="swiper-slide"><img src="img/5.jpg" alt=""></div>
                <div class="swiper-slide"><img src="img/6.jpg" alt=""></div>
            </div>
        </div>
        </section>
        <!--brand container section ends-->

        <!--footer container section starts-->

        <section class="footer">
            <div class="box-container">
                <div class="box">
                    <h3>about us</h3>
                    <p>With a legacy of 2 years in the hospitality industry, we pride ourselves on delivering
                        exceptional service and unforgettable experiences to our guests.
                        We strive to exceed guest expectations by offering exceptional amenities, high-class dining, and
                        attentive service.
                    </p>
                </div>
                <div class="box">
                    <h3>hotel locations</h3>
                    <a href="#packages">Colombo 05</a>
                    <a href="#packages">Moratuwa</a>
                    <a href="#packages">Colombo 12</a>
                    <a href="#packages">Mount Lavinia</a>
                    <a href="#packages">Colombo 07</a>
                </div>
                <div class="box">
                    <h3>quick links</h3>
                    <a href="#home"> Home</a>
                    <a href="#book"> Book</a>
                    <a href="#packages"> Packages</a>
                    <a href="#services"> Services</a>
                    <a href="#gallery"> Gallery</a>
                    <a href="#review"> Review</a>
                    <a href="#contact"> Contact us</a>
                </div>
                <div class="box">
                    <h3>follow us</h3>
                    <a href="#">facebook</a>
                    <a href="#">instagram</a>
                    <a href="#">twitter</a>
                    <a href="#">linkedin</a>
                </div>
            </div>
            <h1 class="credit"> created by <span>TTdesigning</span> | all rights reserved !! </h1>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script src="script.js"></script>

</body>
</head>

</html>