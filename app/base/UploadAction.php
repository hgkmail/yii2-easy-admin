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

        if($file) {
            $rand = uniqid($file->baseName.'_');
            $url = "/upload/$category/$rand.$file->extension";
            $file->saveAs(Yii::getAlias('@webroot').$url);
            if(!empty($modelId) && $category!='temp') {
                $this->updateAfterUpload($category, $modelId, $url);
            }
            return $this->controller->asJson(['code' => 200, 'data' => $url]);
        } else {
            return $this->controller->asJson(['code' => 400, 'msg' => 'file is empty']);
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
}