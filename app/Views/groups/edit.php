<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Update Grup - YukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
        <a href="<?= site_url('groups') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Update Grup</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Edit Grup</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('groups/'.$group->id_group) ?>" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="nama_group">Nama group</label>
                      <input type="text" class="form-control <?= $validation->hasError('nama_group') ? 'is-invalid' : null ?>" name="nama_group" 
                      value="<?= old('nama_group', $group->nama_group) ?>" >
                      <?php if($validation->hasError('nama_group')): ?>
                        <div class="invalid-feedback">
                          <?= $validation->getError('nama_group') ?>
                        </div>
                      <?php endif; ?>
                    </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6 ">
                      <label for="info">Info group</label>
                      <textarea class="form-control" name="info"><?= $group->info ?></textarea>
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
