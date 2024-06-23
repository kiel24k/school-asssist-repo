<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
</head>

<style>
    * {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    body {
        font-family: Helvetica;
        -webkit-font-smoothing: antialiased;
        background: rgba(71, 147, 227, 1);
    }

    h2 {
        text-align: center;
        font-size: 18px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
        padding: 30px 0;
    }

    /* Table Styles */

    .table-wrapper {
        margin: 10px 70px 70px;
        box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
    }

    .fl-table {
        border-radius: 5px;
        font-size: 12px;
        font-weight: normal;
        border: none;
        border-collapse: collapse;
        width: 100%;
        max-width: 100%;
        white-space: nowrap;
        background-color: white;
    }

    .fl-table td,
    .fl-table th {
        text-align: center;
        padding: 8px;
    }

    .fl-table td {
        border-right: 1px solid #f8f8f8;
        font-size: 12px;
    }

    .fl-table thead th {
        color: #ffffff;
        background: #4FC3A1;
    }


    .fl-table thead th:nth-child(odd) {
        color: #ffffff;
        background: #324960;
    }

    .fl-table tr:nth-child(even) {
        background: #F8F8F8;
    }

    /* Responsive */

    @media (max-width: 767px) {
        .fl-table {
            display: block;
            width: 100%;
        }

        .table-wrapper:before {
            content: "Scroll horizontally >";
            display: block;
            text-align: right;
            font-size: 11px;
            color: white;
            padding: 0 0 10px;
        }

        .fl-table thead,
        .fl-table tbody,
        .fl-table thead th {
            display: block;
        }

        .fl-table thead th:last-child {
            border-bottom: none;
        }

        .fl-table thead {
            float: left;
        }

        .fl-table tbody {
            width: auto;
            position: relative;
            overflow-x: auto;
        }

        .fl-table td,
        .fl-table th {
            padding: 20px .625em .625em .625em;
            height: 60px;
            vertical-align: middle;
            box-sizing: border-box;
            overflow-x: hidden;
            overflow-y: auto;
            width: 120px;
            font-size: 13px;
            text-overflow: ellipsis;
        }

        .fl-table thead th {
            text-align: left;
            border-bottom: 1px solid #f7f7f9;
        }

        .fl-table tbody tr {
            display: table-cell;
        }

        .fl-table tbody tr:nth-child(odd) {
            background: none;
        }

        .fl-table tr:nth-child(even) {
            background: transparent;
        }

        .fl-table tr td:nth-child(odd) {
            background: #F8F8F8;
            border-right: 1px solid #E6E4E4;
        }

        .fl-table tr td:nth-child(even) {
            border-right: 1px solid #E6E4E4;
        }

        .fl-table tbody td {
            display: block;
            text-align: center;
        }
    }
</style>

<body>


    <?php
    if (session()->getFlashdata('status')) {
        echo '<div style="background-color: green;height:4rem;max-width:100%;position:sticky;top:0;text-align:center;display:grid;align-items:center;color:white;font-weight:bolder;">' . session()->getFlashdata('status') . "</div>";
    }
    ?>

    <main>


        <h2>Create, Read, Update and Delete</h2>
        <div class="table-wrapper">
            <a href="<?= base_url('/create_view') ?>">
                <button style="background:green;color:white;padding:10px;cursor:pointer;border:0;border-radius:10px;">Create</button>
            </a>

            <table class="fl-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date Changes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) : ?>
                        <tr>
                            <td>
                                <img src="/uploads/<?= $row['image'] ?>" width="50px" height="50px" alt="">
                            </td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['description'] ?></td>
                            <td><?= $row['created_at'] ?></td>
                            <td>
                                <a href="<?= base_url('update_view/' . $row['id']) ?>">
                                    <button style="padding:10px;background-color:skyblue;border-radius:10px;border:0;color:white;cursor:pointer;">Update</button>
                                </a>
                                <a href="<?= base_url('download/' . $row['image']) ?>">
                                    <button style="padding:10px;background-color:green;border-radius:10px;border:0;color:white;cursor:pointer;">Download</button>
                                </a>
                                <a href="<?= base_url('delete/' . $row['id']) ?>">
                                    <button style="padding:10px;background-color:red;border-radius:10px;border:0;color:white;cursor:pointer;">Delete</button>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach ?>
                <tbody>
            </table>
        </div>

    </main>
</body>

</html>