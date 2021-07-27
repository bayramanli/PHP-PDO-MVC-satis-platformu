<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $data['users']['users_name'].' '.$data['users']['users_surname']; ?> Kullanıcısına ait Müşteriler</h6>
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-primary" href="/admin/users">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php if (!isset($data['clients'])) { ?>
            <div>
                <p>Bu kullanıcının müşterisi bulunmamaktadır.</p>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Müşteri Adı</th>
                        <th>Müşteri Adresi</th>
                        <th>Düzenle</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Müşteri Adı</th>
                        <th>Müşteri Adresi</th>
                        <th>Düzenle</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($data['clients'] as $clients) : ?>
                        <tr>
                            <td><?php echo $clients['clients_name']; ?></td>
                            <td><?php echo $clients['clients_address']; ?></td>
                            <td>
                                <a href="/admin/clients/update/<?php echo $clients['clients_id']; ?>" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-edit"></i>
                                </span>
                                    <span class="text">Düzenle</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>