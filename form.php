<!DOCTYPE html>
<html>
    <head>
        <title>PHP Secure Form Example</title>
        <style>
            body {
                background-color: #1d2542;
                font-family: sans-serif;
            }
            .mainBox {
                width: 50vw;
                height: auto;
                background-color: #ffffff;
                margin: 30px auto;
                padding: 10px;
                color: #0a0a0a;
                border-radius: 5px;
            }
            .forminput {
                padding: 10px;
                border: 0.3px solid grey;
                background-color: #f5fafe;
                width: 90%;
                margin-bottom: 10px;
            }

        </style>
    </head>
    <body>

   <?php    
        //Initializing variables for empty values and errors;
        $nameErr = $emailErr = $genderErr = $websiteErr = "";
        $name = $email = $gender = $comment = $website = "";

        //Validate Name
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["username"])) {
              $nameErr = "Name is required";
              throwError($nameErr);
            } else {
              $name = test_input($_POST["username"]);
              //Check if name only contains letters and whitespace
              if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed";
                throwError($nameErr);
              }
            }

        //Validate Email
        if(empty($_POST["useremail"])) {
            $emailErr = "Email is required";
            throwError($emailErr);
          } else {
            $email = test_input($_POST["useremail"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format";
              throwError($emailErr);
            }
          }

        //Validate Website
        if(empty($_POST["userwebsite"])) {
            $website = "";
          } else {
            $website = test_input($_POST["userwebsite"]);
            // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
              $websiteErr = "Invalid URL";
              throwError($websiteErr);
            }
          }

        //Validate Comment
        if(empty($_POST["usercomment"])) {
            $comment = "";
          } else {
            $comment = test_input($_POST["usercomment"]);
          }

        //Validate Gender
        if(empty($_POST["gender"])) {
            $genderErr = "Gender is required";
            throwError($genderErr);
        } else {
            $gender = test_input($_POST["gender"]);
        }
    }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function throwError($error) {
            echo "<script>window.alert('Error: $error')</script>";
        }

   ?>


        <div class="mainBox">
            <h1 style="color: #cb1217; margin-bottom: 10px;">PHP Secure Form Example</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
                <input type="text" name="username" class="forminput" placeholder="Name"><br>
                <input type="text" name="useremail" class="forminput" placeholder="Email"><br>
                <input type="text" name="userwebsite" class="forminput" placeholder="Website"><br>
                <textarea name="usercomment" rows="5" cols="60" placeholder="Comments" class="forminput" style="resize: none;"></textarea><br>
                Male: <input type="radio" name="gender" value="male"> Female: <input type="radio" name="gender" value="male"> <br>
                <input type="submit" name="submit" value="Submit Form" style="background-color: #cb1217; color: #ffffff; width: 100%; border: 0; padding: 10px; margin-top: 10px;" >          
            </form>
        </div>

        <div class="mainBox">
            <h1 style="color: #cb1217; margin-bottom: 10px;">Output:</h1>
            <?php
                echo $name;
                echo "<br>";
                echo $email;
                echo "<br>";
                echo $website;
                echo "<br>";
                echo $comment;
                echo "<br>";
                echo $gender;
            ?>
        </div>

    </body>
</html>