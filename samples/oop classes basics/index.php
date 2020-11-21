<?php
declare(strict_types=1);

require_once __DIR__ . '/Human.php';
require_once __DIR__ . '/Student.php';


$student = new Student();
$student2 = new Student();

$student->setName('Anton');
$student->setSurname('Mykhailovskyi');
$student->setAge(18);
$student->setBirthday('06.06.2002');

$student->homework();
$student->breathe();

echo <<<INFO
Student {$student->getSurname()} {$student->getName()} has breathed {$student->memory['breathe']} times and must
do homework before {$student->homework()} date
INFO;
