<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategor Ekle</h6>
            </div>
            <div class="col-md-8 text-right">
                <a class="btn btn-primary" href="/admin/category">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="/admin/category/insert/categoryInsertOp" method="post">
            <div class="form-group">
                <label for="categoryName">Kategori Adı</label>
                <input type="text" name="categories_name" class="form-control" id="categoryName">
            </div>
            <button type="submit" name="category_insert" class="btn btn-primary">Kaydet</button>
        </form>
    </div>
</div>