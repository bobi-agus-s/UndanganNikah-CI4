<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Kontak - YukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <h1>Kontak</h1>
    <div class="section-header-button">
      <a href="<?= site_url('kontak/new') ?>" class="btn btn-primary">Add New</a>
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
          <div class="card-header">
            <form action="" method="get" autocomplete="off">
              <div class="float-left">
                <?php $request = \Config\Services::request(); ?>
                <!-- <input type="text" name="keyword" value="<?//= $keyword ?>" class="form-control" style="width: 155pt" placeholder="masukkan pencarian..."> -->
                <input type="text" name="keyword" value="<?= $request->getGet('keyword') ?>" class="form-control" style="width: 155pt" placeholder="masukkan pencarian...">
              </div>
              <div class="float-right ml-2">
                <button class="btn  btn-primary" type="submit"><i class="fas fa-search"></i></button>

                <?php 
                  $request = \Config\Services::request();
                  $keyword = $request->getGet('keyword');
                  if ($keyword != '') {
                    $param = "?keyword=".$keyword;
                  } else {
                    $param = '';
                  }
                ?>
                
                <a href="<?= site_url('kontak/export'.$param) ?>" class="btn btn-primary">
                  <i class="fas fa-file-download mr-2"></i> Export Excel
                </a>
              </div>
            </form>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md" id="">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Kontak</th>
                    <th>Phone</th>
                    <th>Group</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $page = isset($_GET['page']) ? $_GET['page'] : 1;
                  $no = 1 + (10 * ($page - 1));
                  foreach($kontak as $key => $row) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama_kontak ?></td>
                    <td><?= $row->phone ?></td>
                    <td><?= $row->nama_group ?></td>
                    <td style="width: 10%;">
                      <a href="<?= site_url('kontak/').$row->id_kontak.'/edit' ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <form action="<?= site_url('kontak/').$row->id_kontak ?>" method="post" class="d-inline" id="del-<?= $row->id_kontak ?>">
                      <?= csrf_field() ?> 
                      <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-sm" data-confirm="hapus data|yakin dek?" data-confirm-yes="submitDel(<?= $row->id_kontak ?>)">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <div class="float-left">
                <i>showing <?= empty($kontak) ? 0 : 1 + (10 * ($page - 1)) ?> to <?= $no - 1 ?> of <?= $pager->getTotal() ?> entries</i>
              </div>
              <div class="float-right">
                <?= $pager->links('default', 'pagination') ?>
              </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
