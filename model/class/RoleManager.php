<?php
require_once('Manager.php');

class RoleManager extends Manager
{

    // Save role to database
    public function saveRole($data)
    {
        global $errors;
        $errors = self::validateRole($_POST);
        if (count($errors) === 0) {
            // receive form values
            $url = API_ROOT_PATH . '/roles';
            $result = Manager::file_post_contents($url, $data);
            $result = json_decode($result);
            $result = (array) $result;
            if (!$result['error']) {
                $_SESSION['success_msg'] = "Role created successfully";
                header("location: index.php?action=roleList");
                exit(0);
            } else {
                $_SESSION['error_msg'] = "Something went wrong. Could not save role in Database";
            }
        }
    }
    public function updateRole($role_id, $data)
    {
        global $conn, $errors, $name, $isEditting; // pull in global form variables into public function
        $errors = self::validateRole($_POST); // validate form
        if (count($errors) === 0) {
            // receive form values
            $url = API_ROOT_PATH . "/roles/$role_id";
            $result = self::file_put_contents($url, $data);

            if (!$result['error']) {
                $_SESSION['success_msg'] = "Role successfully updated";
                $isEditting = false;
                header("location: index.php?action=roleList");
                exit(0);
            } else {
                $_SESSION['error_msg'] = "Something went wrong. Could not save role in Database";
            }
        }
    }
    public function editRole($role_id)
    {
        global  $isEditing;
        $url = API_ROOT_PATH . '/roles/id/' . $role_id;
        $role = self::file_get_data($url);
        if (!$role['error']) {
            $isEditing = true;
            $role = $role['data'][0];
            return $role;
        }
    }
    public function deleteRole($role_id)
    {
        $sql = "DELETE FROM roles WHERE id=?";
        $result = Manager::modifyRecord($sql,  [$role_id]);
        if ($result) {
            $_SESSION['success_msg'] = "Role trashed!!";
            header("location: index.php?action=roleList");
            exit(0);
        }
    }

    public static function validateRole($role)
    {
        global $conn;
        $errors = [];
        foreach ($role as $key => $value) {
            if (empty($role[$key])) {
                $errors[$key] = "This field is required";
            }
        }
        return $errors;
    }

    public static function getAllRoles()
    {
        $url = API_ROOT_PATH . '/roles';
        $data = Manager::file_get_data($url);
        if (!$data['error']) {
            $data = $data['data'];
            return $data;
        } else {
            $errors['message'] = $data['message'];
            return $errors;
        }
    }
}
