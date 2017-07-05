
<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;
use app\models\Bus;
?>
<?php
/* @var $this yii\web\View */

$this->title = 'Список водителей';
?>
<div class="site-index">

    <div class="body-content">
        <h2>Список водителей</h2>
        <table class="table-bordered table-striped table">
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Возраст</th>
                <th>Номер телефона</th>
                <th>Активен</th>
                <th>Транспорт</th>
                <th style="width: 30px; text-align: center">Редактировать</th>
            </tr>
            <?php foreach ($drivers as $driver): ?>
                <tr>
                    <td><?php echo $driver->name; ?></td>
                    <td><?php echo $driver->last_name; ?></td>
                    <td><?php echo $driver->getAge($driver->birthday); ?></td>
                    <td><?php echo $driver->phone; ?></td>
                    <td><input type="checkbox" <?php echo $driver->getStatusText($driver->is_available); ?> id="chbox" data-id="<?php echo $driver->id; ?>"/></td>
                    <td>
                        <ul>
                            <?php foreach ($driver->getSelectedBuses() as $bus): ?>
                                <li><?php echo Bus::findOne($bus)->model; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td style="width: 30px; text-align: center"><a href="<?= Url::toRoute(['admin/driver/update', 'id' => $driver->id]) ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                </tr>
            <?php endforeach; ?>


        </table>
        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>
</div>

<script>
            $(document).ready(function() {
                $("#chbox").click(function() {
                    var id = $(this).attr("data-id");
                    $.post("admin/driver/addAjax/"+id, {YII_CSRF_TOKEN: "<?php echo Yii::$app->request->csrfToken; ?>"});
                    return false;
                });
            });

//    $('#chbox').change(function () {
//
//        // Проверка стоит галочка или нет
//        if ($(this).is(':checked')) {
//
//            var id = $(this).attr("data-id");
//
//            // Ваш запрос
//            $.ajax({
//                url: "<?= Url::toRoute(['admin/driver/addAjax', 'id' => $driver->id]) ?>",
//                type: 'post',
//                success: function () {
//                    alert('Статус изменен');
//                }
//            });
//
//        }
//
//    });
</script>
