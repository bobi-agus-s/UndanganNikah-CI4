<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Grub Kontak - Trash</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <h1>Grub Kontak - Trash</h1>
    <div class="section-header-button">
      <a href="<?= site_url('groups') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>  
  </div>

  <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">x</button>
        <b>Success !</b>
        <?= session()->getFlashdata('success') ?>
      </div>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">x</button>
        <b>Error !</b>
        <?= session()->getFlashdata('error') ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Grup Kontak - Trash</h4>
            <?php if($groups): ?>
              <div class="card-header-action">
                <a href="<?= site_url('groups/restore') ?>" class="btn btn-info">Restore All</a>
                <form action="<?= site_url('groups/delete2') ?>"  method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data permanen')">
                  <?= csrf_field() ?>
                  <button class="btn btn-danger">Delete All Permanently</button>
                </form>
              </div>
            <?php endif; ?>
          </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tbody>
                  <tr>
                    <th>#</th>
                    <th>Nama Grup</th>
                    <th>Info</th>
                    <th>Action</th>
                  </tr>
                  <?php $no = 1 ?>
                  <?php foreach($groups as $row) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama_group ?></td>
                    <td><?= $row->info ?></td>
                    <td style="width: 20%;">
                      <a href="<?= site_url('groups/restore/').$row->id_group ?>" class="btn btn-success btn-sm">Restore</a>
                      <form action="<?= site_url('groups/delete2/').$row->id_group ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data permanen')">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-sm">
                          Hapus Permanen
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection('content') ?>
