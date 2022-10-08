<script type="text/javascript">
    function showTime() {
        var a_p = "";
        var greet = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
            a_p = "AM";
        } else {
            a_p = "PM";
        }
        if(curr_hour < 12){
            greet = "Selamat Pagi,&nbsp";
        }else if(curr_hour >= 12 && curr_hour < 15){
            greet = "Selamat Siang,&nbsp";
        }else if(curr_hour >= 15 && curr_hour < 18){
            greet = "Selamat Sore,&nbsp";
        }else if(curr_hour >= 18){
            greet = "Selamat Malam,&nbsp";
        }
        if (curr_hour == 0) {
            curr_hour = 12;
        }
        if (curr_hour > 12) {
            curr_hour = curr_hour - 12;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document
            .getElementById('time')
            .innerHTML = " " + curr_hour + ":" + curr_minute + ":" + curr_second + a_p;
        document
            .getElementById('greet')
            .innerHTML = greet;
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);
</script>
<?php

require "../koneksi.php";
$sql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = '0'");
$sql2 = mysqli_query($conn, "SELECT * FROM masyarakat");
$hitungPengaduan = mysqli_num_rows($sql);
$hitungMasyarakat = mysqli_num_rows($sql2);

if (isset($_GET['url']))
{
	$url=$_GET['url'];

	switch($url)
	{
		

		case 'verifikasi_pengaduan':
		include 'verifikasi_pengaduan.php';
		break;
		
		case 'detail_pengaduan':
		include 'detail_pengaduan.php';
		break;


	}
}
else
{
	?>

        <div class="d-flex">
            <div class="d-flex align-items-center ml-0 bg-danger px-2 rounded text-light">
                <i class="fas fa-calendar-alt pr-2"></i>
                <div id="date"></div>
            </div>
            <div class="d-flex align-items-center ml-2 bg-danger px-2 rounded text-light">
                <i class="fas fa-clock pr-2"></i>
                <div id="time"></div>
            </div>
        </div>
        <h3>
            <div class="d-flex mt-3">
                <div id="greet"></div>
                <?php echo $_SESSION['nama']; ?>
            </div>
        </h3>

        <h4 class="mt-5">
            <b>Informasi Pengaduan</b>
        </h5>
        <hr>

        <div class="row mt-3">
            <div class="col-sm-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Pengaduan</h5>
                        <div class="row mr-auto mt-4">
                            <div class="col-3">
                                <h1 class="fas fa-file-export"></h1>
                            </div>
                            <div class="col-3 mb-3">
                                <h1 class="card-text"><?= $hitungPengaduan ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Masyarakat</h5>
                        <div class="row mr-auto mt-4">
                            <div class="col-3">
                                <h1 class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <div class="col-3 mb-3">
                                <h1 class="card-text"><?= $hitungMasyarakat ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-5">
            <b>Menu Petugas</b>
        </h5>
        <hr>

        <div class="row mt-3" style="height: 24vh;">
            <div class="col-sm-2">
                <a href="?url=verifikasi_pengaduan" class="btn btn-lg btn-info">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    Verifikasi Pengaduan</a>
            </div>
            <div class="col-sm-1">
                <a href="../logout.php" class="btn btn-lg btn-danger">
                    <i class="fa fa-power-off " aria-hidden="true"></i>
                    Keluar</a>
            </div>
        </div>

        <br>
        <br>
        <script>
            var months = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];
            var date = new Date();
            var weekday = new Array(7);
            weekday[0] = "Minggu";
            weekday[1] = "Senin";
            weekday[2] = "Selasa";
            weekday[3] = "Rabu";
            weekday[4] = "Kamis";
            weekday[5] = "Jum'at";
            weekday[6] = "Sabtu";

            var nowadays = weekday[date.getDay()];
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();

            document
                .getElementById("date")
                .innerHTML = " " + nowadays + ", " + day + " " + months[month] + " " + year;
        </script>
        <?php
 }
?>