<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Edit Data Kategori
<?= $this->endSection() ?>

<?= $this->section('subJudul') ?>
<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('" . site_url('kategori/index') . "')"
]) ?>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>

<?= form_open('kategori/update', '', [
    'id' => $kategori['katid']
]) ?>
<div class="form-group">
    <label for="namaKategori">Nama Kategori</label>
    <?= form_input('namakategori', $kategori['katnama'], [
        'class' => 'form-control',
        'id' => 'namakategori',
        'autofocus' => 'true',
        'placeholder' => 'masukkan nama kategori'
    ]) ?>

    <?= session()->getFlashdata('errorNamaKategori') ?>

</div>

<div class="form-group">
    <?= form_submit('', 'Simpan', [
        'class' => 'btn btn-success'
    ]) ?>
</div>

<?= form_close() ?>

<?= $this->endSection() ?>