<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Roboto", sans-serif;
            background-color: #DEB992;
        }

        a {
            text-decoration: none;
        }

        section {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 колонки */
            gap: 20px;
            padding: 20px;
            justify-items: center;
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
    </style>
</head>
<body>
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
                            <a href="#"><i class="fa fa-heart"></i></a>
                            <a href="#"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; } ?>
</section>
</body>
</html>


