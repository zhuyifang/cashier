<?php
$diyPath = \Yii::$app->basePath . '/plugins/diy/views/';

$currentDir = scandir(__DIR__ . '/../');
$components = [];
foreach ($currentDir as $fileName) {
    if (preg_match("/^f-(\S)+\.php$/", $fileName)) {
        $m = substr($fileName, 0, strripos($fileName, ".php"));
        array_push($components, $m);
        Yii::$app->loadViewComponent($m, __DIR__ . '/../');
    };
}

Yii::$app->loadViewComponent('app-hotspot');
Yii::$app->loadViewComponent('app-radio');
Yii::$app->loadViewComponent('color', $diyPath . 'diy-form');
Yii::$app->loadViewComponent("app-padding", \Yii::$app->viewPath . '/components/diy');
//////////other
$other = ['banner', 'link', 'video', 'rubik', 'copyright', 'image-text', 'empty'];
Yii::$app->loadViewComponent("diy-banner", \Yii::$app->viewPath . '/components/diy');
Yii::$app->loadViewComponent("diy-link", \Yii::$app->viewPath . '/components/diy');
Yii::$app->loadViewComponent("diy-video", \Yii::$app->viewPath . '/components/diy');
Yii::$app->loadViewComponent("diy-rubik", \Yii::$app->viewPath . '/components/diy');
Yii::$app->loadViewComponent("diy-copyright", $diyPath . 'template');
Yii::$app->loadViewComponent('app-rich-text');
Yii::$app->loadViewComponent('diy/diy-bg');
Yii::$app->loadViewComponent("diy-image-text", \Yii::$app->viewPath . '/components/diy');
Yii::$app->loadViewComponent("diy-empty", \Yii::$app->viewPath . '/components/diy');
?>