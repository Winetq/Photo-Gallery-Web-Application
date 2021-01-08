<!DOCTYPE html>
<html>
<head>
    <title>Logowanie</title>
    <link rel="stylesheet" href="static/css/styles.css"/>
</head>
<body>

<form method="post">
    <label>
        <span>Login:</span>
        <input type="text" name="login" required/>
    </label>
    <label>
        <span>Hasło:</span>
        <input type="password" name="password1" required/>
    </label>

    <div>
        <a href="products" class="cancel">Anuluj</a>
        <input type="submit" value="Zaloguj się!"/>
    </div>
</form>

</body>
</html>
