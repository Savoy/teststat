<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Client */
/* @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Статистика пользователя #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить пользователя и всю его статистику?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => \yii\grid\SerialColumn::class],
            [
                'attribute' => 'motion',
                'value' => function ($model) {
                    return is_array($model->motion) ? implode(', ', array_map(function ($key, $val) {
                        return $key . ': ' . $val;
                    }, array_keys($model->motion), $model->motion)) : $model->motion;
                },
            ],
            'light',
            [
                'attribute' => 'battery',
                'value' => function ($model) {
                    return $model->battery . '%';
                },
            ],
        ],
    ]) ?>
</div>
