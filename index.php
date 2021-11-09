<html>
    <body>
        <div class="login">
            <p>Create an account?</p>
            <form action=" includes/signup.inc.php"  method="POST">
                <input type="text" name="firstname" placeholder="First Name">
                <input type="text" name="lastname" placeholder="Last Name">
                <input type="text" name="school" placeholder="School">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="passwordcon" placeholder="Confirm Password">
                <button type="submit" name="submit" >submit</button>


            </form>
            <p>Login into your account</p>
            <form action=" includes/login.inc.php"  method="POST">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="submit1" >submit</button>


            </form>
            <form action="includes/deleteUser.inc.php" method="POST">  
            <input type="email" name="email" placeholder="Please input you email to delete your account">
                
            <button type= "submit1" name="delete"> </button>


            </form>
        </div>
    </body>
</html>