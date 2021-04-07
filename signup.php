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
                <label for="username">Username:
            </td>
            <td>
                 <input type='text' name='username' id='username'>

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
    $username = strtolower($_POST['username']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $sqlQuery = "SELECT * FROM Accounts where username = '$username'";

    $queryResult = $mysql_connect -> query($sqlQuery);
    // check if username taken
    $queryRow = mysqli_num_rows($queryResult);

    // password not matching
    if(strcmp($password, $password2) !== 0){
        print("Password and confirm password are not the same. Please try again");
    }
    // blank entry
    elseif($username == "" || $password == ""){
        print("You must enter a password and username");

    }
    // username taken
    elseif($queryRow != 0){

        print("An account already exists with this username");
        echo("<br>");
        print("Please pick another username");
    }
    elseif(!isset($_POST['agreement'])){
        print("Please accept the terms and agreement");
    }
    else{
        // add to datebase
        $sqlQuery = "INSERT INTO Accounts ('username', 'password') VALUES ('$username','$password')";
        $mysql_connect -> query($sqlQuery);
        $_SESSION['login_message'] = "account created successfully";
        // redirect user to login page
        echo'
        <script>
        window.location.replace("https://cypress-cdbat.000webhostapp.com/index.php");
        </script>
        ';
       }
}

?>
</div>


