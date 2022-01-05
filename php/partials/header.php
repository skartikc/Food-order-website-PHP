<!-- Navbar Section Starts Here -->
<section class="navbar-s">
        <div class="container-1">
            <div class="logo-s">
            <a href="../php/index.php" title="Logo">
                    <img src="../static/images/icons/sitelogo.jpg" alt="Restaurant Logo" class="img-logo">
            </a>
            </div>    
            <div class='logo-txt respon-nav'>
                <h1 id='logo-txt-real'>BitesBank</h1>
            </div>
            <div class="log-btn respon-nav">
            <?php if(!isset($_SESSION['logstat']) || $_SESSION['logstat']!=true)
                    {    
                        echo '<a class="a-nav" href="../php/login.php">Login';
                    }
                  else
                    {
                        echo '<a class="a-nav" href="../php/mycart.php">My Cart';
                    }
            ?>
            </a></div>
            <div class="menu text-center respon-nav">
                <ul>
                    <li>
                        <a class = 'a-nav' href="../php/explore.php">Explore</a>
                    </li>
                    <li>
                        <a class = 'a-nav' href="#">Your Account</a>
                        <ul> 
                        <?php
                            if(!isset($_SESSION['logstat']))
                                echo '<li class="dd-menu"><a class="a-nav" href="../php/login.php">Profile</a></li>';
                            else if(!isset($_SESSION['phone']))
                                echo '<li class="dd-menu"><a class="a-nav" href="../php/resto/index-r.php">Profile</a></li>';
                                else
                                    echo '<li class="dd-menu"><a class="a-nav" href="../php/profile.php">Profile</a></li>';
                            if(isset($_SESSION['logstat']))
                                echo '<li class="dd-menu"><a class="a-nav" href="../php/logout.php">Logout</a></li>';
                        ?>
                        </ul>
                    </li>
                    <li>
                    <?php
                        if(isset($_SESSION['logstat']))
                            echo '<a class="a-nav" href="../php/support.php">Help & Support</a>';
                        else
                            echo '<a class="a-nav" href="../php/login.php">Help & Support</a>';
                    ?>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

