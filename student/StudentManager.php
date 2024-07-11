<?php
require_once (__DIR__ . '/../config/DatabaseConnection.php');

class StudentManager extends DatabaseConnection
{
    function __construct()
    {
        parent::__construct();
    }

    public function studentLogin($email, $password)
    {
        $response = [];

        // Check if email or password is empty
        if (empty($email) || empty($password)) {
            $response = [
                'success' => false,
                'error' => 'Login Failed',
                'message' => "All fields are required"
            ];
            return json_encode($response);
        }

        // Prepare the SQL statement
        $sql_user_login = "SELECT * FROM students WHERE email=? OR phone_number=?";
        $stmt = $this->conn->prepare($sql_user_login);

        if (!$stmt) {
            // Handle the case where preparing the statement fails
            $response = [
                'success' => false,
                'error' => 'Database Error',
                'message' => "Failed to prepare the SQL statement"
            ];
            return json_encode($response);
        }


        // $hashedPassword=password_hash($password,DEFAULT_PASSWORD);

        // Bind parameters and execute the statement
        $stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $result_login = $stmt->get_result();

        if ($result_login->num_rows === 1) {
            $userDetails = $result_login->fetch_assoc();
            $hashedPasswordFromDatabase = $userDetails['password'];

            if (password_verify($password, $hashedPasswordFromDatabase)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['student_id'] = $userDetails['student_id'];
                $_SESSION['full_name'] = $userDetails['full_name'];


                $response['success'] = true;
                $response['message'] = "Logged in successfully";

                // Redirect to buyer dashboard
                header('Location: bdashboard.php');
                exit();
            } else {
                $response = [
                    'success' => false,
                    'error' => 'Login Failed',
                    'message' => 'Email or Password do not match'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'error' => 'Login Failed',
                'message' => 'User not found'
            ];
        }

        return json_encode($response);
    }

    public function getTotalStudents()
    {

        $sql = "SELECT COUNT(*) as total FROM users where usertype='student'";
        $result = $this->conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row["total"];
        } else {
            return 0;
        }
    }

    function logout()
    {
        session_destroy();
        header('Location:../userLogin.php');
    }
}
?>