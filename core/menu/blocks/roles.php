<div class="form-group d-flex">
    <label for="role"></label>
    <input type="hidden" class="form-control item-menu" id="role" name="role" placeholder="role...">
    <i class="fas fa-eye iconn"></i>
    <select name="role" id="role_value" multiple class="js-example-programmatic-3" style="width:90%;">
        <?

        use zetsoft\models\core\CoreRole;

        $roles = CoreRole::find()->all();

        foreach ($roles as $role) :
            ?>

            <option><?= $role->name?></option>
        <?
        endforeach;
        ?>
    </select>
</div>
