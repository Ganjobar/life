<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

?>
<script type="text/javascript" >
    window.onload = function(){
        $(function(){
            $('.fullcalendar').ready(function(){

            });
        });
        var user = <?php echo $user_type; ?>;
        if(user != 1){
            Array.from(document.getElementsByClassName('admin')).forEach(function(element){
                element.style="display:none";
            });
        }
        $(function(){
            $(document).on('click','.fc-content', function(){
                var date = $(this)[0].textContent.substr(0, 11);
                document.location.href="?r=site/article&date=" + date + "&text=&title=&smile=&imgUrl=";
            });
        });
        $(function(){
            $(document).on('click','.add', function(){
                $.get('index.php?r=site/add',function (){
                    $('#modal').modal('show')
                        .find('#modalContent');
                });
            });
        });
        $(function(){
            $(document).on('click','.search', function(){
                var check1 = document.getElementById('checkOne').checked ? 1 : 0;
                var check2 = document.getElementById('checkTwo').checked ? 2 : 0;
                var check3 = document.getElementById('checkThree').checked ? 3 : 0;
                var check4 = document.getElementById('checkFour').checked ? 4 : 0;
                var check5 = document.getElementById('checkFive').checked ? 5 : 0;
                document.location.href="?r=site/diary&check1=" + check1 + "&check2=" + check2 + "&check3=" + check3 + "&check4=" + check4 + "&check5=" + check5;
            });
        });
    }
</script>
<?php $form = ActiveForm::begin(['id' => 'diary-form']);?>
<div align="center">
    <table class="diary-search-table">
        <tr>
            <td>
                <img style="width: 50px;" src="../images/smiles/1.png" alt=""/> <br>
                <div align="center">
                    <?= $form->field($search_model, 'checkOne')->checkbox(['label' => '', 'id' => 'checkOne', 'checked' => '1', 'unchecked' => '0']) ?>
                </div>

            </td>
            <td>
                <img style="width: 50px;" src="../images/smiles/2.png" alt=""/>
                <div align="center">
                    <?= $form->field($search_model, 'checkTwo')->checkbox(['label' => '', 'id' => 'checkTwo', 'checked' => '1', 'unchecked' => '0']) ?>
                </div>
            </td>
            <td>
                <img style="width: 50px;" src="../images/smiles/3.png" alt=""/>
                <div align="center">
                    <?= $form->field($search_model, 'checkThree')->checkbox(['label' => '', 'id' => 'checkThree', 'checked' => '1', 'unchecked' => '0']) ?>
                </div>
            </td>
            <td>
                <img style="width: 50px;" src="../images/smiles/4.png" alt=""/>
                <div align="center">
                    <?= $form->field($search_model, 'checkFour')->checkbox(['label' => '', 'id' => 'checkFour', 'checked' => '1', 'unchecked' => '0']) ?>
                </div>
            </td>
            <td>
                <img style="width: 50px;" src="../images/smiles/5.png" alt=""/>
                <div align="center">
                    <?= $form->field($search_model, 'checkFive')->checkbox(['label' => '', 'id' => 'checkFive', 'checked' => '1', 'unchecked' => '0']) ?>
                </div>
            </td>
        </tr>
    </table>
</div>

<?php ActiveForm::end(); ?>

<?php
    Modal::begin([
        'header' => '<h2>Add article</h2>',
        'toggleButton' => [
            'label' => 'Add article',
            'tag' => 'button',
            'class' => 'btn admin btn-success',
        ]
    ]);
?>
    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

    <?= $form->field($model_add, 'AName')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model_add, 'AText')->textarea(['rows' => 6]) ?>

    <?= $form->field($model_add, 'APic') ?>

    <?= $form->field($model_add, 'ACreateDate') ?>

    <?= $form->field($model_add, 'idCat') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Modal::end();?>
<br><br>
<div style="width:100%; text-align:center;">
    <?= Html::button('Search', ['class' => 'btn btn-primary search', 'name' => 'search-button']) ?>
</div>
<br><br>
<div class="site-calendar">
   <?= yii2fullcalendar\yii2fullcalendar::widget(array(
           'events' => $events,
           'options' => [
               'id' => "C_diary"
               ],
       'clientOptions' => [
           'selectable' => true,
           'eventColor' => '#FAEBD7'
       ]
   ))
   ?>
</div>


