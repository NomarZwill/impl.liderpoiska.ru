<?php

namespace common\html_constructor\models\utility;


class SiteParamsHelper
{
    public static function getHcParams()
    {
        if(empty($_SERVER['HTTP_HOST'])) {
            return [];
        }
        $uploadFolder = 'upload';
        $uploadSystemPath = \yii\helpers\Url::to(
            implode(
                DIRECTORY_SEPARATOR,
                ['@frontend', 'web', $uploadFolder]
            )
        );
        $hostParts = explode('.', $_SERVER['HTTP_HOST']);
        $hostParts = array_reverse($hostParts);
        $siteAddress = $hostParts[1] . '.' . $hostParts[0];
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        return [
            'siteAddress' => $siteAddress,
            'siteProtocol' => $protocol,
            'uploadFolder' => $uploadFolder,
            'uploadSystemPath' => $uploadSystemPath,
            'getPreviewLink' => function ($id) use ($protocol, $siteAddress) {
                return $protocol . '://' . $siteAddress . '/blog/preview-post/' . $id . '/';
            }
        ];
    }
}
