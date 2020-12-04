<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
use zetsoft\system\Az;
use zetsoft\widgets\iconers\ZLangPickerWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZTextAreaWidget;

?>


<div class="d-flex justify-content-between p-1" style="background: #fafafa;z-index: 5;">
    <div class="d-flex flex-grow-1 justify-content-around flex-wrap">

    </div>
    <div class="flex-grow-1"></div>
    <div class="flex-grow-1"></div>
    <div class="d-flex flex-grow-1 justify-content-around flex-wrap">
        <div>
        
        </div>
        <div class="d-flex align-items-center">
            <?
            echo ZLangPickerWidget::widget();
            ?>
        </div>
    </div>
</div>


<div class="modal fade" id="callBackModal" tabindex="-1" role="dialog" aria-labelledby="callBackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <p class="modal-title fp-20" id="callBackModalLabel">Служба поддержки</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fp-30">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                     <h3 class="text-center">Обратная связь</h3>
                     <p class="text-center text-muted font-weight-normal fp-16">Мы всегда готовы ответить на любой вопрос, а также <br> услышать ваши отзывы и предложения по работе нашего сервиса.</p>
                     <div class="d-flex">

                        <div class="col-md-6">

                            <?
                                echo ZHInputWidget::widget([
                                    'config' => [
                                         'class' => 'fp-16',
                                        'placeholder' => Az::L('Ваше имя')

                                    ]
                                ])
                            ?>

                        </div>

                        <div class="col-md-6">
                            <?
                            echo ZHInputWidget::widget([
                                'config' => [
                                    'class' => 'fp-16',
                                    'placeholder' => Az::L('Ваш город')

                                ]
                            ])
                            ?>
                        </div>

                    </div>

                     <div class="d-flex">

                         <div class="col-md-6">

                             <?
                             echo ZHInputWidget::widget([
                                 'config' => [
                                     'class' => 'fp-16',
                                     'placeholder' => Az::L('Мобильный телефон')

                                 ]
                             ])
                             ?>

                         </div>

                         <div class="col-md-6">

                             <?
                             echo ZHInputWidget::widget([
                                 'config' => [
                                     'class' => 'fp-16',
                                     'placeholder' => Az::L('Адрес электронной почты')
                                 ]
                             ])
                             ?>

                         </div>

                     </div>

                     <div class="col-md-12">

                        <div>

                            <?
                                echo ZTextAreaWidget::widget([
                                    'config' => [

                                        'placeholder' => Az::L('Опишите ваш вопрос'),
                                        'rows' => 1,
                                        'class' => 'border-light fp-17',
                                        'style' => 'max-height: 10px;'

                                    ]
                                ]);
                            ?>

                        </div>

                     </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                <button type="button" class="btn btn-success">Отправить</button>
            </div>
        </div>
    </div>
</div>



