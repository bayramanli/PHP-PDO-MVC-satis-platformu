<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <h6 class="m-0 font-weight-bold text-primary">Müşteri Seçme ve Satış Yapma</h6>
            </div>
            <div class="col-md-8 text-right">
                <a class="btn btn-primary" href="/products">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php if (!isset($data['clients'])) { ?>
            <div>
                <p>Ürün satışı yapabilmeniz için öncelikle müşteri eklemeniz gerekmektedir.</p>
            </div>
        <?php } else { ?>
            <form action="/products/sales/salesOp" method="post">
                <div class="form-group">
                    <label>Ürün Adı</label>
                    <input type="text" readonly="readonly" class="form-control" value="<?php echo $data['products']['products_name']; ?>">
                </div>
                <div class="form-group">
                    <label>Ürün Fiyatı</label>
                    <input type="text" name="products_price" readonly="readonly" class="form-control" value="<?php echo $data['products']['products_price']; ?>">
                </div>
                <input type="hidden" name="products_id" value="<?php echo $data['products']['products_id']; ?>">
                <div class="form-group">
                    <label for="clientsName">Ürünü Satacağınız Müşteriyi Seçiniz</label>
                    <select class="form-control" name="clients_id" required>
                        <?php foreach ($data['clients'] as $clients) : ?>
                            <option value="<?php echo $clients['clients_id']; ?>"><?php echo $clients['clients_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="products_sales" class="btn btn-primary">Ürünü Sat</button>
            </form>
        <?php } ?>
    </div>
</div>