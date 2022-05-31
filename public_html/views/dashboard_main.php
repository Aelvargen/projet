<?php include('anchors/header.php'); ?>



<div class="sidebar">
    <div class="logo-details">
        <i></i>
        <span class="logo_name">DAMN</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="dashboard.php" class="active">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Tableau de bord</span>
            </a>
        </li>
        <li>
            <a href="dashboardProducts.php">
                <i class='bx bx-box'></i>
                <span class="links_name">Produits enregistrés</span>
            </a>
        </li>
        <li>
            <a href="dashboardAnalytics.php">
                <i class='bx bx-pie-chart-alt-2'></i>
                <span class="links_name">Analyses</span>
            </a>
        </li>
        <li>
            <a href="dashboardData.php">
                <i class='bx bx-coin-stack'></i>
                <span class="links_name">Données</span>
            </a>
        </li>
        <li class="log_out">
            <a href="disconnect.php">
                <i class='bx bx-log-out'></i>
                <span class="links_name">Se déconnecter</span>
            </a>
        </li>
    </ul>
</div>
<section class="home-section">
    <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Tableau de bord</span>
        </div>
        <div class="profile-details">
            <span class="admin_name"><?php echo $username ?></span>
        </div>
    </nav>

    <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Usages totaux</div>
                    <div class="number">xx</div>
                    <div class="indicator">
                        <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Augmentation aujourd'hui</span>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Usages aujourd'hui</div>
                    <div class="number">xx</div>
                    <div class="indicator">
                        <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Augmentation aujourd'hui</span>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Appels d'urgence aujourd'hui</div>
                    <div class="number">xx</div>
                    <div class="indicator">
                        <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Augmentation aujourd'hui</span>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Déambulateurs en service</div>
                    <div class="number">x/n</div>
                    <div class="indicator">
                        <i class='bx bx-down-arrow-alt down'></i>
                        <span class="text">Diminution aujourd'hui</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="sales-boxes">
            <div class="recent-sales box">
                <div class="title">Dernières utilisations</div>
                <div class="sales-details">
                    <ul class="details">
                        <li class="topic">Date</li>
                        <li><a href="#">xx/xx/xxxx</a></li>
                    </ul>
                    <ul class="details">
                        <li class="topic">Déambulateur</li>
                        <li><a href="#">xx</a></li>
                    </ul>
                    <ul class="details">
                        <li class="topic">Appels d'urgence</li>
                        <li><a href="#">xx</a></li>
                    </ul>
                    <ul class="details">
                        <li class="topic">Temps d'utilisation</li>
                        <li><a href="#">xx:xx:xx</a></li>
                    </ul>
                </div>
                <div class="button">
                    <a href="dashboardAnalytics.php">Voir Tout</a>
                </div>
            </div>
            <div class="top-sales box">
                <div class="title">Déambulateurs enregistrés</div>
                <ul class="top-sales-details">
                    <li>
                        <img src="images/walker.png" alt="">
                        <span class="product">xx</span>
                        <span class="price"></span>
                    </li>
                    <!-- À copier/coller pour rajouter des déambulateurs-->
                </ul>
            </div>
        </div>
    </div>
</section>

<script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else
            sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
</script>


<?php include('anchors/footer.php'); ?>