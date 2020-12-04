<div class="col-12 border border-light rounded">
    <h4 class="mt-2">Смежные категории</h4>
    <?

    use zetsoft\system\Az;
    use zetsoft\widgets\menus\MenuItemWidget;
    use zetsoft\widgets\menus\ZMenuItemWidget;

    $category_id = $this->httpGet('id');
    if (isset($category_id))
        echo ZMenuItemWidget::widget([
            'config' => [
                'menuItem' => Az::$app->market->category->getMenuItem($category_id)
            ]
        ]);
    ?>
</div>
