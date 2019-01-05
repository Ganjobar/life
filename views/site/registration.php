<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registration';
?>
<div class="site-registration">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    foreach ($users as $user){
        echo $user . '<br>';
    }
    ?>
    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?php if(Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo Yii::$app->session->hasFlash('success') ?>
    </div>
    <?php endif; ?>

    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-error alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo Yii::$app->session->hasFlash('error') ?>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Register me', ['class' => 'btn btn-primary', 'name' => 'registration-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>