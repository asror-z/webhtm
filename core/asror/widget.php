<?php

    use zetsoft\models\core\CoreInput;


    /** @var array $option */

    $model = $this->modelGet(CoreInput::class, 7);

    /** @var string $class */
    $className = bname($class);
    $attribute = strtolower($className);

    echo $class::widget([
        'config' => $config,
        'model' => $model,
        'attribute' => $attribute,
        'data' => [
            111,
            222,
            333,
            444,
        ]
    ]);



