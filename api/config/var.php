<?php
        //Pour la connexion à la base de donnée
        $this->config["host"] = 'localhost';
        $this->config["db_name"] = 'campus_fr';
        $this->config["username"] = 'root';
        $this->config["password"] = '';
$this->config["tables"] = ['campus_reviews','country','highschool','highschool_more','roles','student','study_to_france','university','users',];

$this->config['tables']['campus_reviews'] = ['id','educational_advice','educational_level','choice_relevance','french_level','english_level','other_languages','comment','student',];

$this->config['tables']['campus_reviews']['id'] = ['id'];

$this->config['tables']['country'] = ['id','iso','name','nicename','iso3','numcode','phonecode',];

$this->config['tables']['campus_reviews']['id'] = ['id'];$this->config['tables']['country']['id'] = ['id'];

$this->config['tables']['highschool'] = ['id','name','classroom','classroom_type','average','year_BAC','student',];

$this->config['tables']['campus_reviews']['id'] = ['id'];$this->config['tables']['country']['id'] = ['id'];$this->config['tables']['highschool']['id'] = ['id'];

$this->config['tables']['highschool_more'] = ['id','classroom','type_classroom','average','year_classroom','highschool',];

$this->config['tables']['campus_reviews']['id'] = ['id'];$this->config['tables']['country']['id'] = ['id'];$this->config['tables']['highschool']['id'] = ['id'];$this->config['tables']['highschool_more']['id'] = ['id'];

$this->config['tables']['roles'] = ['id_roles','types','read_role','write_role','user',];

$this->config['tables']['campus_reviews']['id'] = ['id'];$this->config['tables']['country']['id'] = ['id'];$this->config['tables']['highschool']['id'] = ['id'];$this->config['tables']['highschool_more']['id'] = ['id'];$this->config['tables']['roles']['id'] = ['id_roles'];

$this->config['tables']['student'] = ['id','firstname','lastname','gender','phone_number_1','phone_number_2','email','birthdate','nationality','profession','profession_father','profession_mother','password_','last_comming','date_comming','is_submitted',];

$this->config['tables']['campus_reviews']['id'] = ['id'];$this->config['tables']['country']['id'] = ['id'];$this->config['tables']['highschool']['id'] = ['id'];$this->config['tables']['highschool_more']['id'] = ['id'];$this->config['tables']['roles']['id'] = ['id_roles'];$this->config['tables']['student']['id'] = ['id'];

$this->config['tables']['study_to_france'] = ['id','type','city','university','degree','visa','finacement','description','student',];

$this->config['tables']['campus_reviews']['id'] = ['id'];$this->config['tables']['country']['id'] = ['id'];$this->config['tables']['highschool']['id'] = ['id'];$this->config['tables']['highschool_more']['id'] = ['id'];$this->config['tables']['roles']['id'] = ['id_roles'];$this->config['tables']['student']['id'] = ['id'];$this->config['tables']['study_to_france']['id'] = ['id'];

$this->config['tables']['university'] = ['id','cycle','universities','faculty','domain','average','degree','degree_year','student',];

$this->config['tables']['campus_reviews']['id'] = ['id'];$this->config['tables']['country']['id'] = ['id'];$this->config['tables']['highschool']['id'] = ['id'];$this->config['tables']['highschool_more']['id'] = ['id'];$this->config['tables']['roles']['id'] = ['id_roles'];$this->config['tables']['student']['id'] = ['id'];$this->config['tables']['study_to_france']['id'] = ['id'];$this->config['tables']['university']['id'] = ['id'];

$this->config['tables']['users'] = ['id_user','last_name','first_name','email','phone_number','password_','code','last_comming','date_comming',];

$this->config['tables']['campus_reviews']['id'] = ['id'];$this->config['tables']['country']['id'] = ['id'];$this->config['tables']['highschool']['id'] = ['id'];$this->config['tables']['highschool_more']['id'] = ['id'];$this->config['tables']['roles']['id'] = ['id_roles'];$this->config['tables']['student']['id'] = ['id'];$this->config['tables']['study_to_france']['id'] = ['id'];$this->config['tables']['university']['id'] = ['id'];$this->config['tables']['users']['id'] = ['id_user'];
