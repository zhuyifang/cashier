
<?php

$currentDir = __DIR__ . '/../../template/';
$components = [];
$ignore = array_map(function ($item) {
    return $item . '.php';
}, ['f-phone', 'f-time', 'f-button']);
foreach (scandir($currentDir) as $fileName) {
    if (preg_match("/^f-(\S)+\.php$/", $fileName) && !in_array($fileName, $ignore)) {
        $m = substr($fileName, 0, strripos($fileName, ".php"));
        array_push($components, $m);
        Yii::$app->loadViewComponent($m,$currentDir);
    };
}

$currentDir = __DIR__ . '/../';
$ignore = [];
foreach (scandir($currentDir) as $fileName) {
    if (preg_match("/^f-(\S)+\.php$/", $fileName) && !in_array($fileName, $ignore)) {
        $m = substr($fileName, 0, strripos($fileName, ".php"));
        array_push($components, $m);
        Yii::$app->loadViewComponent($m, $currentDir);
    };
}

Yii::$app->loadViewComponent('app-hotspot');
Yii::$app->loadViewComponent('app-radio');
Yii::$app->loadViewComponent('color', __DIR__.'/../../');
Yii::$app->loadViewComponent("app-padding", \Yii::$app->viewPath . '/components/diy');

Yii::$app->loadViewComponent('calc-common', __DIR__.'/../');
//////////other
$other = ['rubik', 'link', 'image-text', 'empty'];
Yii::$app->loadViewComponent("diy-rubik", \Yii::$app->viewPath . '/components/diy');
Yii::$app->loadViewComponent("diy-link", \Yii::$app->viewPath . '/components/diy');
Yii::$app->loadViewComponent("diy-image-text", \Yii::$app->viewPath . '/components/diy');
Yii::$app->loadViewComponent('diy/diy-bg');
Yii::$app->loadViewComponent('app-rich-text');
Yii::$app->loadViewComponent("diy-empty", \Yii::$app->viewPath . '/components/diy');
?>