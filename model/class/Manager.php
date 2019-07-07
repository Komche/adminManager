<?php
class Manager{

    protected static function bdd()
    {
        $dbname = 'akoybizc_campus_fr';
        $user = 'akoybizc_komche';
        $pass = '@damoukomche2019';
        if ($_SERVER["SERVER_NAME"] == 'localhost') {
            $dbname = 'admin';
            $user = 'root';
            $pass = '';
        }
        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8", "$user", "$pass", $pdo_options);
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
        return $bdd;
    }
}
