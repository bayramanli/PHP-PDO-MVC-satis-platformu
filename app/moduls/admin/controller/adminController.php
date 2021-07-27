<?php

class adminController extends mainController
{
    public function index()
    {
        $data = [];
        if ($_SESSION['users']['users_role'] == "admin") {
            $this->callLayout("backend", "main", "admin", "index", $data);
        } else {
            Header("Location:/404");
        }
    }

    //USERS
    public function users()
    {
        $data = [];
        $usersModel = new adminModel();
        $data['users'] = $usersModel->usersModel();
        $this->callLayout("backend", "main", "admin", "users", $data);
    }

    public function usersUpdate($users_id)
    {
        $data = [];
        $usersUpdateModel = new adminModel();
        $data['users'] = $usersUpdateModel->usersUpdate($users_id);
        $data['roles'] = $usersUpdateModel->usersRoles();
        $this->callLayout("backend", "main", "admin", "usersUpdate", $data);
    }

    public function usersUpdateOp()
    {

        $usersUpdateOpModel = new adminModel();
        $data = $usersUpdateOpModel->usersUpdateOp();
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Kullanıcı bilgileri başarılı bir şekilde güncellendi.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Kullanıcı bilgileri güncellenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    public function usersDelete($users_id)
    {
        $usersDeleteModel = new adminModel();
        $data = $usersDeleteModel->usersDelete($users_id);
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Kullanıcı başarılı bir şekilde silindi.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Kullanıcı silinirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    //CLIENTS
    public function clients($users_id)
    {
        $data = [];
        $clientsModel = new adminModel();
        $data['clients'] = $clientsModel->clientsModel($users_id);
        $data['users'] = $clientsModel->usersUpdate($users_id);
        $this->callLayout("backend", "main", "admin", "clients", $data);
    }

    public function clientsUpdate($clients_id)
    {
        $data = [];
        $clientsUpdateModel = new adminModel();
        $data['clients'] = $clientsUpdateModel->clientsUpdate($clients_id);
        $data['users'] = $clientsUpdateModel->usersUpdate($data['clients']['users_id']);
        $this->callLayout("backend", "main", "admin", "clientsUpdate", $data);
    }

    public function clientsUpdateOp()
    {

        $clientsUpdateOpModel = new adminModel();
        $data = $clientsUpdateOpModel->clientsUpdateOp();
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Müşteri bilgileri başarılı bir şekilde güncellendi.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Müşteri bilgileri güncellenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    //CATEGORY
    public function category()
    {
        $data = [];
        $categoryModel = new adminModel();
        $data['category'] = $categoryModel->categoryModel();
        $this->callLayout("backend", "main", "admin", "category", $data);
    }

    public function categoryInsert()
    {
        $data = [];
        $this->callLayout("backend", "main", "admin", "categoryInsert", $data);
    }

    public function categoryInsertOp()
    {
        $categoryInsertOp = new adminModel();
        $data = $categoryInsertOp->categoryInsertOp();
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Kategori başarılı bir şekilde eklendi.";
            Header("Location:/admin/category");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Kategori eklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:/admin/category");
            exit;
        }
    }

    public function categoryUpdate($categories_id)
    {
        $data = [];
        $categoryUpdateModel = new adminModel();
        $data['category'] = $categoryUpdateModel->categoryUpdate($categories_id);
        $this->callLayout("backend", "main", "admin", "categoryUpdate", $data);
    }

    public function categoryUpdateOp()
    {

        $categoryUpdateOpModel = new adminModel();
        $data = $categoryUpdateOpModel->categoryUpdateOp();
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Kategori başarılı bir şekilde güncellendi.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Kategori güncellenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    public function categoryDelete($category_id)
    {
        $categoryDeleteModel = new adminModel();
        $data = $categoryDeleteModel->categoryDelete($category_id);
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Kategori başarılı bir şekilde silindi.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Kategori silinirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    //PRODUCTS
    public function products($category_id)
    {
        $data = [];
        $productsModel = new adminModel();
        $data['products'] = $productsModel->productsModel($category_id);
        $data['category'] = $productsModel->categoryUpdate($category_id);
        $this->callLayout("backend", "main", "admin", "products", $data);
    }

    public function productsInsert($category_id)
    {
        $data = [];
        $productsInsertModel = new adminModel();
        $data['category'] = $productsInsertModel->categoryUpdate($category_id);
        $this->callLayout("backend", "main", "admin", "productsInsert", $data);
    }

    public function productsInsertOp()
    {
        $category_id = $_POST['categories_id'];
        $productsInsertOp = new adminModel();
        $data = $productsInsertOp->productsInsertOp();
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Kategoriye ürün başarılı bir şekilde eklendi.";
            Header("Location:/admin/products/$category_id");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Kategori ürün eklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:/admin/products/$category_id");
            exit;
        }
    }

    public function productsUpdate($products_id)
    {
        $data = [];
        $productsUpdateModel = new adminModel();
        $data['products'] = $productsUpdateModel->productsUpdate($products_id);
        $this->callLayout("backend", "main", "admin", "productsUpdate", $data);
    }

    public function productsUpdateOp()
    {

        $productsUpdateOpModel = new adminModel();
        $data = $productsUpdateOpModel->productsUpdateOp();
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Ürün başarılı bir şekilde güncellendi.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Ürün güncellenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    public function productsDelete($products_id)
    {
        $productsDeleteModel = new adminModel();
        $data = $productsDeleteModel->productsDelete($products_id);
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Ürün başarılı bir şekilde silindi.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Ürün silinirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    public function sales()
    {
        $data = [];
        $salesModel = new adminModel();
        $data['sales'] = $salesModel->salesModel();
        $indis = 0;
        foreach ($data['sales'] as $sales) {
            $products = $salesModel->productsUpdate($sales['products_id']);
            $clients = $salesModel->clientsUpdate($sales['clients_id']);
            $users = $salesModel->usersUpdate($clients['users_id']);
            $data['sales'][$indis]['products'] = $products;
            $data['sales'][$indis]['clients'] = $clients;
            $data['sales'][$indis]['users'] = $users;
            $indis++;
        }
        //echo "<pre>";
        //print_r($data['sales']);
        //exit();
        $this->callLayout("backend", "main", "admin", "sales", $data);
    }


}