<?php 
    if ((isset($_REQUEST['Username'])) && (isset($_REQUEST['Password']))) {
        // Create a Database named honeypot, one table called loginattempts with 5 columns: 
        // id INT Autoincrement Primary, username VARCHAR(256), password VARCHAR(256), ip VARCHAR(256), date current_date
        // Insert your DB credentials
        $dbname = "honeypot";
        $username = "dbuser";
        $password = "...";  
        $hostname = "localhost:3306";

        $dsn = "mysql:host=$hostname;dbname=$dbname;charset=UTF8";
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $pdo = new PDO($dsn, $username, $password, $options);

        $honeypotUsername = $_REQUEST['Username'] ? $_REQUEST['Username'] : "empty";
        $honeypotPassword = $_REQUEST['Password'] ? $_REQUEST['Password'] : "empty";
        $honeypotIP = $_SERVER['REMOTE_ADDR'] ? $_SERVER['REMOTE_ADDR'] : "empty";

        $sql = 'insert into loginattempts(username, password, ip) values(:username,:password,:ip)';
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':username', $honeypotUsername);
        $statement->bindValue(':password', $honeypotPassword);
        $statement->bindValue(':ip', $honeypotIP);
        $statement->execute();

        $posted = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css?v=1.0.0">
        <title>CMS login</title>
    </head>
    <body class="login">
        <main>
            <div class="content">
                <h3>Login to custom Backend and Server controls</h3>
                <form action="login.php" method="POST">
                    <img src="logo.png" alt="Login Logo"> <!-- Insert a logo image for a more convincing appearance -->
                    <input type="text" name="Username" placeholder="Username / Email">
                    <input type="password" name="Password" placeholder="Password">
                    <input type="submit">
                    <?php if ($posted) : ?>
                        <div class="error">
                            Wrong Username or Password!
                        </div>
                    <?php endif ?>
                </form>
                <p>XCMS v1.14.5a (beta)</p>
            </div>
        </main>
        <footer>
            <p><b>Confidential Area</b></p>
            <p>For employees only</p>
        </footer>
    </body>
</html>
