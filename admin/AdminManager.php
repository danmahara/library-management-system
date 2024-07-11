<?php
// require_once('../config/DatabaseConnection.php');

require_once (__DIR__ . '/../config/DatabaseConnection.php');
class AdminManager extends DatabaseConnection
{
    public function __construct()
    {
        parent::__construct();
    }

    function isEmailTaken($email)
    {
        $response = [];
        if (empty($email)) {
            $response = [
                'success' => false,
                'message' => 'Email field is required'
            ];
            return json_encode($response);
        }

        $sql = "SELECT email FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function createUser($full_name, $email, $password, $usertype, $department = null)
    {
        $response = [];
        // chek if email is taken 
        if ($this->isEmailTaken($email)) {
            $response = [
                'success' => false,
                'message' => 'Email is already taken'
            ];
            return json_encode($response);
        }
        // Prepare SQL statement
        $sql = "INSERT INTO users (full_name, email, password, usertype, department) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            $response = [
                'success' => false,
                'message' => 'Database query failed'
            ];
            return json_encode($response);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("sssss", $full_name, $email, $password, $usertype, $department);
        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'User created successfully'
            ];
            header('Location:userLogin.php');
            exit();
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to create user'
            ];
        }

        $stmt->close();
        return json_encode($response);
    }



    function login($email, $password)
    {
        $response = [];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            $response = [
                'success' => false,
                'message' => 'Database query failed'
            ];
            return json_encode($response);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the hashed password using password_verify()
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                session_start(); // Start the session to manage user sessions
                switch ($user['usertype']) {
                    case 'student':
                        $_SESSION['user_type'] = $user['usertype'];
                        $_SESSION['student_name'] = $user['full_name'];
                        header('Location: student');
                        exit(); // break;
                    case 'admin':

                        $_SESSION['admin_name'] = $user['full_name'];
                        $_SESSION['user_type'] = $user['usertype'];
                        header('Location: admin');
                        exit();  // break;
                    case 'librarian':

                        $_SESSION['librarian_name'] = $user['full_name'];
                        $_SESSION['user_type'] = $user['usertype'];
                        header('Location: librarian');
                        exit();  // break;
                    default:
                        header('Location:../userLogin.php');
                        break;
                }


                $response = [
                    'success' => true,
                    'message' => 'Login successful',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Invalid password',
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'No user found with this email',
            ];
        }

        $stmt->close();
        return json_encode($response);
    }

    function studentsList()
    {
        $response = [];

        // Prepare SQL statement
        try {

            $sql = "SELECT user_id,full_name, email, usertype, department FROM users where usertype='student'";
            $result = $this->conn->query($sql);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $response['data'][] = $row; // Add each product to the array
            }
            $response['success'] = true;
            $response['message'] = 'Data found';
        } else {
            $response = [
                'success' => false,
                'message' => "No students found"
            ];
        }

        // Return the response in JSON format
        return json_encode($response);
    }

    function deleteStudent($student_id)
    {
        $response = [];
        $sql = "DELETE FROM users where user_id='$student_id'";
        $result = $this->conn->query($sql);
        if ($result) {
            $response = [
                'success' => true,
                'message' => 'Deleted successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to delete'
            ];
        }
        return json_encode($response);
    }
    function logout()
    {
        session_destroy();
        header('Location:../userLogin.php');
    }

}
?>