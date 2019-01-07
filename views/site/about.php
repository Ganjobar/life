<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<script type="text/javascript" >
    window.onload = function(){
        $(function(){
            $('.fullcalendar').ready(function(){
                /*$('.fc-time').css('display', 'none');
                $('.fc-content').css({
                    'height': '100px'
                });
                $('.fc-title').css('color', '#2F4F4F');*/ //потом удалим, пока пусть будет
            });
        });
        $(function(){
            $(document).on('click','.fc-content', function(event){
                alert("переход на страницу просмотра");
            });
        });
    }
</script>
<?php $form = ActiveForm::begin(['id' => 'diary-form']);
var_dump($search_model);?>

<table class="diary-search-table">
    <tr>
        <td>
            <img src="../images/smiles/smile.png" alt=""/> <br>
            <?= $form->field($search_model, 'checkOne')->checkbox(['label' => '' ]) ?>
        </td>
        <td>
            <img src="../images/smiles/smile.png" alt=""/>
            <?= $form->field($search_model, 'checkTwo')->checkbox(['label' => '' ]) ?>
        </td>
        <td>
            <img src="../images/smiles/smile.png" alt=""/>
            <?= $form->field($search_model, 'checkThree')->checkbox(['label' => '' ]) ?>
        </td>
        <td>
            <img src="../images/smiles/smile.png" alt=""/>
            <?= $form->field($search_model, 'checkFour')->checkbox(['label' => '' ]) ?>
        </td>
        <td>
            <img src="../images/smiles/smile.png" alt=""/>
            <?= $form->field($search_model, 'checkFive')->checkbox(['label' => '' ]) ?>
        </td>
        <td>
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'name' => 'search_button']) ?>
        </td>
    </tr>
</table>
<?php ActiveForm::end(); ?>
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

