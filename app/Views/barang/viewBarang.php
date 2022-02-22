<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Manajement Data Barang
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<?= form_open('/barang/index') ?>
<div class="input-group mb-3" style="width: 45%;">
    <input type="text" class="form-control" placeholder="Cari berdasarkan nama, kategori atau satuan..." aria-describedby="basic-addon2" name="keyword" value="<?= session()->getFlashdata('keyword') ?>">
    <button class="input-group-text" id="basic-addon2" type="submit" name="submit"><i class="fa fa-search"></i></button>
</div>
<?= form_close() ?>
<?= session()->getFlashdata('success') ?>

<table class="table table-striped table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Stok</th>
            <th style="width: 15%;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1 + (($pageCount - 1) * 5);
        foreach ($barang as $brg) :
        ?>
            <tr>
                <td>#<?= $nomor++ ?></td>
                <td><?= $brg['brgkode'] ?></td>
                <td><?= $brg['brgnama'] ?></td>
                <td><?= $brg['katnama'] ?></td>
                <td><?= $brg['satnama'] ?></td>
                <td><?= $brg['brgharga'] ?></td>
                <td><?= $brg['brggambar'] ?></td>
                <td><?= $brg['brgstok'] ?></td>
                <td>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="float-center">
    <?= $pager->links('barang', 'mypager') ?>
</div>
<script>
    function edit(id) {
        window.location = '/kategori/formEdit/' + id;
    }

    function hapus() {
        let pesan = confirm('Yakin menghapus?');

        if (pesan) {
            return true;
        } else {
            return false;
        }
    }
</script>
<?= $this->endSection() ?>

<?= $this->section('subJudul') ?>
<?= form_button('', '<i class="fa fa-plus-circle"></i> Tambah Barang', [
    'class' => 'btn btn-info',
    'onclick' => "location.href=('" . site_url('barang/tambah') . "')"
]) ?>
<?= $this->endSection() ?>