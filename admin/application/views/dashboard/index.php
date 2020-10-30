<!-- counters -->

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="mdi mdi-chart-areaspline icon-lg text-success"></i>
                        <div class="ml-3">
                            <p class="mb-0">Total Transaction</p>
                            <h6><?= count($transaksi); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="mdi mdi-square-inc-cash icon-lg text-warning"></i>
                        <div class="ml-3">
                            <p class="mb-0">Total Transaction Value</p>
                            <h6><?= $currency['app_currency'] ?>
                                <?= number_format($saldo['total'] / 100, 2, ".", ".") ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
        <div class="col-md-6 col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="mdi mdi-account-multiple icon-lg text-info"></i>
                        <div class="ml-3">
                            <p class="mb-0">Total Users</p>
                            <h6><?= count($user); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="mdi mdi-motorbike icon-lg text-danger"></i>
                        <div class="ml-3">
                            <p class="mb-0">Total Driver</p>
                            <h6><?= count($hitungdriver); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                        <i class="mdi mdi-store icon-lg text-primary"></i>
                        <div class="ml-3">
                            <p class="mb-0">Total Merchant</p>
                            <h6><?= count($mitra); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of counter -->

    <div class="row">
            
            <div class="col-md-6 col-lg-6 grid-margin stretch-card">
            <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Mountly service transaction</h6>
                            <p class="card-description">Services that are creating the most revenue and
                                their sales throughout the year and the variation in behavior of sales.</p>
                            <div id="js-legend2" class="chartjs-legend mt-4 mb-5"></div>
                            <div class="demo-chart">
                                <canvas id="merchantChart"></canvas>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-6 col-lg-6 grid-margin stretch-card">
            <div class="card">
                            <div class="card-body">
                                <br>
                                <h4 class="card-title">Transaction Complete</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-fixed">
                                            <table id="order-list" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Service</th>
                                                        <th>Daily</th>
                                                        <th>Monthly</th>
                                                        <th>Year</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        
                                                        <?php $i = 1;
                                                        foreach ($harian as $hr) { ?>
                                                        <tr>
                                                            <td><?= $i ?></td>
                                                            <td><?= $hr['fitur'] ?></td>
                                                            <td > 
                                                            <label class="badge badge-success"><?= $hr['hari'] ?></label>
                                                            </td>
                                                            <td>
                                                            <label class="badge badge-info"><?= $hr['bulan'] ?></label>
                                                            </td>
                                                            <td>
                                                            <label class="badge badge-danger"><?= $hr['tahun'] ?></label>
                                                            </td>
                                                        </tr>
                                                        <?php $i++;
                                                            } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
          </div>

    <!-- start latest Transaction -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Latest Transaction</h4>
            

            <div class="row">
                <div class="col-12">
                    <?php if ($this->session->flashdata()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('demo'); ?>
                            <?php echo $this->session->flashdata('cancel'); ?>
                            <?php echo $this->session->flashdata('hapus'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Driver</th>
                                    <th>Service</th>
                                    <th>Pick Up</th>
                                    <th>Destination</th>
                                    <th>Price</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($transaksi as $tr) { ?>

                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $tr['fullnama'] ?></td>
                                        <td><?= $tr['nama_driver'] ?></td>
                                        <td><?= $tr['fitur'] ?></td>
                                        <td style="max-width:300px;"><?= $tr['alamat_asal'] ?></td>
                                        <td style="max-width:300px;"><?= $tr['alamat_tujuan'] ?></td>
                                        <td><?= $currency['app_currency'] ?>
                                            <?= number_format($tr['biaya_akhir'] / 100, 2, ".", ".") ?></td>
                                        <td>
                                            <?php if ($tr['pakai_wallet'] == '0') {
                                                echo 'CASH';
                                            } else {
                                                echo 'WALLET';
                                            } ?>
                                        </td>
                                        <td>
                                            <?php if ($tr['status'] == '2') { ?>
                                                <label class="badge badge-primary"><?= $tr['status_transaksi']; ?></label>
                                            <?php } ?>
                                            <?php if ($tr['status'] == '3') { ?>
                                                <label class="badge badge-success"><?= $tr['status_transaksi']; ?></label>
                                            <?php } ?>
                                            <?php if ($tr['status'] == '5') { ?>
                                                <label class="badge badge-danger"><?= $tr['status_transaksi']; ?></label>
                                            <?php } ?>
                                            <?php if ($tr['status'] == '4') { ?>
                                                <label class="badge badge-info"><?= $tr['status_transaksi']; ?></label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url(); ?>dashboard/detail/<?= $tr['id_transaksi']; ?>" class="btn btn-outline-primary">View</a>
                                            <a onclick="return confirm ('Are You Sure?')" href="<?= base_url(); ?>dashboard/delete/<?= $tr['id_transaksi']; ?>" class="btn btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>

    <!-- end of latest transaction -->
</div>

<!-- footer -->
<?php $this->load->view('includes/footer'); ?>

<!-- End custom js for this page-->


<script>

    (function($) {
        'use strict';
        $(function() {
            if ($("#merchantChart").length) {
                var ctx = document
                    .getElementById('merchantChart')
                    .getContext("2d");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [
                            'Jan',
                            'Feb',
                            'Mar',
                            'Apr',
                            'May',
                            'Jun',
                            'Jul',
                            'Aug',
                            'sep',
                            'okt',
                            'nov',
                            'des'
                        ],
                        datasets: [{
                            label: "Passenger Transportation",
                            borderColor: 'rgba(171, 140 ,228, 1)',
                            backgroundColor: 'rgba(171, 140 ,228, 0.3)',
                            pointRadius: 0,
                            fill: true,
                            borderWidth: 3,
                            fill: 'origin',
                            data: [
                                <?= $jan1[0]['jumlah'] ?>,
                                <?= $feb1[0]['jumlah'] ?>,
                                <?= $mar1[0]['jumlah'] ?>,
                                <?= $apr1[0]['jumlah'] ?>,
                                <?= $mei1[0]['jumlah'] ?>,
                                <?= $jun1[0]['jumlah'] ?>,
                                <?= $jul1[0]['jumlah'] ?>,
                                <?= $aug1[0]['jumlah'] ?>,
                                <?= $sep1[0]['jumlah'] ?>,
                                <?= $okt1[0]['jumlah'] ?>,
                                <?= $nov1[0]['jumlah'] ?>,
                                <?= $des1[0]['jumlah'] ?>
                            ]
                        }, {
                            label: "Shipment",
                            borderColor: 'rgba(88, 216 ,163, 1)',
                            backgroundColor: 'rgba(88, 216 ,163, 0.3)',
                            pointRadius: 0,
                            fill: true,
                            borderWidth: 3,
                            fill: 'origin',
                            data: [
                                <?= $jan2[0]['jumlah'] ?>,
                                <?= $feb2[0]['jumlah'] ?>,
                                <?= $mar2[0]['jumlah'] ?>,
                                <?= $apr2[0]['jumlah'] ?>,
                                <?= $mei2[0]['jumlah'] ?>,
                                <?= $jun2[0]['jumlah'] ?>,
                                <?= $jul2[0]['jumlah'] ?>,
                                <?= $aug2[0]['jumlah'] ?>,
                                <?= $sep2[0]['jumlah'] ?>,
                                <?= $okt2[0]['jumlah'] ?>,
                                <?= $nov2[0]['jumlah'] ?>,
                                <?= $des2[0]['jumlah'] ?>
                            ]
                        }, {
                            label: "Rental",
                            borderColor: 'rgba(255, 180 ,99, 1)',
                            backgroundColor: 'rgba(255, 180 ,99, 0.3)',
                            pointRadius: 0,
                            fill: true,
                            borderWidth: 3,
                            fill: 'origin',
                            data: [
                                <?= $jan3[0]['jumlah'] ?>,
                                <?= $feb3[0]['jumlah'] ?>,
                                <?= $mar3[0]['jumlah'] ?>,
                                <?= $apr3[0]['jumlah'] ?>,
                                <?= $mei3[0]['jumlah'] ?>,
                                <?= $jun3[0]['jumlah'] ?>,
                                <?= $jul3[0]['jumlah'] ?>,
                                <?= $aug3[0]['jumlah'] ?>,
                                <?= $sep3[0]['jumlah'] ?>,
                                <?= $okt3[0]['jumlah'] ?>,
                                <?= $nov3[0]['jumlah'] ?>,
                                <?= $des3[0]['jumlah'] ?>
                            ]
                        }, {
                            label: "Purchasing Service",
                            borderColor: 'rgba(255, 0, 0, 1)',
                            backgroundColor: 'rgba(255, 0, 0, 0.3)',
                            pointRadius: 0,
                            fill: true,
                            borderWidth: 3,
                            fill: 'origin',
                            data: [
                                <?= $jan4[0]['jumlah'] ?>,
                                <?= $feb4[0]['jumlah'] ?>,
                                <?= $mar4[0]['jumlah'] ?>,
                                <?= $apr4[0]['jumlah'] ?>,
                                <?= $mei4[0]['jumlah'] ?>,
                                <?= $jun4[0]['jumlah'] ?>,
                                <?= $jul4[0]['jumlah'] ?>,
                                <?= $aug4[0]['jumlah'] ?>,
                                <?= $sep4[0]['jumlah'] ?>,
                                <?= $okt4[0]['jumlah'] ?>,
                                <?= $nov4[0]['jumlah'] ?>,
                                <?= $des4[0]['jumlah'] ?>
                            ]
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false,
                            position: "top"
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    display: true,
                                    beginAtZero: true,
                                    fontColor: 'rgba(0, 0, 0, 1)'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false,
                                    color: 'transparent',
                                    zeroLineColor: '#eeeeee'
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    drawBorder: true,
                                    display: true,
                                    color: '#eeeeee'
                                },
                                categoryPercentage: 0.5,
                                ticks: {
                                    display: true,
                                    beginAtZero: true,
                                    stepSize: 20,
                                    max: 100,
                                    fontColor: 'rgba(0, 0, 0, 1)'
                                }
                            }]
                        }
                    },
                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                });
                document.getElementById('js-legend2').innerHTML = myChart.generateLegend();
            }
        });
    })(jQuery);
</script>