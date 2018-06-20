<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-15
 * Time: 上午1:31
 */
/* @var $this yii\web\View */

$this->title = 'Test Upload Ex';
$this->params['breadcrumbs'][] = $this->title;

\app\assets\FileInputAsset::register($this);
\app\assets\JqueryFileUploadAsset::register($this);
\app\assets\PluploadAsset::register($this);

$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;
$js = <<<JS
$('#fileAll').fileinput({
uploadUrl: '/site/upload',
uploadAsync: true,
});

$('#fileAll').on('fileuploaded', function(event, data, previewId, index) {
    console.log('fileuploaded', data, index);
});

$('#fileAll').on('fileuploaderror', function(event, data, msg) {
    console.log('fileuploaderror', data, msg);
});

$('#fileAll').on('filebatchuploadsuccess', function(event, data) {    
    // only for uploadAsync=false
    console.log('File batch upload success');
});

$('#fileAll').on('filebatchuploadcomplete', function(event, files, extra) {   
    // both uploadAsync=true and uploadAsync=false
    // files - array contain file not uploaded
    // extra - uploadExtraData 
    console.log('File batch upload complete', files, extra);
    if(files.length==0) {
        alert('All files have uploaded.');
    } else {
        alert(files.length+' files fail to upload.');
    }
});

$('body').on('click', '#upload-all', function(e) {
    var file1 = $('#fileOne')[0].files[0];
    var file2 = $('#fileTwo')[0].files[0];
    var file3 = $('#fileThree')[0].files[0];
    console.log(file1, file2, file3);
    
    $('#fileAll').fileinput('clearStack');
    $('#fileAll').fileinput('addToStack', file1);
    $('#fileAll').fileinput('addToStack', file2);
    $('#fileAll').fileinput('addToStack', file3);
    $('#fileAll').fileinput('upload');
})

$('#fileAll-jq').fileupload({
    url: '/upload/test/index.php',
    dataType: 'json',
    autoUpload: true,
    done: function (e, data) {
        console.log('done', e);
    },
    progressall: function (e, data) {
        
    }
}).prop('disabled', !$.support.fileInput)
    .parent().addClass($.support.fileInput ? undefined : 'disabled');
$('#upload-all-jq').click(function(e) {
    // $('#fileAll-jq').fileupload('send');    // not effect
});

var uploader = new plupload.Uploader({
	browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
	url: '/site/upload',
	multipart_params: {
	    $csrfParam: '$csrfToken',
	},
	file_data_name: 'file_data',
	chunk_size: '512kb',
    max_retries: 3
});

uploader.init();
uploader.bind('FilesAdded', function(up, files) {
	var html = '';
	plupload.each(files, function(file) {
		html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
	});
	document.getElementById('filelist').innerHTML += html;
});
uploader.bind('UploadProgress', function(up, file) {
	document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
});
uploader.bind('Error', function(up, err) {
	document.getElementById('console').innerHTML += "\\n Error #" + err.code + ": " + err.message;
});
uploader.bind('FileUploaded', function(uploader, file, result) {
    console.log('FileUploaded', file, result);
});
uploader.bind('UploadComplete', function(uploader, files) {
    console.log('UploadComplete', files);
});
uploader.bind('ChunkUploaded', function(up, file, info) {   // not fired, an issue
     console.log('ChunkUploaded', info);
});

document.getElementById('start-upload').onclick = function() {
    var file1 = $('#fileOne')[0].files[0];
    var file2 = $('#fileTwo')[0].files[0];
    var file3 = $('#fileThree')[0].files[0];
    // console.log(file1, file2, file3);
    
    var aFileParts = ['<a id="a"><b id="b">hey!</b></a>']; // an array consisting of a single DOMString
    var oMyBlob = new Blob(aFileParts, {type : 'text/html'}); // the blob
    var file4 = new File([oMyBlob], 'aaa.html');   // first param is array
    
    uploader.addFile(file1);
    // uploader.addFile(file2);
    // uploader.addFile(file3);
    // uploader.addFile(file4);
	uploader.start();
};

JS;
$this->registerJs($js);

?>

<div class="row">
    <div class="col-md-6">
        <h4>Bootstrap File Input - multiple upload</h4>
        <label for="fileOne">File One:</label>
        <input type="file" name="fileOne" id="fileOne">
        <label for="fileTwo">File Two:</label>
        <input type="file" accept="image/*" name="fileTwo" id="fileTwo">
        <label for="fileThree">File Three:</label>
        <input type="file" accept="image/*" name="fileThree" id="fileThree">
        <div class="hidden">
            <input type="file" id="fileAll">
        </div>
        <button type="button" class="btn btn-primary btn-flat" id="upload-all">Upload All</button>
        <div class="">
            <input type="file" id="fileAll-jq">
        </div>
        <button type="button" class="btn btn-primary btn-flat" id="upload-all-jq">Upload All jq</button>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h4>Plupload</h4>
        <ul id="filelist"></ul>
        <br />
        <div id="container">
            <a id="browse" href="javascript:;">[Browse...]</a>
            <a id="start-upload" href="javascript:;">[Start Upload]</a>
        </div>
        <br />
        <pre id="console"></pre>
    </div>
</div>

