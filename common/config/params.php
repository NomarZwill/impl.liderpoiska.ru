<?php
return array_merge(
    [
        'adminEmail' => 'admin@example.com',
        'supportEmail' => 'support@example.com',
        'user.passwordResetTokenExpire' => 3600,
    ],
    \common\html_constructor\models\utility\SiteParamsHelper::getHcParams()
);
