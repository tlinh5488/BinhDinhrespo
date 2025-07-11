<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/BinhDinhNews/app/config/database.php';

    class UserDAO{
        private $conn;
        public function setConnection($conn) 
        {
            $this->conn = $conn;
        }

        function getConnection()
        {
            $dbConnect =  new DatabaseConnection();
            return $dbConnect->getConnection();
        }

        public function checkPassword($uid, $password) {
            $conn = $this->getConnection();
            $sql = "SELECT * FROM userdata WHERE UserID = ? AND PassWord = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $hashedPassword = hash('sha256', $password);
            $stmt->bind_param("is", $uid, $hashedPassword);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        
        function getUserByAuthCokkies($authcode){
            $conn = $this->getConnection();
            $sql = "Select * from UserData where AuthCookies = '".$authcode."'";
            $result = mysqli_query($conn, $sql);

            mysqli_close($conn);
            return $result;
        }

        function getUserByEmail($email){
            $conn = $this->getConnection();
            $sql = $conn->prepare("Select * from UserData where email = ?");
            $sql->bind_param("s", $email);
            $sql->execute();
            $result = $sql->get_result();
            $data = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            return $data;
        }

        function getAuthorInfo($uid)
        {
            $conn = $this->getConnection();
            $sql = "SELECT * FROM userdata WHERE UserID = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                mysqli_close($conn);
                return null;
            }
            $stmt->bind_param("s", $uid);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                $stmt->close();
                mysqli_close($conn);
                return $data;
            } else {
                $stmt->close();
                mysqli_close($conn);
                return null;
            }
        }
        // function updateAuthorInfo($uid, $fullname, $sdt,$email , $cccd, $adias, $organ, $role )
        // {
        //     $conn = $this->getConnection();
        //     $sql = "UPDATE `userdata` 
        //             SET `Email`='" . $email . "',
        //                 `FullName`='" . $fullname . "',
        //                 `Phone`='" . $sdt . "',
        //                 `Alias`='" . $adias . "',
        //                 `Organization`='" . $organ . "',
        //                 `CCCD`='" . $cccd . "',
        //                  `ROLE` = '".$role."'   
        //             WHERE `UserID`='" . $uid . "'";
        //      if(mysqli_query($conn, $sql))
        //      {
        //         mysqli_close($conn);
        //         return true;
        //      }
        //      mysqli_close($conn);
        //      return false;
             

        // }
        function updateAuthorInfo($uid, $fullname, $sdt, $email, $cccd, $adias, $organ, $role)
        {
            $conn = $this->getConnection();

            $sql = "UPDATE `userdata` 
                    SET `Email` = ?, 
                        `FullName` = ?, 
                        `Phone` = ?, 
                        `Alias` = ?, 
                        `Organization` = ?, 
                        `CCCD` = ?, 
                        `ROLE` = ?
                    WHERE `UserID` = ?";

            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                mysqli_close($conn);
                return false;
            }

            $stmt->bind_param("ssssssss", $email, $fullname, $sdt, $adias, $organ, $cccd, $role, $uid);

            $result = $stmt->execute();
            $stmt->close();
            mysqli_close($conn);

            return $result;
        }
        function updateAuthorAvatar($uid, $img)
        {
            $conn = $this->getConnection();
            $sql = "UPDATE `userdata` 
            SET `user_img` = '".$img."'
             WHERE `UserID`='".$uid."'";
             if(mysqli_query($conn, $sql))
             {
                mysqli_close($conn);
                return true;
             }
             mysqli_close($conn);
             return false;
        }

        public function isUsernameOrEmailExists($username, $email) {
                $sql = "SELECT * FROM userdata WHERE UserName = ? OR Email = ?";
                $stmt = $this->conn->prepare($sql);
                if (!$stmt) {
                    die("Prepare failed: " . $this->conn->error);
                }
                $stmt->bind_param("ss", $username, $email);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->num_rows > 0;
            }

        public function createUser($username, $email, $role, $hashedPassword, $img, $fullname, $phone, $alias, $organization, $cccd) {
            $sql = "INSERT INTO userdata (UserName, Email, Role, PassWord, user_img, FullName, Phone, Alias, Organization, CCCD)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            if (!$stmt) return false;

            $stmt->bind_param("ssisssssss", $username, $email, $role, $hashedPassword, $img, $fullname, $phone, $alias, $organization, $cccd);
            return $stmt->execute();
        }



        public function getAllUsers() {
            $conn = $this->getConnection();
            $sql = "SELECT UserID, UserName, Role, user_img FROM userdata ";
            $result = $conn->query($sql);
            $users = [];
            while($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            $conn->close();
            return $users;
        }
        
        function updateUserPasswordByEmail($email, $newPassword)
        {   
            $conn = $this->getConnection();
            $sql = "UPDATE userdata SET PassWord = ? WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                return false;
            }
            $newPassword = hash('sha256', $newPassword);
            $stmt->bind_param("ss", $newPassword, $email);
            $result = $stmt->execute();
            $stmt->close();
            mysqli_close($conn);
            return $result;
        }

        public function isEmailExists($email) {
            $conn = $this->getConnection();
            $sql = "SELECT * FROM userdata WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Không kết nối được: " . $conn->error);
            }
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $exists = $result->num_rows > 0;
            $stmt->close();
            mysqli_close($conn);
            return $exists;
        }

        public function updatePasswordById($userId, $newPassword){
            $conn = $this->getConnection();
            $sql = "UPDATE userdata SET PassWord = ? WHERE UserID = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $newPassword = hash('sha256', $newPassword);
            $stmt->bind_param("si", $newPassword, $userId);
            $result = $stmt->execute();
            $stmt->close();
            mysqli_close($conn);
            return $result;
        }
    }
?>