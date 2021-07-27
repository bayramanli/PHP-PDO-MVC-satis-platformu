<?php
session_start();

class Database
{
    private $db;
    private $dbhost = DBHOST;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;
    private $dbname = DBNAME;


    function __construct()
    {

        try {

            $this->db = new PDO('mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname . ';charset=utf8', $this->dbuser, $this->dbpass);

//             echo "Bağlantı Başarılı";

        } catch (Exception $e) {

            die("Bağlantı Başarısız:" . $e->getMessage());
        }

    }

    public function addValue($argse)
    {

        $values = implode(',', array_map(function ($item) {
            return $item . '=?';
        }, array_keys($argse)));

        return $values;
    }


    public function insert($table, $values, $options = [])
    {

        try {

//             echo "<pre>";
//             print_r($values);
//             exit;

            if (isset($options['slug'])) {
                if (empty($values[$options['slug']])) {
                    $values[$options['slug']] = $this->seo($values[$options['title']]);
                } else {
                    $values[$options['slug']] = $this->seo($values[$options['slug']]);
                }
            }


            if (!empty($_FILES[$options['file_name']]['name'])) {

                $name_y = $this->imageUpload(
                    $_FILES[$options['file_name']]['name'],
                    $_FILES[$options['file_name']]['size'],
                    $_FILES[$options['file_name']]['tmp_name'],
                    $options['dir']
                );

                if (!$name_y['status']) {
                    return ['status' => FALSE, 'error' => $name_y['error']];
                    exit;
                } else {
                    $values += [$options['file_name'] => $name_y];
                }

            }


            if (isset($options['pass'])) {
                $values[$options['pass']] = md5($values[$options['pass']]);
            }
            // echo "<pre>";
            // print_r($values);
            // exit;


            unset($values[$options['form_name']]);


            $stmt = $this->db->prepare("INSERT INTO $table SET {$this->addValue($values)}");
            $stmt->execute(array_values($values));

            if ($stmt->rowCount()) {
                return ['status' => TRUE];
            } else {
                return ['status' => FALSE, 'error' => "Kayıt Başarısız"];
                exit;

            }

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];
        }

    }


    public function update($table, $values, $options = [])
    {

        try {


            if (isset($options['slug'])) {

                if (empty($values[$options['slug']])) {
                    $values[$options['slug']] = $this->seo($values[$options['title']]);
                } else {
                    $values[$options['slug']] = $this->seo($values[$options['slug']]);
                }
            }

            if (!empty($_FILES[$options['file_name']]['name'])) {

                $name_y = $this->imageUpload(
                    $_FILES[$options['file_name']]['name'],
                    $_FILES[$options['file_name']]['size'],
                    $_FILES[$options['file_name']]['tmp_name'],
                    $options['dir'],
                    $values[$options['file_delete']]
                );

                if (!$name_y['status']) {
                    return ['status' => FALSE, 'error' => $name_y['error']];
                    exit;
                } else {
                    $values += [$options['file_name'] => $name_y];
                }

            }

            //Eski Resim Dosyasının Değerini Temizleme...
            unset($values[$options['file_delete']]);


            /*
            // cookie işlemleri
            if (!empty($values[$options['pass']])) {
                $values[$options['pass']] = md5($values[$options['pass']]);
                setcookie("adminsLogin", json_encode($admins), strtotime("-30 day"), "/");

            } else {
                unset($values[$options['pass']]);
            }
            */
            unset($values[$options['pass']]);

            $columns_id = $values[$options['columns']];
            unset($values[$options['form_name']]);
            unset($values[$options['columns']]);
            $valuesExecute = $values;
            $valuesExecute += [$options['columns'] => $columns_id];


//             echo "<pre>";
//             print_r($values);
//
//             print_r($valuesExecute);
//             echo "<pre>";d
//             exit;


            $stmt = $this->db->prepare("UPDATE $table SET {$this->addValue($values)} WHERE {$options['columns']}=?");
            $stmt->execute(array_values($valuesExecute));

            if ($stmt->rowCount() > 0) {
                return ['status' => TRUE];
            } else {
                throw new Exception('İşlem Başarısız');
            }

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];
        }

    }


    public function delete($table, $columns, $values, $fileName = null)
    {


        try {

            if (!empty($fileName)) {
                unlink("dimg/$table/" . $fileName);
            }

            $stmt = $this->db->prepare("DELETE FROM $table WHERE $columns=?");
            $stmt->execute([htmlspecialchars($values)]);

            if ($stmt->rowCount() > 0) {
                return ['status' => TRUE];
            } else {
                throw new Exception('İşlem Başarısız');
            }

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];
        }

    }


    public function imageUpload($name, $size, $tmp_name, $dir, $file_delete = null)
    {

        try {

            $izinli_uzantilar = [
                'jpg',
                'jpge',
                'png',
                'ico'
            ];

            $ext = strtolower(substr($name, strpos($name, '.') + 1));

            if (in_array($ext, $izinli_uzantilar) === false) {
                throw new Exception('Bu dosya türü kabul edilmemektedir...');
            }

            if ($size > 1048576) {
                throw new Exception('Dosya boyutu çok büyük...');

            }


            $name_y = uniqid() . "." . $ext;

            if (!@move_uploaded_file($tmp_name, getcwd() . "/images/$dir/$name_y")) {
                throw new Exception('Dosya yükleme hatası...');
            }

//            echo getcwd()."/images/".$dir."/".$file_delete;
//            exit;
            if (!empty($file_delete)) {
                unlink(getcwd() . "/images/$dir/$file_delete");
                if (strstr($dir, "admin")) {
                    $_SESSION["admins"]["admins_file"] = $name_y;
                }
            }
            return $name_y;
        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }

    public function read($table, $options = [])
    {


        try {

            if (isset($options['columns_name']) && empty($options['limit'])) {

                $stmt = $this->db->prepare("SELECT * FROM $table order by {$options['columns_name']} {$options['columns_sort']}");

            } else if (isset($options['columns_name']) && isset($options['limit'])) {


                $stmt = $this->db->prepare("SELECT * FROM $table order by {$options['columns_name']} {$options['columns_sort']} limit {$options['limit']}");
            } else {

                $stmt = $this->db->prepare("SELECT * FROM $table");

            }


            $stmt->execute();

            return $stmt;

        } catch (Exception $e) {

            echo $e->getMessage();
            return false;
        }
    }


    public function wread($table, $columns, $values, $options = [])
    {


        try {

            $stmt = $this->db->prepare("SELECT * FROM $table WHERE $columns=?");
            $stmt->execute([htmlspecialchars($values)]);

            return $stmt;

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }


    public function seo($str, $options = array())
    {
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => true
        );
        $options = array_merge($defaults, $options);
        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
            'ÿ' => 'y',
            // Latin symbols
            '©' => '(c)',
            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z',
            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',
            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
        $str = trim($str, $options['delimiter']);
        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }

    //USERS
    //LOGIN
    public function usersLogin($users_email, $users_password)
    {

        //echo "<pre>";
        //echo $users_email;
        //echo $users_password;
        //exit;

        try {

            $stmt = $this->db->prepare("SELECT * FROM users WHERE users_email=? AND users_password=?");
            $stmt->execute([$users_email, md5($users_password)]);

            //echo "<pre>";
            //echo $stmt->rowCount();
            //exit;

            if ($stmt->rowCount() == 1) {

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $roles = $this->wread("roles", "roles_id", $row['roles_id']);
                $user_roles = $roles->fetch(PDO::FETCH_ASSOC);

                $_SESSION["users"] = [
                    "users_email" => $users_email,
                    "users_namesurname" => $row['users_name'] . ' ' . $row['users_surname'],
                    "users_id" => $row['users_id'],
                    "users_role" => $user_roles['roles_name']
                ];

                return ['status' => TRUE];

            } else {

                return ['status' => FALSE, 'error' => "Giriş Başarısız"];

            }

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];

        }

    }

    //LOGOUT
    public function usersLogout()
    {
        unset($_SESSION['users']);
        Header("Location:/login");
        exit;
    }


}

?>