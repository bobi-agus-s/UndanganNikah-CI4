<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Update Gawe - YukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
        <a href="<?= site_url('gawe') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Update Gawe</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Edit Gawe</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('gawe/'.$gawe->id_gawe) ?>" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="nama_gawe">Nama Gawe</label>
                      <input type="text" class="form-control" name="nama_gawe" value="<?= $gawe->nama_gawe ?>">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="date_gawe">Tanggal Gawe</label>
                      <input type="date" class="form-control" name="date_gawe" value="<?= $gawe->date_gawe ?>">
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6 ">
                      <label for="info_gawe">Info Gawe</label>
                      <textarea class="form-control" name="info_gawe"><?= $gawe->info_gawe ?></textarea>
                  </div>
              </div>
              <div>
                <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Update</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection('content') ?>
