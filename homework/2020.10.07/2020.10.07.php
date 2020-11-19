<?php
error_reporting(E_ALL);
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

print_r ($taskManager);