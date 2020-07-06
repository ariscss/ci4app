<?= $this->extend('layouts/_template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/comics/create" class="btn btn-primary mt-2">Tambah Data Komik</a>
            <h1 class="mt-2 mb-4">Daftar Komik</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-info" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    <?php foreach ($komik as $c) : ?>
                        <tr>
                            <th scope="row"><?= ++$no; ?></th>
                            <td><img src="/image/<?= $c['sampul']; ?>" alt="comic image" class="sampul"></td>
                            <td><?= $c['judul']; ?></td>
                            <td>
                                <a href="/comics/<?= $c['slug']; ?>" class="btn btn-success">Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>