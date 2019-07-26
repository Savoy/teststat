<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';

\frontend\assets\SensorsAsset::register($this);
$this->registerJs('var interval = setInterval(function() {
    console.log(sensors);
    $.ajax({
        url: "'.Url::toRoute('site/sensors').'",
        method: "post",
        data: {sensors: sensors}
    }).fail(function() {
        clearInterval(interval);
    });
}, 5000)', $this::POS_READY, 'sensors');
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-12">
                <h2>Датчики устройства</h2>

                <div id="div1">Акселерометр не поддерживается</div>
                <br/>
                <div id="div2">Уровень освещенности не поддерживается</div>
                <br/>
                <div id="div3">Уровень заряда батареи не поддерживается</div>
            </div>
        </div>
    </div>
</div>
