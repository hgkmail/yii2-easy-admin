<?php

use app\base\NestableWalker;
use app\models\NavMenu;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\NavMenu */
/* @var $form yii\widgets\ActiveForm */
/* @var $menuItems array */

\app\assets\NestableAsset::register($this);

$nestHtml = '';
if(!empty($model->item_tree)) {
    $walker = new NestableWalker();
    $walker->walk($model->item_tree);
    $nestHtml = $walker->output;
}

$menuItemsJson = '';
if(isset($menuItems)) {
    $menuItemsJson = json_encode($menuItems);
}
$js = <<<JS
$('.dd').nestable({ /* config options */ });

$('.dd').on('change', function() {
    console.log('nestable', $('.dd').nestable('serialize'));
    $('#item-tree').val(JSON.stringify($('.dd').nestable('serialize'))); 
});

$('#add-item').click(function() {
    var item = $('<li class="dd-item dd3-item"></li>');
    var btnRemove = $('<a class="pull-right dd-btn dd-remove""><span class="fa fa-remove"></span></a>');
    var btnConfig = $('<a class="pull-right dd-btn dd-config"><span class="fa fa-gear"></span></a>');
    var hiddenInput = $("<input type='hidden' name='nav_menu_items[]' class='dd-data'>");
    
    var time = new Date().getTime();
    item.attr('data-id', time);
    
    item.append($('<div class="dd-handle dd3-handle" />'));
    item.append($('<div class="dd3-content"><span class="dd-item-name">Item</span></div>')
        .append(btnConfig).append(btnRemove).append(hiddenInput));
    $('.dd > .dd-list').append(item);
    $('.dd').trigger('change');
});

$('body').on('click', '.dd-remove', function() {
    $(this).closest('.dd-item.dd3-item').detach();
    $('.dd').trigger('change');
});

$('body').on('click', '.dd-config', function() {
    var item = $(this).siblings('.dd-data').val();
    try {
        item = JSON.parse(item);
    } catch (e) {
        item = {id: $(this).closest('.dd-item').data('id')};
    }
    if(!item) {
        item = {id: $(this).closest('.dd-item').data('id')};
    }
    window.frames['frame1'].setMenuItem(item);
    $('#modal-menu-item').modal('toggle');
});

function setItemData(item) {
    if(item.label) {
        var itemName = $("[data-id='"+item.id+"'] > .dd3-content > .dd-item-name");
        itemName.text(item.label);
    }
    if(item.id) {
        var input = $("[data-id='"+item.id+"'] > .dd3-content > .dd-data");
        input.val(JSON.stringify(item));
    }
}

$('body').on('click', '#save-config', function() {
    var item = window.frames['frame1'].getMenuItem();
    console.log('getMenuItem', item);
    setItemData(item);
});

// init item data
var menuItemsJson = '$menuItemsJson';
try {
    var menuItems = JSON.parse(menuItemsJson);
    for(var idx in menuItems) {
        var item = menuItems[idx];
        setItemData({
            id: item.id,
            status: item.status, 
            label: item.label,
            icon: item.icon,
            action: item.action,
            target: item.target,
            extra: item.extra,
        });
    }
} catch (e) {
    
}

JS;
$this->registerJs($js);

?>

<div class="nav-menu-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'status', ['inline' => true])->radioList(
            [NavMenu::STATUS_ENABLED => 'Enabled', NavMenu::STATUS_DISABLED => 'Disabled'],
            ['itemOptions' => ['labelOptions' => ['class' => 'text-black']]]) ?>

        <?= $form->field($model, 'item_tree')->hiddenInput([
            'id' => 'item-tree',
            'value' => json_encode($model->item_tree),
        ]) ?>
        <div>
            <?= Html::button('Add Item', ['class' => 'btn btn-primary btn-flat', 'id' => 'add-item']) ?>
        </div>

        <div class="dd" id="nav-menu-nestable">
            <ol class="dd-list">
                <?= $nestHtml ?>
            </ol>
        </div>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php Modal::begin([
    'header' => '<h4>Config Menu Item</h4>',
    'footer' => '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-primary" id="save-config" data-dismiss="modal">OK</button>',
    'id' => 'modal-menu-item',
    'size' => Modal::SIZE_DEFAULT,
]) ?>
<div>
    <iframe src="/nav-menu-item/create" frameborder="0" scrolling="no" name="frame1" width="100%" height="470">
    </iframe>
</div>
<?php Modal::end() ?>
