<?php
declare(strict_types=1);

require_once __DIR__ . '/Duties.php';
require_once __DIR__ . '/Homework.php';
require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/Mentor.php';

$student = new Student();
$mentor = new Mentor();


$student->setName('Anton');
$student->setSurname('Mykhailovskyi');
$mentor->setName('Dmytro');
$mentor->setSurname('Kotenko');

$mentor->setStudentHomework('Do task from 1 to 5');


$student->getHomework($mentor->getStudentHomework());

if(mt_rand(1,2) === 1) {
    $student->doingHomework();
}


if(!$student->homeworkIsDone()){
    exit("<p style='font-size: 20px; text-align: center'>Student {$student->getSurname()} {$student->getName()} did not complete homework '<strong>{$mentor->getStudentHomework()}</strong>'</p>");
}

$mentor->sendHomework($student->doneHomework);

$student->grade = $mentor->evaluationHomework();


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border="2" cellpadding="20" align="center" style="border-spacing: 10px; border-color: red">
    <?php
        echo <<<RESULT
            <tr><td>Homework (<strong>{$mentor->getStudentHomework()}</strong>) that mentor 
            {$mentor->getSurName()} {$mentor->getName()} sent to student</td></tr> 
            <tr><td>Completed homework (<strong>{$student->doneHomework}</strong>) from student {$student->getSurname()} {$student->getName()} </td></tr>
            <tr><td><h1>Final grade Anton`s homework — {$student->grade}</h1></td></tr>
            RESULT;
    ?>
</table>
</body>
</html>
