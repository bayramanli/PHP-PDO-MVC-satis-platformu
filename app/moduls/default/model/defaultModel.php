<?php

class defaultModel extends mainModel
{
    public function usersInsertModel()
    {
        $users_name = trim(strip_tags($_POST['users_name']));
        $users_surname = trim(strip_tags($_POST['users_surname']));
        $email = trim(strip_tags($_POST['users_email']));
        $password = trim(strip_tags(md5($_POST['users_password'])));

        if (empty($users_name) || empty($users_surname) || empty($email) || empty($password)) {
            return ['status' => FALSE, 'message' => "Lütfen bütün alanları doldurunuz."];
        } else {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //benzer email adresi adı var mı
                $sql = $this->db->wread("users", "users_email", $email);
                $count = $sql->rowCount();
                if ($count) {
                    return ['status' => FALSE, 'message' => "Girdiğiniz email adresi başka hesaba tanımlıdır. Lütfen başka bir email adresi giriniz."];
                } else {
                    $sql = $this->db->wread("roles", "roles_name", "user");
                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                    $values = [
                        "roles_id" => $row['roles_id'],
                        "users_name" => $users_name,
                        "users_surname" => $users_surname,
                        "users_email" => $email,
                        "users_password" => $password
                    ];
                    //echo "<pre>";
                    //print_r($values);
                    //exit();
                    $sql = $this->db->insert("users", $values);

                    if ($sql['status']) {
                        return ['status' => TRUE, 'message' => "Kaydınız başarılı bir şekilde yapıldı. Giriş formundaki bilgileri doldurarak giriş yapabilirsiniz."];
                    } else {
                        return ['status' => FALSE, 'message' => "Kayıt Başarısız. Lütfen daha sonra tekrar deneyiniz."];
                    }
                }
            } else {
                return ['status' => FALSE, 'message' => "Lütfen email adresinizi uygun formatta giriniz. ( Örnek: example@exapmle.com )"];
            }
        }
    }

    //LOGIN
    public function loginControlModel()
    {
        //echo "<pre>";
        //print_r($_POST);
        //exit();
        $result = $this->db->usersLogin(htmlspecialchars($_POST['users_email']), htmlspecialchars($_POST['users_password']));

        return $result;
    }

    //LOGOUT
    public function logoutModel()
    {
        $this->usersLogout();
    }

    //CLIENTS
    public function clientsModel($users_id)
    {
        $sql = $this->db->wread("clients", "users_id", $users_id);
        $indis = 0;
        while ($client = $sql->fetch(PDO::FETCH_ASSOC)) {
            $clients[$indis] = $client;
            $indis++;
        }
        //echo "<pre>";
        //print_r($products);
        //exit();
        return @$clients;
    }

    public function clientsInsertOp()
    {
        $sql = $this->db->insert("clients", $_POST,
            [
                "form_name" => "clients_insert"
            ]
        );
        return $sql;
    }

    public function clientsUpdate($clients_id)
    {
        $sql = $this->db->wread("clients", "clients_id", $clients_id);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function clientsUpdateOp()
    {

        $sql = $this->db->update("clients", $_POST, [
                "form_name" => "clients_update",
                "columns" => "clients_id"

            ]
        );

        return $sql;
    }

    public function clientsDelete($clients_id)
    {
        $sql = $this->db->delete("clients", "clients_id", $clients_id);
        return $sql;

    }

    //PRODUCTS
    public function productsModel()
    {
        $sql = $this->db->read("products",
            [
                "columns_name" => "products_id",
                "columns_sort" => "DESC"
            ]
        );

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function productsInfo($products_id)
    {
        $sql = $this->db->wread("products", "products_id", $products_id);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function productsSalesOp()
    {
        $products_id = trim(strip_tags($_POST['products_id']));
        $clients_id = trim(strip_tags($_POST['clients_id']));
        $products_price = trim(strip_tags($_POST['products_price']));
        $sales_prim = ($products_price * 10) / 100;

        $values = [
            "products_id" => $products_id,
            "clients_id" => $clients_id,
            "sales_prim" => $sales_prim,
            "sales_status" => 1
        ];

        $sql = $this->db->insert("sales", $values);

        return $sql;
    }

    public function salesModel($clients_id)
    {
        $sql = $this->db->wread("sales", "clients_id", $clients_id);
        $indis = 0;
        while ($sale = $sql->fetch(PDO::FETCH_ASSOC)) {
            $sales[$indis] = $sale;
            $sales[$indis]['products'] = $this->productsInfo($sale['products_id']);
            $sales[$indis]['clients'] = $this->clientsUpdate($clients_id);
            $indis++;
        }
        //echo "<pre>";
        //print_r($sales);
        //exit();
        return @$sales;
    }

    //CATEGORY
    public function category($category_id)
    {
        $sql = $this->db->wread("categories", "categories_id", $category_id);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}