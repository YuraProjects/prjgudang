<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Manajement Data Kategori
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<?= form_open('/kategori/index') ?>
<div class="input-group mb-3" style="width: 35%;">
    <input type="text" class="form-control" placeholder="Cari kategori..." aria-describedby="basic-addon2" name="keyword" value="<?= session()->getFlashdata('keyword') ?>">
    <button class="input-group-text" id="basic-addon2" type="submit" name="submit"><i class="fa fa-search"></i></button>
</div>
<?= form_close() ?>
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
        $nomor = 1 + (($pageCount - 1) * 5);
        foreach ($kategori as $kat) :
        ?>
            <tr>
                <td>#<?= $nomor++ ?></td>
                <td><?= $kat['katnama'] ?></td>
                <td>
                    <button class="btn btn-info" title="Edit" onclick="edit('<?= $kat['katid'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>

                    <form method="POST" action="/kategori/hapus/<?= $kat['katid'] ?>" style="display:inline" onsubmit="hapus()">
                        <input type="hidden" value="DELETE" name="_method">
                        <button type="submit" class="btn btn-danger" title="Hapus">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="float-center">
    <?= $pager->links('kategori', 'mypager') ?>
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

<?= form_button('', '<i class="fa fa-plus-circle"></i> Tambah Kategori', [
    'class' => 'btn btn-info',
    'onclick' => "location.href=('" . site_url('kategori/tambah') . "')"
]) ?>


<?= $this->endSection() ?>