<?php
require 'function.php';
require 'check.php';
?>
<html>
<head>
    <title id="stock-title">Barang Masuk</title>
    <script>
        var today = new Date();
        var date = today.getDate();
        var month = today.getMonth() + 1;
        var year = today.getFullYear();

        var title = document.getElementById('stock-title');
        title.innerHTML = "Barang Masuk (" + year + "-" + month + "-" + date + ")";
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<body>
<div class="container">
    <h2>Barang Masuk</h2>
    <h2 id="tanggal"></h2>
    <div class="data-tables datatable-dark">
        <table class="table table-bordered" id="data-table-barangmasuk" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>ID Barang</th>
                    <th>Nama Barang Masuk</th>
                    <th>Jumlah Barang</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM masuk m, stock s WHERE s.idbarang = m.idbarang");
                while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                    $idb = $data['idbarang'];
                    $idm = $data['idmasuk'];
                    $tanggal = $data['tanggal'];
                    $tanggal2 = str_replace('-', '', $data['tanggal']);
                    $idbunik = $tanggal2 . $idb; // Menggabungkan tanggal dan ID barang
                    $namabarang = $data['namabarang'];
                    $qty = $data['qty'];
                    $keterangan = $data['keterangan'];
                    $deskripsi = $data['deskripsi'];
                ?>
                <tr>
                    <td><?= $tanggal; ?></td>
                    <td><?= $idbunik; ?></td>
                    <td><?= $namabarang; ?></td>
                    <td><?= $qty; ?></td>
                    <td><?= $keterangan; ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        const tanggalElement = document.getElementById('tanggal');
        const tanggalSekarang = new Date();
        tanggalElement.textContent = "Tanggal: " + tanggalSekarang.toLocaleDateString();

        $('#data-table-barangmasuk').DataTable({
            fixedHeader: {
                header: true,
                footer: true
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    footer: true
                },
                {
                    extend: 'pdfHtml5',
                    customize: function(doc) {
                        var now = new Date();
                        var year = now.getFullYear();
                        var footer = {
                            text: '© ' + year + ' Yuk Nyetok',
                            alignment: 'center',
                            margin: [0, 10]
                        };
                        doc['footer'] = footer;
                        var table = doc.content[1];
                        table.table.widths = Array(table.table.body[0].length + 1).join('*').split('');
                        table.table.body.forEach(function(row, rowIndex) {
                            row.forEach(function(cell, cellIndex) {
                                cell.alignment = 'center';
                                cell.margin = [0, 5, 0, 5];
                                cell.style = 'tableCell';
                                if (rowIndex === 0) {
                                    cell.fillColor = '#ccc';
                                    cell.bold = true;
                                }
                            });
                        });
                        var rowCount = table.table.body.length;
                        var columnCount = table.table.body[0].length;
                        var lineStyle = {
                            lineWidth: 0.5,
                            lineColor: '#000'
                        };
                        for (var i = 0; i < rowCount; i++) {
                            for (var j = 0; j < columnCount; j++) {
                                var cell = table.table.body[i][j];
                                cell['layout'] = lineStyle;
                            }
                        }
                    }
                }
            ]
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</body>
</html>
