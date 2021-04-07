<?php

    session_start();

    $mysql_connect = mysqli_connect("localhost", "id16543739_cdbat", "Cypress@12345", "id16543739_cypress");

    // check if database connected properly
    if(!$mysql_connect){
        die(mysqli_connect_error());
    }

    include 'header.php';

?>


<head>
    <title>Sign Up</title>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="">

</head>

<body>
<div  style = "width:50%; margin: auto; ">
    <form onsbumit method="POST" id = "sign_up" name = "sign_up" action="#" >
    <table style="width:100%">
        <tr>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>
                <label for="first_name">First Name:
            </td>
            <td>
                 <input type='input' name='first_name' id='first_name'>

            </td>
        </tr>
        <tr>
            <td>
                <label for="last_name">Last Name:
            </td>
            <td>
                 <input type='input' name='last_name' id='last_name'>

            </td>
        </tr>
        <tr>
            <td>
                <label for="address">Address:
            </td>
            <td>
                 <input type='input' name='address' id='address'>

            </td>
        </tr>
        <tr>
            <td>
                <label for="number">Phone (Format: 416-000-0000):
            </td>
            <td>
            <input type="tel" id="number" name="number"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" >

            </td>
        </tr>
        <tr>
            <td>
                <label for="email">Email:
            </td>
            <td>
                 <input type='email' name='email' id='email'>

            </td>
        </tr>
        <tr>
            <td>
            <label for="password">Password:

            </td>
            <td>
            <input type='password' name='password' id='password' >

            </td>
        </tr>
        <tr>
            <td>
            <label for="password2">Confrim New Password:

            </td>
            <td>
            <input type='password' name='password2' id='password2'>

            </td>
        </tr>
        <tr>
            <td>
            <label for="security">Security:
            </td>
            <td>
            <input type='input' name='security' id='security'>

            </td>
        </tr>
        <tr>
            <td>
            <label for="agreement">I agree to Cypress Terms of Service and Privacy Agreement

            </td>
            <td>
            <input type='checkbox' name='agreement' id='agreement'>

            </td>
        </tr>
    </table>
        <br>
            <br>
            <button type="submit"  id="create_account" name="create_account">Create Account</button>

    </form>

</div>
</body>

<div style = "width:50%; margin: auto; ">
<?php

// user tried to create new acount
if(isset($_POST['create_account'])){

    // get form info
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $security = $_POST['security'];



    $sqlQuery = "SELECT * FROM Accounts where email = '$email'";

    $queryResult = $mysql_connect -> query($sqlQuery);
    // check if email taken
    $queryRow = mysqli_num_rows($queryResult);

    // password not matching
    if(strcmp($password, $password2) !== 0){
        print("Password and confirm password are not the same. Please try again");
    }
    // blank entry
    elseif($fname == ""){
        print("You must enter a first name");
    }
    elseif($lname == ""){
        print("You must enter a last name");
    }
    elseif($address == ""){
        print("You must enter an address");
    }
    elseif($number == ""){
        print("You must enter your number");
    }
    elseif($security == ""){
        print("You must a secruity word");
    }
    elseif($email == "" ){
        print("You must enter an email");
    }
    elseif( $password == ""){
        print("You must enter a password");
    }
    // email taken
    elseif($queryRow != 0){

        print("An account already exists with this email");
        echo("<br>");
        print("Please pick another email");
    }
    elseif(!isset($_POST['agreement'])){
        print("Please accept the terms and agreement");
    }
    else{
        // add to datebase
        $sqlQuery = "INSERT INTO Accounts (email, password,first_name,last_name,address,number,security) VALUES ('$email','$password','$fname','$lname','$address','$number','$security')";
        $mysql_connect -> query($sqlQuery);

        $_SESSION['login_message'] = "account created successfully";
        // redirect user to index or login page
        echo'
        <script>
        window.location.replace("https://cypress-cdbat.000webhostapp.com/index.php");
        </script>
        ';
       }
}

?>
</div>


