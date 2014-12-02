<?php
    session_start();
    
//check for required fields from the form
if ((filter_input(INPUT_POST, 'fieldname'))) {
    //connect to server and select database
    $fieldname = filter_input(INPUT_POST, 'fieldname');
    $crop = filter_input(INPUT_POST, 'cropOption');
    $fertilizer = filter_input(INPUT_POST, 'fertOption');
    $member_id = $_SESSION['member_id'];
    $area = filter_input(INPUT_POST, 'fieldarea');
    
    $mysqli = mysqli_connect("localhost", "organicDBuser", "letmein", "organic");
    
    $sql = "INSERT into fields values('','".$member_id."','".$fieldname."','".$crop."','".$area."');";
    
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    header("Location: userlogin.html");
    
}else{
$displayBlock = '
       <h3> Provide Field Details Below </h3>
       <fieldset>
       <legend>Add Field</legend>
       <form method="POST" action="">
           <p>Provide a name to identify your field</p>
                Field Name:
                <input type =\'text\' name=\'fieldname\'>
                </br>
                Field Area (acres):
                <input type =\'text\' name=\'fieldarea\'>
                </br>
                <p>Select a Crop for this field:</p>
                <select name="cropOption">
                    <option value="Apple">Apple</option>
                    <option value="Cherry">Cherry</option>
                    <option value="Strawberries">Strawberries</option>
                </select>
                
                <p>Select the Fertilizer used for this field:</p>
                <select name="fertOption">
                    <option value="jerrys">Jerry\'s Green Grow</option>
                    <option value="toms">Tom\'s Grow</option>
                    <option value="supergrow">SuperGrow Crop Fertilizer</option>
                </select>
                <p><input type="submit" name="submit" value="Submit"/></p>
       </form>
       </fieldset>';
}
?>
<html>
<head>
   <title>Supply Your Field Details</title>
</head>
    <body>
        <?php echo $displayBlock ?>
    </body>
</html>
