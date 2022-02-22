<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Tambah Data barang
<?= $this->endSection() ?>

<?= $this->section('subJudul') ?>
<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('" . site_url('kategori/index') . "')"
]) ?>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>

<?= form_open('barang/save') ?>
<div class="form-group">
    <label for="kode">Kode Barang</label>
    <?= form_input('kode', '', [
        'class' => 'form-control',
        'id' => 'kode',
        'autofocus' => 'true',
        'placeholder' => 'kode barang '
    ]) ?>
    <?= ($validation->getError('kode')) ? '<br><div class="alert alert-danger">' . $this->validation->getError('kode') . '</div>' : '' ?>
</div>
<div class="form-group">
    <label for="nama">Nama Barang</label>
    <?= form_input('nama', '', [
        'class' => 'form-control',
        'id' => 'nama',
        'autofocus' => 'true',
        'placeholder' => 'Nama barang '
    ]) ?>
    <?= (session()->getFlashdata('errorNama')) ? session()->getFlashdata('errorNama') : '' ?>
</div>
<div class="form-group">
    <select name="katid" class="form-control" aria-label="Default select example">
        <!-- <option selected>----- Pilih Kategori -----</option> -->
        <?php foreach ($kategori as $kat) : ?>
            <option value="<?= $kat['katid'] ?>"><?= $kat['katnama'] ?></option>
        <?php endforeach; ?>
    </select>
    <?= (session()->getFlashdata('errorKategori')) ? session()->getFlashdata('errorKategori') : '' ?>
</div>
<div class="form-group">
    <select name="satid" class="form-control" aria-label="Default select example">
        <!-- <option selected>----- Pilih Satuan -----</option> -->
        <?php foreach ($satuan as $sat) : ?>
            <option value="<?= $sat['satid'] ?>"><?= $sat['satnama'] ?></option>
        <?php endforeach; ?>
    </select>
    <?= (session()->getFlashdata('errorSatuan')) ? session()->getFlashdata('errorSatuan') : '' ?>
</div>
<div class="form-group">
    <label for="harga">Harga Barang</label>
    <?= form_input('harga', '', [
        'class' => 'form-control',
        'id' => 'harga',
        'autofocus' => 'true',
        'placeholder' => 'Harga barang '
    ]) ?>
    <?= (session()->getFlashdata('errorHarga')) ? session()->getFlashdata('errorHarga') : '' ?>
</div>
<div class="form-group">
    <label for="stok">Stok Barang</label>
    <?= form_input('stok', (old('stok')) ? old('stok') : '', [
        'class' => 'form-control',
        'id' => 'stok',
        'autofocus' => 'true',
        'placeholder' => 'stok barang '
    ]) ?>
    <?= (session()->getFlashdata('errorStok')) ? session()->getFlashdata('errorStok') : '' ?>
</div>

<div class="form-group">
    <?= form_submit('', 'Simpan', [
        'class' => 'btn btn-success'
    ]) ?>
</div>

<?= form_close() ?>

<?= $this->endSection() ?>