<!DOCTYPE html>
<html>
    <head>
        <title>PHP4</title>
        <link rel = "stylesheet" type = "text/css" href = "phptask4.css">  
        <meta charset="utf-8">
        <?php include 'classes.php'; ?>
    </head>
    <body>
        <div id = "wrap">
            <div id="header">
                <div>
                    <p>PHP Задание 3.</p>
                </div>
            </div>
            <div id = "container">
                <?php
                    echo "<h1>Студенты</h1>";
                    $studentsGroup = new StudentsGroup;
                    $studentsGroup->number = "845";
                    $studentsGroup->speciality = "Информатика и вычислительная техника";

                    $sasha = new Student('Банников Владимир Дмитриевич', 20, 'Муж.', '845', 44792);
                    $dimae = new Student('Сафронов Никита Михайлович', 20, 'Муж.', '845', 32172);

                    $studentsGroup->students = [ $sasha, $dimae,
                                                new Student('Сургутов  Михаил Павлович', 24, 'Муж.', '845', 54324),
                                                new Student('Аджелина Джоли', 56, 'Жен.', '845', 54323),
                                                new Student('Козлин Глеб Павлович', 19, 'Муж.', '845', 54637)];
                    $studentsGroup->headMan = $studentsGroup->students[0];
                
                    $studentsGroup->outputGroupAsTable();
                    
                ?>
            </div>
           
        </div>
    </body>
</html>