<?php $title = "Gider Analizi";?>
<?php include('header.php')?>
<?php include('../code/DbQuerries.php')?>
<?php include('../code/CheckAuthorized.php')?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div class="container mt-5">
    <form action="" method="POST">
        <div class="row">
            <div class="col">
                <select class="form-select" name="year" id="yearSelect">
                    <option value="" disabled selected>Yıllar</option>
                    <?php
                        $years = selectYears("gider");
                        foreach($years as $year) {
                            echo "<option value='{$year}'>" . $year . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
    </form>
</div>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">.... Yılı Aylık Giderler</h5>
            <canvas id="grafikGiderler" style="width:100%;"></canvas>
        </div>
    </div>
</div>

<script>
    async function fetchGiderDataByMonth(year) {
        const response = await fetch(`../code/GetGiderDataByMonth.php?year=${year}`);
        const data = await response.json();
        return data;
    }

    async function drawGiderCharts(year) {
        const giderData = await fetchGiderDataByMonth(year);

        const months = Object.keys(giderData);
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

    
    document.getElementById('yearSelect').addEventListener('change', function() {
        var selectedYear = this.value;
        drawGiderCharts(selectedYear);
    });
</script>

<?php include('footer.php')?>