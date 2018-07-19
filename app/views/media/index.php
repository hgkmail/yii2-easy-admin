<?php

use app\base\FileUtil;
use app\models\Media;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Media');
$this->params['breadcrumbs'][] = $this->title;

$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;

\app\assets\PluploadAsset::register($this);
\app\assets\FileIconAsset::register($this);

/**
 * @param Media $media
 * @return string
 */
function renderTitle($media)
{
    $iconHtml = '';
    if(FileUtil::isImageMIME($media->mime) && !empty($media->thumb_path)) {
        $iconHtml = "<img src='{$media->thumb_path}' class='media-thumb'>";
    } else {
        $iconHtml = "<span class='fiv-viv fiv-icon-{$media->mime_icon}'></span>";
    }

    return <<<HTML
<div class="media" style="max-width: 300px">
    <div class="media-left"> 
        <a>$iconHtml</a> 
    </div> 
    <div class="media-body"> 
        <a class="media-heading strong" href="{$media->upload_path}" download target="_blank" data-pjax="0">{$media->title}</a>
        <p>{$media->originName}</p>
    </div>
</div>
HTML;

}

$js = <<<JS
var latestFile = {};
function saveMedia(path) {
    var jqXHR = $.ajax({
        url: '/media/create',
        method: 'POST',
        cache: false,
        data: {
            upload_path: path,
            file_name: latestFile.name,
            file_size: latestFile.size,
        }
    });
    jqXHR.done(function(msg) {
        window.location.reload();
    });
    jqXHR.fail(function(jqxhr, textStatus) {
        alert('save media fail');
    });
}

// Plupload
var uploader = new plupload.Uploader({ 
	browse_button: 'upload-media',
	url: '/site/upload',
	file_data_name: 'file_data',
	multipart_params: {
	    category: 'media',
	    $csrfParam: '$csrfToken',
	}, 
    max_retries: 1,
	chunk_size: '512kb',
});
uploader.init();
uploader.bind('Error', function(up, err) {
    alert('upload error');
});
uploader.bind('FileUploaded', function(uploader, file, result) {
    if(result.response) {
       var res = JSON.parse(result.response);
        if(res && res.code==200) {
            saveMedia(res.data);
            return;
        } 
    }
    console.log('FileUploaded', file, result);
    alert('upload fail');
});
uploader.bind('FilesAdded', function(up, files) {
    // console.log('FilesAdded', files);
    latestFile = {
        size: files[0].size, 
        name: files[0].name
    };
    uploader.start();
});
JS;
$this->registerJs($js);

?>
<div class="media-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::button(Yii::t('app', 'Upload Media'),
            ['class' => 'btn btn-success btn-flat', 'id' => 'upload-media']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => '\app\widgets\CustomCheckboxColumn'],
                ['class' => 'yii\grid\ActionColumn'],
                [
                    'attribute' => 'title',
                    'format' => 'raw',
                    'value' => function($model) {
                        return renderTitle($model);
                    }
                ],
                [
                    'attribute' => 'size',
                    'value' => function($model) {
                        return Yii::$app->formatter->asShortSize($model->size, 1);
                    }
                ],
                'status',
                'visibility',
                'author_id',
                // 'upload_path',
                // 'mime',
                // 'caption:ntext',
                // 'alt',
                // 'desc:ntext',
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
