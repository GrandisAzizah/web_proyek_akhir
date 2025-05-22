<?php
require 'functions.php';

$req = query("SELECT * FROM request ORDER BY id_req ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Read Request</title>
</head>

<style>
    table {
        margin: 10px 10 px;
        max-width: 1000px;
    }

    a {
        color: red;
    }
</style>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>RequestID</td>
                <td>Request Data</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($req as $row): ?>
                <tr>
                    <td><?= $row['id_req'] ?></td>
                    <td><?= $row['request_data'] ?></td>
                    <td><a href="hapus_req.php?id_req=<?= $row['id_req'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z" />
                                <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0" />
                            </svg></a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>