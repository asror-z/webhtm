<table class="table">
    <thead>
    <tr>
            <?php $obj = $this->res[0]?>
            <?php foreach ($obj as $key => $val): ?>
                <th><?= $key ?></th>
            <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->res as $obj): ?>
        <tr>
            <?php foreach ($obj as $valval): ?>
                <?php if (is_array($valval)): ?>
                    <td>
                        <?php /*foreach ($valval as $val10): */?><!--
                            <?php /*echo $val10; */?>
                        --><?php /*endforeach; */?>
                        <?php var_dump($valval)?>
                    </td>
                <?php else: ?>
                    <td><?php echo $valval; ?></td>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
/*foreach ($this->res as $obj) {
    foreach ($obj as $key => $value) {
        var_dump($value);
    }
}*/
?>
