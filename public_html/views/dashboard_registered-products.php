<?php include('anchors/header.php'); ?>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

<div class="sidebar">
    <div class="logo-details">
        <i></i>
        <span class="logo_name">DAMN</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="dashboard.php">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Tableau de bord</span>
            </a>
        </li>
        <li>
            <a href="dashboardProducts.php" class="active">
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
                <div class="title">Déambulateurs enregistrés</div>
                <div class="top-sales box">
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
    </div>
</section>


<style>
    #map {
        height: 1000px;
    }
</style>
<script>
    window.onload = function() {
        const ctx = document.getElementById('pieChartHelpCalls').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    'Sessions sans appel d\'urgence',
                    'Sessions avec appel(s) d\'urgence',
                ],
                datasets: [{
                    data: [300, 50],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                    ],
                    hoverOffset: 4
                }]
            }
        });


        const ctx2 = document.getElementById('lineChartActivity').getContext('2d');
        const myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                /*labels: months({
                    count: 7
                }),*/
                datasets: [{
                    label: 'Ces derniers mois',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        });

        const ctx3 = document.getElementById('barChartActivity').getContext('2d');
        const myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: 'Utilisations mensuelles',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx4 = document.getElementById('doughnutChartHoursOfActivity').getContext('2d');
        const myChart4 = new Chart(ctx4, {
            type: 'doughnut',
            data: {
                labels: [
                    'Appels d\'urgence entre 08h00 et 12h00',
                    'Appels d\'urgence entre 12h00 et 18h00',
                    'Appels d\'urgence entre 18h00 et 00h00',
                    'Appels d\'urgence entre 00h00 et 00h08',
                ],
                datasets: [{
                    label: 'test',
                    data: [300, 50, 100, 20],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 80)',
                        'rgba(75, 192, 192)'
                    ],
                    hoverOffset: 4
                }]
            }
        });

        const ctx5 = document.getElementById('barChartAverageUsetime').getContext('2d');
        const myChart5 = new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: ['Red'],
                datasets: [{
                    label: 'Niveau actuel de batterie',
                    data: [100],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true

                    }
                }
            }
        });



        // barChartAverageUsetime

    }


    var map = L.map('map').setView([49.09820, 6.15969], 17);
    var marker = L.marker([49.09820, 6.15969]).addTo(map);


    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map)


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