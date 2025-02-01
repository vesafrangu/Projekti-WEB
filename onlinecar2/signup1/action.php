<?php

require_once('User.php'); // Moved outside the class

class Action {
    public function __construct() { // Removed 'argument' as it was incorrect
        if (isset($_POST['submit'])) { // Ensure submit is set before using it
            switch ($_POST['submit']) {
                case 'insert':
                    $objUser = new User();
                    $objUser->setUsername($_POST['username']);
                    $objUser->setPassword($_POST['password']);
                    
                    if ($objUser->insert()) {
                        header('Location: signup.php?insert=1'); // Fixed syntax
                        exit(); // Always exit after header to prevent further execution
                    } else {
                        header('Location: signup.php?insert=0');
                        exit();
                    }
                    break;
                    
                default:
                    header('Location: signup.php');
                    exit();
            }
        } else {
            header('Location: signup.php?insert=0');
            exit();
        }
    }
}

// Instantiate the Action class if form is submitted
if (isset($_POST['submit'])) {
    new Action();
} else {
    header('Location: signup.php?insert=0');
    exit();
}

?>
