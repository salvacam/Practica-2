<!doctype html>
<html lang = "es">

    <head>
        <title>Foto Casa Administrador</title>
        <meta charset = "utf-8">
        <link rel = "stylesheet" href = "../font/font.css">
        <link rel = "stylesheet" href = "../css/back-end.css">
        <link rel = "shortcut icon" href = "../img/favicon.ico">
    </head>

    <body>
        <div id = "contenedor">
            <?php include "../include/header.php";
            ?>

            <div id="body">
                <div id="body-center">	
                    <form action="phpLogin.php" method="POST" id="formLogin">            
                        <input type="text" name="nombre" value="" id="nombre" placeholder="nombre" required/>
                        <input type="password" name="clave" value="" id="clave" placeholder="clave" required/>
                        <input type="submit" value="Login" />
                    </form>
                </div>
            </div>
        </div>
        <?php include "../include/footer.php"; ?>
    </body>

</html>
