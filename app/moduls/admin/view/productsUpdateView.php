<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $data['products']['products_name']; ?> Ürün Bilgilerini Düzenle</h6>
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-primary" href="/admin/products/<?php echo $data['products']['categories_id']; ?>">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="/admin/products/update/productsUpdateOp" method="post">
            <div class="form-group">
                <label for="productsName">Ürün Adı</label>
                <input type="text" name="products_name" class="form-control" id="productsName" value="<?php echo $data['products']['products_name']; ?>">
            </div>
            <div class="form-group">
                <label for="productsPrice">Ürün Fiyatı</label>
                <input type="text" name="products_price" class="form-control" id="productsPrice" value="<?php echo $data['products']['products_price']; ?>">
            </div>
            <input type="hidden" name="products_id" value="<?php echo $data['products']['products_id']; ?>">
            <button type="submit" name="products_update" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
</div>