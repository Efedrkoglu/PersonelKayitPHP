<?php $title = "Ana Sayfa"; ?>
<?php include 'header.php'; ?>
<?php include '../code/DbQuerries.php'?>
<?php include('../code/CheckAuthorized.php')?>
<?php $personels = selectLeavePersonel();?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div class="container mt-5">
    
    <div class="row mb-4">
        <div class="col">
            <h4>Hoşgeldiniz <?php echo $_SESSION['username'];?></h4>
            <div>
                <a href="../logout.php" class="btn btn-danger btn-sm" style="font-weigth: bold;">Çıkış <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
        <div class="col text-end">
            <div class="datetime-container">
                <div class="date" id="date"></div>
                <div class="time" id="time"></div>
            </div>
        </div>
    </div>

    
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header bg-success text-white">
                    İzin Süreleri
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                            foreach($personels as $personel) {
                                echo "<li class='list-group-item'>" . $personel->getAd() . " " . $personel->getSoyad() . "</li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Yıllara Göre Toplam Gelir</h5>
                    <canvas id="grafikGelirler" style="width:100%;max-width:700px"></canvas>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Yıllara Göre Toplam Gider</h5>
                    <canvas id="grafikGiderler" style="width:100%;max-width:700px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gelirler</h5>
                    <canvas id="grafikGelirler2" style="width:100%;max-width:700px"></canvas>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Giderler</h5>
                    <canvas id="grafikGiderler2" style="width:100%;max-width:700px"></canvas>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script>
    async function fetchGelirDataByYear() {
        const response = await fetch('../code/GetGelirDataByYear.php');
        const data = await response.json();
        return data;
    }

    async function fetchGelirDataByName() {
        const response = await fetch('../code/GetGelirDataByName.php');
        const data = await response.json();
        return data;
    }

    async function fetchGiderDataByYear() {
        const response = await fetch('../code/GetGiderDataByYear.php');
        const data = await response.json();
        return data;
    }

    async function fetchGiderDataByName() {
        const response = await fetch('../code/GetGiderDataByName.php');
        const data = await response.json();
        return data;
    }

    async function drawGelirCharts1() {
        const gelirData = await fetchGelirDataByYear();

        const years = Object.keys(gelirData);
        const gelirler = Object.values(gelirData).map(value => parseFloat(value));

        const grafikGelirler = document.getElementById("grafikGelirler").getContext("2d");
        new Chart(grafikGelirler, {
            type: "line",
            data: {
                labels: years,
                datasets: [{
                    label: 'Gelirler',
                    borderColor: "rgba(0,255,0,0.5)",
                    pointBorderColor: "rgba(0,255,0,1)",
                    fill: false,
                    data: gelirler
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }

    async function drawGiderCharts1() {
        const giderData = await fetchGiderDataByYear();

        const years = Object.keys(giderData);
        const giderler = Object.values(giderData).map(value => parseFloat(value));
        
        const grafikGiderler = document.getElementById("grafikGiderler").getContext("2d");
        new Chart(grafikGiderler, {
            type: "line",
            data: {
                labels: years,
                datasets: [{
                    label: 'Giderler',
                    borderColor: "rgba(255,0,0,0.5)",
                    pointBorderColor: "rgba(255,0,0,1)",
                    fill: false,
                    data: giderler
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }

    async function drawGelirCharts2() {
        const gelirData = await fetchGelirDataByName();

        const names = Object.keys(gelirData);
        const gelirler = Object.values(gelirData).map(value => parseFloat(value));

        const grafikGelirler2 = document.getElementById("grafikGelirler2").getContext("2d");
        new Chart(grafikGelirler2, {
            type: "bar",
            data: {
                labels: names,
                datasets: [{
                    fill: false,
                    data: gelirler,
                    backgroundColor: 'rgba(0,255,0, 0.1)',
                    borderColor: 'rgb(0,255,0)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }

    async function drawGiderCharts2() {
        const giderData = await fetchGiderDataByName();

        const names = Object.keys(giderData);
        const giderler = Object.values(giderData).map(value => parseFloat(value));

        const grafikGiderler2 = document.getElementById("grafikGiderler2").getContext("2d");
        new Chart(grafikGiderler2, {
            type: "bar",
            data: {
                labels: names,
                datasets: [{
                    fill: false,
                    data: giderler,
                    backgroundColor: 'rgba(255,0,0, 0.1)',
                    borderColor: 'rgb(255,0,0)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }


    function updateDateTime() {
        const dateElement = document.getElementById('date');
        const timeElement = document.getElementById('time');

        const now = new Date();
        const options = { timeZone: 'Europe/Istanbul', hour12: false };
        const dateFormatter = new Intl.DateTimeFormat('tr-TR', {
            year: 'numeric', month: 'long', day: '2-digit', ...options
        });
        const timeFormatter = new Intl.DateTimeFormat('tr-TR', {
            hour: '2-digit', minute: '2-digit', second: '2-digit', ...options
        });

        dateElement.innerHTML = dateFormatter.format(now);
        timeElement.innerHTML = timeFormatter.format(now);
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
    drawGelirCharts1();
    drawGiderCharts1();
    drawGelirCharts2();
    drawGiderCharts2();
</script>

<?php include 'footer.php'; ?>
