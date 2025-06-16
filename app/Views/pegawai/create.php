<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="my-3 p-3 bg-body rounded shadow-sm">
  <div class="d-flex justify-content-between border-bottom py-2">
    <h3 class="mb-0 pb-0">
      Create jabatan
    </h3>
    <a href="/pegawai" class="btn btn-dark">Kembali</a>
  </div>
  <div class="p-3">
    <form action="/pegawai/store" method="post" enctype="multipart/form-data">
      <?= csrf_field(); ?>
      <div class="mb-3">
        <label for="" class="form-label">Nama Pegawai:</label>
        <input type="text" class="form-control" name="nama_pegawai" placeholder="Masukkan nama pegawai">
      </div>
      
      <div class="mb-3">
        <label for="" class="form-label">Alamat Pegawai:</label>
        <input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat pegawai">
      </div>
      
      <div class="mb-3">
        <label for="" class="form-label">No. Telepom Pegawai:</label>
        <input type="text" class="form-control" name="telepon" placeholder="Masukkan No. telepon pegawai">
      </div>
      
      <div class="mb-3">
        <label for="" class="form-label">Jabatan Pegawai</label>
        <select name="jabatan_id" id="" class="form-control">
          <?php foreach ($jabatan as $j) { ?>
            <option value="<?= $j->id; ?>"><?= $j->nama_jabatan; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Foto Pegawai:</label>
        <input type="file" class="form-control" name="file_foto">
      </div>
      <button type="submit" class="btn btn-dark">Simpan</button>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>