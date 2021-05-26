<!DOCTYPE html>
<html>
    <head>
        <title>PHP4</title>
        <link rel = "stylesheet" type = "text/css" href = "phptask4.css">  
        <meta charset="utf-8">
        <?php
            include 'classes.php';
        ?>
    </head>
    <body>
        <?php
            $studentsGroup = new StudentsGroup;
            $studentsGroup->number = "845";
            $studentsGroup->speciality = "Информатика и вычислительная техника";
            for($i = 1; $i < 10; $i++)
            {
                if (isset($_POST["CB$i"]))
                {
                    if (($_POST['sex'] == women && $_POST["sex$i"] == 'Жен.')
                    || ($_POST['sex'] == men && $_POST["sex$i"] == 'Муж.'))
                        $studentsGroup->addStudent(new Student($_POST["name$i"], $_POST["age$i"], $_POST["sex$i"], '846', $_POST["ID$i"]));

                }
            }
            echo "<table>";
                echo "<tr>";
                    echo "<th colspan = '4'>Группа <i>$studentsGroup->number</i> направление <i>$studentsGroup->speciality</i></th>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>№ зачетки</th>";
                    echo "<th>ФИО</th>";
                    echo "<th>Возраст</th>";
                    echo "<th>Пол</th>";
                echo "</tr>";
            foreach ($studentsGroup->students as $student => $studentInfo)
            {
                echo "<tr>";
                echo "<td>$studentInfo->ZachyotkaID</td>";
                echo "<td>$studentInfo->FullName</td>";
                echo "<td>$studentInfo->Age</td>";
                echo "<td>$studentInfo->Sex</td>";
                echo "</tr>";
            }
        ?>
        <a href = "index.php">Вернуться назад</a>
    </body>
</html>