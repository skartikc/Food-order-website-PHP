    <!-- Navbar Section Starts Here -->
    <section class="navbar-s-r">
        <div class="container-1-r">
            <div class="logo-s">
            <a href="../resto/index-r.php" title="Logo">
                    <img src="../../static/images/icons/sitelogo.jpg" alt="Restaurant Logo" class="img-logo-r">
            </a>
            </div>    
            <div class='logo-txt respon-nav'>
                <h1 id='logo-txt-real-r'>BitesBank</h1>
            </div>
            <div class="menu text-center respon-nav">
                <ul>
                    <li class='r-li'>
                        <a  class="a-r" href="../resto/index-r.php">Dashboard</a>
                    </li>
                    <li class='r-li'>
                        <a  class="a-r" href="../resto/order-r.php">Orders</a>
                    </li>
                    <li class='r-li'>
                        <a  class="a-r" href="#">Your Account</a>
                        <ul> 
                        <?php
                            if(isset($_SESSION['logstat']))
                            {
                                echo '<li class="dd-menu-r"><a  href="../resto/profile-r.php">Edit Profile</a></li>';
                                echo '<li class="dd-menu-r"><a  href="../resto/menu-r.php">Edit Menu</a></li>';
                                echo '<li class="dd-menu-r"><a  href="../logout.php">Logout</a></li>';
                            }
                        ?>
                        </ul>
                    </li>
                    <li class='r-li'>
                    <?php
                        if(isset($_SESSION['logstat']))
                            echo '<a  class="a-r" href="../resto/support-r.php">Help & Support</a>';
                        else
                            echo '<a  class="a-r" href="../login.php">Help & Support</a>';
                    ?>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
        <hr>
    </section>
    <!-- Navbar Section Ends Here -->