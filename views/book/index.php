<?
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use app\components\Helper;
?>
<div class="books-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
//        'filterModel' => $searchModel,
        'columns' => [
            'id', 'name',
            [
                'attribute' => 'preview',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(Html::img($model->preview, ['class'=>'preview']));
                }
            ],
            'authorName',
            [
                'attribute' => 'date',
                'value' => function($model){
                    $time = strtotime($model->date);
                    return Helper::getDateFromTime($time);
                }
            ],
            [
                'attribute' => 'date_create',
                'value' => function($model){
                    $date = Helper::getDateFromTime($model->date_create);
                    return $date;
                }
            ],
            [
                'class' => \yii\grid\ActionColumn::className(),
                'template' => '{create} {view} {update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $redirect = array_merge(['update'], Yii::$app->getRequest()->get(), ['id'=>$model->id]);
                        $url = \yii\helpers\Url::toRoute($redirect);
                        $options = [
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                    'view' => function ($url, $model, $key) {
                        $url = Url::toRoute(['view','id' => $model->id]);
                        return \yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#mymodal', [
                            'title' => 'Просмотр','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>$url
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
<?php \yii\bootstrap\Modal::begin(['header'=>'Просмотр', 'id'=>'mymodal'])?>
<?php \yii\bootstrap\Modal::end()?>
<?
$js=<<<JS
$(document).on("click","[data-remote]",function(e) {
    e.preventDefault();
    $("div#mymodal .modal-body").load($(this).data('remote'));
});
JS;
$this->registerJs($js);

$this->registerJS('
    $(document).on("click", ".preview", function(){
        $(".dummy").css("display", "block");
        $(this).removeClass().addClass("full");
    });
    $(document).on("click", ".dummy", function(){
        $("img.full").removeClass().addClass("preview");
    })
');