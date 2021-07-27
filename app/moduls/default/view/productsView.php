<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-primary">Tüm Ürünler</h6>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Ürün Adı</th>
                    <th>Ürün Kategorisi</th>
                    <th>Ürünü Sat</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Ürün Adı</th>
                    <th>Ürün Kategorisi</th>
                    <th>Satış Yap</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($data['products'] as $products) : ?>
                    <tr>
                        <td><?php echo $products['products_name']; ?></td>
                        <td><?php echo $products['category']; ?></td>
                        <td>
                            <a href="/products/sales/<?php echo $products['products_id']; ?>" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Ürünü Sat</span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>