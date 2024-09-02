<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
include 'koneksi.php'; // Pastikan Anda sudah memiliki file koneksi database

if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];
    $sql = "SELECT t.*, p.nama_produk FROM transaksi t
            JOIN produk p ON t.id_produk = p.id_produk
            WHERE t.id_transaksi = '$id_transaksi'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    if ($row) {
        ?>
        <div class="container mt-5">
            <h2>Edit Transaksi</h2>
            <form action="proses.php?action=update&id=<?php echo $id_transaksi; ?>" method="POST">
                <div class="mb-3">
                    <label for="id_produk" class="form-label">Nama Produk</label>
                    <select class="form-control" id="id_produk" name="id_produk" required>
                        <?php
                        $produkSql = "SELECT id_produk, nama_produk FROM produk";
                        $produkResult = $conn->query($produkSql);
                        while ($produkRow = $produkResult->fetch_assoc()) {
                            $selected = $produkRow['id_produk'] == $row['id_produk'] ? 'selected' : '';
                            echo "<option value='{$produkRow['id_produk']}' $selected>{$produkRow['nama_produk']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
        <?php
    } else {
        echo "Data tidak ditemukan!";
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
    // Proses update data
    $id_transaksi = $_GET['id'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $total_harga = $jumlah * $harga;

    $sql = "UPDATE transaksi SET id_produk='$id_produk', jumlah='$jumlah', harga='$harga', total_harga='$total_harga' WHERE id_transaksi='$id_transaksi'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate!";
        header("Location: index.php"); // Redirect kembali ke halaman utama setelah update
    } else {
        echo "Error: " . $conn->error;
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    // Proses delete data
    $id_transaksi = $_GET['id'];
    $sql = "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus!";
        header("Location: index.php"); // Redirect kembali ke halaman utama setelah delete
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Aksi tidak valid!";
}

$conn->close();
?>
