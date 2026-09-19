<?php
require_once 'Tiket.php';
session_start();

// inisialisasi 4 data tiket awal sesuai desain gambar
if (!isset($_SESSION['daftarTiket'])) {
    $_SESSION['daftarTiket'] = [
        new Tiket("T01", "Spider-Man", 2, 50000, "img/TiketSpiderman.png"),
        new Tiket("T02", "Detective Conan", 1, 45000, "img/TiketConan.png"),
        new Tiket("T03", "Operasi Pesta Copet", 4, 35000, "img/TiketCopet.png"),
        new Tiket("T04", "Insidious", 3, 55000, "img/TiketInsidoius.png")
    ];
}

$daftarTiket = &$_SESSION['daftarTiket'];
$pesan = "";
$tipePesan = "sukses";
$menu = $_GET['menu'] ?? 'tampil';

// method cekId
function cekId($id, $daftar) {
    foreach ($daftar as $t) {
        if ($t->getId() === $id) return true;
    }
    return false;
}

// method tambahTiket
function tambahTiket(&$daftar, $id, $nama, $jumlah, $harga, $gambar) {
    if (cekId($id, $daftar)) return false;
    $daftar[] = new Tiket($id, $nama, $jumlah, $harga, $gambar);
    return true;
}

// method updateTiket
function updateTiket(&$daftar, $id, $nama, $jumlah, $harga, $gambar) {
    foreach ($daftar as $t) {
        if ($t->getId() === $id) {
            $t->setNama($nama);
            $t->setJumlah($jumlah);
            $t->setHarga($harga);
            if (!empty($gambar)) $t->setGambar($gambar);
            return true;
        }
    }
    return false;
}

// method hapusTiket
function hapusTiket(&$daftar, $id) {
    foreach ($daftar as $key => $t) {
        if ($t->getId() === $id) {
            unset($daftar[$key]);
            $daftar = array_values($daftar);
            return true;
        }
    }
    return false;
}

// method cariTiket
function cariTiket($daftar, $keyword) {
    $hasil = [];
    $keyword = strtolower(trim($keyword));
    foreach ($daftar as $t) {
        if (str_contains(strtolower($t->getId()), $keyword) || str_contains(strtolower($t->getNama()), $keyword)) {
            $hasil[] = $t;
        }
    }
    return $hasil;
}

// method tampilSemua
function tampilSemua($daftar) {
    return $daftar;
}

// reset data jika diminta
if ($menu === 'reset') {
    unset($_SESSION['daftarTiket']);
    header("Location: Main.php?menu=tampil");
    exit;
}

// proses aksi form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';

    if ($aksi === 'tambah') {
        $id = trim($_POST['id']);
        $nama = trim($_POST['nama']);
        $jumlah = intval($_POST['jumlah']);
        $harga = floatval($_POST['harga']);
        $gambar = trim($_POST['gambar']);

        if (cekId($id, $daftarTiket)) {
            $pesan = "ID Tiket sudah ada ey, ganti!";
            $tipePesan = "error";
        } elseif ($jumlah <= 0) {
            $pesan = "Jumlah tiket tidak boleh kurang dari atau sama dengan 0";
            $tipePesan = "error";
        } elseif ($harga <= 0) {
            $pesan = "Harga tiket tidak boleh kurang dari atau sama dengan 0";
            $tipePesan = "error";
        } else {
            tambahTiket($daftarTiket, $id, $nama, $jumlah, $harga, $gambar);
            $pesan = "Tiket berhasil ditambahkan!";
            $menu = 'tampil';
        }
    } 
    elseif ($aksi === 'update') {
        $id = trim($_POST['id']);
        $nama = trim($_POST['nama']);
        $jumlah = intval($_POST['jumlah']);
        $harga = floatval($_POST['harga']);
        $gambar = trim($_POST['gambar']);

        if (!cekId($id, $daftarTiket)) {
            $pesan = "ID Tiket tidak ditemukan!";
            $tipePesan = "error";
        } elseif ($jumlah <= 0 || $harga <= 0) {
            $pesan = "Jumlah atau harga tidak boleh kurang dari 0!";
            $tipePesan = "error";
        } else {
            updateTiket($daftarTiket, $id, $nama, $jumlah, $harga, $gambar);
            $pesan = "Tiket berhasil diupdate!";
            $menu = 'tampil';
        }
    } 
    elseif ($aksi === 'hapus') {
        $id = trim($_POST['id']);
        if (hapusTiket($daftarTiket, $id)) {
            $pesan = "Tiket berhasil dihapus!";
            $menu = 'tampil';
        } else {
            $pesan = "ID Tiket tidak ditemukan!";
            $tipePesan = "error";
        }
    } 
    elseif ($aksi === 'cek') {
        $id = trim($_POST['id']);
        if (cekId($id, $daftarTiket)) {
            $pesan = "ID '$id' SUDAH ADA di dalam daftar!";
        } else {
            $pesan = "ID '$id' BELUM ADA (Tersedia)!";
            $tipePesan = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Tiket Bioskop - TP1 DPBO</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f0f4f8; color: #222; margin: 20px; }
        h1 { color: #1e3a8a; margin-bottom: 5px; }
        p { color: #555; }
        .menu { margin: 20px 0; }
        .menu a { text-decoration: none; padding: 8px 12px; background-color: #2563eb; color: white; border-radius: 4px; margin: 2px; display: inline-block; font-size: 14px; }
        .menu a:hover { background-color: #1d4ed8; }
        .menu a.reset { background-color: #dc2626; }
        .pesan { margin: 15px auto; padding: 10px; width: 60%; border-radius: 4px; }
        .pesan.sukses { background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .pesan.error { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        table { margin: 20px auto; border-collapse: collapse; width: 85%; background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #cbd5e1; padding: 10px; text-align: center; }
        th { background-color: #1e293b; color: white; }
        tr:nth-child(even) { background-color: #f8fafc; }
        img { width: 100px; height: auto; border: 1px solid #ccc; border-radius: 4px; }
        form { display: inline-block; background-color: white; padding: 20px; border: 1px solid #cbd5e1; border-radius: 6px; text-align: left; width: 350px; margin-top: 10px; }
        label { font-weight: bold; font-size: 13px; }
        input, select { width: 100%; padding: 8px; margin: 5px 0 12px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background-color: #16a34a; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
        button:hover { background-color: #15803d; }
    </style>
</head>
<body>

    <h1>Sistem Penjualan Tiket Bioskop</h1>
    <p>Tugas Praktikum 1 (DPBO) - Versi PHP</p>

    <!-- Menu Navigasi -->
    <div class="menu">
        <a href="Main.php?menu=tampil">1. Tampil Semua</a>
        <a href="Main.php?menu=tambah">2. Tambah Tiket</a>
        <a href="Main.php?menu=update">3. Update Tiket</a>
        <a href="Main.php?menu=hapus">4. Hapus Tiket</a>
        <a href="Main.php?menu=cari">5. Cari Tiket</a>
        <a href="Main.php?menu=cek">6. Cek Tiket</a>
        <a href="Main.php?menu=reset" class="reset">Reset Data</a>
    </div>

    <!-- Notifikasi Pesan -->
    <?php if (!empty($pesan)): ?>
        <div class="pesan <?= $tipePesan ?>"><?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>

    <!-- 1. TAMPIL SEMUA DATA -->
    <?php if ($menu === 'tampil'): ?>
        <h2>Daftar Semua Tiket</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Desain Tiket</th>
                <th>ID Tiket</th>
                <th>Nama Tiket</th>
                <th>Harga</th>
                <th>Jumlah Tiket (Dibeli)</th>
                <th>Total Harga</th>
            </tr>
            <?php 
                $data = tampilSemua($daftarTiket);
                $no = 1;
                $totalBeli = 0;
                $totalHarga = 0;
                foreach ($data as $t): 
                    $subtotal = $t->getJumlah() * $t->getHarga();
                    $totalBeli += $t->getJumlah();
                    $totalHarga += $subtotal;
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><img src="<?= htmlspecialchars($t->getGambar()) ?>" alt="Tiket"></td>
                <td><strong><?= htmlspecialchars($t->getId()) ?></strong></td>
                <td><?= htmlspecialchars($t->getNama()) ?></td>
                <td>Rp <?= number_format($t->getHarga(), 0, ',', '.') ?></td>
                <td><?= $t->getJumlah() ?> tiket</td>
                <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr style="font-weight: bold; background-color: #e2e8f0;">
                <td colspan="5">TOTAL KESELURUHAN</td>
                <td><?= $totalBeli ?> tiket</td>
                <td>Rp <?= number_format($totalHarga, 0, ',', '.') ?></td>
            </tr>
        </table>

    <!-- 2. TAMBAH TIKET -->
    <?php elseif ($menu === 'tambah'): ?>
        <h2>Tambah Tiket</h2>
        <form method="POST">
            <input type="hidden" name="aksi" value="tambah">
            <label>ID Tiket:</label>
            <input type="text" name="id" placeholder="contoh: T05" required>
            <label>Nama Tiket:</label>
            <input type="text" name="nama" placeholder="nama film/tiket" required>
            <label>Jumlah Tiket yang Dibeli:</label>
            <input type="number" name="jumlah" min="1" value="1" required>
            <label>Harga Satuan (Rp):</label>
            <input type="number" name="harga" min="1" value="50000" required>
            <label>Desain Gambar:</label>
            <select name="gambar">
                <option value="img/TiketSpiderman.png">Tiket 1 - Spider-Man</option>
                <option value="img/TiketConan.png">Tiket 2 - Detective Conan</option>
                <option value="img/TiketCopet.png">Tiket 3 - Operasi Pesta Copet</option>
                <option value="img/TiketInsidoius.png">Tiket 4 - Insidious</option>
            </select>
            <button type="submit">Tambah Tiket</button>
        </form>

    <!-- 3. UPDATE TIKET -->
    <?php elseif ($menu === 'update'): ?>
        <h2>Update Tiket</h2>
        <form method="POST">
            <input type="hidden" name="aksi" value="update">
            <label>ID Tiket yang Ingin Diubah:</label>
            <select name="id" required>
                <option value="">-- Pilih ID Tiket --</option>
                <?php foreach ($daftarTiket as $t): ?>
                    <option value="<?= htmlspecialchars($t->getId()) ?>"><?= htmlspecialchars($t->getId()) ?> - <?= htmlspecialchars($t->getNama()) ?></option>
                <?php endforeach; ?>
            </select>
            <label>Nama Tiket Baru:</label>
            <input type="text" name="nama" placeholder="nama baru" required>
            <label>Jumlah Tiket Baru (Dibeli):</label>
            <input type="number" name="jumlah" min="1" value="1" required>
            <label>Harga Satuan Baru (Rp):</label>
            <input type="number" name="harga" min="1" value="50000" required>
            <label>Pilihan Gambar:</label>
            <select name="gambar">
                <option value="img/TiketSpiderman.png">Tiket 1 - Spider-Man</option>
                <option value="img/TiketConan.png">Tiket 2 - Detective Conan</option>
                <option value="img/TiketCopet.png">Tiket 3 - Operasi Pesta Copet</option>
                <option value="img/TiketInsidoius.png">Tiket 4 - Insidious</option>
            </select>
            <button type="submit">Update Tiket</button>
        </form>

    <!-- 4. HAPUS TIKET -->
    <?php elseif ($menu === 'hapus'): ?>
        <h2>Hapus Tiket</h2>
        <form method="POST">
            <input type="hidden" name="aksi" value="hapus">
            <label>Pilih ID Tiket yang Dihapus:</label>
            <select name="id" required>
                <option value="">-- Pilih ID Tiket --</option>
                <?php foreach ($daftarTiket as $t): ?>
                    <option value="<?= htmlspecialchars($t->getId()) ?>"><?= htmlspecialchars($t->getId()) ?> - <?= htmlspecialchars($t->getNama()) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" style="background-color: #dc2626; margin-top: 10px;">Hapus Tiket</button>
        </form>

    <!-- 5. CARI TIKET -->
    <?php elseif ($menu === 'cari'): ?>
        <h2>Cari Tiket</h2>
        <form method="GET">
            <input type="hidden" name="menu" value="cari">
            <label>Masukkan ID atau Nama Tiket:</label>
            <input type="text" name="keyword" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" required>
            <button type="submit">Cari</button>
        </form>

        <?php if (isset($_GET['keyword'])): ?>
            <?php $hasil = cariTiket($daftarTiket, $_GET['keyword']); ?>
            <h3>Hasil Pencarian:</h3>
            <?php if (empty($hasil)): ?>
                <p style="color: red;">Data tidak ditemukan!</p>
            <?php else: ?>
                <table>
                    <tr>
                        <th>Desain</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                    </tr>
                    <?php foreach ($hasil as $t): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($t->getGambar()) ?>" alt="Tiket"></td>
                        <td><?= htmlspecialchars($t->getId()) ?></td>
                        <td><?= htmlspecialchars($t->getNama()) ?></td>
                        <td>Rp <?= number_format($t->getHarga(), 0, ',', '.') ?></td>
                        <td><?= $t->getJumlah() ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        <?php endif; ?>

    <!-- 6. CEK TIKET -->
    <?php elseif ($menu === 'cek'): ?>
        <h2>Cek Tiket (Cek ID)</h2>
        <form method="POST">
            <input type="hidden" name="aksi" value="cek">
            <label>Masukkan ID Tiket yang Dicek:</label>
            <input type="text" name="id" placeholder="contoh: T01" required>
            <button type="submit">Cek ID Tiket</button>
        </form>
    <?php endif; ?>

</body>
</html>
