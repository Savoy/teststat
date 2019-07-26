<?php
/* @var $this yii\web\View */
/* @var yii\data\ActiveDataProvider $dataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stat-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'header' => 'Сессий',
                'value' => function ($model) {
                    return $model->getSessions()->count();
                }
            ],
            [
                'header' => 'Данных датчиков',
                'value' => function ($model) {
                    return $model->getStats()->count();
                }
            ],
            'created_at:datetime',
            [
                'class' => \yii\grid\ActionColumn::class,
                'template' => '{view} {delete}',
            ],
        ],
    ]) ?>
</div>
