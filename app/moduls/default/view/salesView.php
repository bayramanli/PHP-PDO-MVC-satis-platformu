<?php
//echo "<pre>";
//print_r($data);
//exit();
/*
foreach ($data['sales'] as $sales) {
    //print_r($sales);
    foreach ($sales as $sale) {
        //print_r($sale); ?>
        <tr>
            <td><?php echo $sale['products']['products_name']; ?></td>
            <td><?php echo $sale['products']['products_price']; ?></td>
            <td><?php echo $sale['clients']['clients_name']; ?></td>
            <td><?php echo $sale['sales_prim']; ?></td>
            <td><?php echo $sale['sales_status'] == 1 ? "BAŞARILI" : "BAŞARISIZ"; ?></td>
        </tr>
    <?php }
}
exit();
*/


?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-primary">Satılan Ürünler</h6>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php if (!isset($data['sales'][0])) { ?>
            <div>
                <p>Henüz satış yapmadınız.</p>
            </div>
        <?php } else {  ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Ürün Fiyatı</th>
                        <th>Satıldığı Müşteri</th>
                        <th>Kazanılan Prim</th>
                        <th>Satış Durumu</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Ürün Fiyatı</th>
                        <th>Satıldığı Müşteri</th>
                        <th>Kazanılan Prim</th>
                        <th>Satış Durumu</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($data['sales'] as $sales) : ?>
                        <?php foreach ($sales as $sale) : ?>
                            <tr>
                                <td><?php echo $sale['products']['products_name']; ?></td>
                                <td><?php echo $sale['products']['products_price']; ?></td>
                                <td><?php echo $sale['clients']['clients_name']; ?></td>
                                <td><?php echo $sale['sales_prim']; ?></td>
                                <td><?php echo $sale['sales_status'] == 1 ? "BAŞARILI" : "BAŞARISIZ"; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>