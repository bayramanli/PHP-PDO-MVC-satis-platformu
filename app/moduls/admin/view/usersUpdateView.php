<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <h6 class="m-0 font-weight-bold text-primary">Kullanıcı Bilgilerini Düzenle</h6>
            </div>
            <div class="col-md-8 text-right">
                <a class="btn btn-primary" href="/admin/users">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="/admin/users/update/usersUpdateOp" method="post">
            <div class="form-group">
                <label for="usersName">Adı</label>
                <input type="text" name="users_name" class="form-control" id="usersName" value="<?php echo $data['users']['users_name']; ?>">
            </div>
            <div class="form-group">
                <label for="usersSurname">Soyadı</label>
                <input type="text" name="users_surname" class="form-control" id="usersSurname" value="<?php echo $data['users']['users_surname']; ?>">
            </div>
            <div class="form-group">
                <label for="usersEmail">Email Adresi</label>
                <input type="text" name="users_email" class="form-control" id="usersEmail" value="<?php echo $data['users']['users_email']; ?>">
            </div>
            <div class="form-group">
                <label for="usersName">Kullanıcı Rolü</label>
                <select class="form-control" name="roles_id" required>
                    <option value="<?php echo $data['users']['roles_id']; ?>">
                        <?php foreach ($data['roles'] as $roles) {
                            if ($roles['roles_id'] == $data['users']['roles_id']) {
                                echo $roles['roles_name'];
                            }
                        } ?>
                    </option>
                    <?php foreach ($data['roles'] as $roles) : ?>
                        <option value="<?php echo $roles['roles_id']; ?>"><?php echo $roles['roles_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="hidden" name="users_id" value="<?php echo $data['users']['users_id']; ?>">
            <button type="submit" name="users_update" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
</div>