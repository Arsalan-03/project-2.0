<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Меню</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
    <style>
        /* Ваши стили */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
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

        section {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 колонки */
            gap: 20px;
            padding: 20px;
            justify-items: center;
            position: fixed;
        }

        .product-card {
            max-width: 250px;
            position: relative;
            box-shadow: 0 2px 5px #333;
            background: #1A2238;
            border-radius: 10px;
            overflow: hidden;
        }

        .badge {
            position: absolute;
            left: 0;
            top: 10px;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: 700;
            background: #6E6E6E;
            color: #BCFD4C;
            padding: 3px 10px;
            border-radius: 0 5px 5px 0;
        }

        .product-thumb {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px;
            padding: 20px;
            background: #EAD6CD;
        }

        .product-thumb img {
            max-width: 100%;
            max-height: 100%;
        }

        .product-details {
            padding: 20px;
        }

        .product-details h4 a {
            font-weight: 500;
            display: block;
            margin-bottom: 10px;
            text-transform: uppercase;
            color: #00ABE1;
            text-decoration: none;
            transition: 0.3s;
        }

        .product-details h4 a:hover {
            color: #F52544;
        }

        .product-details p {
            font-size: 14px;
            line-height: 18px;
            margin-bottom: 10px;
            color: #99DDFF;
        }

        .product-bottom-details {
            overflow: hidden;
            border-top: 1px solid #99DDFF;
            padding-top: 10px;
        }

        .product-bottom-details div {
            float: left;
            width: 50%;
        }

        .product-price {
            font-size: 16px;
            color: #F52544;
            font-weight: 600;
        }

        .product-price small {
            font-size: 80%;
            font-weight: 400;
            text-decoration: line-through;
            display: inline-block;
            margin-right: 5px;
        }

        .product-links {
            display: flex;
            justify-content: flex-end ;
            text-align: right;
        }

        .product-links a {
            display: inline-block;
            margin-left: 5px;
            color: #5CE0D8;
            transition: 0.3s;
            font-size: 16px;
        }

        .product-links a:hover {
            color: #F52544;
        }

        .mini-cart-popup {
            position: fixed;
            top: 50%;
            right: -50%;
            transform: translateY(-50%);
            width: 50%;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: right 0.3s ease-in-out;
        }

        .mini-cart-popup.active {
            right: 0;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-header h2 {
            margin: 0;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }

        .free-shipping {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .shipping-icon {
            font-size: 20px;
            margin-right: 8px;
        }

        .separator {
            width: 100%;
            height: 2px;
            background-color: black;
            margin: 10px 0;
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 8px;
        }

        .product-details {
            flex-grow: 1;
            margin-left: 10px;
        }

        .product-details p {
            margin: 0;
        }

        .price {
            color: #FF0000;
            font-weight: bold;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .quantity-input {
            width: 30px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 0 5px;
        }

        .minus-btn, .plus-btn {
            background: none;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 30px;
            height: 30px;
            font-size: 18px;
            cursor: pointer;
        }

        .delete-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .total {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .cart-footer {
            display: flex;
            justify-content: space-between;
        }

        .view-bag-btn, .checkout-btn {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .view-bag-btn {
            background-color: white;
            border: 1px solid #000;
        }

        .checkout-btn {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <a href="#" class="logo">Роллы</a>
    <nav>
        <ul>
            <li><a href="#" id="cart-button">Cart</a></li>
            <li><a href="/add-product">Add-Cart</a></li>
            <li><a href="">Technologies</a></li>
            <li><a href="">Portfolio</a></li>
            <li><a href="">Description</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <section>
        <?php if (isset($products)) {
            foreach ($products as $product):
                ?>
                <div class="product-card">
                    <div class="badge">New Product</div>
                    <div class="product-thumb">
                        <img src="<?= $product['image']; ?>">
                    </div>
                    <div class="product-details">
                        <h4><a href="#"><?= $product['name']; ?></a></h4>
                        <p><?= $product['info']; ?></p>
                        <div class="product-bottom-details">
                            <div class="product-price"><small><?= $product['price']; ?></small>$7.99</div>
                            <div class="product-links">
                                <form>
                                    <a href="#"><i class="fa fa-heart"></i></a>
                                </form>
                                <form action="/add-product" method="post">
                                   <button><a href="#"><i class="fa fa-shopping-cart"></i></a> </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; } ?>
    </section>
</div>

<div class="mini-cart-popup" id="mini-cart">
    <div class="cart-header">
        <h2>My Cart</h2>
        <button class="close-btn" id="close-cart">&times;</button>
    </div>
    <div class="free-shipping">
        <span class="shipping-icon">🚚</span>
        <span>You've qualified for free shipping</span>
    </div>
    <div class="separator"></div>
    <?php if (isset($userProducts)) : ?>
        <?php foreach ($userProducts as $userProduct): ?>
            <div class="cart-item">
                <img src="<?php echo htmlspecialchars($userProduct['image']); ?>" alt="Product Image" class="product-image">
                <div class="product-details">
                    <p><?php echo htmlspecialchars($userProduct['name']); ?></p>
                    <p class="price"><?php echo htmlspecialchars($userProduct['price']); ?></p>
                    <div class="quantity-selector">
                        <button class="minus-btn">−</button>
                        <input type="text" value="<?php echo htmlspecialchars($userProduct['quantity']); ?>" class="quantity-input">
                        <button class="plus-btn">+</button>
                    </div>
                </div>
                <button class="delete-btn">🗑️</button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="cart-footer">
        <button class="view-bag-btn">View Bag (1)</button>
        <button class="checkout-btn">Checkout</button>
    </div>
</div>

<script>
    document.getElementById('cart-button').addEventListener('click', function() {
        document.getElementById('mini-cart').classList.add('active');
    });

    document.getElementById('close-cart').addEventListener('click', function() {
        document.getElementById('mini-cart').classList.remove('active');
    });
</script>

</body>
</html>
