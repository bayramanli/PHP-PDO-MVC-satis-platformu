<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $data['category']['categories_name']; ?> Kategorisine Yeni Ürün Ekle</h6>
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-primary" href="/admin/products/<?php echo $data['category']['categories_id']; ?>">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="/admin/products/insert/productsInsertOp" method="post">
            <div class="form-group">
                <label for="productsName">Ürün Adı</label>
                <input type="text" name="products_name" class="form-control" id="productsName">
            </div>
            <div class="form-group">
                <label for="productsPrice">Ürün Fiyatı <small>Türk Lirası cinsinden</small></label>
                <input type="text" name="products_price" class="form-control" id="productsPrice">
            </div>
            <input type="hidden" name="categories_id" value="<?php echo $data['category']['categories_id']; ?>">
            <button type="submit" name="products_insert" class="btn btn-primary">Kaydet</button>
        </form>
    </div>
</div>