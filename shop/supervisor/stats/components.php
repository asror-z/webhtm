<div class="col-sm-4  mt-3">
    <?php

    use zetsoft\system\Az;
    use zetsoft\widgets\former\ZFormWidget;
    use zetsoft\widgets\navigat\ZButtonWidget;

    $form = $this->ajaxBegin();
    ?>


    <div class="row">
        <div class="col-12 d-flex">

            <?php
/*

            echo ZFormWidget::widget([
                'model' => $model_d,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => false,
                ],
            ]); */?>
            <div class="col-6 d-grid">
                <?php
                echo ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Филтровать'),
                        'btnType' => ZButtonWidget::btnType['submit'],
                        'btnRounded' => false,
                        'btnStyle' => 'text-success border border-success',
                        'btnSize' => 'btn-ml',
                        'class' => 'p-1 pl-3 pr-3',
                    ]

                ]);

                ?>
            </div>
            <div class="col-6 d-grid">
                <?php
                echo ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Очистить фильтр'),
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnRounded' => false,
                        'btnStyle' => 'text-success border border-success',
                        'btnSize' => 'btn-ml',
                        'class' => 'p-1 pl-3 pr-3',
                    ],
                    'event' => [
                        'click' => <<<JS
                                        function() {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '/core/product/rangeClearCalls.aspx',
                                                    success: function (response) {
                                                        location.reload();
                                                    },
                                                });
                                            
                                        }
JS
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>



    <?php
    $this->ajaxEnd();
    ?>
</div>
