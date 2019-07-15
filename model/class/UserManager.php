<?php
require_once('Manager.php');

class UserManager extends Manager
{

    // Accept a user ID and returns true if user is admin and false if otherwise
    public static function isAdmin($user_id)
    {
        $sql = "SELECT * FROM users WHERE id=? AND role_id IS NOT NULL LIMIT 1";
        $user = self::getSingleRecord($sql, [$user_id]); // get single user from database
        if (!empty($user)) {
            return true;
        } else {
            return false;
        }
    }

    private static function loginById($user_id)
    {
        //die(print_r($user_id));
        $sql = "SELECT u.id, u.role_id, u.username, r.name as role FROM users u LEFT JOIN roles r ON u.role_id=r.id WHERE u.id=? LIMIT 1";
        $user = self::getSingleRecord($sql, [$user_id]);
        //print_r($user);
        if (!empty($user)) {
            // put logged in user into session array
            $_SESSION['user'] = $user;
            $_SESSION['success_msg'] = "You are now logged in";
            //die(print_r($user_id));
            // if user is admin, redirect to dashboard, otherwise to homepage
            if (self::isAdmin($user_id)) {
                $permissionsSql = "SELECT p.name as permission_name FROM permissions as p
                            JOIN permission_role as pr ON p.id=pr.permission_id
                            WHERE pr.role_id=?";
                $userPermissions = self::getMultipleRecords($permissionsSql, [$user['role_id']]);
                $_SESSION['userPermissions'] = $userPermissions;
                header('location: ' . BASE_URL . 'admin/dashboard.php');
            } else {
                header('location: index.php');
            }
            exit(0);
        }
    }

    // Accept a user object, validates user and return an array with the error messages
    private static function validateUser($user)
    {
        $errors = [];
        // password_ confirmation
        if (isset($user['passwordConf']) && ($user['password_'] !== $user['passwordConf'])) {
            $errors['passwordConf'] = "The two passwords do not match";
        }
        // if passwordOld was sent, then verify old password_
        if (isset($user['passwordOld']) && isset($user['user_id'])) {
            $sql = "SELECT * FROM users WHERE id=? LIMIT 1";
            $oldUser = self::getSingleRecord($sql, [$user['user_id']]);
            $prevPasswordHash = $oldUser['password_'];
            if (!password_verify($user['passwordOld'], $prevPasswordHash)) {
                $errors['passwordOld'] = "The old password_ does not match";
            }
        }
        
        if (!empty($user['passwordConf'])) {
            // the email should be unique for each user for cases where we are saving admin user or signing up new user
            $oldUser = self::file_get_data(API_ROOT_PATH . '/users/email/' . $user['email']);
            if (!$oldUser['error']) {
                $errors['email'] = "Email already exists";
            }
        }

        // required validation
        foreach ($user as $key => $value) {
            if (empty($user[$key])) {
                $errors[$key] = "This field is required";
            }
        }
        return $errors;
    }
    // upload's user profile profile picture and returns the name of the file
    private static function uploadProfilePicture($file)
    {
        // if file was sent from signup form ...
        if (!empty($file) && !empty($file['profile_picture']['name'])) {
            // Get image name
            $profile_picture = date("Y.m.d") . $file['profile_picture']['name'];
            // define Where image will be stored
            $target = "public/img/" . $profile_picture;
            // upload image to folder
            if (move_uploaded_file($file['profile_picture']['tmp_name'], $target)) {
                return $profile_picture;
                exit();
            } else {
                echo "Failed to upload image";
            }
        }
    }

    public static function addUser($data, $file)
    {
        // variable declaration
        $errors  = [];
        // validate form values
        $errors = self::validateUser($data);

        // receive all input values from the form. No need to escape... bind_param takes care of escaping
        
        $data['password_'] = password_hash($data['password_'], PASSWORD_DEFAULT); //encrypt the password_ before saving in the database
        $data['profile_picture'] = self::uploadProfilePicture($file);
        $data['created_at'] = date('Y-m-d H:i:s');
        print_r($data);
        // if no errors, proceed with signup
        if (count($errors) === 0) {
            unset($data['passwordConf']);
            $res = self::file_post_contents(API_ROOT_PATH . '/users', $data);
            //die(print_r($data));
            //die(print_r($res));
            $res = json_decode($res);
            $res = (array) $res;
            // insert user into database
            if (!$res['error']) {
                $user_id = self::file_get_data(API_ROOT_PATH . '/users/id/last');
                $user_id = $user_id['data']['id'];
                self::loginById($user_id);
            } else {
                $_SESSION['error_msg'] = "Database error: Could not register user";
            }
        }
        return $errors;
    }

    public static function connectUser($data)
    {
        //die(print_r($data));
        // validate form values
        $errors = self::validateUser($data);

        if (empty($errors)) {
            $url = API_ROOT_PATH . '/users/email/' . $data['email'];
            $user = self::file_get_data($url);
            // echo($url);
            //  die(print_r($user));
            // $user = json_decode($user);
            // $user = (array) $user;

            if (!$user['error']) { // if user was found
                $user = $user['data'][0];
                $hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';
                //print_r($data['password_']);
                echo(trim($data['password_']));
                if (password_verify($data['password_'], $user['password_'])) { // if password_ matches
                    // log user in
                    //die(print_r($data));
                    self::loginById($user['id']);
                } else { // if password_ does not match
                    $_SESSION['error_msg'] = "Wrong credentials password_";
                }
            } else { // if no user found
                $_SESSION['error_msg'] = "Wrong credentials";
            }
        }
    }
}
