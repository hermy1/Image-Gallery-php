<?php
session_start();
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generateValidationErrorReport($required,$requiredPatterns,
                                       $requestData)
{
    $uppercase = null;
    $lowercase = null;
    $number    = null;
    $pass_len = 0;
    $data = [];
    $errors = [];
    $passwordKeys = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        foreach($requestData as  $k => $v)
        {
            $v = sanitize($v);
            if(empty($v) && $v != 0 )
            {
                if(in_array($k,$required))
                {
                    $errors[$k] = "required";
                }

            }
            else{
                $data[$k] = $v;
                if($requiredPatterns[$k] == "isPassword"){
                    $passwordKeys[$k] = $v;
                }

                $uppercase = preg_match('/[A-Z]/', $data[$k]);
                $lowercase = preg_match('/[a-z]/', $data[$k]);
                $number    = preg_match('/[0-9]/', $data[$k]);
                $nonword = preg_match('/[^\w]/',$data[$k]);
                $pass_len = strlen($data[$k]);
            }
            if(isset($data[$k]))
            {
                if( array_key_exists($k,$requiredPatterns))
                {
                    if( $requiredPatterns[$k] === "isName" && !preg_match("/^[a-zA-Z-' ]*$/",$data[$k])){
                        $errors[$k] = " invalid name format";

                    }
                    else if($requiredPatterns[$k] === "isEmail" && !filter_var($data[$k], FILTER_VALIDATE_EMAIL))
                    {
                        $errors[$k] = " invalid email format";

                    }
                    else if($requiredPatterns[$k] === "isUrl" && !filter_var($data[$k], FILTER_VALIDATE_URL) === true)
                    {
                        //!preg_match("/\b(?:(?:https?|ftp|http):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$data[$k])
                        $errors[$k] = " invalid url format";

                    }
                    else if($requiredPatterns[$k] === "isNumeric" && !is_numeric($data[$k]))
                    {

                        $errors[$k] = " invalid numeric format";

                    }
                    else if($requiredPatterns[$k] === "isInt" && !ctype_digit($data[$k]))
                    {
                        $errors[$k] = " invalid integer format";

                    }
                    else if($requiredPatterns[$k] === "isAlphaNumeric" && !ctype_alnum($data[$k]))
                    {
                        $errors[$k] = "not alpha numeric format";
                    }
                    else if($requiredPatterns[$k] === "isPassword" &&
                        (!$uppercase || !$lowercase || !$number || !$nonword || $pass_len < 8 ))
                    {
                        $errors[$k] = "Need upper/lower case,digit,special, & >= 8 chars";
                    }

                }
            }

        }
        foreach($required as $k ){
            if(!isset($requestData[$k])){
                $errors[$k] = "required";
            }
        }

        if(empty($errors)){
            $_SESSION['data'] = $data;
            unset($_SESSION['errors']);
            #header("Location: $okUrl" );
        }
        else{
            foreach($passwordKeys as $key=>$value){
                unset($data[$key]);
            }
            $_SESSION["data"] = $data;
            $_SESSION["errors"] = $errors;
            #header("Location: $hasErrorsUrl");
        }
    }
}
?>