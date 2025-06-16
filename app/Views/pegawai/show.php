<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="my-3 p-3 bg-body rounded shadow-sm">
  <div class="d-flex justify-content-between border-bottom py-2">
    <h3 class="mb-0 pb-0">
      Detail pegawai
    </h3>
    <a href="/pegawai" class="btn btn-dark">Kembali</a>
  </div>
  <div class="p-3">
    <div class="row">
      <div class="col-md-4 text-center">
        <img src="<?= site_url();?>uploads/<?= $pegawai->foto_pegawai; ?>" class="img-fluid rounded-pill mb-3" style="max-width:150px;" alt="">
      </div>
      <div class="col-md-8">
        <table class="table">
          <tr>
            <th>Nama pegawai</th>
            <th>:</th>
            <td><?= $pegawai->nama_pegawai; ?></td>
          </tr>
          <tr>
            <th>Alamat</th>
            <th>:</th>
            <td><?= $pegawai->alamat; ?></td>
          </tr>
          <tr>
            <th>No. telepon</th>
            <th>:</th>
            <td><?= $pegawai->telepon; ?></td>
          </tr>
          <tr>
            <th>Jabatan</th>
            <th>:</th>
            <td><?= $pegawai->nama_jabatan; ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>