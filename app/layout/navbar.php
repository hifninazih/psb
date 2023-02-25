<?php 

    $p = ''; // variable untuk menentukkan halaman sekarang
    
    if(isset($_GET['p'])) { // memeriksa variable
        if (($_GET['p'] === 'data') || ($_GET['p'] === 'data-info') || ($_GET['p'] === 'data-detail' )) {
            $data = true;
        } elseif ($_GET['p'] === 'akun') {
            $akun = true;
        } elseif ($_GET['p'] === 'status') {
            $status = true;
        }
    } else {
        $beranda = true;
    }
    
?>

<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item <?php echo ($beranda) ? 'active' : '' ?>">
                <a class="nav-link" href="index.php">Beranda</a>
            </li>
            <li class="nav-item <?php echo ($data) ? 'active' : '' ?>">
                <a class="nav-link" href="index.php?p=data">Data Pendaftar</a>
            </li>

            <?php
                if ($_SESSION['jenis_akun'] === 'Pendaftar') {
                
             ?>

                <li class="nav-item <?php echo ($status) ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=status">Status Pendaftaran</a>
                </li>

            <?php 
                } 
            ?>
            
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a class="btn my-2 my-sm-0 mr-2 <?php echo ($akun) ? 'btn-primary' : 'btn-outline-primary' ?>" href="index.php?p=akun" role="button">Akun</a>
            <a class="btn btn-outline-danger my-2 my-sm-0 ml-2" href="logout.php" role="button">Log-out</a>
        </form>
    </div>
</nav>