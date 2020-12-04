<div class="form-group d-flex">
    <label for="title"></label>
    <i class="fas fa-comments iconn"></i>
    <select class="js-example-programmatic " style="width:50%;" name="text" id="text">
        <option></option>

        <?

        use zetsoft\system\helpers\ZArrayHelper;

        $texts = ZArrayHelper::map($actions, 'id', 'text');


        foreach ($texts as $key => $text):
            ?>
            <option value="<?= $key ?>"><?= $text ?></option>
        <?

        endforeach;
        ?>
    </select>


    <!-- <input type="text" name="title" class="form-control item-menu" id="title"
           placeholder="Подсказка"> -->
</div>
