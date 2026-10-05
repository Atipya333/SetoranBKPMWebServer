<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Server & Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 480px;
        }
        h2 {
            text-align: center;
            color: #1a73e8;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 22px;
            border-bottom: 2px solid #e8f0fe;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 12px 8px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 15px;
        }
        td.label {
            font-weight: 600;
            color: #444;
            width: 40%;
        }
        td.value {
            color: #222;
        }
        .highlight {
            color: #0d6efd;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Informasi Praktikum</h2>
        <table>
            <tr>
                <td class="label">Nama Mahasiswa</td>
                <td class="value">: Gatot Dwi Umi Eka Putra Atipya</td>
            </tr>
            <tr>
                <td class="label">NIM</td>
                <td class="value">: E41250539</td>
            </tr>
            <tr>
                <td class="label">Waktu Server</td>
                <td class="value">: 
                    <span class="highlight">
                        <?php 
                            date_default_timezone_set('Asia/Jakarta');
                            echo date('d F Y, H:i:s T'); 
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label">Versi PHP</td>
                <td class="value">: <?php echo phpversion(); ?></td>
            </tr>
            <tr>
                <td class="label">Sistem Operasi Server</td>
                <td class="value">: <?php echo PHP_OS; ?></td>
            </tr>
        </table>
    </div>

</body>
</html>
