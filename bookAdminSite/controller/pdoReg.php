<?php
    session_start();

    require ("../model/db.php");
    require ("../model/dbFunctions.php");
    require ("../model/testInput.php");

    if (!empty([$_POST])) {

    //input sanitation via testUserInput function
        $username = !empty($_POST['username'])? testUserInput(($_POST['username'])): null;
        $mypass = !empty($_POST['password'])? testUserInput(($_POST['password'])): null;
        $email = !empty($_POST['email']) ? testUserInput(($_POST['email'])): null;
        $firstname = !empty($_POST['firstName'])? testUserInput(($_POST['firstName'])): null;
        $lastname = !empty($_POST['lastName']) ? testUserInput(($_POST['lastName'])): null;
        $accessRights = !empty($_POST['accessRights']) ? testUserInput(($_POST['accessRights'])): null;

        // using password hash to encrypt the password
        $password= password_hash($mypass, PASSWORD_DEFAULT);

        try {
            if($_POST['action_type'] == 'addUser'){
                // search the database for the entered username
                $query= $conn->prepare("SELECT username FROM login WHERE username=:username");
                $query->bindValue(":username",$username);
                $query->execute();

                // check if the username doosn't exists in the database then add the user
                if ($query->rowcount()<1) {   
                $querySuccess = addUser($username, $password, $email, $firstname, $lastname, $accessRights);
                    if ($querySuccess == true){
                        header('location:../view/pages/displayBook.php?message=New user is added as: '.$username);
                        exit;
                    }  
                }
                // the user already exists
                else { 
                    header ('location:../view/pages/addUser.php?message=User name exists');
                }
            }
        }
        // if something goes wrong during the adding user, show the error message
        catch (PDOException $e) {
            echo "Account creation problems".$e -> getMessage();
            die();
        }
    }
?>  

