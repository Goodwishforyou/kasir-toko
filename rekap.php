<?php
require 'ceklogin.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="row container">
        <div class="col-md-15 mt-5">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    <h4>Data Transaksi</h4>
                </div>
                <div class="card-body">
                    <form action="" method="get" class="form-inline mb-3">
                        <div class="row">
                            <div class="col">
                                <input type="date" name="tgl_mulai" class="form-control">
                            </div>
                            <div class="col">
                                <input type="date" name="tgl_selesai" class="form-control">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-info">Filter</button>
                            </div>
                        </div>
                    </form>
                    <hr>

                    <div id="div1">
                        <div class="row g-3 align-items-center mb-5">
                            <div class="col-auto">
                                <button class="btn btn-secondary" onclick="printDiv('div1')">
                                    <i class="bi bi-printer-fill"></i> Print Barang Masuk
                                </button>
                            </div>
                            <?php
                            if (isset($_GET['tgl_mulai']) or isset($_GET['tgl_mulai'])) {

                                $mulai = $_GET['tgl_mulai'];
                                $selesai = $_GET['tgl_selesai'];
                                $tampil = $c->query("select * from detailpesanan p, produk pr where p.idproduk=pr.
                                idproduk and idpesanan and p.tgl BETWEEN '$mulai' and '$selesai'");
                            } else {
                                $tampil = $c->query("select * from detailpesanan p, produk pr where p.idproduk=pr.
                            idproduk and idpesanan");
                            }

                            ?>
                        </div>
                        <table class="table table-bordered">
                            <thead class="table-primary text-center">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Produk</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Sub-total</th>
                                </tr>
                            </thead>

                            <?php
                            $get = mysqli_query($c, "select * from detailpesanan p, produk pr where p.idproduk=pr.
                                   idproduk and idpesanan");
                            $i = 1;


                            while ($p = mysqli_fetch_array($tampil)) {
                                $idpr = $p['idproduk'];
                                $tgl = date("Y-m-d H:i:s");
                                $iddp = $p['iddetailpesanan'];
                                $qty = $p['qty'];
                                $harga = $p['harga'];
                                $namaproduk = $p['namaproduk'];
                                $desc = $p['deskripsi'];
                                $subtotal = $qty * $harga;

                            ?>


                                </tbody>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $tgl; ?></td>
                                    <td><?= $namaproduk; ?> (<?= $desc; ?>)</td>
                                    <td>Rp<?= number_format($harga); ?></td>
                                    <td><?= number_format($qty); ?></td>
                                    <td>Rp<?= number_format($subtotal); ?></td>
                                    <td>



                                </tr>
                                </tbody>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printDiv(el) {
            var a = document.body.innerHTML;
            var b = document.getElementById(el).innerHTML;
            document.body.innerHTML = b;
            window.print();
            document.body.innerHTML = a;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>