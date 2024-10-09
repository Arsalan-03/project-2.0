<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>
<body>
<div class="container">
    <form action="/registrate" method="post" id="form" class="form">
        <h2>Регистрация!</h2>
        <div class="form-control">
            <label for="username">Username</label>
            <label style="color: red"><?php echo $errors['name'] ?? ''; ?></label>
            <input type="text" id="username" name="name" placeholder="Enter username" required />
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="email">Email</label>
            <label style="color: red"><?php echo $errors['email'] ?? '';?></label>
            <input type="text" id="email" name="email" placeholder="Enter email" required/>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="password">Password</label>
            <label style="color: red"><?php echo $errors['password'] ?? ''; ?></label>
            <input type="password" id="password" name="password" placeholder="Enter password" required/>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="password2">Confirm password</label>
            <label style="color: red"><?php echo $errors['password-repeat'] ?? ''; ?></label>
            <input
                    type="password"
                    id="password2"
                    name="password-repeat"
                    placeholder="Renter your password" required
            />
            <small>Error message</small>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora&family=Yeseva+One&display=swap');

    * {
        --hibiscus-love: #fc465c;
        --fine-ii: #f9b198;
        --afl: #fac8af;
        --mexican-sky: #cfdddd;
        --brasillia-peach: #facb85;
        --free: #33032d;
        --captured: #2b2120;

        --primary-color: var(--brasillia-peach);
        --secondary-color: var(--hibiscus-love);
        --tertiary-color: var(--fine-ii);
        --quadrary-color: var(--afl);
        --bg-color: var(--mexican-sky);
        --text-color: var(--free);
        --header-color: var(--captured);
        --error-color: var(--hibiscus-love);
        --success-color: #73d12e;

        box-sizing: border-box;
    }

    h1,
    h2,
    h3,
    h4,
    h5 {
        font-family: 'Yeseva One', Georgia, cursive;
        color: var(--header-color);
    }

    body {
        font-family: 'Lora', 'Times New Roman', serif;
        background-color: var(--bg-color);
        color: var(--free);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-flow: column nowrap;
        min-height: 100vh;
    }

    .container {
        width: 400px;
        border-radius: 0.6em;
        padding: 20px;
        background-color: var(--primary-color);
        box-shadow: 20px 20px 60px #97a1a1, -20px -20px 60px #ffffff;
        margin: 20px auto;
    }

    .form {
        padding: 30px 40px;
    }

    .form h2 {
        text-align: center;
        margin: 0 0 20px;
    }

    .form-control {
        margin-bottom: 10px;
        padding-bottom: 20px;
        position: relative;
    }

    .form-control label {
        color: var(--text-color);
        display: block;
        margin-bottom: 5px;
    }
    .form-control input {
        border-radius: 6px;
        background: var(--primary-color);
        box-shadow: inset 3px 3px 7px #e9bd7c, inset -3px -3px 7px #ffd98e;
        min-height: 2.618em;
        border: var(--quadrary-color) solid 2px;
        display: block;
        width: 100%;
        font-size: 14px;
        padding: 10px;
    }

    .form-control input:focus {
        outline: 0;
        border-color: var(--tertiary-color);
    }

    .form-control.success input {
        border-color: var(--success-color);
    }

    .form-control.error input {
        border-color: var(--error-color);
    }

    .form-control small {
        color: var(--error-color);
        position: absolute;
        bottom: 0;
        left: 0;
        visibility: hidden;
    }

    .form-control.error small {
        visibility: visible;
    }

    .form button {
        cursor: pointer;
        background: var(--secondary-color);
        box-shadow: 4px 4px 8px #c19c66, -4px -4px 8px #fffaa4;
        border: 1px solid #ec263c66;
        color: #fff;
        font-size: 16px;
        padding: 0.618em 1.2em;
        border-radius: 0.4em;
        font-family: 'Yeseva One', Georgia, cursive;
        display: block;
        margin-top: 1.2em;
        width: 100%;
    }

    .form button:active,
    .form button:focus {
        outline: 0;
        background-color: #fc364c;
    }
</style>