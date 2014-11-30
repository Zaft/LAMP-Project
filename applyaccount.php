<?php

echo "<html>";
echo "<head>";
echo "<link rel='stylesheet' type='text/css' href='styles.css'></style>";
echo "<title>User Login</title>";
echo "</head>";

$emailFound = FALSE; //Variable to store whether users email exists in db.

if (!filter_input($INPUT_POST,'submit')) { // if page is not submitted to itself echo the form
    ?>
<body>
 <h1>Complete and submit form to create account</h1>
        <!form method="post" action="<?php echo $PHP_SELF;?>">
        <form method='post' action="">
            <p><strong>firstname:</strong><br/>
            <input type='text' name='firstname'required/></p>
            <p><strong>lastname:</strong><br/>
            <input type='text' name='lastname' required/></p>
            <p><strong>email:</strong><br/>
            <input type='text' name='email' required/></p>
            <p><strong>password:</strong><br/>
            <input type='password' name='password'required/></p>
            <p><strong>age:</strong><br/>
            <input type='text' name='age'required/></p>
            <p><strong>gender:</strong><br/>
            <input type='text' name='gender'required/></p>
            <p><input type='submit' name='submit' value='submit'/></p>
        </form>
<?php
} else {
    
    $firstname = filter_input($INPUT_POST,'firstname');
    $lastname = filter_input($INPUT_POST,'lastname');
    $email = strtolower(filter_input($INPUT_POST,'email'));
    $password = filter_input($INPUT_POST,'password');
    $age = filter_input($INPUT_POST,'age');
    $gender = filter_input($INPUT_POST,'gender');
    
    //connect to server and select database
    $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "testDB");

    //create and issue the query
    $sql = "SELECT * FROM members WHERE email = '".$email."')";
    $sqltest = "SELECT * FROM members";
    $result = mysqli_query($mysqli, $sqltest) or die(mysqli_error($mysqli));
    
    //get the number of rows in the result set; should be 1 or more if a match
    if (mysqli_num_rows($result) >= 1) {
	$info = mysqli_fetch_array($result);
        foreach($info as $value){
		//$test = stripslashes($info['email']);
                //echo stripslashes($info['email']);
                if($value == $email){
                    echo "<p>Your email address is already is use. Please use a different email"
                        . " address for a new account </p>";
                    global $emailFound; 
                    $emailFound = TRUE;
                    header("Refresh:5");
                    break;
                }
        }
    }
    
    if(!$emailFound){                    
        $sqlInsert3 =  "INSERT INTO members ".
        "VALUES     ('".$firstname."','"
                     .$lastname."','"
                     .$email."',"
                     ."Password('".$password."'),"
                     .$age.",'"
                     .$gender."',"
                     ."CURDATE());";

        $retval = mysqli_query($mysqli, $sqlInsert3);
        if(!$retval){
            echo "<p>Could not insert data</p>";
            die('Could not enter data:  '.msql_error());
            exit;
        }
        
        mkdir("../uploaddir/".$email,0733); 
        echo "<p>Your new account has been created. Thank you for joining us!</p>";
        echo "<p>Click <a href='userlogin.php'>Here</a> to Login";    
    }
}
?>

<body>
</body>
</html>