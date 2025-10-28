<!DOCTYPE html>
<html>
<head>
    <title>Hasil Kompetisi - <?php echo $kompetisi['nama']; ?></title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Hasil Kompetisi</h1>
    <h2><?php echo $kompetisi['nama']; ?></h2>

    <h4>Peringkat Entri Lomba</h4>
    <?php if (!empty($summary)): ?>
        <table>
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Karya</th>
                    <th>Rata-rata Skor</th>
                    <th>Jumlah Juri Menilai</th>
                </tr>
            </thead>
            <tbody>
                <?php $rank = 1; foreach ($summary as $s): ?>
                    <tr>
                        <td><?php echo $rank++; ?></td>
                        <td><?php echo $s['nama_karya']; ?></td>
                        <td><?php echo number_format($s['rata_rata_skor'], 2); ?></td>
                        <td><?php echo $s['jumlah_juri_menilai']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada hasil penilaian untuk kompetisi ini.</p>
    <?php endif; ?>

</body>
</html>
