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

<script src="<?= base_url(); ?>assets/vendors/apexcharts/apexcharts.min.js"></script>
<script>
    var piechart = {
        chart: {
            height: 300,
            type: "pie"
        },
        colors: ["#f77eb9", "#7ee5e5"],
        legend: {
            position: 'top',
            horizontalAlign: 'center'
        },
        stroke: {
            colors: ['rgba(0,0,0,0)']
        },
        labels: ['Laki-laki', 'Perempuan'],
        series: [<?= $lakilaki; ?>, <?= $perempuan; ?>]
    };
    var chart = new ApexCharts(document.querySelector("#apexPie"), piechart);
    chart.render();

    var barchart = {
        chart: {
            type: 'bar',
            height: '320',
            parentHeightOffset: 0
        },
        colors: ["#f77eb9"],
        grid: {
            borderColor: "rgba(77, 138, 240, .1)",
            padding: {
                bottom: -15
            }
        },
        series: [{
            name: 'Jumlah',
            data: [<?= $jumlahjabatan; ?>]
        }],
        xaxis: {
            type: 'text',
            categories: [<?= $namajabatan; ?>]
        }
    }
    var apexBarChart = new ApexCharts(document.querySelector("#apexBar"), barchart);
    apexBarChart.render();
</script>

<?php
$this->load->view("web/partials/footer.php");
?>