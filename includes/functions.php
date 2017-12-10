<?php
// AUTHOR: Alireza MEGHDADI, includes adaptations from LYNDA course PHP AND MYSQL ESSENTIAL TRAINING by KEVIN SKOGLUND

    $errors = array();

    // Form validation functions
    function fieldname_as_text ($fieldname) {
        $fieldname = str_replace("_", " ", $fieldname);
        $fieldname = ucfirst($fieldname);
        return $fieldname;
    }

    function has_presence($value) {
	return isset($value) && $value !== "";
    }

    function validate_presence ($required_fields) {
    global $errors;
        foreach($required_fields as $field) {
        $input = trim($_POST[$field]);
            if (!has_presence($input)) {
                $errors[$field] = fieldname_as_text($field) . " can't be blank";
            }
        }
    }

    function has_max_length($value, $max) {
	return strlen($value) <= $max;
    }

    function validate_max_length ($fields_with_max_lengths) {
	global $errors;
        foreach($fields_with_max_lengths as $field => $max) {
        $input = trim($_POST[$field]);
            if (!has_max_length($input, $max)) {
            $errors[$field] = fieldname_as_text($field) . " is too long";
            }
        }
    }

    function check_user_exists($postcode){
        global $connection;
        global $errors;
        $db_compatible_postcode = strtoupper(str_replace(" ", "", mysql_prep($postcode)));
        $query  = "SELECT postcode FROM users ";
        $query .= "WHERE postcode = '{$db_compatible_postcode}'";

        $result = mysqli_query($connection, $query);

        $exitin_postcode = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) > 0) {
            $errors["user"] = "User already exists";
        }
        mysqli_free_result($result);
    }

    // Display Form errors
    function display_form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}

    function mysql_prep($string) {
        global $connection;

        $escaped_string = mysqli_real_escape_string($connection, $string);
        return $escaped_string;
    }

    function redirect_to ($new_location) {
        header("Location: " . $new_location);
        exit;
    }

    function confirm_query($result_set) {
        if (!$result_set) {
            die("Database query failed!");
        }
    }

    // Log in functions
    function find_user_by_email($email) {

        global $connection;
		$safe_email = mysqli_real_escape_string($connection, $email);

		$query  = "SELECT * ";
		$query .= "FROM users ";
		$query .= "WHERE email = '{$safe_email}' ";
		$query .= "LIMIT 1";
		$user_set = mysqli_query($connection, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user;
		} else {
			return null;
		}
	}

    function login($email, $password) {

        // Find user
		$user = find_user_by_email($email);
		if ($user) {

			if (password_verify($password,$user["hashed_password"])) {
				return $user;
			} else {

				// Password does not match
				return false;
			}
		} else {
			// User not found
			return false;
		}
	}

    function logged_in() {
		return isset($_SESSION['user_id']);
	}

    function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to ("login.php");
		}
	}
?>
