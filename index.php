<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk & Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Manajemen Produk & Transaksi</h2>
    
    <!-- Button untuk Tambah Produk -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Tambah Produk
    </button>

    <!-- Button untuk Tambah Transaksi -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#transaksiModal">
        Tambah Transaksi
    </button>

    <!-- Tabel Data Produk -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM produk";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['id_produk']; ?></td>
                <td><?php echo $row['nama_produk']; ?></td>
                <td><?php echo $row['stok_produk']; ?></td>
                <td><?php echo $row['harga_produk']; ?></td>
                <td><?php echo $row['keterangan']; ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id_produk']; ?>">Edit</button>
                    <a href="index.php?delete=<?php echo $row['id_produk']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>

            <!-- Modal Edit Produk -->
            <div class="modal fade" id="editModal<?php echo $row['id_produk']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="index.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_produk" value="<?php echo $row['id_produk']; ?>">
                                <div class="mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="nama_produk" value="<?php echo $row['nama_produk']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stok_produk" class="form-label">Stok Produk</label>
                                    <input type="number" class="form-control" name="stok_produk" value="<?php echo $row['stok_produk']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga_produk" class="form-label">Harga Produk</label>
                                    <input type="number" class="form-control" name="harga_produk" value="<?php echo $row['harga_produk']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" required><?php echo $row['keterangan']; ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="index.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok_produk" class="form-label">Stok Produk</label>
                        <input type="number" class="form-control" name="stok_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_produk" class="form-label">Harga Produk</label>
                        <input type="number" class="form-control" name="harga_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Transaksi -->
<div class="modal fade" id="transaksiModal" tabindex="-1" aria-labelledby="transaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="index.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaksiModalLabel">Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_produk" class="form-label">Pilih Produk</label>
                        <select class="form-control" name="id_produk" required>
                            <?php
                            $sql = "SELECT * FROM produk";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['id_produk']."'>".$row['nama_produk']." - Rp. ".$row['harga_produk']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                        <input type="date" class="form-control" name="tanggal_transaksi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" name="transaksi" class="btn btn-success">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h3>Data Transaksi</h3>

    <!-- Tabel Data Transaksi -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT t.id_transaksi, p.nama_produk, t.jumlah, t.harga, t.total_harga, t.tanggal_transaksi 
                    FROM transaksi t
                    JOIN produk p ON t.id_produk = p.id_produk";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['id_transaksi']; ?></td>
                <td><?php echo $row['nama_produk']; ?></td>
                <td><?php echo $row['jumlah']; ?></td>
                <td><?php echo $row['harga']; ?></td>
                <td><?php echo $row['total_harga']; ?></td>
                <td><?php echo $row['tanggal_transaksi']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
// Proses Tambah Data
if (isset($_POST['save'])) {
    $nama_produk = $_POST['nama_produk'];
    $stok_produk = $_POST['stok_produk'];
    $harga_produk = $_POST['harga_produk'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO produk (nama_produk, stok_produk, harga_produk, keterangan) VALUES ('$nama_produk', '$stok_produk', '$harga_produk', '$keterangan')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}

// Proses Edit Data
if (isset($_POST['update'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $stok_produk = $_POST['stok_produk'];
    $harga_produk = $_POST['harga_produk'];
    $keterangan = $_POST['keterangan'];

    $sql = "UPDATE produk SET nama_produk='$nama_produk', stok_produk='$stok_produk', harga_produk='$harga_produk', keterangan='$keterangan' WHERE id_produk='$id_produk'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}

// Proses Hapus Data
// Proses Hapus Data
if (isset($_GET['delete'])) {
    $id_produk = $_GET['delete'];

    // Pastikan tidak ada transaksi yang terkait dengan produk ini
    $sql_check_transaksi = "SELECT COUNT(*) AS count FROM transaksi WHERE id_produk='$id_produk'";
    $result_check_transaksi = $conn->query($sql_check_transaksi);
    $row_check_transaksi = $result_check_transaksi->fetch_assoc();

    if ($row_check_transaksi['count'] > 0) {
        echo "<script>alert('Tidak dapat menghapus produk karena terkait dengan transaksi!'); window.location='index.php';</script>";
    } else {
        $sql = "DELETE FROM produk WHERE id_produk='$id_produk'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    }
}


// Proses Tambah Transaksi
if (isset($_POST['transaksi'])) {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];

    // Ambil harga produk berdasarkan ID
    $sql_produk = "SELECT harga_produk, stok_produk FROM produk WHERE id_produk='$id_produk'";
    $result_produk = $conn->query($sql_produk);
    $produk = $result_produk->fetch_assoc();
    $harga = $produk['harga_produk'];
    $total_harga = $harga * $jumlah;

    // Kurangi stok produk
    if ($jumlah <= $produk['stok_produk']) {
        $stok_baru = $produk['stok_produk'] - $jumlah;
        $sql_update_stok = "UPDATE produk SET stok_produk='$stok_baru' WHERE id_produk='$id_produk'";
        $conn->query($sql_update_stok);

        // Simpan transaksi ke database
        $sql_transaksi = "INSERT INTO transaksi (id_produk, jumlah, harga, total_harga, tanggal_transaksi) VALUES ('$id_produk', '$jumlah', '$harga', '$total_harga', '$tanggal_transaksi')";
        if ($conn->query($sql_transaksi) === TRUE) {
            echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error: " . $sql_transaksi . "<br>" . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Stok produk tidak mencukupi!');</script>";
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
