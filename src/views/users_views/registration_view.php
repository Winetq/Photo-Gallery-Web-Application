<!DOCTYPE html>
<html>
<head>
    <title>Rejestracja</title>
    <link rel="stylesheet" href="static/css/styles.css"/>
</head>
<body>

<form method="post">
    <label>
        <span>Login:</span>
        <input type="text" name="login" value="<?= $user['login'] ?>" required/>
    </label>
    <label>
        <span>E-mail:</span>
        <input type="email" name="email" value="<?= $user['email'] ?>" required/>
    </label>
    <label>
        <span>Hasło:</span>
        <input type="password" name="password1" value="<?= $user['password1'] ?>" required/>
    </label>
    <label>
        <span>Powtórz:</span>
        <input type="password" name="password2" required/>
    </label>
    
    <input type="hidden" name="id" value="<?= $user['_id'] ?>">

    <div>
        <a href="products" class="cancel">Anuluj</a>
        <input type="submit" value="Zapisz się!"/>
    </div>
</form>

</body>
</html>
