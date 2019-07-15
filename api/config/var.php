<?php
        //Pour la connexion à la base de donnée
        $this->config["host"] = 'localhost';
        $this->config["db_name"] = 'admin';
        $this->config["username"] = 'root';
        $this->config["password_"] = '';
$this->config["tables"] = ['roles','users',];

$this->config['tables']['roles'] = ['id','name','description',];

$this->config['tables']['roles']['id'] = ['id'];

$this->config['tables']['users'] = ['id','role_id','username','email','password_','profile_picture','created_at','updated_at',];

$this->config['tables']['roles']['id'] = ['id'];$this->config['tables']['users']['id'] = ['id'];
