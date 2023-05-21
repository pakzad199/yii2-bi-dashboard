<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var sadi01\bidashboard\models\ReportWidget $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="report-widget-form">
    <?php $form = ActiveForm::begin(['action' => ['/bidashboard/report-widget/create']]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'range_type')->dropDownList([0 => (Yii::t('biDashboard', 'daily')), 1 => (Yii::t('biDashboard', 'monthly'))]) ?>
        </div>
    </div>

    <?= $form->field($model, 'search_model_class')->hiddenInput(['value' => $searchModel::class])->label(false) ?>
    <?= $form->field($model, 'search_model_method')->hiddenInput(['value' => 'search'])->label(false) ?>
    <?php
    foreach ($params as $Pkey => $Pvalue) {
        echo $form->field($model, 'params[' . $Pkey . ']')->hiddenInput(['value' => $Pvalue])->label(false);
    }

    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('biDashboard', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
