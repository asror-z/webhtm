<?php

use yii\helpers\Html;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Офферы';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = false;
$action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

$this->beginPage();
?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>

        <?php

        require Root . '/webhtm/block/metas/main.php';
        require Root . '/webhtm/block/assets/App/main_arbit.php';

        $this->head();

        ?>

    </head>


    <body class="<?= ZWidget::skin['white-skin'] ?>">

    <?php

    $this->beginBody();

    echo $this->require( '\webhtm\cpas\blocks\header.php');



    ?>

    <div id="page">

        <?
        $search = Html::encode($this->httpGet('search'));
        $countries = \zetsoft\models\place\PlaceCountry::find()->select('id,name')->orderBy('name ASC')->asArray()->all();

        $this->userIdentity()->user_company_id;

        ?>
        <div class="mt-2">
            <div class="p-1 bg-white mx-1 p-3">
                <h2 class="text-muted"><?= Az::l('Офферы')?></h2>
                <a href="/cpas/admin/statistic.aspx"><?= Az::l('Главная')?></a><span> / <?= Az::l('Офферы')?></span>
            </div>
        </div>
        <div class="container-fluid grey lighten-5 pt-1">
          <form method="get" class="col-md-9 offer-search d-flex">
            <select class="browser-default custom-select" id="country" name="country">
                <?php
                $all = false;
                if (!$this->httpGet('country')) {
                    $all = true;
                } ?>

              <option <?= $all ? 'selected' : '' ?> value="">Все</option>
                <?php
                foreach ($countries as $country):
                    $selected = false;

                    if ($country['id'] === (int)$this->httpGet('country')) {
                        $selected = true;
                    }
                    ?>

                  <option value="<?= $country['id'] ?>" <?= $selected ? 'selected' : '' ?>><?= $country['name'] ?></option>
                <?php endforeach; ?>

            </select>
            <input type="text" name="search" value="<?php echo $search; ?>" class="textbox"
                   placeholder="Искать офферы по названию"
                   id="searchInput">
            <input title="Search" value="" type="submit" class="button" id="searchSubmit">
          </form>
            <div class="row">
                <div class="col-md-12 pt-2">
                    <?php

                    $model = new CpasOffer();

                    $urlof = ZUrl::to([
                        '/cpas/admin/createOffer',
                    ]);

                    echo ZButtonWidget::widget([
                        'config' => [
                            'url' => $urlof,
                            'text' => Az::l('Создать оффер'),
                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                            'hasIcon' => false,
                            'btn' => true,
                            'class' => 'py-1 px-3 rounded',
                            'btnRounded' => false,
                        ]
                    ]);
                    if ($search) {
                        $model->query = CpasOffer::find()
                            ->where([
                                '!=', 'status', 'not_accepted'
                            ])->andWhere(['like', 'title', '%' . $search . '%', false])
                            ->orWhere(['like', 'title', '%' . ucfirst($search) . '%', false])
                            ->orderBy([
                                'id' => SORT_DESC
                            ]);
                    } else {
                        $model->query = CpasOffer::find()
                            ->where([
                                '!=', 'status', 'not_accepted'
                            ])
                            ->orderBy([
                                'id' => SORT_DESC
                            ]);
                    }
                    echo ZListViewWidget::widget([
                        'model' => $model,
                        'config' => [
                            'type' => ZListViewWidget::type['model'],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->require( '/webhtm/cpas/admin/card.php', [
                                    'id' => ZArrayHelper::getValue($model, 'id')
                                ]);
                            },
                            'layout' => "{items}\n{pager}"
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>



    <? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>

    <?php $this->endBody() ?>

    </body>

    </html>

<?php $this->endPage() ?>
