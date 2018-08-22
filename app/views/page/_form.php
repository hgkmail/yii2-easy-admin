<?php

use app\models\Page;
use app\widgets\CustomTinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $form yii\widgets\ActiveForm */
/* @var $pages \app\models\Page[] */
/* @var $users \app\models\User[] */

$statusDict=[];
$statusDict[Page::STATUS_DRAFT]='Draft';
$statusDict[Page::STATUS_PUBLISH]='Publish';
$statusDict[Page::STATUS_PENDING_REVIEW]='Pending Review';

$visibilityDict=[];
$visibilityDict[Page::VISIBILITY_PUBLIC]='Public';
$visibilityDict[Page::VISIBILITY_PRIVATE]='Private';

$userDict=[];
foreach ($users as $user) {
    $userDict[$user->id]=$user->username;
}

foreach ($pages as $i=>$page) {
    if($page->id==$model->id) {
        unset($pages[$i]);
        break;
    }
}
$walker = new \app\base\CommonWalker();
$walker->label_field = 'title';
$walker->walk($pages, 100);
$pageDict = $walker->items;

\app\assets\PluploadAsset::register($this);
\app\assets\ImageUploadWithPreviewAsset::register($this);
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;
$cover = $model->cover;
$js = <<<JS
$('#image-preview').imageUploadWithPreview({
    inputId: 'image-preview-input',
    useCropModal: true,
    initImage: '$cover',
});

// Pluploader
var uploadStatus = 'prepare';   // prepare, done, error 
var uploadIndex = {};           // file id => index
var uploader = new plupload.Uploader({
	browse_button: 'browse',
	url: '/site/upload',
	file_data_name: 'file_data',
	multipart_params: {
	    category: 'page',
	    $csrfParam: '$csrfToken',
	}, 
    max_retries: 1,
	chunk_size: '512kb',
});
uploader.init();
uploader.bind('FilesAdded', function(up, files) {
    var file = files[0];
    var newIndex = Object.keys(uploadIndex).length;
    uploadIndex[file.id] = newIndex;
});
uploader.bind('Error', function(up, err) {
	uploadStatus = 'error';
});
uploader.bind('FileUploaded', function(uploader, file, result) {
    var index = uploadIndex[file.id];
    var res = JSON.parse(result.response);
    if(index===0) {   // cover
        $('#page-cover').val(res.data); 
    }
});
uploader.bind('UploadComplete', function(uploader) {
    if(uploadStatus != 'error') {
        uploadStatus = 'done';
        $('#page-form').yiiActiveForm('submitForm');
    } else {
        uploadStatus = 'prepare';
        alert('upload error');
    }
});

$('#page-form').on('beforeSubmit', function (e) {
    if(uploadStatus == 'prepare') {    // use Plupload to upload all files
        uploadIndex = {};
        var up = false, img = $('#image-preview').imageUploadWithPreview('getImage');
        if(img instanceof Blob) {
            uploader.addFile(img); up = true;
        }
        if(up) {
            uploader.start();
            return false;
        }
    }
    return true;
});
JS;
$this->registerJs($js);

?>

<div class="page-form box box-primary">
    <?php $form = ActiveForm::begin(['id' => 'page-form']); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'author_id')->dropDownList($userDict, ['prompt' => 'Select an author']) ?>

        <?= $form->field($model, 'content')->widget(CustomTinyMce::class, [
            'options' => ['row' => 10, 'id' => 'tiny-editor'],
        ]) ?>

        <?= $form->field($model, 'cover')->hiddenInput(['id' => 'page-cover']) ?>
        <div>
            <div id="image-preview" style="display: inline-block"></div>
        </div>
        <div class="hidden">
            <a id="browse" href="javascript:;">[Browse...]</a>
        </div>

        <?= $form->field($model, 'parent_id')->dropDownList($pageDict,
            ['encodeSpaces' => true, 'prompt' => '(no parent)']) ?>

        <?= $form->field($model, 'order')->textInput() ?>

        <?= $form->field($model, 'status')->dropDownList($statusDict) ?>

        <?= $form->field($model, 'visibility')->dropDownList($visibilityDict) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?= \app\widgets\CropModal::widget() ?>
</div>
