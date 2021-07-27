<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Müşteri Ekle</h6>
            </div>
            <div class="col-md-8 text-right">
                <a class="btn btn-primary" href="/clients">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="/clients/insert/clientsInsertOp" method="post">
            <div class="form-group">
                <label for="clientsName">Müşteri Adı</label>
                <input type="text" name="clients_name" class="form-control" id="clientsName">
            </div>
            <div class="form-group">
                <label for="clientsAddress">Müşteri Adresi</label>
                <input type="text" name="clients_address" class="form-control" id="clientsAddress">
            </div>
            <input type="hidden" name="users_id" value="<?php echo $_SESSION['users']['users_id']; ?>">
            <button type="submit" name="clients_insert" class="btn btn-primary">Kaydet</button>
        </form>
    </div>
</div>