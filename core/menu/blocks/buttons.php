<div class="card-footer d-flex col-lg-12" style="padding:1.75rem !important;">
    <div class="btn-group">
        <button type="button" id="btnUpdate" title="Обновить"
                class="btn btn-rounded  btn-outline-success"
                disabled style="" aria-label="tooltip"><i
                class="fas fa-sync-alt ft"></i>
        </button>
        <?php

        use kartik\form\ActiveForm;
        use zetsoft\system\helpers\ZHTML;

        $form = ActiveForm::begin(['id' => 'menuform']);


        echo $form->field($form, 'json')->hiddenInput(['value' => $json])->label(false);

        echo ZHTML::submitButton('<i class="fas fa-save ft"></i>', ['class' => 'btn btn-outline-primary', 'title' => 'Сохранить']);

        ActiveForm::end();

        ?>
        <button type="button" class="btn btn-rounded btn-outline-dark" title="Добавить" style=""
                id="btnAdd"><i class="fas fa-plus ft"></i>
        </button>
    </div>
    <div class="ml-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-rounded btn-outline-danger" title="Удалить меню"
                    id="delMen"><i
                    class="far fa-trash-alt ft"></i>
            </button>
            <button type="button" class="btn btn-rounded btn-outline-primary" title="Примерное меню"
                    id="setDat">
                <i class="fas fa-code"></i>
            </button>

        </div>
    </div>


</div>
