<?php
    if(!isset($_SESSION['auth'])){
        redirect('../proj-front/login.php','Please Log In First!');
    }
?>
<nav class="navbar navbar-expand-lg bg-white border-bottom border-4 border-danger main-nav" style="min-height: 100px;">
    <div class="container">
        <a class="navbar-brand" href="view-inventory.php"><img class="logo" src="image/logo.png" alt="logo" ></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 h5">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="view-inventory.php">Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="medicine-display.php">Medicines</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="sales-display.php">Sales</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="order-display.php">Orders</a>
                </li>
            </ul>
        <?php
            if(isset($_SESSION['auth'])){
                $user_name = $_SESSION['loggedInUser']['name'];
        ?>
        <ul class="navbar-nav mx-5  mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="material-symbols-rounded" onclick="toggleNavMenu()" style="font-size:2.5rem; cursor: pointer;color: black;">account_circle</span>
                </a>
                <!-- User Profile dropdown menu -->
                <ul class="dropdown-menu mt-3 p-2 profile-down">
                    <li><a class="dropdown-item mt-3" href="#">
                        <div class="user-info">
                            <span class="material-symbols-outlined">account_circle</span>
                            <h3><?= $user_name ?></h3>
                        </div>
                    </a></li>
                    <div class="dropdown-divider"></div>
                    <li>
                        <a class="sub-menu-link px-3" href="edit-profile.php">
                            <span class="material-symbols-outlined" id="icon">person</span>
                            <p>Edit Profile</p>
                            <span>></span>
                        </a>
                    </li>
                    <li>
                        <a class="sub-menu-link px-3" href="view-inventory.php">
                            <span class="material-symbols-outlined" id="icon">inventory_2</span>
                            <p>Dashboard</p>
                            <span>></span>
                        </a>
                    </li>
                    <li>
                        <a class="sub-menu-link px-3" href="transaction.php">
                            <span class="material-symbols-outlined" id="icon">inventory_2</span>
                            <p>View Transaction</p>
                            <span>></span>
                        </a>
                    </li>
                    
                    <li><a class="sub-menu-link px-3" href="../proj-back/logout.php">
                        <span class="material-symbols-outlined" id="icon">logout</span>
                        <p>Log Out</p>
                        <span>></span>
                    </a></li>
                </ul>
            </li>
        </ul>
            
            <?php 
        }else{
            echo '
            <div >
                <h3><a href="login.php">Log IN</a></h3>
            </div>';
            }
    ?>
    </div>
    </div>
</nav>