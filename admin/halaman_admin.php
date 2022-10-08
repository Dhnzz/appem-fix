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
        if (curr_hour < 12) {
            greet = "Selamat Pagi,&nbsp";
        } else if (curr_hour >= 12 && curr_hour < 15) {
            greet = "Selamat Siang,&nbsp";
        } else if (curr_hour >= 15 && curr_hour < 18) {
            greet = "Selamat Sore,&nbsp";
        } else if (curr_hour >= 18) {
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

$queryPengaduan = mysqli_query($conn, "SELECT * FROM pengaduan");
$queryPengaduan1 = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 'selesai'");
$queryPengaduan2 = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 'proses'");
$queryPengaduan3 = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = '0'");
$queryMasyarakat = mysqli_query($conn, "SELECT * FROM masyarakat");
$queryPetugas = mysqli_query($conn, "SELECT * FROM petugas");
$hitungPengaduan = mysqli_num_rows($queryPengaduan);
$hitungTanggapan = mysqli_num_rows($queryPengaduan1);
$hitungTanggapanProses = mysqli_num_rows($queryPengaduan2);
$hitungTanggapanBelum = mysqli_num_rows($queryPengaduan3);
$hitungMasyarakat = mysqli_num_rows($queryMasyarakat);
$hitungPetugas = mysqli_num_rows($queryPetugas);


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

		case 'tanggapan':
		include'tanggapan.php';
		break;

		case 'lihat_petugas':
		include 'lihat_petugas.php';
		break;

		case 'tambah_Petugas':
		include 'tambah_petugas.php';
		break;

		case 'edit_petugas':
		include 'edit_petugas.php';
		break;

		case 'lihat_masyarakat':
		include 'lihat_masyarakat.php';
		break;

		case 'lihat_laporan':
		include 'lihat_laporan.php';
		break;

		case 'lihat_tanggapan':
		include 'lihat_tanggapan.php';
		break;

		case 'detail_tanggapan':
		include 'detail_tanggapan.php';
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
        <div class="card text-white bg-danger mb-3" style="max-width: 22rem;">
            <div class="card-body">
                <h5 class="card-title">Jumlah Total Pengaduan</h5>
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
        <div class="card text-white bg-danger mb-3" style="max-width: 22rem;">
            <div class="card-body">
                <h5 class="card-title">Belum Ditanggapi</h5>
                <div class="row mr-auto mt-4">
                    <div class="col-3">
                        <h1 class="fa fa-eye-slash" aria-hidden="true"></h1>
                    </div>
                    <div class="col-3 mb-3">
                        <h1 class="card-text"><?= $hitungTanggapanBelum ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card text-white bg-danger mb-3" style="max-width: 22rem;">
            <div class="card-body">
                <h5 class="card-title">Sedang Diproses</h5>
                <div class="row mr-auto mt-4">
                    <div class="col-3">
                        <h1 class="fa fa-eye" aria-hidden="true"></h1>
                    </div>
                    <div class="col-3 mb-3">
                        <h1 class="card-text"><?= $hitungTanggapanProses ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card text-white bg-danger mb-3" style="max-width: 22rem;">
            <div class="card-body">
                <h5 class="card-title">Pengaduan Ditanggapi</h5>
                <div class="row mr-auto mt-4">
                    <div class="col-3">
                        <h1 class="fa fa-check-square" aria-hidden="true"></h1>
                    </div>
                    <div class="col-3 mb-3">
                        <h1 class="card-text"><?= $hitungTanggapan ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h4 class="mt-5">
    <b>Data</b>
</h5>
<hr>

<div class="row mt-3">
    <div class="col-sm-3">
        <div class="card text-white bg-danger mb-3" style="max-width: 22rem;">
            <div class="card-body">
                <h5 class="card-title">Data Masyarakat</h5>
                <div class="row mr-auto mt-4">
                    <div class="col-3">
                        <h1 class="fas fa-users"></h1>
                    </div>
                    <div class="col-3 mb-3">
                        <h1 class="card-text"><?= $hitungMasyarakat ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card text-white bg-danger mb-3" style="max-width: 22rem;">
            <div class="card-body">
                <h5 class="card-title">Data Petugas</h5>
                <div class="row mr-auto mt-4">
                    <div class="col-3">
                        <h1 class="fas fa-users-cog" aria-hidden="true"></h1>
                    </div>
                    <div class="col-3 mb-3">
                        <h1 class="card-text"><?= $hitungPetugas ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h4 class="mt-5 mb-1">
    <b>Menu Admin</b>
</h5>
<hr>

<div
    class="d-flex mt-3 justify-content-start align-items-center"
    style="height: 24vh;;">
    <div class="mr-3">
        <a href="?url=verifikasi_pengaduan" class="btn btn-lg btn-primary text-light">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Lihat Aduan</a>
    </div>
    <div class="mr-3">
        <div class="dropdown">
            <button
                class="btn btn-info btn-lg dropdown-toggle"
                type="button"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                Data Pengguna
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="?url=lihat_masyarakat">Data Masyarakat</a>
                <a class="dropdown-item" href="?url=lihat_petugas">Data Petugas</a>
            </div>
        </div>
    </div>
    <div class="mr-3">
        <a href="../logout.php" class="btn btn-lg btn-danger">
            <i class="fa fa-power-off " aria-hidden="true"></i>
            Keluar</a>
    </div>
</div>

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