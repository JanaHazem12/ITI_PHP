<?php

require_once 'helpers.php';

$submittedData = validateSubmittedData($_POST);
$submittedErrors = $submittedData["errors"];
$submittedValidData = $submittedData["valid"];

# show the errors in the query string
# convert errors/validData arrays to string (using json_encode)
if(count($submittedErrors)){
    $submittedValidData = json_encode($submittedValidData);
    $submittedErrors = json_encode($submittedErrors);
    echo "ERRORSSSSSSSSSS: ";
    $queryString = "errors=$submittedErrors";
    if($submittedValidData){ // if valid data is NOT empty
        $queryString .= "&valid=$submittedValidData";
        // . for concatenation
    }
    $headerURL = header("location:form.php?{$queryString}");
}

else{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    // $username = $_POST["username"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $code = $_POST["code"];
    // var_dump(isset($username));

    // function maleGreeting(){
    //     global $fname;
    //     global $lname;
    //     echo "<span>Thank you Mr. </span>".$fname.' '.$lname." !<br>";
    // }

    // function femaleGreeting(){
    //     global $fname;
    //     global $lname;
    //     echo "<span>Thank you Miss </span>".$fname.' '.$lname." !<br>";
    // }

    // if($gender === 'Male'){
    //     maleGreeting();
    // } else{
    //     femaleGreeting();
    // }

    /*echo "Please Review Your Information:<br>
    Name: <span style='font-weight: bold;'>$username</span><br>Address:<span style='font-weight: bold;'>".$address."</span><br>Your Skills: ";*/

    // handle the case where no option is selected
    // $checkbox = $_POST["checklist"] ?? null;
    // // assign a default value if NO skills are found to check on it in the condition
    // if($checkbox === null){
    //     echo "No skills found !";
    // } else{
    //     foreach($checkbox as $selected){
    //         echo "<div style='font-weight: bold;'>$selected</div>";
    //     }
    // }

    // echo "<br>Department: "."<span style='font-weight: bold;'>$department</span>";

    // echo "codee";
    // var_dump($code);
    
    if ((int)$code !== 1234) {
        echo "<script type='text/javascript'>alert('Wrong code ! Please try again.');window.location.href='form.html';</script>";
        exit();
    }

    // ids.txt
    // add 1 if empty, increment the num. if NOT
    $openFile = fopen('ids.txt', 'r');
    $size = filesize('ids.txt');
    if($size === 0){ // empty file
        $emptyFile = fopen('ids.txt', 'a');
        $getData = 1;
        fwrite($emptyFile,$getData);
    } else{
        $getData = (int)file_get_contents('ids.txt',1);
        $getData++;
        file_put_contents('ids.txt',$getData);
    }
    fclose($openFile);


    // open customer.txt file
    // write customer's submitted data in it with a ':" delimiter
    echo "<br>";
    $fileFound = fopen('customer.txt', 'a+');
    if($fileFound){
        fwrite($fileFound, $getData.":".$fname.":".$lname.":".$email.":".$gender."\n");
        fclose($fileFound);
    } else{
        echo "File Not Found !";
    }

    $lines = file('customer.txt'); // array of ALL lines in the .txt file
    $table_fields = [];
    // var_dump($table_fields);
    // var_dump($lines);
    if($lines){
    foreach($lines as $line){
        $line = trim($line);
        // START FROM THE SECOND FIELD - SKIP id
        $line = explode(':',$line, 2);
        // SIMILAR TO DESTRUCTURING
        // 2 puts the 1st field(id) in a chunk, the rest in another chunk (returns a string)
        // Array ( [0] => id [1] => fname,lname,email,gender);
        $idField = $line[0];
        $secChunk = $line[1];
        $secChunk=explode(':',$secChunk); // converts string to array to be able to loop over it
        $table_fields[] = $secChunk;
        }
    }
}

// echo $idField; // string
// var_dump($idField);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Customer Table</title>
</head>
<body class="p-6 bg-gray-100">

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-3 px-6 text-left">First Name</th>
                    <th class="py-3 px-6 text-left">Last Name</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Gender</th>
                    <th class="py-3 px-6 text-left"></th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                    <!-- <td class="py-3 px-6"> -->
                    <?php
                    if($table_fields !== null){
                    foreach($table_fields as $line){
                        echo '<tr class="border-b hover:bg-gray-100">';
                        foreach($line as $field){
                            echo'<td class="py-3 px-6">'.$field.'</td>';
                        }
                        echo'<td class="py-3 px-6"><button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">X</button></td>';
                    }
                    echo "</tr>";
                }
                    ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<!-- ******DISPLAY TABLE OF ALL USERS REGISTERED****** -->
<!-- save the submitted user's data in customer.txt - DONE -->
<!-- in this form = fname:lname:email:gender - DONE -->
<!-- loop over the file + loop over each line to access the fields
+ display fields in the correct headers - DONE -->
<!-- BONUS: ADD A DELETE BUTTON -->


<!-- ******DELETE BY ID****** -->
<!-- create ids.txt file to store the id in it -->
<!-- add id for every record id:fname:lname:email:gender
if the file is empty, add '1'
if the file is NOT empty, cast (int) THEN increment the no. in it && add it as the 1st field in customer.txt
-->
<!-- loop over the line starting the 2nd field NOT the 1st
to prevent displaying the id in the table -->
