<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kids Projects</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
* {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
}

body {
      font-family: "roboto";
}
.login-form .logo {
      width: 20%;
      display: block;
}
.login-form {
      position: relative;
      min-height: 100vh;
      z-index: 0;
      background-image:url("{{asset('assets')}}/images/bg.jpg");
      padding: 40px;
      justify-content: center;
      display: grid;
      grid-template-rows: 1fr auto 1fr;
      align-items: center;
}
.container {
      max-width: 800px;
      margin: 0 auto;
}

.login-form img {
      text-align: center;
      margin-left: auto;
      margin-right: auto;
      width: 100%;
}
.login-form h2 {
      font-size: 30px;
      line-height: 40px;
      margin-bottom: 5px;
      font-weight: 500px;
      color: #272346;
      text-align: center;
}

.login-form .main {
      position: relative;
      display: flex;
      margin: 30px 0;
      box-shadow: rgb(38 57 77) 0px 20px 30px -10px;
}
.login-form .content {
      flex-basis: 50%;
      padding: 3em 3em;
      background: #fff;
      box-shadow: 2px 9px 49px -17px rgba(0, 0, 0, 0.1);
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;
}
.form-img {
      flex-basis: 50%;
      background: #ffffff;
      background-size: cover;
      padding: 40px;
      border-top-right-radius: 8px;
      border-bottom-right-radius: 8px;
      align-items: center;
      display: grid;
      box-shadow: rgb(38 57 77) 0px 20px 30px -10px;
}
.form-img img {
      max-width: 100%;
}

.account {
      color: #666;
      font-size: 16px;
      line-height: 18px;
      opacity: 0.5;
      text-align: center;
}
.btn,
button,
input {
      border-radius: 35px;
}

.btn:hover,
button:hover {
      transition: 0.5s ease;
}

a {
      text-decoration: none;
}

.login-form form {
      margin: 30px 0;
}

.login-form input {
      outline: none;
      margin-bottom: 10px;
      font-stretch: 19px;
      color: #999;
      text-align: left;
      padding: 14px 20px;
      width: 100%;
      display: inline-block;
      box-sizing: border-box;
      border: 1px solid #e5e5e5;
      background: #f7fafc;
      transition: 0.3s ease;
}

.login-form input:focus {
      background: transparent;
      border: 1px solid #0568c1;
}
button.btn {
      margin: 25px 0;
}
.login-form button {
      font-size: 18px;
      color: #fff;
      width: 100%;
      background: #0568c1;
      border: none;
      padding: 14px 15px;
      font-weight: 500;
      transition: 0.3s ease;
}

.login-form button:hover {
      background: #272346;

      color: #fff;
}

p.acount,
p.account a {
      text-align: center;
      padding: 20px;
      padding-bottom: 0;
      font-size: 16px;
      color: rgb(215, 212, 212);
}
p.account a {
      color: #0568c1;
}

p.account a:hover {
      text-decoration: underline;
}

/**Responsive login sistema */

@media (max-width: 746px) {
      .login-form .content {
            flex-basis: 60%;
            padding: 4em 4em;
            background: #fff;
            box-shadow: 2px 9px 49px -17px rgb(0 0 0 / 10%);
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
      }
      .login-form .main {
            flex-direction: column;
      }
      .login-form .main {
            position: relative;
            display: flex;
            margin: 48px -38px;
            box-shadow: rgb(38 57 77) 0px 20px 30px -10px;
      }
      .login-form form {
            margin-top: 30px;
            margin-bottom: 10px;
      }
      .form-img {
            border-radius: 0;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            order: 2;
      }
      .content {
            order: 1;
            border-radius: 0;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
      }
      .login-form .logo {
            width: 90%;
            display: block;
      }
      button.btn {
            margin: 25px 0;
      }
      .form-img {
            flex-basis: 50%;
            background: #ffffff;
            background-size: cover;
            padding: 40px;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            align-items: center;
            display: none;
            box-shadow: rgb(38 57 77) 0px 20px 30px -10px;
      }
      .account {
            color: #666;
            font-size: 16px;
            line-height: 19px;
            opacity: 0.5;
            text-align: center;
      }
}

    </style>
</head>
<body>
<div class="login-form">
<img class="logo" src="{{asset('assets')}}/images/adop_logointro_white.gif" alt="">
<div class="container">
    <div class="main">
        <div class="content">
                <h2>Sign In</h2>
                <form method="post" action="{!! url('auth/login') !!}">
                 {!! csrf_field() !!}
                    <input type="email" id="email" name="email" placeholder="Username" required>
                    <input type="password" id="password" name="password" placeholder="password" required>

                    <button class="btn" name="submit" name="submit" type="submit">Login</button>
                </form>
            </div>
            <div class="form-img">
                    <img src="{{asset('assets')}}/images/bg1.webp" alt="">
            </div>
        </div>
    </div>
</div>
</body>
</html>