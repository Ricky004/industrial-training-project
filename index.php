<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
</head>

<body>
    <main>
        <div id="navbar">
            <h2 id="logo">TechCare</h2>
            <div class="nav-l-1">
                <?php if (isset($_SESSION['technician_id'])): ?>
                    <a href="create-service.html">
                        <button class="req-service-btn">Create a Service</button>
                    </a>
                <?php else: ?>
                    <a href="service-list.php">
                        <button class="req-service-btn">Request a Service</button>
                    </a>
                <?php endif; ?>
                <?php if (isset($_SESSION['technician_id'])): ?>
                    <a href="backend/my_services.php">
                        <button id="categoryButton" class="button-category">My Services</button>
                    </a>
                <?php endif; ?>
                <a href="service-list.php">
                    <li>Browse services</li>
                </a>
                <a href="how-it-works.html">
                    <li>How it works</li>
                </a>
            </div>
            <div class="nav-l-2">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="profile">
                        <img src="images/profile.png" alt="profile picture" class="profile-pic">
                        <div class="profile-badge">
                            <a href="backend/user/profile.php">
                                <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                            </a>
                        </div>
                    </div>
                <?php elseif (isset($_SESSION['technician_id'])): ?>
                    <div class="profile">
                        <img src="images/handyman.png" alt="profile picture" class="profile-pic">
                        <div class="profile-badge">
                            <a href="backend/profile.php">
                                <span><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                                <i class="fa-solid fa-fire"></i>
                            </a>
                        </div>
                    </div>
                <?php elseif (isset($_SESSION['admin_id'])): ?>
                    <div class="profile">
                        <img src="images/handyman.png" alt="profile picture" class="profile-pic">
                        <div class="profile-badge">
                            <a href="backend/admin/profile.php">
                                <span><?php echo htmlspecialchars($_SESSION['admin_name']); ?></span>
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="signup-page.html">
                        <button class="sign-up">Sign up</button>
                    </a>
                    <a href="login-page.html">
                        <button class="log-in">Log in</button>
                    </a>
                    <a href="join-as-a-technician.html">
                        <button class="nav-l2-btn-1">Join as a Technician</button>
                    </a>
                    <a href="backend/admin/register.php">
                        <button class="admin-btn">Admin</button>
                    </a>
                <?php endif; ?>

            </div>
        </div>
        <hr class="nav-hr">

        <div class="bg-top">
            <div>
                <div>
                    <p class="text-1">GET TASK DONE BY</p>
                    <span class="fancy">PROFESSIONALS</span>
                </div>
                <p class="text-2">Expert Help, Just a Click Away.</p>
                <div class="btn-grp-1">
                    <a href="service-list.php">
                        <button class="bg-btn-1">Request a Service</button>
                    </a>
                    <a href="join-as-a-technician.html">
                        <button class="bg-btn-2">Earn money as a Technician</button>
                    </a>
                </div>
                <div class="desc-1">
                    <img src="images/people.png" alt="user">
                    <div>
                        <p>1M+</p>
                        <p>customer</p>
                    </div>
                    <img src="images/verified.png" alt="verified">
                    <div>
                        <p>verified</p>
                        <p>technician</p>
                    </div>
                    <img src="images/star.png" alt="star">
                    <div>
                        <p>4.4</p>
                        <p>star rating</p>
                    </div>
                </div>
            </div>
            <div>
                <img src="images/pit-1.png" class="pit-1" alt="Technician-1">
                <img src="images/pit-2.png" class="pit-2" alt="Technician-2">
            </div>
        </div>

        <h2 class="list-h">Most book services</h2>
        <div class="top-service-list">
            <div>
                <div class="card">
                    <img src="https://img.freepik.com/free-photo/hvac-technician-working-capacitor-part-condensing-unit_155003-20894.jpg?w=1380&t=st=1727861922~exp=1727862522~hmac=3fd8acaa14672bf37e138c04a9e8747f84aef2294c085c7f1b12e6c6756e46ed"
                        alt="">
                </div>
                <div class="card-content">
                    <h4>
                        AC Repair
                    </h4>
                    <p>
                        ₹200
                    </p>
                </div>
            </div>
            <div>
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1625047509168-a7026f36de04?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">
                </div>
                <div class="card-content">
                    <h4>
                        Car Repair
                    </h4>
                    <p>
                        ₹550
                    </p>
                </div>
            </div>
            <div>
                <div class="card">
                    <img src="https://img.freepik.com/free-photo/high-angle-man-working-as-plumber_23-2150746327.jpg?w=1380&t=st=1727863938~exp=1727864538~hmac=7ff972dec37ddae4bf951b912764bcf15a73e119d24be77061ae6b5f6b4302db"
                        alt="">
                </div>
                <div class="card-content">
                    <h4>
                        Washing Machine Repair
                    </h4>
                    <p>
                        ₹390
                    </p>
                </div>
            </div>
            <div>
                <div class="card">
                    <img src="https://img.freepik.com/free-photo/installing-cooker-hood_1098-17808.jpg?w=1380&t=st=1727864125~exp=1727864725~hmac=1a9e5cc0e0871f771a793ba4d166c6988190871e0dfe9adf3616235b2d815a26"
                        alt="">
                </div>
                <div class="card-content">
                    <h4>
                        Chimney Repair
                    </h4>
                    <p>
                        ₹120
                    </p>
                </div>
            </div>
        </div>
        <div class="why-us">
            <img src="images/pit-4.png" alt="">
            <div class="">
                <div class="why-us-chip">why us</div>
                <h2>Our Commitment to Excellence</h2>
                <div class="why-us-p">
                    <p>Our open, positive, proactive approach helps us</p>
                    <p>to find ways to align with your work enviornment with the culture.</p>
                </div>
                <div class="list-2">
                    <div>
                        <i class="fa-solid fa-circle-check"></i>
                        Expert Technicians
                    </div>
                    <div>
                        <i class="fa-solid fa-circle-check"></i>
                        Quick Response Times
                    </div>
                    <div>
                        <i class="fa-solid fa-circle-check"></i>
                        Affordable Rates
                    </div>
                </div>
                <a href="service-list.php">
                    <button>BooK a Service</button>
                </a>
            </div>
        </div>
    </main>
    <footer>
        <div>
            <h2>LOGO.</h2>
            <div class="footer-p">
                <p>Lorem ipsum dolor sit amet, consectetur
                <p>adipisicing elit. Rem nobis officia,</p>
                <p>odit earum adipisci necessitatibus minima ad labore soluta!</p>
            </div>
            <div class="footer-social">
                <p>Follow us on:</p>
                <div>
                    <!-- <img src="images/instagram.png" alt="">
                    <img src="images/facebook.png" alt="">
                    <img src="images/twitter.png" alt=""> -->
                </div>
            </div>
        </div>
        <div class="footer-list">
            <div>
                <li>Home</li>
                <li>Why us</li>
                <li>Deals</li>
            </div>
            <div>
                <li>Service</li>
                <li>Case studies</li>
                <li>Plan</li>
            </div>
            <div>
                <li>Testimonial</li>
                <li>About</li>
                <li>FAQ</li>
            </div>
        </div>
    </footer>
    <script src="/main.js"></script>
</body>

</html>