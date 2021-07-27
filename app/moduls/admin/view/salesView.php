<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-primary">Satılan Ürünler ve Kazanılan Primler</h6>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php if (!isset($data['sales'])) { ?>
            <div>
                <p>Henüz ürün satışı yapılmamıştır.</p>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Ürün Fiyatı</th>
                        <th>Ürünü Satan Kullanıcı</th>
                        <th>Satıldığı Müşteri</th>
                        <th>Kazanılan Prim</th>
                        <th>Satış Durumu</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Ürün Fiyatı</th>
                        <th>Ürünü Satan Kullanıcı</th>
                        <th>Satıldığı Müşteri</th>
                        <th>Kazanılan Prim</th>
                        <th>Satış Durumu</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php $indis = 0; foreach ($data['sales'] as $sales) : ?>
                        <tr>
                            <td><?php echo $sales['products']['products_name']; ?></td>
                            <td><?php echo $sales['products']['products_price']; ?></td>
                            <td><?php echo $sales['users']['users_name'].' '.$sales['users']['users_surname']; ?></td>
                            <td><?php echo $sales['clients']['clients_name']; ?></td>
                            <td><?php echo $sales['sales_prim']; ?></td>
                            <td><?php echo $sales['sales_status'] == 1 ? "BAŞARILI" : "BAŞARISIZ"; ?></td>
                        </tr>
                        <?php $indis++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>