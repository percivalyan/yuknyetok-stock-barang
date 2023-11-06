<?php
//Menghubungkan ke function.php
require 'function.php';

//Menghubungkan check.php
require 'check.php';
?>
<html>
<head>
 <title id="stock-title">Stock Barang</title>
    <script>
        // Mengambil tanggal hari ini
        var today = new Date();
        var date = today.getDate();
        var month = today.getMonth() + 1;
        var year = today.getFullYear();

        // Mengubah judul sesuai tanggal hari ini
        var title = document.getElementById('stock-title');
        title.innerHTML = "Stock Barang (" + date + "/" + month + "/" + year + ")";
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
    <h2>Stock Barang</h2>
    <h2 id="tanggal">
        <script>
      const tanggalElement = document.getElementById('tanggal');
      const tanggalSekarang = new Date();
      tanggalElement.textContent = `Tanggal: ${tanggalSekarang.toLocaleDateString()}`;
    </script>
    </h2>
    <div class="data-tables datatable-dark">
        <table class="table table-bordered" id="data-table-stockbarang" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock");
                while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                    //$i = 1;
                    $idb = $data['idbarang'];
                    $tanggal = date("Ymd"); // Format tanggal sebagai contoh: 20230528
                    $idbunik = $tanggal . $idb; // Menggabungkan tanggal dan ID barang
                    $namabarang = $data['namabarang'];
                    $deskripsi = $data['deskripsi'];
                    $stock = $data['stock'];
                    $tanggal = $data['tanggal'];
                ?>
                <tr>
                    <td><?= $tanggal; ?></td>
                    <!-- <td><?= $i++; ?></td> -->
                    <td><?php echo $idbunik; ?></td>
                    <td><?php echo $namabarang; ?></td>
                    <td><?php echo $deskripsi; ?></td>
                    <td><?php echo $stock; ?></td>
                </tr>
                <?php
                };
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// $(document).ready(function() {
//     $('#data-table-stockbarang').DataTable( {
//         dom: 'Bfrtip',
//         buttons: [
//             'excel', 'pdf', 'print'
//         ]
//     } );
// } );
    $(document).ready(function() {
    $('#data-table-stockbarang').DataTable( {
        fixedHeader: {
            header: true,
            footer: true
        },
        dom: 'Bfrtip',
          buttons: [
                {
                    extend: 'excel',
                    footer: true // Menampilkan footer pada file Excel
                },
                {
                    extend: 'pdf',
                    footer: true, // Menampilkan footer pada file PDF
                    customize: function(doc) {
                        var now = new Date();
                        var year = now.getFullYear();
                        var footer = {
                            text: '© ' + year + ' stock.u',
                            alignment: 'center',
                            margin: [0, 10]
                        };
                        doc['footer'] = footer;
                    }
                },
                // {
                //     extend: 'print',
                //     footer: true, // Menampilkan footer pada file cetak
                //     customize: function(win) {
                //         $(win.document.body).find('table tfoot tr').append('<td colspan="5" style="text-align: center;">© 2023 stock.u</td>');
                //         $(win.document.body).find('table tfoot tr').css('font-size', '12px');
                //     }
                // }
                // {
                //     extend: 'print',
                //     footer: true, // Menampilkan footer pada file cetak
                //     customize: function(win) {
                //         $(win.document.body).find('table tfoot tr').html('<th colspan="5" style="text-align:center;">© 2023 stock.u</th>');
                //         $(win.document.body).find('table tfoot tr').css('font-size', '12px');
                //     }
                // }
                {
    extend: 'print',
    footer: true, // Menampilkan footer pada file cetak
    customize: function(win) {
        var $footer = $(win.document.body).find('table tfoot tr');
        if ($footer.length === 0) {
            $footer = $('<tfoot>').appendTo($(win.document.body).find('table'));
        }
        $footer.html('<th colspan="5" style="text-align:center;">© 2023 stock.u</th>');
        $footer.css('font-size', '12px');
    }
}

            ]
    } );
    
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

</body>
</html>
