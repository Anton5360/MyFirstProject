<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../samples/style.css">
    <title>Homework</title>
</head>
<body>
<?php
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
?>
<table>
    <tr>
        <th class="main">TaskID</th>
        <th class="main">Task Title</th>
        <th class="main" colspan="3">Task Owner</th>
        <th class="main">Task Description</th>
        <th class="main" colspan="3">Task Deadline</th>
        <th class="main">Task Status</th>
    </tr>
    <tr>
        <th class="submain"></th>
        <th class="submain"></th>
        <th class="submain">name</th>
        <th class="submain">surname</th>
        <th class="submain">age</th>
        <th class="submain"></th>
        <th class="submain">day</th>
        <th class="submain">month</th>
        <th class="submain">year</th>
        <th class="submain"></th>
    </tr>
        <?php
        foreach ($taskManager as $task) {
            echo "<tr>
            <td>{$task['taskID']}</td><td>{$task['taskTitle']}</td>
            <td>{$task['taskOwner']['name']}</td><td>{$task['taskOwner']['surname']}</td><td>{$task['taskOwner']['age']}</td>
            <td>{$task['taskDescription']}</td><td>{$task['taskDeadline']['day']}</td><td>{$task['taskDeadline']['month']}</td>
            <td>{$task['taskDeadline']['year']}</td><td>{$task['taskStatus']}</td>
            </tr>";
        }
        ?>
</table>

</body>
</html>



