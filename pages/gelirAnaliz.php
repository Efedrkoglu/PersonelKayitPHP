<?php $title = "Gelir Analizi";?>
<?php include('header.php')?>
<?php include('../code/DbQuerries.php')?>
<?php include('../code/CheckAuthorized.php')?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div class="container mt-5">
    <form action="">
        <div class="row">
            <div class="col">
                <select class="form-select" name="year" id="yearSelect">
                    <option value="" disabled selected>Yıllar</option>
                    <?php
                        $years = selectYears("gelir");
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
            <h5 class="card-title">.... Yılı Aylık Gelirler</h5>
            <canvas id="grafikGelirler" style="width:100%;"></canvas>
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

    
    document.getElementById('yearSelect').addEventListener('change', function() {
        var selectedYear = this.value;
        drawGelirCharts(selectedYear);
    });
</script>

<?php include('footer.php')?>