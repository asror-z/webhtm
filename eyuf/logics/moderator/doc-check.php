<div class="col-12">

    <?

    use zetsoft\models\App\eyuf\EyufDocument;
    use zetsoft\models\App\eyuf\EyufScholar;
    use zetsoft\system\Az;
    use zetsoft\system\kernels\ZView;
    use zetsoft\widgets\former\ZDynaWidget;
    use zetsoft\dbitem\core\WebItem;

    /** @var ZView $this */

    $action = new WebItem();

    $action->title = Azl . 'Cписок документов на подтверждение';
    $action->icon = 'fas fa-file';


    $action->layout = true;
    $action->debug = false;


    $this->paramSet(paramAction, $action);

    $this->title();
    $this->toolbar();
    //$company_id = $this->userIdentity()->getCoreCompany()->id;

    //start|JakhongirKudratov|2020-10-17

    $company_id = $this->userIdentity()->user_company_id;

    /*    $query = EyufScholar::find()
            ->where([
                'user_company_id' => $company_id
            ])
            ->one();*/

    $docs = new EyufDocument();

    $docs->configs->query = EyufDocument::find()
        ->where([
            'need_verify' => true
        ]);

    /*

      $docs->configs->query = EyufDocument::find()
          ->where([
              'eyuf_scholar_id' => $query->id
          ]);*/

    $docs->configs->readonlyOff = [
        'verified_email'
    ];

/*    $docs->configs->nameOn = [
        'id',
        'eyuf_document_type_id',
        'file',
        'verified_email',
        'file_comment',
        'comment',
    ];*/

    $docs->columns();

    //end|JakhongirKudratov|2020-10-17


    echo ZDynaWidget::widget([
        'model' => $docs,
        'rightBtn' => [
            'update' => [
                'content' => '',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],

            'system' => [
                'content' => '',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
            'add-clone-delete' => [
                'content' => '',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
            'filter-sort-id' => [
                'content' => '',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
            'statistics' => [
                'content' => '',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
            'export' => [
                'content' => '{jsonExcel}{export}',
                'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
            ],
            'toggleData' => [
                'content' => '{all}',
                'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
            ],
            'filterPjax' => [
                'content' => '',
                'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
            ],
        ],
        'config' => [
            'title' => Az::l('Cписок документов на подтверждение'),
            'actionEdit' => false,
            'topCreate' => false,
            'actionDelete' => false,
            'actionClone' => false,
            'actionView' => true,
            'columnAction' => false,
            'columnRelation' => false,
            'topSort' => false,
            'topFilter' => false,
            'topSetting' => false,
            'columnAfter' => false,
            'columnBefore' => [
                'false'
            ]


        ],
    ]);

    ?>

</div>
