<?php $title = "Ana Sayfa"; ?>
<?php include 'header.php'; ?>
<?php include '../code/DbQuerries.php'?>
<?php include('../code/CheckAuthorized.php')?>

<div class="container mt-5">
    
    <div class="row mb-4">
        <div class="col">
            <h4>Hoşgeldiniz <?php echo $_SESSION['username'];?></h4>
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
                            $personels = selectLeavePersonel();

                            foreach($personels as $personel) {
                                echo "<li class='list-group-item'>" . $personel->getAd() . " " . $peronsel->getSoyad() . "</li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a href="../logout.php" class="btn btn-danger btn-sm" style="font-weigth: bold;">Çıkış <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
</div>

<script>
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
</script>

<?php include 'footer.php'; ?>
