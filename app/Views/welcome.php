<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<?php if (session()->get('login')): ?>
  <div class="alert alert-success">
    Selamat datang <strong><?= session()->get('nama'); ?></strong>
  </div>
<?php endif; ?>
<div class="p-5 text-center bg-white rounded-3 shadow-sm">
    <hi class="text-body-emphasis">
      aplikasi crud pegawai
    </hi>
    <p class="lead">
      selamat datang di aplikasi crud pegawai. aplikasi ini digunakan untuk mengelola data pegawai.
    </p>
</div>
<?= $this->endSection(); ?>