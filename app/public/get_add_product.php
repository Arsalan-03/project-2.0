<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Меню</title>
    <style>
        /* Ваши стили */
    </style>
</head>
<body>

<header>
    <a href="#" class="logo">Роллы</a>
    <nav>
        <ul>
            <li><a href="/main" id="cart-button">HOME</a></li>
            <li><a href="/add-product">Add-Cart</a></li>
            <li><a href="">Technologies</a></li>
            <li><a href="">Portfolio</a></li>
            <li><a href="">Description</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </nav>
</header>

<form action="/add-product" method="post">
    <div class="container">
        <div class="color-btn">
            <h1>Добавление товара</h1>
            <hr>

            <label for="email"><b>Product_id</b></label>
            <label style="color: red"> <?php echo $errors['product_id'] ?? '';?></label>
            <input type="text" placeholder="Enter Email" name="product_id" id="email" required>

            <label for="psw"><b>Quantity</b></label>
            <label style="color: red"> <?php echo $errors['quantity'] ?? '';?></label>
            <input type="password" placeholder="Enter Password" name="quantity" id="psw" required>

            <button type="submit" class="registerbtn">Добавить</button>
        </div>

    </div>
</form>

</body>
</html>q

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
        list-style: none;
        text-decoration: none;
    }

    body {
        height: 100vh;
        background-size: cover;
        background: black;
    }

    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8%;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    header .logo {
        font-size: 20px;
        font-weight: 900;
        color: #000;
        transition: .5s;
    }

    header .logo:hover {
        transform: scale(1.2);
    }

    header nav ul {
        display: flex;
        align-items: center;
    }

    header nav ul li {
        margin-left: 20px;
    }

    header nav ul li a {
        padding: 15px;
        color: #000;
        font-size: 16px;
        display: block;
    }

    header nav ul li a:hover {
        background: #000;
        color: #fff;
        border-radius: 5px;
    }

    .container {
        margin-top: 80px;
    }
    @media (max-width: 992px) {
        .card {
            flex: 1 1 calc(33.333% - 1rem);
            max-width: calc(33.333% - 1rem);
        }
    }

    @media (max-width: 768px) {
        .card {
            flex: 1 1 calc(50% - 1rem);
            max-width: calc(50% - 1rem);
        }
    }

    @media (max-width: 576px) {
        .card {
            flex: 1 1 100%;
            max-width: 100%;
        }
    }

    <style>
     * {box-sizing: border-box}

    /* Add padding to containers */
    .container {
        padding: 16px;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit/register button */
    .registerbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity:1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }

    .color-btn {
        color: white;
    }
</style>
</style>
</head>









