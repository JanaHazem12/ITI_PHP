<?php
# put ALL empty fields in the errors array
# put the errors in an associative array key:value style
# submittedData is an array of ALL values(with keys) submitted
function validateSubmittedData($submittedData){
    $errors = [];
    $validData = [];
    foreach ($submittedData as $key => $value) {
        if(!isset($value) or empty($value)){
            $errors[$key] = ucfirst("$key is required !");
            echo $errors[$key]."<br>";
            // echo "KEYSSSSSS: ";
            // var_dump($key);
        } else{
            $validData[$key] = $value;
        }
    }
    return ["errors" => $errors, "valid" => $validData];
}

?>