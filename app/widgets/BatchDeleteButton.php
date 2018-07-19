<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-2
 * Time: 下午4:03
 */

namespace app\widgets;


use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class BatchDeleteButton extends Widget
{
    public $idsParam = 'ids';

    public $gridId = '#grid';

    public $action;


    public function init()
    {
        parent::init();
    }

    public function run()
    {
        // TODO: use FormData
        $js = <<<JS
$('#$this->id').click(function() {
  var keys = $('$this->gridId').yiiGridView('getSelectedRows');
  var url = '/index.php{$this->action}?';
  for (var i in keys) {
      if (i!==0)
          url += '&';
      url += '$this->idsParam[' + i + ']=' + keys[i];
  }
  window.location.href = url;
})
JS;
        $this->view->registerJs($js);
        echo Html::a(Yii::t('app', 'Batch Delete'), 'javascript:void(0)',
            ['class' => 'btn btn-danger btn-flat', 'id' => $this->id]);
    }
}