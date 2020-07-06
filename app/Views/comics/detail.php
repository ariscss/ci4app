<?= $this->extend('layouts/_template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-2 mb-4">Detail Komik</h2>
    <div class="row">
        <div class="col">
            <div class="card mb-3 shadow p-3 mb-5 bg-white rounded-lg" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/image/<?= $komik['sampul']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><?= $komik['judul']; ?></h3>
                            <p class="card-text"><b>Penulis : </b><?= $komik['penulis']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Penerbit : </b><?= $komik['penerbit']; ?></small></p>

                            <a href="/comics/edit/<?= $komik['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/comics/<?= $komik['id']; ?>" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ?'); ">Delete</button>
                            </form>

                            <div class="mt-3">
                                <a href="/comics">Kembali ke daftar komik</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>