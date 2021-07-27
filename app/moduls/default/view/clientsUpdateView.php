<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <h6 class="m-0 font-weight-bold text-primary">Müşteri Bilgilerini Düzenle</h6>
            </div>
            <div class="col-md-8 text-right">
                <a class="btn btn-primary" href="/clients">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="/clients/update/clientsUpdateOp" method="post">
            <div class="form-group">
                <label for="clientsName">Müşteri Adı</label>
                <input type="text" name="clients_name" class="form-control" id="clientsName" value="<?php echo $data['clients']['clients_name']; ?>">
            </div>
            <div class="form-group">
                <label for="clientsAddress">Müşteri Adresi</label>
                <input type="text" name="clients_address" class="form-control" id="clientsAddress" value="<?php echo $data['clients']['clients_address']; ?>">
            </div>
            <input type="hidden" name="clients_id" value="<?php echo $data['clients']['clients_id']; ?>">
            <button type="submit" name="clients_update" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
</div>