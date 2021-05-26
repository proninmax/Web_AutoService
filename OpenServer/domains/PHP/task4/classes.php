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

                public function addStudent($student)
                {
                    $this->students[] = $student;
                }
                public function outputStudents($students)
                {
                    echo "<form method = \"post\" action = \"markedStudents.php\">";
                    echo "<div>";
                        echo "<input type = \"radio\" id = \"men\" name = \"sex\" value = \"men\" checked>";
                        echo "<label for \"men\"> Парни</label>";
                    echo "</div>";
                    echo "<div>";
                        echo "<input type = \"radio\" id = \"women\" name = \"sex\" value = \"women\">";
                        echo "<label for \"women\"> Девушки</label>";
                    echo "</div>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th colspan = '5'>Группа <i>$this->number</i> направление <i>$this->speciality</i></th>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<th>№ зачетки</th>";
                        echo "<th>ФИО</th>";
                        echo "<th>Возраст</th>";
                        echo "<th>Пол</th>";
                        echo "<th>Учет посещаемости</th>";
                    echo "</tr>";
                    $counter = 1;
                    foreach ($students as $student => $studentInfo)
                    {
                        
                        echo "<tr>";
                        echo "<td><input type = \"hidden\" name = \"ID$counter\" value = \"$studentInfo->ZachyotkaID\">$studentInfo->ZachyotkaID</input></td>";
                        echo "<td><input type = \"hidden\" name = \"name$counter\" value = \"$studentInfo->FullName\">$studentInfo->FullName</input></td>";
                        echo "<td><input type = \"hidden\" name = \"age$counter\" value = \"$studentInfo->Age\">$studentInfo->Age</input></td>";
                        echo "<td><input type = \"hidden\" name = \"sex$counter\" value = \"$studentInfo->Sex\">$studentInfo->Sex</input></td>";
                        echo "<td><input type = \"checkbox\" name = \"CB$counter\"></td>";
                        echo "</tr>";
                        $counter++;
                    }
                    echo "</table>";
                    echo "<input type = \"submit\" value = \"OK\">";
                    echo "</form>";
                    $headmanFullName = $this->headMan->FullName;
                }

                public function outputGroupAsTable()
                {
                    $this->outputStudents($this->students);
                }

                public function outputStudentsListAsTable($students)
                {
                    $this->outputStudents($students);
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