<?= $this->extend('layouts/base-layout'); ?>
<?= $this->section('title'); ?>Beranda<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="text-white bg-dark border rounded border-0 p-4 p-md-5">
        <h2 class="fw-bold text-white mb-3">Biben dum fringi dictum, augue purus</h2>
        <p class="mb-4">Tincidunt laoreet leo, adipiscing taciti tempor. Primis senectus sapien,
            risus donec ad fusce augue interdum.</p>
        <div class="my-3"><a class="btn btn-primary btn-lg me-2" role="button" href="#">Button</a><a class="btn btn-light btn-lg" role="button" href="#">Button</a></div>
    </div>
</div>
<?= $this->endSection(); ?>