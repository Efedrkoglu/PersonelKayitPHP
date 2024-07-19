<?php $title = "Analiz";?>
<?php include('navbar.php')?>
<?php include('../code/DbQuerries.php')?>
<?php include('../code/CheckAuthorized.php')?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div class="container mt-5">
    <form action="">
        <div class="row">
            <div class="col">
                <select class="form-select" name="year" id="yearSelect">
                    <option value="" disabled selected>Yıllar</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
            </div>
        </div>
    </form>
</div>
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-body" style="background-color: rgb(76,175,80); color: white; font-size: 20px;">
                    <h5 class="card-title">Toplam gelir</h5>
                    <div id="toplamGelir"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body" style="background-color: rgb(255,0,0); color: white; font-size: 20px;">
                    <h5 class="card-title">Toplam gider</h5>
                    <div id="toplamGider"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body" id="netKazancCard">
                    <h5 class="card-title">Net Kazanç</h5>
                    <div id="netKazanc"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Aylık Gelirler</h5>
                <canvas id="grafikGelirler" style="width:100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Aylık Giderler</h5>
                <canvas id="grafikGiderler" style="width:100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const monthNames = [
        'Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 
        'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'
    ];
    
    async function fetchGelirDataByMonth(year) {
        const response = await fetch(`../code/GetGelirDataByMonth.php?year=${year}`);
        const data = await response.json();
        return data;
    }

    async function fetchGiderDataByMonth(year) {
        const response = await fetch(`../code/GetGiderDataByMonth.php?year=${year}`);
        const data = await response.json();
        return data;
    }

    async function fetchGelirDataBySelectedYear(year) {
        const response = await fetch(`../code/GetGelirDataBySelectedYear.php?year=${year}`);
        const data = await response.json();
        return data;
    }

    async function fetchGiderDataBySelectedYear(year) {
        const response = await fetch(`../code/GetGiderDataBySelectedYear.php?year=${year}`);
        const data = await response.json();
        return data;
    }

    async function drawGelirCharts(year) {
        const gelirData = await fetchGelirDataByMonth(year);

        const months = Object.keys(gelirData).map(month => monthNames[parseInt(month) - 1]);
        const gelirler = Object.values(gelirData).map(value => parseFloat(value));

        const grafikGelirler = document.getElementById("grafikGelirler").getContext("2d");
        new Chart(grafikGelirler, {
            type: "line",
            data: {
                labels: months,
                datasets: [{
                    label: 'Gelirler',
                    borderColor: "rgba(76, 175, 80, 0.5)",
                    pointBorderColor: "rgba(76, 175, 80, 1)",
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

    async function drawGiderCharts(year) {
        const giderData = await fetchGiderDataByMonth(year);

        const months = Object.keys(giderData).map(month => monthNames[parseInt(month) - 1]);
        const giderler = Object.values(giderData).map(value => parseFloat(value));

        const grafikGiderler = document.getElementById("grafikGiderler").getContext("2d");
        new Chart(grafikGiderler, {
            type: "line",
            data: {
                labels: months,
                datasets: [{
                    label: 'Giderler',
                    borderColor: "rgba(255, 0, 0, 0.5)",
                    pointBorderColor: "rgba(255, 0, 0, 1)",
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

    async function calculateGelirGider(year) {
        const totalGelir = await fetchGelirDataBySelectedYear(year);
        const totalGider = await fetchGiderDataBySelectedYear(year);
          
        const gelir = totalGelir[year] == undefined ? 0 : parseFloat(totalGelir[year]);
        const gider = totalGider[year] == undefined ? 0 : parseFloat(totalGider[year]);
        const netKazanc = gelir - gider;

        document.getElementById('toplamGelir').innerText = gelir.toLocaleString('tr-TR', {style: 'currency', currency: 'TRY'});
        document.getElementById('toplamGider').innerText = gider.toLocaleString('tr-TR', {style: 'currency', currency: 'TRY'});
        document.getElementById('netKazanc').innerText = netKazanc.toLocaleString('tr-TR', {style: 'currency', currency: 'TRY'});
        
        const kazancCardElement = document.getElementById('netKazancCard');
        
        if (netKazanc >= 0) {
            kazancCardElement.style.color = 'white';
            kazancCardElement.style.backgroundColor = 'rgb(76, 175, 80)';
            kazancCardElement.style.fontSize = '20px';
        } 
        else {
            kazancCardElement.style.color = 'white';
            kazancCardElement.style.backgroundColor = 'rgb(255, 0, 0)';
            kazancCardElement.style.fontSize = '20px';
        }
    }

    
    document.getElementById('yearSelect').addEventListener('change', function() {
        var selectedYear = this.value;
        drawGelirCharts(selectedYear);
        drawGiderCharts(selectedYear);
        calculateGelirGider(selectedYear);
    });
</script>

<?php include('footer.php')?>