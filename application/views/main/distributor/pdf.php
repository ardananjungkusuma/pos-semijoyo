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
        <h3>Data Distributor</h3><br>
        <table>
            <thead style="background-color:dimgray;color:white">
                <tr>
                    <th class="short">No</th>
                    <th class="normal">Nama</th>
                    <th class="normal">No Telpon</th>
                    <th class="normal">Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($distributor as $d) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $d['nama_distributor']; ?></td>
                        <td><?= $d['no_telpon']; ?></td>
                        <td><?= $d['alamat']; ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </center>
</body>

</html>