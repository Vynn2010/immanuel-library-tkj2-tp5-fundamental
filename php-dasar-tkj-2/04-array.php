<?php
//basic array
$names = ['Alex', 'Valen', 'Alvin', 'Destin'];
echo $names[2];

//array asosiatif
$profile = [
    'name' => 'Alvin',
    'age' => 22,
    'job' => 'student',
];
echo $profile['job'];

//array multidimensi
$students = [
    [
        'nis'=> '001',
        'name'=>'Alex'
    ],
    [
        'nis'=> '002',
        'name'=>'Alvin'
    ]
];
echo $students[0]['name'];

foreach ($students as $student) {
    echo $student['nis'];
}
?>