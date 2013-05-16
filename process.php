<?php
/*
 *  Specify the field names that are in the form. This is meant
 *  for security so that someone can't send whatever they want
 *  to the form.
 */
$allowedFields = array(
    'name',
    'email',
    'url'
);
// Specify the field names that you want to require...
$requiredFields = array(
    'name',
    'email',
    'url',
);
// Loop through the $_POST array, which comes from the form...
$errors = array();
foreach($_POST AS $key => $value){
    // first need to make sure this is an allowed field
    if(in_array($key, $allowedFields)){
        $$key = $value;
        // is this a required field?
        if(in_array($key, $requiredFields) && $value == ''){
            $errors[] = "The field $key is required.";
        }else{
        	// The field was populated, lets check to see if its valid
        	if($key == "email"){
        		if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        			// Not valid add to errors
        			$errors[] = "Please enter a valid $key";
        		}else{
        			// Valid lets sanitize the input
        			$_POST["email"] = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
        		}
        	}else if($key == "name"){
        		$_POST["name"] = filter_var($_POST["name"],FILTER_SANITIZE_STRING);
        	}else if($key == "url"){
        		if(!filter_var($_POST["url"],FILTER_VALIDATE_URL)){
        			$errors[] = "Please enter a valid $key, try adding http://";
        		}else{
        			$_POST["url"] = filter_var($_POST["url"],FILTER_SANITIZE_URL);
        		}
        	}
        }
    }  
}
// were there any errors?
if(count($errors) > 0){
    $errorString = '<p>There was an error processing the form.</p>';
    $errorString .= '<ul>';
    foreach($errors as $error){
        $errorString .= "<li>$error</li>";
    }
    $errorString .= '</ul>';
     
    // display the previous form
    include 'index.php';
}else{
    // At this point you can send out an email or do whatever you want
    // with the data...
     
    // each allowed form field name is now a php variable that you can access
     
    // display the thank you page
    header("Location: thanks.php");
}