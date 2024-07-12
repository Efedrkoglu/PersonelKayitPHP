<?php include('header.php')?>
<?php include('../code/DbQuerries.php')?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div class="container mt-5">
    <form action="">
        <div class="row">
            <div class="col">
                <select class="form-select" name="year">
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
    const months = ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"];
    const gelirler = [3, 5, 3, 1, 4, 6, 7, 3, 8, 4, 6, 9];

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
</script>

<?php include('footer.php')?>