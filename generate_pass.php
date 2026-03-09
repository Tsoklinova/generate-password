<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Generate Password · by PHP script</title>
        <style>
            body {
                background-color: #1e7adc;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                margin: 0;
                font-family: Arial, sans-serif;
            }
            h1 {
                font-family: 'Lucida Calligraphy', cursive;
                margin: 10px;
                padding: 25px;
                text-align: center;
                color: white;
            }
            form {
                background: rgba(255, 255, 255, 0.1);
                padding: 30px;
                border-radius: 10px;
                text-align: center;
            }
            input[type="text"] {
                padding: 10px;
                font-size: 16px;
                margin-bottom: 10px;
                width: 350px;
                border-radius: 15px;
            }
            input[type="range"] {
                display: block;
                margin: 10px auto;
                width: 350px;
            }
            button {
                padding: 12px 24px;
                margin: 5px;
                cursor: pointer;
                background: transparent;
                border: 2px solid white;
                color: white;
                font-size: 16px;
                border-radius: 15px;
                transition: all 0.3s ease;
            }
            button:hover {
                background: white;
                color: #1e7adc;
            }
        </style>
    </head>
    <body>
        <h1>Generate your own password for maximum security!</h1>

        <?php
            // Cryptographically secure function
            function generate_secure_pswd($length = 16) {
                $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*";
                $password = '';
                $charLength = strlen($chars);

                for ($i = 0; $i < $length; $i++) {
                    // random_int() -> cryptographically secure generator, uses hardware entropy (/dev/urandom in Linux). While rand() -> pseudo-random numbers, which 
                    // are predictable in an attack. 
                    // Analogy: rand() is like shuffling playing cards the same way each time, while random_int() is like throwing dice in a black box.
                    $password .= $chars[random_int(0, $charLength - 1)];
                }
                return $password;
            }

            // Generate a password only with button.
            $password = '';
            $length = isset($_POST['length']) ? (int)$_POST['length'] : 16;

            if (isset($_POST['generate'])) {
                $password = generate_secure_pswd($length);
                $_SESSION['password'] = $password;
                $_SESSION['length'] = $length;
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }

            if (isset($_SESSION['password'])) {
                $password = $_SESSION['password'];
                $length = $_SESSION['length'];
                unset($_SESSION['password']);
                unset($_SESSION['length']);
            }
        ?>

        <form method="post" action="">
            <input type="text" value="<?php echo htmlspecialchars($password); ?>" readonly placeholder="Your generated password here..." />

            <label style="color: white; display: block; margin: 10px;">Length: <span id="val"><?php echo $length; ?></span></label>
            <input type="range" name="length" min="8" max="32" value="<?php echo $length; ?>" oninput="document.getElementById('val').textContent = this.value">

            <div>
                <button type="submit" name="generate">Generate 🔐</button>
                <button type="button" onclick="navigator.clipboard.writeText(document.querySelector('input[type=text]').value)">Copy 📋</button>
            </div>
        </form>

    </body>
</html>

