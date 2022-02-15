<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Manajement Data Kategori
<?= $this->endSection() ?>

<?= $this->section('isi') ?>

<?= session()->getFlashdata('success') ?>

<table class="table table-striped table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th>Nama Kategori</th>
            <th style="width: 15%;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1;
        foreach ($kategori as $kat) :
        ?>
            <tr>
                <td><?= $nomor ?></td>
                <td><?= $kat['katnama'] ?></td>
                <td>
                    aksi
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>

<?= $this->section('subJudul') ?>

<?= form_button('', '<i class="fa fa-plus-circle"></i> Tambah Kategori', [
    'class' => 'btn btn-info',
    'onclick' => "location.href=('" . site_url('kategori/tambah') . "')"
]) ?>

<?= $this->endSection() ?>