<!doctype HTML>
<html>
    <head>
        <title><?= $title; ?></title>
        <style>
            body { 
                font-family: Arial, sans-serif;
                background-color: #f9f9f9; 
            }
            .box {
                width: 600px;
                color: #3e3e3e;
                margin: 100px auto;
                padding: 30px;
                border: 1px solid orange;
                background-color: white;
            }
            h1 {
                margin: 0px 0px 20px 0px;
                font-size: 18px;
                padding-bottom: 4px;
                border-bottom: 1px solid #3e3e3e;
            }
            p {
                font-size: 12px;
                line-height: 18px;
            }
        </style>
    </head>
    
    <body>
        <div class="box">
            <h1>Hello</h1>
            <p><?= $message; ?></p>
        </div>
    </body>
</html>