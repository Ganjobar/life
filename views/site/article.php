<?php
/**
 * Created by PhpStorm.
 * User: ganjobar
 * Date: 07.01.19
 * Time: 15:22
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

$this->title = 'Article';
$img_adress = "../images/home.jpeg";
?>

<?php $form = ActiveForm::begin(['id' => 'article-form']);?>


<table class="table">
    <script type="text/javascript">
        window.onload = function(){
            var user = <?php echo $user_type; ?>;
            if(user != 1){
                Array.from(document.getElementsByClassName('editable')).forEach(function(element){
                    element.setAttribute("readonly", "true");
                });
                Array.from(document.getElementsByClassName('admin')).forEach(function(element){
                    element.style="display:none";
                });
            }
            if(user != 1 && user != 0){
                Array.from(document.getElementsByClassName('comment')).forEach(function(element){
                    element.style="display:none";
                });
            }
        };
        OnClick = function(){
            let text = document.getElementById('article_text').value;
            let title = document.getElementById('article_title').value;
            let smile = document.getElementById('article_smile').value;
            let imgUrl = document.getElementById('article_pic').value;
            document.location.href="?r=site/article&date=" + "<?php echo $model->ACreateDate; ?>" + "&text=" + text + "&title=" + title + "&smile=" + smile + "&imgUrl=" + imgUrl;
        }

    </script>
    <tr>
        <td style="float: inside; width: 10%;border-radius: 10px;" >
            <p>
                <img style=" width: 300px; padding: 10px 10px 10px 10px;border-radius: 100px"  src="<?php echo $model->APic?>">
            </p>
            <div class="admin" align="center">
                <?= $form->field($model, 'APic')->textInput(['class' => 'article', 'id' => 'article_pic'])->label('Url:') ?>
            </div>
        </td>

        <td style="margin-left: 41%; width: 60%; height: 30%;">
            <h1 id="article-name" style="text-align: center">
                <?= $form->field($model, 'AName')->textInput(['class' => 'article editable', 'id' => 'article_title'])->label('') ?>
            </h1>
        </td>

        <td style="margin-left: 41%; width: 60%; height: 30%;">
            <p>
                <img style=" width: 200px; padding: 10px 10px 10px 10px;border-radius: 100px"  src="<?php echo $cat_model->CPic ?>">
            </p>
            <div class="admin" align="center">
                <?= $form->field($model, 'idCat')->textInput(['class' => 'article', 'id' => 'article_smile'])->label('Estimation:') ?>
            </div>
        </td>
    </tr>


    <tr>
        <td colspan="3">
            <div>
                <?= $form->field($model, 'AText')->textArea(['class' => 'article-text editable', 'id' => 'article_text'])->label('') ?>
            </div>
        </td>
    </tr>

    <tr>
        <td style="float: inside; width: 10%;border-radius: 10px;" >
            <?= Html::button('Save', ['class' => 'btn btn-primary save admin', 'name' => 'save-button', 'onclick' => 'OnClick()']) ?>
        </td>
    </tr>
</table>
<?php ActiveForm::end(); ?>
<h1>Comments</h1>
<?php
    foreach ($t as $comment){
        echo "<b>" . $comment['username']  . "</b><br>" . $comment['comment'];
        echo "<hr>";
    }
?>
<?php
    Modal::begin([
        'header' => '<h2>Add comments</h2>',
        'toggleButton' => [
            'label' => 'Add comments',
            'tag' => 'button',
            'class' => 'btn comment btn-success',
        ]
    ]);
?>
<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

    <?= $form->field($model_add, 'ComText')->textarea(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'comment-button']) ?>
    </div>

<?php ActiveForm::end(); ?>
<?php Modal::end();?>



