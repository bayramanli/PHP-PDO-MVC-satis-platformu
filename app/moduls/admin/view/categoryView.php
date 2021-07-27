<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <h6 class="m-0 font-weight-bold text-primary">Kategoriler</h6>
            </div>
            <div class="col-md-8 text-right">
                <a class="btn btn-primary" href="/admin/category/insert">
                    <i class="fa fa-plus"></i> Yeni Kategori Ekle
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Kategori Adı</th>
                    <th>Kategori Ürünleri</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Kategori Adı</th>
                    <th>Kategori Ürünleri</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($data['category'] as $category) : ?>
                    <tr>
                        <td><?php echo $category['categories_name']; ?></td>
                        <td>
                            <a href="/admin/products/<?php echo $category['categories_id']; ?>" class="btn btn-primary btn-icon-split">
                                <span class="text">Ürünler</span>
                            </a>
                        </td>
                        <td>
                            <a href="/admin/category/update/<?php echo $category['categories_id']; ?>" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Düzenle</span>
                            </a>
                        </td>
                        <td>
                            <a href="/admin/category/delete/<?php echo $category['categories_id']; ?>" class="btn btn-danger btn-icon-split">
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