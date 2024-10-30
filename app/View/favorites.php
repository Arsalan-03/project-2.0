<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto');

        body {
            font-family: 'Roboto', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
        }

        i {
            margin-right: 10px;
        }

        input:focus,
        button:focus,
        .form-control:focus {
            outline: none;
            box-shadow: none;
        }

        .form-control:disabled, .form-control[readonly] {
            background-color: #fff;
        }

        .table tr,
        .table tr td {
            vertical-align: middle;
        }

        .button-container .form-control {
            max-width: 80px;
            text-align: center;
            display: inline-block;
            margin: 0px 5px;
        }

        #myTable .form-control {
            width: auto;
            display: inline-block;
        }

        .img-prdct {
            width: 50px;
            height: 50px;
            border-radius: 4px;
        }

        .img-prdct img {
            width: 100%;
        }

        .table td, .table th {
            padding: 1rem;
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
<div class="container-fluid mt-5">
    <h2 class="mb-5 text-center">Избранное</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Info</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="product-img">
                                <div class="img-prdct"><img src="https://image.flaticon.com/icons/png/512/3144/3144467.png"></div>
                            </div>
                        </td>
                        <td>
                            <p>Product One</p>
                        </td>
                        <td align="right">$ <span class="amount">0</span></td>
                        <td>
                            <p>Product One</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="product-img">
                                <div class="img-prdct"><img src="https://image.flaticon.com/icons/png/512/3144/3144467.png"></div>
                            </div>
                        </td>
                        <td>
                            <p>Product Two</p>
                        </td>
                        <td align="right">$ <span class="amount">0</span></td>
                        <td>
                            <p>Product Two</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="product-img">
                                <div class="img-prdct"><img src="https://image.flaticon.com/icons/png/512/3144/3144467.png"></div>
                            </div>
                        </td>
                        <td>
                            <p>Product Three</p>
                        </td>
                        <td align="right">$ <span class="amount">0</span></td>
                        <td>
                            <p>Product Three</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="product-img">
                                <div class="img-prdct"><img src="https://image.flaticon.com/icons/png/512/3144/3144467.png"></div>
                            </div>
                        </td>
                        <td>
                            <p>Product Four</p>
                        </td>
                        <td align="right">$ <span class="amount">0</span></td>
                        <td>
                            <p>Product Four</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>