<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\webs\apps;


use kartik\editable\Editable;
use yii\helpers\VarDumper;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\except\ZException;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZAction;


class ZWebAction extends ZAction
{


    public function run()
    {

        /** @var WebItem $action */
        $action = $this->paramGet(paramAction);
        
        if ($action === null)
            throw new ZException(Az::l('Необходимо создать объект WebItem внутри страницы'));

        $mainFile = $this->paramGet('mainFile');


        switch ($action->type) {
        
            case 'ajax':
                return $this->requireAjax($mainFile);
                break;

            case 'part':
                return $this->requirePart($mainFile);
                break;
                
            case 'partFile':
                return $this->requirePartFile($mainFile);
                break;

            case 'ajaxFile':
                return $this->requireAjaxFile($mainFile);
                break;

            case 'ajaxFilePreg':
                return $this->requireAjaxFilePreg($mainFile);
                break;

            default:
                return $this->require($mainFile);
                break;
        }


    }

}
