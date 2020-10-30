<?php

namespace common\html_constructor\controllers;

use common\html_constructor\models\HcFile;
use common\html_constructor\models\HcObjectFile;
use common\html_constructor\models\HcObjectFileTarget;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * This is the class for controller "FileController".
 */
class HcFileController extends BaseHcController
{
    public $enableCsrfValidation = false;
    public function actionUpload()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $hcFileTarget = HcObjectFileTarget::findOne((Yii::$app->request->post('file_target_id', null)));

        if ($hcFileTarget) {
            try {
                reset($_FILES);
                $temp = current($_FILES);
                $file = HcFile::upload($temp, $hcFileTarget);
                $attach = $hcFileTarget->attachFile($file);
            } catch (\Exception $e) {
                return ['error' => $e->getMessage()];
            }

            if (!empty($attach)) {
                $initialPreview[] = $file->getWebFileLink();
                $initialPreviewThumbTags[] = [
                    '{desc}' => '',
                    '{upd}' => '/hc-file/' . $attach->id . '/title/', //TODO
                ];
                return [
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => [[
                        'caption' => $file->getSystemPath(),
                        'url' => '/hc-file/' . $attach->id . '/delete/',
                        'res_id' => $attach->id,
                        'key' => $attach->id,
                        'type' => $file->getFileTypeForPreview(),
                        'previewAsData' => true
                    ]],
                    'initialPreviewThumbTags' => $initialPreviewThumbTags,
                    'append' => true
                ];
            } else return ['error' => 'Ошибка загрузки'];
        } else return ['error' => 'Filetarget missing'];
    }

    public function actionAttach()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $hcFileTarget = HcObjectFileTarget::findOne((Yii::$app->request->post('file_target_id', null)));
        if ($hcFileTarget) {
            try {
                $file = HcFile::findOne((Yii::$app->request->post('file_id', null)));
                $attach = $hcFileTarget->attachFile($file);
            } catch (\Exception $e) {
                return ['error' => $e->getMessage()];
            }
            return ['error' => ''];
        }
        return ['error' => 'fileTarget not found'];
    }

    public function actionFastView()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $initialPreview = [];
        $initialPreviewThumbTags = [];
        $initialPreviewConfig = [];

        $hcFileTarget = HcObjectFileTarget::findOne((Yii::$app->request->post('file_target_id', null)));

        foreach ($hcFileTarget->hcObjectFile as $res) {
            $initialPreview[] = $res->file->getWebFileLink();
            $initialPreviewThumbTags[] = [
                '{desc}' => (string) $res->description,
                '{upd}' => '/hc-file/' . $res->id . '/title/', //TODO
            ];
            $initialPreviewConfig[] = [
                'caption' => $res->file->getSystemPath(),
                'width' => '120px',
                'url' => '/hc-file/' . $res->id . '/delete/',
                'res_id' => $res->id,
                'key' => $res->id,
                'type' => $res->file->getFileTypeForPreview(),
                'previewAsData' => true
            ];
        };

        $response =
            [
                'file_target_id' => $hcFileTarget->id,
                'initialPreview' => $initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
                'initialPreviewThumbTags' => $initialPreviewThumbTags,
                'append' => true,
            ];
        return $response;
    }

    public function actionDelete($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $hcObjectFile = HcObjectFile::findOne(['id' => $id]);
        /** @var File */

        if (!$hcObjectFile->delete()) {
            return ['error' => 'Ошибка удаления объекта'];
        };

        if ($hcObjectFile->getFile()->one()) {
            return ['success' => 'Удалено для этого объекта, но у файла остались связи'];
        }
        return ['success' => 'Удалено'];
    }

    public function actionTitle($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $hcObjectFile = HcObjectFile::findOne(['id' => $id]);
        $hcObjectFile->description = \Yii::$app->request->post('text', '');
        $hcObjectFile->save();
    }

    public function actionResort()
    {
        $newSort = \Yii::$app->request->post('newSort', []);

        foreach ($newSort as $sortObj) {
            $hcObjectFile = HcObjectFile::findOne($sortObj['res_id']);
            if ($hcObjectFile && $hcObjectFile->sort != $sortObj['new_sort']) {
                $hcObjectFile->sort = $sortObj['new_sort'];
                $hcObjectFile->save();
            }
        }
    }

    /**
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @throws HttpException if the model cannot be found
     * @param integer $id
     * @return File the loaded model
     */
    protected function findModel($id)
    {
        if (($model = HcFile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
}
