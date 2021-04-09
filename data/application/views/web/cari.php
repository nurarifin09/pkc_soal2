<?php
$this->load->view("web/partials/header.php");
$this->load->view("web/partials/sidebar.php");
$this->load->view("web/partials/navbar.php");
?>

<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Statistik Karyawan</h6>
                    <div class="row">
                        <div class="col-xl-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Data Berdasarkan Jenis Kelamin</h6>
                                    <div id="apexPie"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Data Berdasarkan Jabatan</h6>
                                    <div id="apexBar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view("web/partials/footer.php");
?>