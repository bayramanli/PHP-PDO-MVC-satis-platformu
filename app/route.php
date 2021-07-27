<?php
App::getAction('/', '/', false);
App::getAction('/404', '/default/page404', false);
//App::getAction('/index','/default/index');

/* Admin Panel İşlemleri*/
//Admin
App::getAction('/admin', '/admin/index',true, "backend");

//USERS
App::getAction('/admin/users', '/admin/users', true, "backend");
App::getAction('/admin/users/update/([0-9a-zA-z-_]+)','/admin/usersUpdate/([0-9a-zA-z-_]+)',true,"backend");
App::postAction('/admin/users/update/usersUpdateOp','/admin/usersUpdateOp',true,"backend");
App::getAction('/admin/users/delete/([0-9a-zA-z-_]+)','/admin/usersDelete/([0-9a-zA-z-_]+)',true,"backend");

//CLIENTS
App::getAction('/admin/clients/([0-9a-zA-z-_]+)', '/admin/clients/([0-9a-zA-z-_]+)', true, "backend");
App::getAction('/admin/clients/update/([0-9a-zA-z-_]+)','/admin/clientsUpdate/([0-9a-zA-z-_]+)',true,"backend");
App::postAction('/admin/clients/update/clientsUpdateOp','/admin/clientsUpdateOp',true,"backend");

//CATEGORY
App::getAction('/admin/category','/admin/category',true,"backend");
App::getAction('/admin/category/insert','/admin/categoryInsert',true,"backend");
App::postAction('/admin/category/insert/categoryInsertOp','/admin/categoryInsertOp',true,"backend");
App::getAction('/admin/category/update/([0-9a-zA-z-_]+)','/admin/categoryUpdate/([0-9a-zA-z-_]+)',true,"backend");
App::postAction('/admin/category/update/categoryUpdateOp','/admin/categoryUpdateOp',true,"backend");
App::getAction('/admin/category/delete/([0-9a-zA-z-_]+)','/admin/categoryDelete/([0-9a-zA-z-_]+)',true,"backend");

//PRODUCTS
App::getAction('/admin/products/([0-9a-zA-z-_]+)','/admin/products/([0-9a-zA-z-_]+)',true,"backend");
App::getAction('/admin/products/insert/([0-9a-zA-z-_]+)','/admin/productsInsert/([0-9a-zA-z-_]+)',true,"backend");
App::postAction('/admin/products/insert/productsInsertOp','/admin/productsInsertOp',true,"backend");
App::getAction('/admin/products/update/([0-9a-zA-z-_]+)','/admin/productsUpdate/([0-9a-zA-z-_]+)',true,"backend");
App::postAction('/admin/products/update/productsUpdateOp','/admin/productsUpdateOp',true,"backend");
App::getAction('/admin/products/delete/([0-9a-zA-z-_]+)','/admin/productsDelete/([0-9a-zA-z-_]+)',true,"backend");

//SALES
App::getAction('/admin/sales', '/admin/sales', true, "backend");

/* /Admin Panel İşlemleri*/

/* User Panel İşlemleri*/
//USERS
App::getAction('/login', '/default/login');
App::postAction('/login', '/default/loginControl');
App::getAction('/logout', '/default/logout');
App::getAction('/register', '/default/register');
App::postAction('/registerOp', '/default/usersInsertOp');
App::getAction('/dashboard','/default/index', true, "frontend");

//CLIENTS
App::getAction('/clients','/default/clients',true,"frontend");
App::getAction('/clients/insert','/default/clientsInsert',true,"frontend");
App::postAction('/clients/insert/clientsInsertOp','/default/clientsInsertOp',true,"frontend");
App::getAction('/clients/update/([0-9a-zA-z-_]+)','/default/clientsUpdate/([0-9a-zA-z-_]+)',true,"frontend");
App::postAction('/clients/update/clientsUpdateOp','/default/clientsUpdateOp',true,"frontend");
App::getAction('/clients/delete/([0-9a-zA-z-_]+)','/default/clientsDelete/([0-9a-zA-z-_]+)',true,"frontend");

//PRODUCTS
App::getAction('/products', '/default/products', true, "frontend");
App::getAction('/products/sales/([0-9a-zA-z-_]+)', '/default/productsSales/([0-9a-zA-z-_]+)', true, "frontend");
App::postAction('/products/sales/salesOp', '/default/productsSalesOp', true, "frontend");
App::getAction('/sales', '/default/sales', true, "frontend");

/* /User Panel İşlemleri*/