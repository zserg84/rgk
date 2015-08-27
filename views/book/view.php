<?
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<div class="book-view">
    <div class="row">
        <div class="col-sm-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'author.fullName'
                ],
            ]) ?>
            <?=Html::a(Html::img($model->preview, ['style' => ['max-width'=>'200px', 'max-height'=>'200px']]))?>
        </div>
    </div>
</div>