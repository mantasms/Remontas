<?php
require '../bootloader.php';
$form = [
    'fields' => [
        'skyrius' => [
            'name' => 'skyrius',
            'label' => '',
            'type' => 'select',
            'options' => [
                'tarptautiniai',
                'vietiniai',
                'mokykla',
                'lengvieji',
                'rezervas',
                'bendros'
            ],
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

function form_success($safe_input, $form) {
    $db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
    $model_irasas = new App\model\ModelIrasas('kokteiliai', $db);
    $irasas = new \App\Item\Irasas([
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
        'dok_suma' => $safe_input['dok_suma'],
    ]);
    $id = time() . '_' . rand(0, 10000);
    $model_irasas->insert($id, $irasas);
}

if (!empty($_POST)) {
    $safe_input = get_safe_input($form);
    $success = validate_form($safe_input, $form);
}

$db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
$model_irasas = new App\model\ModelIrasas('kokteiliai', $db);
//$model_irasas->insert('viskis', $viskis);
//$model_irasas->insert('vodke', $vodke);
//$model_irasas->insert('ginas', $ginas);
//$model_irasas->insert('likeris', $likeris);

$connection = new Core\Database\Connection([
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'JB4BZEm0'
        ]);

$pdo = $connection->getPDO();
$pdo->exec("INSERT INTO `mydb`.`users` (`email`, `surname`)
VALUES('php mailas', 'balaboskinas')");
?>
<html>
    <head>
        <title>Remontas</title>
    </head>
    <body>
        <div>
            <?php require ROOT_DIR . '/core/views/form.php'; ?>
        </div>
        <?php foreach ($model_irasas->loadAll() as $irasas): ?>
            <div>
                <p>Dok Suma: <?php print $irasas->getDokSuma(); ?> Valstybinis nr.: <?php print $irasas->getValstNr(); ?></p>
                <p>Valstybinis nr.: <?php print $irasas->getValstNr(); ?></p>
            <?php endforeach; ?>
        </div>
    </body>
</html>