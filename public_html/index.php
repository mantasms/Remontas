<?php
require '../bootloader.php';

use Core\Database\SQLBuilder;

$form = [
    'fields' => [
        'skyrius' => [
            'name' => 'skyrius',
            'label' => '',
            'type' => 'select',
            'options' => \App\Item\Irasas::getSkyriusOptions(),
            'placeholder' => 'skyrius',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'valst_nr' => [
            'name' => 'valst_nr',
            'label' => '',
            'type' => 'text',
            'placeholder' => 'valst. nr',
            'validate' => [
                'validate_not_empty',
//                'validate_caps',
//                'validate_no_spaces'
            ],
        ],
        'priemones_tipas' => [
            'name' => 'priemones_tipas',
            'label' => '',
            'type' => 'select',
            'options' => [
                'vilkikas',
                'puspriekabė',
                'lengvasis'
            ],
            'placeholder' => 'vilkikas/puspriekabė',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'marke' => [
            'name' => 'marke',
            'label' => '',
            'type' => 'text',
            'placeholder' => 'markė',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'pagaminimo_metai' => [
            'name' => 'pagaminimo_metai',
            'label' => '',
            'type' => 'number',
            'placeholder' => 'pagaminimo metai',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'dok_nr' => [
            'name' => 'dok_nr',
            'label' => '',
            'type' => 'text',
            'placeholder' => 'dok. nr.',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'dok_data' => [
            'name' => 'dok_data',
            'label' => '',
            'type' => 'date',
            'placeholder' => 'dok. data',
//            'title'=> 'd/m/Y',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'tiekejas' => [
            'name' => 'tiekejas',
            'label' => '',
            'type' => 'text',
            'placeholder' => 'tiekėjas',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'detale_darbas' => [
            'name' => 'detale_darbas',
            'label' => '',
            'type' => 'text',
            'placeholder' => 'detalė/darbas',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'vnt_kaina' => [
            'name' => 'vnt_kaina',
            'label' => '',
            'type' => 'float',
            'placeholder' => 'vnt. kaina',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'dok_suma' => [
            'name' => 'dok_suma',
            'label' => '',
            'type' => 'float',
            'placeholder' => 'dok. suma',
            'validate' => [
                'validate_not_empty',
            ],
        ],
    ],
    'buttons' => [
        'submit' => [
            'text' => 'Submit'
        ]
    ],
    'callbacks' => [
        'success' => [
            'form_success'
        ],
        'fail' => []
    ]
];

$connection = new Core\Database\Connection([
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'JB4BZEm0'
        ]);

$pdo = $connection->getPDO();

function form_success($safe_input, $form) {
    $connection = new Core\Database\Connection([
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'JB4BZEm0'
    ]);

    $data = [
        'skyrius' => $safe_input['skyrius'],
        'valst_nr' => $safe_input['valst_nr'],
        'priemones_tipas' => $safe_input['priemones_tipas'],
        'marke' => $safe_input['marke'],
        'pagaminimo_metai' => $safe_input['pagaminimo_metai'],
        'dok_nr' => $safe_input['dok_nr'],
        'dok_data' => $safe_input['dok_data'],
        'tiekejas' => $safe_input['tiekejas'],
        'detale_darbas' => $safe_input['detale_darbas'],
        'vnt_kaina' => $safe_input['vnt_kaina'],
        'dok_suma' => $safe_input['dok_suma']
    ];

    $columns = array_keys($data);

    $pdo = $connection->getPDO();
    $sql = strtr('INSERT INTO @db.@table ' .
                    '(@columns) VALUES (@values)', [
        '@db' => SQLBuilder::schema('mydb'),
        '@table' => SQLBuilder::table('remontas'),
        '@columns' => SQLBuilder::columns($columns),
        '@values' => SQLBuilder::binds($columns)
    ]);
    var_dump($sql);
    $query = $pdo->prepare($sql);

    foreach ($data as $column => $value) {
        $query->bindValue(SQLBuilder::bind($column), $value);
    }

    $query->execute();
}

if (!empty($_POST)) {
    $safe_input = get_safe_input($form);
    $success = validate_form($safe_input, $form);
}


$query = $pdo->query('SELECT * FROM `mydb` . `remontas`');
$data = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <title>Remontas</title>
    </head>
    <body>
        <div>
            <?php require ROOT_DIR . '/core/views/form.php'; ?>
        </div>
        <table>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?php print \App\Item\Irasas::getSkyriusOptions()[$row['skyrius']]; ?></td>                    
                    <?php foreach ($row as $column): ?>
                        <td><?php print $column; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>