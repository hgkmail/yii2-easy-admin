<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-7-4
 * Time: 下午4:27
 */

use app\base\CommonWalker;
use app\models\Post;
use app\widgets\TagsInputWidget;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form ActiveForm */
/* @var $allTags \app\models\Tag[] */
/* @var $allCats \app\models\Category[] */
/* @var $hasTags \app\models\Tag[] */
/* @var $hasCats \app\models\Category[] */

$tagItems = [];
array_walk($allTags, function ($item, $key) use(&$tagItems) {
    $tagItems[$item->id] = $item->name;
});

$walker = new CommonWalker();
$walker->label_field = 'name';
$walker->walk($allCats, 0);
$catItems = $walker->items;

$hasTagItems = [];
array_walk($hasTags, function ($item, $key) use(&$hasTagItems) {
    $hasTagItems[$item->id] = $item->name;
});

$hasCatItems = [];
array_walk($hasCats, function ($item, $key) use(&$hasCatItems) {
    $hasCatItems[$item->id] = $item->name;
});

$statusItems = [
    Post::STATUS_DRAFT => 'Draft',
    Post::STATUS_PENDING_REVIEW => 'Pending Review',
    Post::STATUS_PUBLISH => 'Publish',
];

$commentStatusItems = [
    Post::COMMENT_OPEN => 'Open',
    Post::COMMENT_CLOSE => 'Close',
];

$visibilityItems = [
    Post::VISIBILITY_PUBLIC => 'Public',
    Post::VISIBILITY_PRIVATE => 'Private',
];

$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;
$cover = $model->cover;

\app\assets\PluploadAsset::register($this);
\app\assets\ImageUploadWithPreviewAsset::register($this);
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
	    category: 'post',
	    $csrfParam: '$csrfToken',
	}, 
    max_retries: 1,
	chunk_size: '512kb',
});
uploader.init();
uploader.bind('FilesAdded', function(up, files) {
    var file = files[0];
    var count = Object.keys(uploadIndex).length;
    uploadIndex[file.id] = count;
});
uploader.bind('Error', function(up, err) {
	uploadStatus = 'error';
});
uploader.bind('FileUploaded', function(uploader, file, result) {
    var index = uploadIndex[file.id];
    var res = JSON.parse(result.response);
    if(index===0) {   // cover
        $('#post-cover').val(res.data);
    }
});
uploader.bind('UploadComplete', function(uploader) {
    if(uploadStatus != 'error') {
        uploadStatus = 'done';
        $('#post-form').yiiActiveForm('submitForm');
    } else {
        uploadStatus = 'prepare';
        alert('upload error');
    }
});

$('#post-form').on('beforeSubmit', function (e) {
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

<div class="post-form box box-solid box-no-shadow">
    <div class="box-body table-responsive">
        <div class="form-group">
            <label class="control-label">Post Tags</label>
            <?= TagsInputWidget::widget([
                'inputName' => 'post-tags',
                'buttonLabel' => 'Add Selected Tag',
                'tagClass' => 'post-tag',
                'containerClass' => 'post-tag-wrapper',
                'listData' => $tagItems,
                'inputData' => $hasTagItems,
            ]) ?>
        </div>

        <div class="form-group">
            <label class="control-label">Post Categories</label>
            <?= TagsInputWidget::widget([
                'inputName' => 'post-cats',
                'buttonLabel' => 'Add Selected Category',
                'tagClass' => 'post-cat',
                'containerClass' => 'post-cat-wrapper',
                'listData' => $catItems,
                'inputData' => $hasCatItems,
            ]) ?>
        </div>

        <?= $form->field($model, 'status')->dropDownList($statusItems) ?>

        <?= $form->field($model, 'visibility')->dropDownList($visibilityItems) ?>

        <?= $form->field($model, 'commentStatus')->dropDownList($commentStatusItems) ?>

        <?= $form->field($model, 'cover')->hiddenInput(['id' => 'post-cover']) ?>
        <div>
            <div id="image-preview" style="display: inline-block"></div>
        </div>
        <div class="hidden">
            <a id="browse" href="javascript:;">[Browse...]</a>
        </div>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
</div>
