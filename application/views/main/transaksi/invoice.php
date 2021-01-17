<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota <?= $transaksi->id_transaksi ?></title>
    <link href="<?= base_url() ?>assets/css/invoice.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div id="invoice">
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <a target="_blank" href="">
                                <img src="<?= base_url() ?>assets/img/gambar_pos/sj.jpg" width="150px" data-holder-rendered="true" />
                            </a>
                        </div>
                        <div class="col company-details">
                            <h2 class="name">
                                Semi Joyo
                            </h2>
                            <div>Sersan Kusman, Banjarjo</div>
                            <div>(123) 456-789</div>
                            <div>semijoyo@gmail.com</div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-details">
                            <h1 class="invoice-id"><?= $transaksi->id_transaksi ?></h1>
                            <div class="date">Tanggal Transaksi: <?= date("d-m-Y", strtotime($transaksi->tanggal_transaksi))  ?></div>
                            <div class="date">Jam Transaksi: <?= $transaksi->jam_transaksi ?></div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-left">Barang</th>
                                <th class="text-right">Harga Barang(Satuan)</th>
                                <th class="text-right">Jumlah Barang</th>
                                <th class="text-right">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($transaksidetail as $td) {
                                $no++;
                                $harga_satuan = $td['harga_barang'] / $td['jumlah_barang'];
                            ?>
                                <tr>
                                    <td class="no"><?= $no ?></td>
                                    <td class="text-left">
                                        <h3><?= $td['nama_barang'] ?></h3>
                                    </td>
                                    <td class="unit">Rp. <?= number_format($harga_satuan, 0, ',', '.') ?></td>
                                    <td class="qty"><?= $td['jumlah_barang'] ?></td>
                                    <td class="total">Rp. <?= number_format($td['harga_barang'], 0, ',', '.') ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">TOTAL</td>
                                <td>Rp. <?= number_format($transaksi->total_harga, 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="notices">
                        <div>Perhatian : </div>
                        <div class="notice">
                            <ol>
                                <li>Barang tidak bisa ditukar/dikembalikan kecuali ada perjanjian.</li>
                                <li>Nota ini dibuat otomatis dan valid meski tanpa tanda tangan/stempel.</li>
                            </ol>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(() => {
        window.print();
        window.onunload = refreshParent;

        function refreshParent() {
            window.opener.location.reload();
        }
        window.addEventListener('afterprint', (event) => {
            window.close();
        });
    });
</script>

</html>