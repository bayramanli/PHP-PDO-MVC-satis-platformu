<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $data['category']['categories_name']; ?> Kategorisine ait Ürünler</h6>
            </div>
            <div class="col-md-8 text-right">
                <a class="btn btn-primary" href="/admin/products/insert/<?php echo $data['category']['categories_id']; ?>">
                    <i class="fa fa-plus"></i> Kategoriye Yeni Ürün Ekle
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php if (!isset($data['products'])) { ?>
            <div>
                <p>Bu kategoriye ait ürün bulunmamaktadır.</p>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Fiyatı</th>
                        <th>Düzenle</th>
                        <th>Sil</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Fiyatı</th>
                        <th>Düzenle</th>
                        <th>Sil</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($data['products'] as $products) : ?>
                        <tr>
                            <td><?php echo $products['products_name']; ?></td>
                            <td><?php echo $products['products_price']; ?></td>
                            <td>
                                <a href="/admin/products/update/<?php echo $products['products_id']; ?>" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-edit"></i>
                                </span>
                                    <span class="text">Düzenle</span>
                                </a>
                            </td>
                            <td>
                                <a href="/admin/products/delete/<?php echo $products['products_id']; ?>" class="btn btn-danger btn-icon-split">
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
        <?php } ?>
    </div>
</div>