<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Create Kontak - YukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
        <a href="<?= site_url('kontak') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Create Kontak</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Buat Kontak</h4>
        </div>
        <div class="card-body">
          <?php $errors = session()->getFlashdata('errors') ?>
            <form action="<?= site_url('kontak') ?>" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <div class="form-row">
              <div class="form-group col-md-6">
                      <label>Grub</label>
                      <select name="id_group" class="form-control py-0 <?= isset($errors['id_group']) ? 'is-invalid' : null ?>">
                        <?php foreach($group as $row): ?>
                          <option value="<?= $row->id_group ?>" <?= old('id_group') == $row->id_group ? 'selected' : null ?>> <?= $row->nama_group ?></option>
                        <?php endforeach; ?>
                      </select>
                      <div class="invalid-feedback">
                        <?= isset($errors['id_group']) ? $errors['id_group'] : null ?>
                      </div>
                    </div>
              </div>
              <div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="nama_kontak">Nama Kontak</label>
                      <input type="text" class="form-control <?= isset($errors['nama_kontak']) ? 'is-invalid' : null ?>" name="nama_kontak" value="<?= old('nama_kontak') ?>">
                      <div class="invalid-feedback">
                        <?= isset($errors['nama_kontak']) ? $errors['nama_kontak'] : null ?>
                      </div>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control" name="phone">
                  </div>
              </div>
                <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Submit</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection('content') ?>
