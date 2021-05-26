<!DOCTYPE html>
<html>
    <head>
        <title>PHP3</title>
        <link rel = "stylesheet" type = "text/css" href = "phptask3.css">  
        <meta charset="utf-8">
        <?php
            abstract class Person
            {
                public $FullName;
                public $Age;
                public $Sex;

                public function __construct($fullName, $age, $sex)
                {
                    $this->FullName = $fullName;
                    $this->Age = $age;
                    $this->Sex = $sex;
                }
            }

            class Student extends Person
            {
                public $GroupNumber;
                public $ZachyotkaID;

                public function __construct($fullName, $age, $sex, $group, $ID)
                {
                    parent::__construct($fullName, $age, $sex);
                    $this->GroupNumber = $group;
                    $this->ZachyotkaID = $ID;
                }
            }

            class Teacher extends Person
            {
                public $Position;

                public function __construct($fullName, $age, $sex, $position)
                {
                    parent::__construct($fullName, $age, $sex);
                    $this->Position = $position;
                }
            }

            class StudCouncil
            {
                public $Members = array();
                public $Ustav;

                public function outputStudCouncilMembers()
                {
                    echo "<table>";
                    echo "<tr>";
                        echo "<th>ФИО</th>";
                        echo "<th>Возраст</th>";
                        echo "<th>Пол</th>";
                        echo "<th>Роль</th>";
                        
                    echo "</tr>";
                    foreach ($this->Members as $member => $memberInfo)
                    {
                        echo "<tr>";
                        echo "<td>$memberInfo->FullName</td>";
                        echo "<td>$memberInfo->Age</td>";
                        echo "<td>$memberInfo->Sex</td>";
                        echo "<td>$memberInfo->Position</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }

            class StudCouncilMember extends Student
            {
                public $position;

                public function __construct($fullName, $age, $sex, $group, $ID)
                {
                    parent::__construct($fullName, $age, $sex, $group, $ID);
                }    
            }

            class StudentsGroup
            {
                public $number;
                public $speciality;
                public $students = array();
                public $headMan;

                public function outputStudents($students)
                {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th colspan = '4'>Группа <i>$this->number</i> направление <i>$this->speciality</i></th>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<th>№ зачетки</th>";
                        echo "<th>ФИО</th>";
                        echo "<th>Возраст</th>";
                        echo "<th>Пол</th>";
                    echo "</tr>";
                    foreach ($students as $student => $studentInfo)
                    {
                        echo "<tr>";
                        echo "<td>$studentInfo->ZachyotkaID</td>";
                        echo "<td>$studentInfo->FullName</td>";
                        echo "<td>$studentInfo->Age</td>";
                        echo "<td>$studentInfo->Sex</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    $headmanFullName = $this->headMan->FullName;
                }

                public function outputGroupAsTable()
                {
                    $this->outputStudents($this->students);
                }

                public function outputMenAsTable()
                {
                    $men = $this->menToList();
                    $this->outputStudents($men);
                }
                
                function menToList()
                {
                    $men = array();
                    $q = 0;
                    foreach ($this->students as $student => $studentInfo)
                    {
                        if ($studentInfo->Sex == 'Муж.')
                        {
                            $men[] = $studentInfo;
                        }
                    }
                    return $men;
                }
            }
        ?>
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
                    $studentsGroup->outputMenAsTable();

                    echo "<h1>Студсовет</h1>";
                    $council = new StudCouncil;

                    $vitya = new Student('Кто-то Виктор Вячеславович', 20, 'Муж.', '745', 432592);
                    $denis = new Student('Какой-то Денис Дмитриевич', 20, 'Муж.', '945', 5322);
                    $council->Members = [$vitya, $denis];
                    $denis->Position = 'Председатель';
                    $vitya->Position = 'Заместитель председателя';

                    $council->Ustav = 'Тут  текст устава, lorem ipsum dolor';
                    echo "<p><b>Устав: </b><br> $council->Ustav";
                    $council->outputStudCouncilMembers();
                ?>
                </div>
                
        </div>
    </body>
</html>