<?
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Authors;
use yii\helpers\Html;
use kartik\date\DatePicker;
?>
<div class="search-form">

    <?php $form = ActiveForm::begin([
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-2">
            <?$authors = Authors::find()->all();?>
            <?= $form->field($model, 'author_id')->dropDownList(ArrayHelper::map($authors, 'id', 'fullName'), ['prompt' => 'автор']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'date_from')->widget(DatePicker::className(), [
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'date_to')->widget(DatePicker::className(), [
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
