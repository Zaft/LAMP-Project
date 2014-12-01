<?php
    
//check for required fields from the form
if ((filter_input(INPUT_POST, 'fieldname'))) {
    //connect to server and select database
    $fieldname = filter_input(INPUT_POST, 'fieldname');
    
    $mysqli = mysqli_connect("localhost", "organicDBuser", "letmein", "organic");
    
    
}else{
$displayBlock = '
       <h3> Provide Field Details Below </h3>
       <fieldset>
       <legend></legend>
       <form method="POST" action="">
           <p>Provide a name to identify your field</p>
                Field Name:
                <input type =\'text\' name=\'fieldname\'>
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
