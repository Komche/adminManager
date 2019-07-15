<?php

class Table
{

    private $table;
    private $fields = [];
    private $values = [];
    private $property;
    private $val;
    private $db;
    private static $results = [];
    private $playload;
    private $key;

    public function __construct($db, $table, $fields = [null], $values = [null], $property = null, $val = null, $playload = null, $key = null)
    {
        $this->db = $db;
        $this->table = $table;
        $this->fields = $fields;
        $this->values = $values;
        $this->property = $property;
        $this->val = $val;
        $this->playload = $playload;
        $this->key = $key;
        self::$results['error'] = false;
        self::$results['message'] = "Tout s'est bien déroulé";
    }


    /**
     * get data format json
     * 
     * @return json_encode($result)
     */
    public function getData()
    {
        $query = "SELECT * FROM $this->table ";
        if ($this->property != null && $this->val != null) {
            if ($this->val === 'last') {
                $this->lastID($this->table, $this->property);
            } elseif ($this->val === 'distinct') {
                $this->distinct($this->table, $this->property);
            } else {
                $query .= "WHERE $this->property=:$this->property";

                $req = $this->db->prepare($query);

                $req->execute([$this->property => $this->val]);
                if (self::$results['data'] = $req->fetchAll(PDO::FETCH_ASSOC)) {
                    http_response_code(200);

                    return json_encode(self::$results);
                } else {
                    $this->throwError(404, "Une erreur s'est produite ou enregistrement non trouvé", true);
                }
            }
        } else {
            $req = $this->db->query($query);
            if (self::$results['data'] = $req->fetchAll(PDO::FETCH_ASSOC)) {
                    http_response_code(200);

                    return json_encode(self::$results);
            } else {
                $this->throwError(404, "Une erreur s'est produite ou enregistrement non trouvé", true);
            }
        }
    }

    /**
     * insert data
     * 
     * @param array|null $required
     * @return void
     */
    public function insert($required = null)
    {
        if ($required !== null) {
            //print_r($this->values); die();
            foreach ($this->values as $key => $value) {

                for ($i = 0; $i < count($required); $i++) {
                    if ($required[$i] == $key) {
                        unset($required[$i]);

                        $required[$key] = $value;
                    }
                }
            }
            $this->is_not_empty($required);
        }
        $values = $this->values;
        if (count($values) > 0) {
            end($values);
            $last = key($values);
            $sql = "INSERT INTO $this->table(";
            foreach ($values as $key => $field) {
                if ($last != $key) {
                    $sql .= $key . ", ";
                } else {
                    $sql .= $key . ") ";
                }
            }
            $sql .= "VALUES(";
            foreach ($values as $key => $field) {
                if ($last != $key) {
                    $sql .= ":$key, ";
                } else {
                    $sql .= ":$key)";
                }
            }
            //s'il existe un champs password_ il sera crypter
            // if (array_key_exists('password_', $this->values)) {
            //     $this->values['password_'] = password_hash($this->values['password_'], PASSWORD_BCRYPT);
            // }

            //s'il existe un champ email il sera verifer s'il est au bon format
            if (array_key_exists('email', $this->values)) {
                if (!filter_var($this->values['email'], FILTER_VALIDATE_EMAIL))
                    $this->throwError(503, "Cette adresse email n'est pas au bon format", true);
            }
            $req = $this->db->prepare($sql);
            if (!empty($this->values)) {
                if ($req->execute($this->values)) {
                    $this->throwError(201, "Enregistrement effectué avec succès");
                } else {
                    $this->throwError(503, "Enregistrement échoué", true);
                }
            } else {
                $this->throwError(400, "Un ou plusieurs champs mal renseigner", true);
            }
        }
    }

    /**
     * update data
     * 
     * @return void
     */
    public function update()
    {

        if (count($this->values) > 0) {
            $temp  = array_keys($this->values);
            $last_key = end($temp);
            $sql = "UPDATE $this->table SET ";
            foreach ($this->values as $key => $field) {
                if ($last_key != $key) {
                    $sql .= "$key=:$key, ";
                } else {
                    $sql .= "$key=:$key ";
                }
            }
            $sql .= "WHERE $this->property=:$this->property";

            //s'il existe un champs password_ il sera crypter
            // if (array_key_exists('password_', $this->values)) {
            //     $this->values['password_'] = password_hash($this->values['password_'], PASSWORD_BCRYPT);
            // }

            $this->values[$this->property] = $this->val;

            $req = $this->db->prepare($sql);
            if ($req->execute($this->values)) {
                $this->throwError(200, "Enregistrement modifié avec succès");
            } else {
                $this->throwError(503, "modification échouée", true);
            }
        }
    }

    /**
     * delete row data
     * 
     * @return void
     */
    public function delete()
    {
        if ($this->is_not_use($this->table, $this->property, $this->val)) {
            $this->throwError(503, "Cet enregistrement n'existe pas", true);
        }
        $sql = "DELETE FROM $this->table WHERE $this->property=?";
        $del = $this->db->prepare($sql);
        if ($del->execute([$this->val])) {
            $this->throwError(200, "Enregistrement supprimer avec succès");
        } else {
            $this->throwError(503, "Suppression échouée", true);
        }
    }

    /**
     * check if fields is empty
     * 
     * @param array $fields
     * @return boolean
     */
    public function is_not_empty($fields = [])
    {
        if (count($fields) != 0) {
            foreach ($fields as $key => $field) {
                if (empty($field) && trim($field) == "") {
                    $this->throwError(503, "$key est vide");
                    return false;
                }
            }
            return true;
        }
    }

    /**
     * get the last id of table
     * 
     * @param mixed $table
     * @param mixed $field
     * @return array
     */
    public function lastID($table, $fields)
    {
        $sql = "SELECT $fields FROM $table ORDER BY $fields DESC LIMIT 1;";
        $req = $this->db->query($sql);

        if (self::$results['data'] = $req->fetch(PDO::FETCH_ASSOC)) {
            echo json_encode(self::$results);
        }
    }

    /**
     * get the last id of table
     * 
     * @param mixed $table
     * @param mixed $field
     * @return array
     */
    public function distinct($table, $fields)
    {
        $sql = "SELECT DISTINCT $fields FROM $table ORDER BY $fields DESC;";
        $req = $this->db->query($sql);

        if (self::$results['data'] = $req->fetchAll(PDO::FETCH_ASSOC)) {
            echo json_encode(self::$results);
        }
    }

    /**
     * check if row exist in a table
     * 
     * @param mixed $table
     * @param mixed $field
     * @param mixed $value
     * @return boolean
     */
    public function is_not_use($table, $field, $value)
    {
        $sql = "SELECT * FROM $table WHERE $field=:value";

        $req = $this->db->prepare($sql);
        $req->execute(array('value' => $value));
        if ($req->fetch()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * error manager
     * 
     * @param int|null $code
     * @param mixed $message
     * @param boolean|false $is_error
     * @return json_encode($result)
     */
    public static function throwError($code = null, $message, $is_error = false)
    {
        if (array_key_exists('data', self::$results))
            unset(self::$results['data']);
        http_response_code($code);
        self::$results['error'] = $is_error;
        self::$results['message'] = $message;
        echo json_encode(self::$results);
        die();
    }
}
