<?php
# GET the errors in the query string - DONE
# convert from json to array (using json_decode) - DONE
# to display 'errors messages' under each field
$errors=[];
$valid=[];
if(isset($_GET["errors"])){
  $errors = $_GET["errors"];
  $errors = json_decode($errors, true);
  // var_dump($errors);
}
if(isset($_GET["valid"])){
  $valid = $_GET["valid"];
  $valid = json_decode($valid, true);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-xs flex justify-center items-center">
        <form action="save.php" method="POST"  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="font-bold text-xl text-center text-blue-400 underline">Application Form</div><br>
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="fname">
              First Name
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstName" type="text" placeholder="First Name" name="fname" value="<?php echo $valid['fname'] ?? ''; ?>">
            <?php 
              # if 'fname' is in the a key in 'errors' then display 'Email is required.'
              if(array_key_exists('fname', $errors)){
                echo '<p class="text-red-600 text-sm mt-1 flex items-center gap-1 animate-pulse">
                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0ZM9 7a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0V7Zm1 7a1 1 0 1 1 0-2h.01a1 1 0 0 1 0 2H10Z" clip-rule="evenodd"/>
                </svg>First name is required</p>';
              }
            ?>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="lname">
              Last Name
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastName" type="text" placeholder="Last Name" name="lname" value="<?php echo $valid['lname'] ?? ''; ?>">
            <?php 
              # if 'lname' is in the a key in 'errors' then display 'Email is required.'
              if(array_key_exists('lname', $errors)){
                echo '<p class="text-red-600 text-sm mt-1 flex items-center gap-1 animate-pulse">
                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0ZM9 7a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0V7Zm1 7a1 1 0 1 1 0-2h.01a1 1 0 0 1 0 2H10Z" clip-rule="evenodd"/>
                </svg>Last name is required</p>';
              }
            ?>
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
              Address
            </label>
            <textarea
           class="overflow-auto shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address" type="text" placeholder="Enter your address here..." name="address"><?php echo $valid['address'] ?? ''; ?></textarea>        
           <?php 
              # if 'department' is in the a key in 'errors' then display 'Email is required.'
              if(array_key_exists('address', $errors)){
                echo '<p class="text-red-600 text-sm mt-1 flex items-center gap-1 animate-pulse">
                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0ZM9 7a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0V7Zm1 7a1 1 0 1 1 0-2h.01a1 1 0 0 1 0 2H10Z" clip-rule="evenodd"/>
                </svg>address is required</p>';
              }
            ?>
          </div>
            <div class="flex flex-row gap-4">
                <div><label class="block text-gray-700 text-sm font-bold mb-2" for="country">Country: </label></div>
                <div><select name="country" id="country" class="bg-blue-300">
                  <!-- <option value="Select">Select Country</option> -->
                  <option value="Egypt" <?php echo ($valid['country'] ?? '') === "Egypt" ? "selected" : ""; ?>>Egypt</option>
                  <option value="Germany" <?php echo ($valid['country'] ?? '') === "Germany" ? "selected" : ""; ?>>Germany</option>
                  <option value="USA" <?php echo ($valid['country'] ?? '') === "USA" ? "selected" : ""; ?>>USA</option>
                  <option value="France" <?php echo ($valid['country'] ?? '') === "France" ? "selected" : ""; ?>>France</option>
                </select>
            </div>
            <?php 
              # if 'country' is in NOT a key in 'valid' then display 'Country is required.'
              if(array_search('Select', $valid)){
                echo '<p class="text-red-600 text-sm mt-1 flex items-center gap-1 animate-pulse">
                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0ZM9 7a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0V7Zm1 7a1 1 0 1 1 0-2h.01a1 1 0 0 1 0 2H10Z" clip-rule="evenodd"/>
                </svg>Country is required</p>';
              } 
              ?> 
          </div><br>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="country">Gender </label>
                <div class="flex gap-10">
                    <div class="inline-flex items-center">
                        <label class="relative flex items-center cursor-pointer" for="male">
                            <input name="gender" type="radio" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all" id="male" value="male" <?php echo ($valid['gender'] ?? '') === "male" ? "checked" : ""; ?>>
                            <span class="absolute bg-slate-800 w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                        </label>
                        <label class="ml-2 text-slate-600 cursor-pointer text-sm" for="male">Male</label>
                    </div>
      
                    <div class="inline-flex items-center">
                        <label class="relative flex items-center cursor-pointer" for="female">
                            <input name="gender" type="radio" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all" id="female" value="female" <?php echo ($valid['gender'] ?? '') === "female" ? "checked" : ""; ?>>
                            <span class="absolute bg-slate-800 w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                        </label>
                        <label class="ml-2 text-slate-600 cursor-pointer text-sm" for="female">Female</label>
                    </div>
                    <?php 
                    # if 'gender' is in NOT a key in 'valid' then display 'Gender is required.'
                    if(array_key_exists('gender', $valid)){
                      echo '<p class="text-red-600 text-sm mt-1 flex items-center gap-1 animate-pulse">
                      <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0ZM9 7a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0V7Zm1 7a1 1 0 1 1 0-2h.01a1 1 0 0 1 0 2H10Z" clip-rule="evenodd"/>
                      </svg>Gender is required</p>';
                    }
                  ?>
                  </div><br>
            <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="country">Skills </label>
            <div class="flex flex-row gap-4">
            <div><input type="checkbox" id="PHP" name="checklist[]" value="PHP" <?php echo in_array("PHP", $valid["checklist"] ?? []) ? "checked" : ""; ?>>
            <label for="PHP"> PHP</label><br></div>
            <div><input type="checkbox" id="JS" name="checklist[]" value="JS" <?php echo in_array("JS", $valid["checklist"] ?? []) ? "checked" : ""; ?>>
            <label for="JS">JS</label><br></div>
            <div><input type="checkbox" id="Mongodb" name="checklist[]" value="Mongodb" <?php echo in_array("Mongodb", $valid["checklist"] ?? []) ? "checked" : ""; ?>>
            <label for="Mongodb">MongoDB</label><br></div>
        </div>
        <?php 
        # if 'skills' is in not a key in 'valid' then display 'skills are required.'
        if(array_key_exists('checklist', $valid)){
          echo '<p class="text-red-600 text-sm mt-1 flex items-center gap-1 animate-pulse">
          <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0ZM9 7a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0V7Zm1 7a1 1 0 1 1 0-2h.01a1 1 0 0 1 0 2H10Z" clip-rule="evenodd"/>
          </svg>Skills are required</p>';
        }
      ?>  
      </div><br>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
              Email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="email" name="email" value="<?php echo $valid['email'] ?? ''; ?>">
            <?php 
              # if 'email' is in the a key in 'errors' then display 'Email is required.'
              if(array_key_exists('email', $errors)){
                echo '<p class="text-red-600 text-sm mt-1 flex items-center gap-1 animate-pulse">
                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0ZM9 7a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0V7Zm1 7a1 1 0 1 1 0-2h.01a1 1 0 0 1 0 2H10Z" clip-rule="evenodd"/>
                </svg>Email is required</p>';
              }
            ?>
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
              Password
            </label>
            <input class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="**********">
          </div>
          <label class="block text-gray-700 text-sm font-bold mb-2" for="department">
            Department
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="department" type="text" placeholder="Department" name="department" value="<?php echo $valid['department'] ?? ''; ?>">
          <?php 
              # if 'department' is in the a key in 'errors' then display 'Email is required.'
              if(array_key_exists('department', $errors)){
                echo '<p class="text-red-600 text-sm mt-1 flex items-center gap-1 animate-pulse">
                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0ZM9 7a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0V7Zm1 7a1 1 0 1 1 0-2h.01a1 1 0 0 1 0 2H10Z" clip-rule="evenodd"/>
                </svg>Department is required</p>';
              }
            ?>
        </div><br>
        <div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/39/Elongated_circle_1234.svg/750px-Elongated_circle_1234.svg.png" alt="captchaVerification">
            <label for="verification">Please enter the above code.</label>
            <input class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="verification" type="number" placeholder="Enter text here..." name="code">
        </div>
          <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
              Submit
            </button>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="reset">
                Reset
              </button>
          </div>
        </form>
      </div>
</body>
</html>