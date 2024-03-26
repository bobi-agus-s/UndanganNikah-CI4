<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Grub Kontak - YukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <h1>Grub Kontak</h1>
    <div class="section-header-button">
      <a href="<?= site_url('groups/new') ?>" class="btn btn-primary">Add New</a>
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
            <h4>Data Grup Kontak</h4>
            <?php if (session('id_user') == 1) : ?>
              <div class="card-header-action">
                <a href="<?= site_url('groups/trash') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Trash</a>
              </div>
            <?php endif; ?>
          </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Grup</th>
                    <th>Info</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($groups as $key => $row) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $row->nama_group ?></td>
                    <td><?= $row->info ?></td>
                    <td style="width: 10%;">
                      <a href="<?= site_url('groups/').$row->id_group.'/edit' ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <form action="<?= site_url('groups/').$row->id_group ?>" method="post" class="d-inline" id="del-<?= $row->id_group ?>">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-sm" data-confirm="Hapus Data|Anda Yakin ?" data-confirm-yes="submitDel(<?= $row->id_group ?>)">
                          <i class="fas fa-trash"></i>
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
