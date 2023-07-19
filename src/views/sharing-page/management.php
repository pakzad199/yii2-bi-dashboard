<?php

use sadi01\bidashboard\components\Pdate;
use sadi01\bidashboard\models\ReportPage;
use sadi01\bidashboard\models\SharingPage;
use sadi01\bidashboard\models\SharingPageSearch;
use sadi01\dateRangePicker\dateRangePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var View $this */
/** @var SharingPage $model */
/** @var ActiveForm $form */
/** @var SharingPage $page_model */
/**@var $pDate Pdate */

$this->title = Yii::t('biDashboard', 'Sharing Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sharing-page-management container text-left">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-12">
            <div class="sharing-page-form">
                <?php $form = ActiveForm::begin(['id' => 'sharing-form', 'enableClientValidation' => true]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'expire_time')->widget(dateRangePicker::class,[
                            'options'  => [
                                'drops' => 'down',
                                'placement' => 'right',
                                'opens' => 'left',
                                'language' => 'fa',
                                'jalaali'=> true,
                                'showDropdowns'=> true,
                                'singleDatePicker' => true,
                                'useTimestamp' => true,
                                'timePicker' => true,
                                'timePicker24Hour' => true,
                                'timePickerSeconds' => true,
                                'locale'=> [
                                    'format'=> 'jYYYY/jMM/jDD',

                                ],
                            ],
                            'htmlOptions' => [
                                'class'	=> 'form-control',
                                'id' => 'from_date_time',
                                'autocomplete' => 'off',
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('biDashboard', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="sharing-page-index">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?= Yii::t('biDashboard', 'Access Key') ?></th>
                        <th><?= Yii::t('biDashboard', 'Expire Time') ?></th>
                        <th><?= Yii::t('biDashboard', 'Button') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($page_model as $key): ?>
                        <tr>
                            <td><?= $key['id'] ?></td>
                            <td><?= $key['access_key'] ?></td>
                            <td><?= Yii::$app->pdate->jdate("Y/m/d H:i", intval($key['expire_time'])) ?></td>
                            <td>
                                <?php Pjax::begin(['id' => 'p-jax-sharing-page']); ?>
                                <?php if ($key['expire_time'] > time()): ?>
                                    <?= Html::a('expire', 'javascript:void(0)',
                                        [
                                            'title' => Yii::t('yii', 'Expired'),
                                            'aria-label' => Yii::t('yii', 'Expired'),
                                            'data-reload-pjax-container' => 'p-jax-sharing-page',
                                            'data-pjax' => '0',
                                            'data-url' => Url::to(['/bidashboard/sharing-page/expire','id_key' => $key['id'], 'page_id'=> $key['page_id']]),
                                            'class' => " p-jax-btn btn-sm text-info",
                                            'data-title' => Yii::t('yii', 'Expired'),
                                        ]); ?>

                                <?php endif; ?>
                                <?php Pjax::end(); ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
