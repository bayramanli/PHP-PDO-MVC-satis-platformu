<?php

class adminModel extends mainModel
{
    public function indexModel()
    {

    }

    //USERS
    public function usersModel()
    {
        $sql = $this->db->read("users");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usersUpdate($users_id)
    {
        $sql = $this->db->wread("users", "users_id", $users_id);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function usersUpdateOp()
    {

        $sql = $this->db->update("users", $_POST, [
                "form_name" => "users_update",
                "columns" => "users_id"

            ]
        );

        return $sql;
    }

    public function usersDelete($users_id)
    {
        $sql = $this->db->delete("users", "users_id", $users_id);
        return $sql;

    }

    public function usersRoles()
    {
        $sql = $this->db->read("roles");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    //CLIENTS
    public function clientsModel($users_id)
    {
        $sql = $this->db->wread("clients", "users_id", $users_id);
        //echo "<pre>";
        //print_r($cq);
        //exit();
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

    //CATEGORY
    public function categoryModel()
    {
        $sql = $this->db->read("categories",
            [
                "columns_name" => "categories_id",
                "columns_sort" => "ASC"
            ]
        );
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function categoryInsertOp()
    {
        $sql = $this->db->insert("categories", $_POST,
            [
                "form_name" => "category_insert"
            ]
        );
        return $sql;
    }

    public function categoryUpdate($category_id)
    {
        $sql = $this->db->wread("categories", "categories_id", $category_id);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function categoryUpdateOp()
    {

        $sql = $this->db->update("categories", $_POST, [
                "form_name" => "category_update",
                "columns" => "categories_id"

            ]
        );

        return $sql;
    }

    public function categoryDelete($category_id)
    {
        $sql = $this->db->delete("categories", "categories_id", $category_id);
        return $sql;

    }

    //PRODUCTS
    public function productsModel($category_id)
    {
        $sql = $this->db->wread("products", "categories_id", $category_id);
        //echo "<pre>";
        //print_r($cq);
        //exit();
        $indis = 0;
        while ($product = $sql->fetch(PDO::FETCH_ASSOC)) {
            $products[$indis] = $product;
            $indis++;
        }
        //echo "<pre>";
        //print_r($products);
        //exit();
        return @$products;
    }

    public function productsInsertOp()
    {
        $sql = $this->db->insert("products", $_POST,
            [
                "form_name" => "products_insert"
            ]
        );
        return $sql;
    }

    public function productsUpdate($products_id)
    {
        $sql = $this->db->wread("products", "products_id", $products_id);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function productsUpdateOp()
    {

        $sql = $this->db->update("products", $_POST, [
                "form_name" => "products_update",
                "columns" => "products_id"

            ]
        );

        return $sql;
    }

    public function productsDelete($products_id)
    {
        $sql = $this->db->delete("products", "products_id", $products_id);
        return $sql;

    }

    //SALES
    public function salesModel()
    {
        $sql = $this->db->read("sales",
            [
                "columns_name" => "sales_id",
                "columns_sort" => "DESC"
            ]
        );
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}