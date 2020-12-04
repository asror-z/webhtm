<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetAbdulloh;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;

$action = new WebItem();
$action->debug = false;

if (!empty($this->httpGet('widget'))) {
    echo $this->viewAsset(Root . '/webhtm/core/widget/widget2.php');
    die;
}

$actionId = $this->httpGet('key');
$PageAction = PageAction::findOne($actionId);


$ccids = $PageAction->ccids;
$widgets = $PageAction->widgets;

$path = Root . '/webhtm/' . $PageAction->name . '.php';
$path = str_replace('\\', '/', $path);

$page = $this->renderAjaxFile($path);

echo ZAjaxWidget::widget([
    'config' => [
        'func' => 'ajaxGrapes',
        'dataType' => 'html',
    ],
    'event' => [
        'success' => <<<JS
            function(response) {
                 $('.gjs-traits-label').html(response);
                 $('.gjs-trt-traits').html('');
            }
JS,
    ]

]);

echo ZButtonWidget::widget([
    'config' => [
        'hasIcon' => true,
        'icon' => 'fas fa-edit',
    ],
    'event' => [
        'click' => <<<JS
    function (event) {
       
        let wrapper = $(editor.Canvas.getDocument().body).find('#wrapper');
        let content = $(wrapper);
        let containerDivs = content.find('[widget-container]');
        let rowDivs = content.find('.row');
        let cellDivs = content.find('.cell');
        
        cellDivs.each(function(key, v) {
           v.getAttributeNames().forEach(function(attr) {
             if (attr !== 'class' && attr !== 'widget-container')
                $(v).removeAttr(attr);
           });
        });
        
        rowDivs.each(function(key, v) {
           v.getAttributeNames().forEach(function(attr) {
             if (attr !== 'class' && attr !== 'widget-container')
                $(v).removeAttr(attr);
           });
        });
        
        containerDivs.each(function(key, v) {
           v.getAttributeNames().forEach(function(attr) {
             if (attr !== 'widget-container')
                $(v).removeAttr(attr);
           });
        });
        
        $.ajax({
            method: 'post',
            url: '/core/widget/save.aspx?file={$path}',
            data: {
                'pcontent':  content.html(),
                'actionId': {$actionId}
            },
        })
          
    }
JS

    ]
]);

ZGrapesJsWidgetAbdulloh::begin([


    'config' => [
        'autoAdd' => '1',
        'dropzone' => '0',
        'widgets' => [
            ZSelect2Widget::class
        ]
    ],

    'event' => [

        'component:add' => <<<JS
    function (event) {
              
        let parentDiv = $(e.view.el);
        let className = e.attributes.name;
       
        if (className.includes('zetsoft')) {
           
           $.ajax({      
               method: "GET",
               url: '',
               data: {
                   widget: className
               },
               success: function(response) {
                   
                  const responseDom = $.parseHTML(response, document, true);
                  $(responseDom).each(function(i , el) {
                      const src = $(el).attr("src");
                      const href = $(el).attr("href");
                      if (src) {
                          const script = document.createElement("script");
                          script.src = src;
                          script.type = "text/javascript";
                          editor.Canvas.getDocument().head.append(script);
                      }
                      if (href) {
                          const link = document.createElement("link");
                          link.href = href;
                          link.rel = "stylesheet";
                          editor.Canvas.getDocument().head.append(link);
                      }
                  });
                      
               }    
           });
                
           $.ajax({      
                method: "GET",
                url: '/core/widget/widget2.aspx?widget=' + className,
                success: function(response) {
                    parentDiv.attr('widget-container', 'true');
                    parentDiv.html(response);
                },
            });
           
        }
    }
JS,

        'component:selected' => <<<JS
   function (event) {
          
       if (!$(".fa-cog").hasClass('gjs-pn-active'))
          $('.fa-cog').click();
       
       $('.gjs-traits-label').html('');
       
       let parentDiv;
        
       if ($(e.view.el).attr('widget-container') === 'true')
           parentDiv = $(e.view.el);
       else
           $(e.view.el).parents().each(function(k, v) {
              if ($(v).attr('widget-container') === 'true') {
                parentDiv = $(v);
                if (v.length > 1)
                  return false;
              }
           });
       
       let className = parentDiv.find('[widget]').attr('widget');
       let configs   = parentDiv.find('[config]').attr('config');

       if (className.includes('zetsoft')) {
            
           ajaxGrapes('/core/widget/option.aspx?widget=' + className + '&configs=' + configs);
           
           $('#sendOptions').click(function() {
           
               $.ajax({      
                    method: "GET",
                    url: '/core/widget/widget2.aspx?' + $('#activeForm').serialize() + '&widget=' + className,
                    success: function(response) {
                        parentDiv.html(response);
                    },
               });
                      
               $(document).on('change', '#activeForm', function() {
                     $(this).click();
               });
            
           });
           
           
           // $('#reset').click(function() {
           //     ajaxGrapes('/core/widget/option.aspx?widget=' + className + '&configs={}');
           // });
   
            $(e.view.el).removeClass('gjs-selected');
   
       } 
       
       
           
   }
JS,
    ]

]);
echo $page;

ZGrapesJsWidgetAbdulloh::end();

$this->title = Az::l('Конструктор сайтов');
