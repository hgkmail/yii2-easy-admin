<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-11
 * Time: 上午12:42
 */

namespace app\base;


use app\models\UserProfile;
use Yii;
use yii\base\Action;
use yii\web\UploadedFile;


class UploadAction extends Action
{

    private function asSuccess($code, $data, $extra=[])
    {
        return $this->controller->asJson(['code' => $code, 'data' => $data, 'extra' => $extra]);
    }

    private function asError($code, $msg, $extra=[])
    {
        return $this->controller->asJson(['code' => $code, 'msg' => $msg, 'extra' => $extra]);
    }

    /**
     * @param string file file to upload
     * @param string category folder to save, default is temp
     * @param string oldfile file to delete
     * @return \yii\web\Response
     */
    public function run()
    {
        // http://plugins.krajee.com/file-input/plugin-options#uploadUrl
        // If input name is not set, the key defaults to "file_data".
        $file = UploadedFile::getInstanceByName('file_data');
        $category = Yii::$app->request->post('category');
        $modelId = Yii::$app->request->post('modelId');
        $oldfile = Yii::$app->request->post('oldfile');
        $oldfileFull = Yii::getAlias('@webroot').$oldfile;
        if(!empty($oldfile) && file_exists($oldfileFull)) {      // delete old file
            unlink($oldfileFull);
        }
        if (empty($category)) {
            $category = 'temp';
        }

        if(isset($_REQUEST['chunks'])) {
            return $this->handleChunk();
        }

        if($file) {
            $rand = uniqid($file->baseName.'_');
            $url = "/upload/$category/$rand.$file->extension";
            $file->saveAs(Yii::getAlias('@webroot').$url);
            if(!empty($modelId) && $category!='temp') {
                $this->updateAfterUpload($category, $modelId, $url);
            }
            return $this->asSuccess(200, $url);
        } else {
            return $this->asError(400, 'file is empty');
        }
    }

    public function updateAfterUpload($category, $modelId, $val)
    {
        switch ($category) {
            case "avatar":
                $model = UserProfile::find()->where(['user_id' => $modelId])->one();
                if(!empty($model)) {
                    $model->avatar = $val;
                    $model->save();
                }
                break;
        }
    }
    
    public function handleChunk()
    {
        // Settings
        $targetDir = Yii::getAlias('@webroot') . "/upload/part";
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 1 * 3600; // Temp file age in seconds

        $category = 'temp';
        if (isset($_REQUEST['category'])) {
            $category = $_REQUEST['category'];
        }

        // Get a file name
        $fileName = '';
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } else {
            return $this->asError(400, 'Chunk upload must have "name" param');
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        // Remove old temp files	
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                return $this->asError(500, 'Failed to open temp directory for chunk');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }

        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            return $this->asError(500, 'Failed to open output stream');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file_data"]["error"] || !is_uploaded_file($_FILES["file_data"]["tmp_name"])) {
                return $this->asError(400, 'Uploaded file has error');
            }
            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file_data"]["tmp_name"], "rb")) {
                return $this->asError(500, 'Failed to open input stream');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                return $this->asError(500, 'Failed to open input stream by php://input');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            $base = pathinfo($filePath, PATHINFO_FILENAME);
            $ext = pathinfo($filePath, PATHINFO_EXTENSION);

            $rand = uniqid("{$base}_");
            $url = "/upload/$category/$rand.$ext";
            rename("{$filePath}.part", Yii::getAlias('@webroot').$url);
            return $this->asSuccess(200, $url);
        }
        return $this->asSuccess(200, "{$filePath}.part");
    } // end of handleChunk

}