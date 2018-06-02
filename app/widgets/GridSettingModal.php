<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-1
 * Time: 下午8:02
 */

namespace app\widgets;


use Yii;
use yii\base\Model;
use yii\base\Widget;use yii\bootstrap\Modal;use yii\helpers\Html;

class GridSettingModal extends Widget
{
    public $gridSettingAction = '/site/grid-setting';

    public $header = '<h4>GridView Setting</h4>';

    public $footer = '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>';

    public $modalId = 'grid-setting';

    /**
     * @var Model
     */
    public $searchModel;

    /**
     * @var array
     */
    public $optAttributes;

    /**
     * @var array
     */
    public $gridSetting;


    public function init()
    {
        parent::init();
    }

    public function run()
    {
        echo Html::beginForm('/site/grid-setting', 'post');
        Modal::begin([
            'id' => $this->modalId,
            'header' => $this->header,
            'footer' => $this->footer
        ]);

        foreach ($this->optAttributes as $attr) {
            if($this->searchModel->isAttributeSafe($attr)) {
                echo "<div>".Html::checkbox("cols[$attr]", in_array($attr, $this->gridSetting),
                        ['label' => $this->searchModel->getAttributeLabel($attr)])."</div>";
            }
        }
        echo Html::hiddenInput("pageRoute", Yii::$app->requestedRoute);

        Modal::end();
        echo Html::endForm();
    }
}