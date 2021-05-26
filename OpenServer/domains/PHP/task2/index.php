<!DOCTYPE html>
<html>
    <head>
        <title>PHP2</title>
        <link rel = "stylesheet" type = "text/css" href = "phptask2.css">  
        <meta charset="utf-8">
        <?php
            
            function studentsToList($students)
            {
                $men = array();
                $q = 0;
                for ($i = 0; $i < 6; $i++)
                {
                    if ($students[$i][2] == "Муж.")
                    {
                        $men[$q] = $students[$i];
                        for ($j = 0; $j < 3; $j++)
                        {
                            $men[$q][$j] = $students[$i][$j];
                        }
                        $q++;
                    }
                }
                return $men;
            }
        ?>
    </head>
    <body>
        <div id = "wrap">
            <div id="header">
                <div>
                    <p>PHP Задание 2.</p>
                </div>
            </div>
            <div id = "container">
                <table>
                    <tr>
                        <th>№ пп</th>
                        <th>ФИО</th>
                        <th>Возраст</th>
                        <th>Пол</th>
                    </tr>
                    <?php
                        $students = array(
                            "1" => array("Сафронов Владимир Дмитриевич", 20, "Муж."),
                            "2" => array("Банников Никита Михайлович", 20, "Муж."),
                            "3" => array("Сургутов Михаил Павлович", 24, "Муж."),
                            "4" => array("Аджелина Джоли", 56, "Жен."),
                            "5" => array("Козлин Глеб Павлович", 19, "Муж.")
                        );
                        foreach ($students as $student => $stus)
                        {
                            echo "<tr>";
                            echo "<td>$student</td>";
                            foreach ($stus as $key => $value)
                            {
                                echo "<td>$value</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </table>
                <table>
                    <tr>
                        <th>№ пп</th>
                        <th>ФИО</th>
                        <th>Возраст</th>
                        <th>Пол</th>
                    </tr>
                    <?php
                        $men = studentsToList($students);
                        foreach ($men as $man => $student)
                        {
                            echo "<tr>";
                            $id = $man + 1;
                            echo "<td>$id</td>";
                            foreach ($student as $key => $value)
                            {
                                echo "<td>$value</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
            
        </div>
    </body>
</html>