<?php
error_reporting(E_ALL);
/*$pow = 2 ** 4;
$count = 0;
function power($number, $power)
{
    global $count;
    $count++;
    if($power === 0)
    {
        return 1;
    }
    if($power % 2 === 0)
    {
        $num = power($number, $power / 2);
        return $num * $num;
    } else
    return $number * power($number,$power-1);
}
//var_dump(power(5,3), $count);*/

/**
 * @param array $example
 * @param string $space
 * @return string
 */
function displayVarDump(array $example, string $space = '') : string
{
    $spaceFixation = $space;
    $space .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $array = " Array<br>{$spaceFixation}(<br>";
    foreach ($example as $key => $value)
    {
        if(is_array($value)) {
            $array .= "{$space}[{$key}] =>";
            $array .= displayVarDump($value, $space). "{$space})<br>";
        }
        else
        {
            $array .= "{$space}[{$key}] => {$value}<br>";
        }
    }
return $array;
}





$taskManager = [
    [
        'taskID' => '1',
        'taskTitle' => 'PHP Course',
        'taskDescription' => 'It will improve backend developer skills',
        'taskOwner' => [
            'name' => 'Anton',
            'surname' => 'Mykhailovskyi',
            'age' => '18'
        ],
        'taskDeadline' => [
            'day' => '25',
            'month' => 'January',
            'year' => '2020',
        ],
        'taskStatus' => 'In processing'
    ],
    [
        'taskID' => '2',
        'taskTitle' => 'Team',
        'taskDescription' => 'It will improve our teamwork skills',
        'taskOwner' => [
            'name' => 'Jack',
            'surname' => 'Kelson',
            'age' => '20'
        ],
        'taskDeadline' => [
            'day' => '30',
            'month' => 'June',
            'year' => '2021',
        ],
        'taskStatus' => 'done',
    ],
    [
        'taskID' => '3',
        'taskTitle' => 'Languages',
        'taskDescription' => 'It will improve English, French and Germain skills',
        'taskOwner' => [
            'name' => 'Alexey',
            'surname' => 'Popov',
            'age' => '26'
        ],
        'taskDeadline' => [
            'day' => '2',
            'month' => 'May',
            'year' => '2020',
        ],
        'taskStatus' => 'Not started',
    ],
];
//echo (displayVarDump($taskManager));

function countRecursive(array $example, bool $parentsCount = true) : int
{

}