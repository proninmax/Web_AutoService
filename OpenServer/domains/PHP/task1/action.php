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
                <?php
                    function fact($n)
                    {
                        $fact = 1;
                        for ($i = 1; $i <= $n; $i++)
                        {
                            $fact = $fact * $i;
                        }
                        return $fact;
                    }

                    $n = $_POST['number'];
                    for ($i = 1; $i <= $n; $i++)
                    {
                        echo fact($i) . ";";
                    }
                ?>
            </div>
           
        </div>
    </body>
</html>