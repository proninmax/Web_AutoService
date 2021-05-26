<!DOCTYPE html>
<html>
    <head>
        <title>PHP1</title>
        <meta charset="utf-8">
        <link rel = "stylesheet" type = "text/css" href = "phptask1.css">  
    </head>
    <body>
    <div id = "wrap">
        <div id="header">
            <div>
                <p>PHP Задание 1.</p>
            </div>
        </div>
        <div id = "container">
            <form name="form" method="POST" action = "action.php">
                <input type="hidden" name = "number" id="n"/>
            </form>
            <script language="JavaScript" type="text/JavaScript">
                var n = Number(prompt("Вывод последовательности: 1!;2!;...;n!\nВведите число n "));
                document.getElementById("n").value = n;
                document.form.submit();
            </script>
        </div>
        <div id="footer">
            <div>
                <a href = "https:\\labs\">Вернуться на главную</a>
            </div>
        </div>
    </div>
    </body>
</html>