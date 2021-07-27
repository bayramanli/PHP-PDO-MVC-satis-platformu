<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Düzenle</h6>
            </div>
            <div class="col-md-8 text-right">
                <a class="btn btn-primary" href="/admin/category">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="/admin/category/update/categoryUpdateOp" method="post">
            <div class="form-group">
                <label for="categoryName">Kategori Adı</label>
                <input type="text" name="categories_name" class="form-control" id="categoryName" value="<?php echo $data['category']['categories_name']; ?>">
            </div>
            <input type="hidden" name="categories_id" value="<?php echo $data['category']['categories_id']; ?>">
            <button type="submit" name="category_update" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
</div>