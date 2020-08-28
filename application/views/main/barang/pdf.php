<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <center>
        <h3>Data Barang</h3><br>
        <table>
            <thead style="background-color:dimgray;color:white">
                <tr>
                    <th class="short">No</th>
                    <th class="normal">Nama</th>
                    <th class="normal">Nama Distributor</th>
                    <th class="normal">Jumlah Barang</th>
                    <th class="normal">Harga</th>
                    <th class="normal">Tanggal Beli</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($barang as $b) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $b['nama_barang'] ?></td>
                        <td><?= $b['nama_distributor'] ?></td>
                        <td><?= $b['jumlah_barang'] ?></td>
                        <td><?= number_format($b['harga_barang'], 0, ',', '.') ?></td>
                        <td><?= $b['tanggal_beli'] ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </center>
</body>

</html>