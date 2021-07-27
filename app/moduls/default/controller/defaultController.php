<?php

class defaultController extends mainController
{

    public function index()
    {
        $data = [];
        if ($_SESSION['users']['users_role'] == "user") {
            $this->callLayout("frontend", "main", "default", "index", $data);
        } else {
            Header("Location:/404");
        }
    }

    //404 Page
    public function page404()
    {
        $data = [];
        $this->callView("default", "404");
    }

    public function login()
    {
        $data = [];
        if (isset($_SESSION['users'])) {
            if ($_SESSION['users']['users_role'] == "admin") {
                Header("Location:/admin");
                exit();
            } else {
                Header("Location:/dashboard");
                exit();
            }
        } else {
            $this->callView("default", "login", $data);
        }
    }

    public function register()
    {
        $data = [];
        $this->callView("default", "register", $data);
    }

    public function usersInsertOp()
    {
        $data = [];
        $usersInsertModel = new defaultModel();
        $_SESSION['messageManagement'] = $usersInsertModel->usersInsertModel();
        if ($_SESSION['messageManagement']['status'] == 1) {
            Header("Location:/login");
        } else {
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit();
        }
    }

    public function loginControl()
    {
        $data = [];
        $loginControlModel = new defaultModel();
        $data = $loginControlModel->loginControlModel();
        //echo "<pre>";
        //print_r($data['status']);
        //exit();

        if ($data['status']) {
            if ($_SESSION['users']['users_role'] == "user") {
                $_SESSION['messageManagement']['status'] = TRUE;
                $_SESSION['messageManagement']['message'] = "Başarılı bir şekilde giriş yapıldı.";
                Header("Location:/dashboard");
            } else {
                $_SESSION['messageManagement']['status'] = TRUE;
                $_SESSION['messageManagement']['message'] = "Başarılı bir şekilde giriş yapıldı.";
                Header("Location:/admin");
            }
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Giriş Başarısız. Lütfen bilgilerinizi doğru girerek tekrar deneyiniz.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    public function logout()
    {
        $data = [];
        $logout = new defaultModel();
        $logout->logoutModel();
        $this->callView("default", "login", $data);

    }

    //CLIENTS
    public function clients()
    {
        $users_id = $_SESSION['users']['users_id'];
        $data = [];
        $clientsModel = new defaultModel();
        $data['clients'] = $clientsModel->clientsModel($users_id);
        $this->callLayout("frontend", "main", "default", "clients", $data);
    }

    public function clientsInsert()
    {
        $data = [];
        $this->callLayout("frontend", "main", "default", "clientsInsert", $data);
    }

    public function clientsInsertOp()
    {
        $clientsInsertOp = new defaultModel();
        $data = $clientsInsertOp->clientsInsertOp();
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Müşteri başarılı bir şekilde eklendi.";
            Header("Location:/clients");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Müşteri eklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:/clients");
            exit;
        }
    }

    public function clientsUpdate($clients_id)
    {
        $data = [];
        $clientsUpdateModel = new defaultModel();
        $data['clients'] = $clientsUpdateModel->clientsUpdate($clients_id);
        $this->callLayout("frontend", "main", "default", "clientsUpdate", $data);
    }

    public function clientsUpdateOp()
    {

        $clientsUpdateOpModel = new defaultModel();
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

    public function clientsDelete($clients_id)
    {
        $clientsDeleteModel = new defaultModel();
        $data = $clientsDeleteModel->clientsDelete($clients_id);
        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Müşteri başarılı bir şekilde silindi.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Müşteri silinirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    //PRODUCTS
    public function products()
    {
        $data = [];
        $productsModel = new defaultModel();
        $data['products'] = $productsModel->productsModel();
        //echo "<pre>";
        //print_r($data);
        //exit();
        $indis = 0;
        foreach ($data['products'] as $product) {
            $category = $productsModel->category($product['categories_id']);
            $data['products'][$indis]['category'] = $category['categories_name'];
            $indis++;
        }
        //echo "<pre>";
        //print_r($data);
        //exit();
        $this->callLayout("frontend", "main", "default", "products", $data);
    }

    public function productsSales($products_id)
    {
        $users_id = $_SESSION['users']['users_id'];
        $data = [];
        $productModel = new defaultModel();
        $data['products'] = $productModel->productsInfo($products_id);
        $data['clients'] = $productModel->clientsModel($users_id);
        //echo "<pre>";
        //print_r($data);
        //exit();
        $this->callLayout("frontend", "main", "default", "productsSales", $data);
    }


    public function productsSalesOp()
    {
        $data = [];
        $productsModel = new defaultModel();
        $data = $productsModel->productsSalesOp();

        if ($data['status']) {
            $_SESSION['messageManagement']['status'] = TRUE;
            $_SESSION['messageManagement']['message'] = "Ürün  Seçilen Müşteriye başarılı bir şekilde satıldı.";
            Header("Location:/sales");
            exit;
        } else {
            $_SESSION['messageManagement']['status'] = FALSE;
            $_SESSION['messageManagement']['message'] = "Ürün seçilen müşteriye satılırken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            Header("Location:{$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    //SALES
    public function sales()
    {
        $users_id = $_SESSION['users']['users_id'];
        $data = [];
        $results = [];
        $salesModel = new defaultModel();
        $results['clients'] = $salesModel->clientsModel($users_id);
        //echo "<pre>";
        //print_r($results);
        //exit();
        if ($results['clients']) {
            $indis = 0;
            foreach ($results['clients'] as $clients) {
                $sales[$indis] = $salesModel->salesModel($clients['clients_id']);
                if ($sales[$indis]) {
                    $data['sales'][$indis] = $sales[$indis];
                }
                $indis++;
            }
        }
        //echo "<pre>";
        //print_r($data);
        //exit();
        $this->callLayout("frontend", "main", "default", "sales", $data);
    }


}