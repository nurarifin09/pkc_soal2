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
                    <h6 class="card-title">Cari Karyawan</h6>
                    <?= form_open(); ?>
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" name="nama" type="text" placeholder="Search by Nama, No Badge atau Nama Anggota Keluarga" value="<?= ($this->input->post('nama') != NULL) ? $this->input->post('nama') : ''; ?>" required>
                        </div>
                        <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-primary btn-icon-text">
                                <i class="btn-icon-prepend" data-feather="search"></i>
                                Search
                            </button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php $no = 0;
        if (isset($karyawan) && $karyawan != NULL) {
            foreach ($karyawan as $k) {
                if ($no == 3) { ?>
    </div>
    <div class="row">
    <?php }
    ?>

    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a><?= $k['NAMA']; ?></a>
                <p class="text-muted"><?= $k['NO_BADGE']; ?></p>
                <p class="text-success"><?= $k['UNIT_KERJA']; ?></p>
            </div>
        </div>
    </div>
<?php $no++;
            }
        } ?>
    </div>

    <?php
    $this->load->view("web/partials/footer.php");
    ?>