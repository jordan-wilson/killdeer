<!doctype html>
<html>
    <head>
        <title>Page Not Found</title>
        <style>
            body { 
                font-size: 15px;
                line-height: 1.5;
                font-family: Arial, sans-serif;
            }
        </style>
    </head>
    <body>
        <h2><?= $message; ?></h2>
        <p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        <p>Please try the following:</p>
        <ul>
            <li>If you typed the page address in the Address bar, make sure that it is spelled correctly.</li>
            <li>Return to a <a href="javascript:history.go(-1)">previous page</a>.</a></li>
            <li>Visit the <a href="/">home page</a> and then look for links to the information you want.</a></li>
        </ul>
    </body>
</html>