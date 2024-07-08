<?php $title = "Personel Ekle"?>
<?php include 'header.php'?>

<div class="container mt-5">
    <form>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Ad" aria-label="Ad">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Soy Ad" aria-label="Soy Ad">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="inputState" class="form-label">Department</label>
                <select id="inputState" class="form-select">
                    <option>dep1</option>
                    <option>dep2</option>
                    <option>dep3</option>
                    <option>dep3</option>
                </select>
            </div>
            <div class="col">
                <label for="inputState" class="form-label">Unvan</label>
                <select id="inputState" class="form-select">
                    <option>dep1</option>
                    <option>dep2</option>
                    <option>dep3</option>
                    <option>dep3</option>
                </select>
            </div>
            <div class="col">
                <label for="inputState" class="form-label">Cinsiyet</label>
                <select id="inputState" class="form-select">
                    <option>Erkek</option>
                    <option>Kadın</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Proje" aria-label="Proje">
            </div>
            
        </div>
        <div class="row">
            <div class="col">
                <label>Ise giris tarihi</label>
                <input type="date">
            </div>
            <div class="col">
                <label>Dogum tarihi</label>
                <input type="date">
            </div>
        </div>
        <input type="submit" value="Kaydet">
    </form>
</div>

<?php include 'footer.php'?>