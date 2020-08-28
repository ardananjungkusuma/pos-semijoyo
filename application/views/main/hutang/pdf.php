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
        <h3>Data Utang Piutang</h3><br>
        <table>
            <thead style="background-color:dimgray;color:white">
                <tr>
                    <th class="short">No</th>
                    <th class="normal">Nama</th>
                    <th class="normal">No Telpon</th>
                    <th class="normal">Alamat</th>
                    <th class="normal">Tanggal Hutang</th>
                    <th class="normal">Jumlah Hutang</th>
                    <th class="normal">Status Hutang</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($hutang as $h) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $h['nama_pengutang'] ?></td>
                        <td><?= $h['no_telpon'] ?></td>
                        <td><?= $h['alamat'] ?></td>
                        <td><?= $h['tanggal_hutang'] ?></td>
                        <td><?= number_format($h['jumlah_hutang'], 0, ',', '.') ?></td>
                        <td><?= $h['status'] ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </center>
</body>

</html>