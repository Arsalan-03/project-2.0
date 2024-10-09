<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("location: /login");
    exit();
} else {
    $userId = $_SESSION['login'];
    try {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT up.id, u.id, u.name AS user_name, u.email, u.password, 
        p.id, p.name, p.image, p.info, p.price, up.quantity FROM user_products up
        JOIN users u ON up.user_id = u.id
        JOIN products p ON up.product_id = p.id
        WHERE u.id = :user_id;");
        $stmt->execute(['user_id' => $userId]);
        $userProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalPrice = 0;

        foreach ($userProducts as $userProduct) {
            $totalPrice += $userProduct['price'] * $userProduct['quantity'];
        }

    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    require_once './main.php';
}
?>

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
    <h3>Catalog</h3>
    <div class="card-deck">
        <?php if (isset($products)) : ?>
            <?php foreach ($products as $product) : ?>
                <div class="card text-center">
                    <a href="#">
                        <img class="card-img-top" src="<?php echo htmlspecialchars($product['image']); ?>" alt="Card image">
                        <div class="card-body">
                            <p class="card-text text-muted"><?php echo htmlspecialchars($product['name']); ?></p>
                            <a href="#"><h5 class="card-title"><?php echo htmlspecialchars($product['info']); ?></h5></a>
                        </div>
                        <div class="card-footer">
                            <?php echo htmlspecialchars($product['price']); ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
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
    <div class="total">
        <span>Total:</span>
        <span class="total-amount">£ . <?php echo '$' . $totalPrice; ?> </span>
    </div>
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

        .card-deck {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 70px;
        }

        .card {
            flex: 1 1 calc(25% - 1rem);
            max-width: calc(25% - 1rem);
            margin: 1rem 0.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: #f8f9fa;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            font-weight: bold;
            font-size: 1.125rem;
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
