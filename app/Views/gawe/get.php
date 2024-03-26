<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Gawe - YukNikah</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <h1>Gawe</h1>
    <div class="section-header-button">
      <a href="<?= site_url('gawe/add') ?>" class="btn btn-primary">Add New</a>
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
            <h4>Data Gawe / Acara</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-md" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Gawe</th>
                    <th>Tanggal</th>
                    <th>Info</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($query as $key => $row): ?>
                  <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $row->nama_gawe ?></td>
                    <td><?= date('d/m/Y', strtotime($row->date_gawe)) ?></td>
                    <td><?= $row->info_gawe ?></td>
                    <td style="width: 10%;">
                      <a href="<?= site_url('gawe/edit/'.$row->id_gawe) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <button class="btn btn-info btn-sm swal-6" value="<?= $row->id_gawe ?>"  type="submit">
                        <i class="fas fa-trash"></i>
                      </button>

                      <form action="<?= site_url('gawe/'.$row->id_gawe) ?>" method="post" class="d-inline" id="del-<?= $row->id_gawe ?>">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-sm" data-confirm="Hapus data|YAkin dek?" data-confirm-yes="submitDel(<?= $row->id_gawe ?>)">
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
<?= $this->endSection() ?>