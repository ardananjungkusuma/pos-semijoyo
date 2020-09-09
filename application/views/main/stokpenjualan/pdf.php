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
        <h3>Data Stok Penjualan</h3><br>
        <table>
            <thead style="background-color:dimgray;color:white">
                <tr>
                    <th class="short">No</th>
                    <th class="normal">Nama Stok</th>
                    <th class="normal">Harga Stok</th>
                    <th class="normal">Satuan Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($stok as $s) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $s['nama_stok'] ?></td>
                        <td><?= number_format($s['harga_stok'], 0, ',', '.') ?></td>
                        <td><?= $s['satuan_stok'] ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </center>
</body>

</html>