<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <title>广东省市县稻谷预警系统</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="/grps/Public/css/login.css" />
        <link rel="shortcut icon" href="/grps/Public/img/favicon.ico"/>
        <script type="text/javascript" src="jquery-1.7.min.js"></script>
    </head>

    <body>
    <div class="bg"></div>
    <div class="lg-container">
    <div class="lg-title">
    	<h1>广东省市县稻谷预警系统</h1>
    </div>
        <form action="/grps/index.php?m=Home&c=User&a=login" id="lg-form" name="lg-form" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" name="user_name" id="username" placeholder="username"/>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="user_pw" id="password" placeholder="password" />
            </div>
            <div>               
                <button type="submit" id="login">Login</button>
            </div>
        </form>
    
    </div>
    </body>
</html>