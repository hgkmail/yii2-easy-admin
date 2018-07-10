<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-7-4
 * Time: 下午11:32
 */

namespace app\widgets;


use yii\base\Widget;
use app\assets\TagsInputAsset;
use yii\bootstrap\Html;

class TagsInputWidget extends Widget
{
    /* data */
    public $inputData = [];     // [id1 => text1, id2 => text2, ...]
    public $listData = [];      // [id1 => text1, id2 => text2, ...]

    public $tagClass = 'post-tag';
    public $containerClass = 'my-tags-input';

    public $inputName = '';
    public $buttonLabel = 'Add';

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->registerClientScript();

        echo Html::beginTag('div', ['class' => $this->containerClass]);
        echo Html::textInput($this->inputName, '', ['class' => 'form-control tag-input',]);
        echo Html::label('All:&nbsp;');
        echo Html::dropDownList('', null, $this->listData, [
            'encodeSpaces' => true,
            'class' => 'tag-list'
        ]);
        echo Html::button($this->buttonLabel, ['class' => 'tag-add']);
        echo Html::button('Clear', ['class' => 'tag-clear']);
        echo Html::endTag('div');
    }

    public function registerClientScript()
    {
        $view = $this->view;
        TagsInputAsset::register($view);

        $inputData = json_encode($this->inputData);
        $js = <<<JS
        
$('.{$this->containerClass} .tag-input').tagsinput({
    itemValue: 'id',
    itemText: 'text',
    tagClass: '{$this->tagClass}',
});

// add exist tags
!function () {
    var inputData = '$inputData';
    if(inputData) {
        var inputObj = JSON.parse(inputData);
        for(var k in inputObj) {
            $('.{$this->containerClass} .tag-input').tagsinput('add', {id: k, text: inputObj[k]});
        }
    } 
}();

$('.{$this->containerClass} .tag-add').click(function() {
    let selVal = $('.{$this->containerClass} .tag-list').val();
    let selText = $('.{$this->containerClass} .tag-list option:selected').text();
    $('.{$this->containerClass} .tag-input').tagsinput('add', {id: selVal, text: selText.trim()});
});

$('.{$this->containerClass} .tag-clear').click(function() {
    $('.{$this->containerClass} .tag-input').tagsinput('removeAll');
});

JS;
        $view->registerJs($js);
    }
}