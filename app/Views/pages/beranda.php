<?= $this->extend('layouts/base-layout'); ?>
<?= $this->section('title'); ?>Beranda<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card d-flex flex-row">
                <div class="card-header col-5">
                    <h4>Card 1</h4>
                </div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quidem.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card d-flex flex-row">
                <div class="card-header col-5">
                    <h4>Card 2</h4>
                </div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quidem.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>