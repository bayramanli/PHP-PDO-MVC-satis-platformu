<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kullanıcılar</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Adı ve Soyadı</th>
                    <th>Email Adresi</th>
                    <th>Kayıt Tarihi</th>
                    <th>Müşterileri</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Adı ve Soyadı</th>
                    <th>Email Adresi</th>
                    <th>Kayıt Tarihi</th>
                    <th>Müşterileri</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($data['users'] as $users) : ?>
                    <tr>
                        <td><?php echo $users['users_name'] . ' ' . $users['users_surname']; ?></td>
                        <td><?php echo $users['users_email']; ?></td>
                        <td><?php echo $users['users_registered']; ?></td>
                        <td>
                            <a href="/admin/clients/<?php echo $users['users_id']; ?>" class="btn btn-secondary btn-icon-split">
                                <span class="text">Müşterileri</span>
                            </a>
                        </td>
                        <td>
                            <a href="/admin/users/update/<?php echo $users['users_id']; ?>" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Düzenle</span>
                            </a>
                        </td>
                        <td>
                            <a href="/admin/users/delete/<?php echo $users['users_id']; ?>" class="btn btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Sil</span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>