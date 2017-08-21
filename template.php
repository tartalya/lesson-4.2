<style>
    table { 
        border-spacing: 0;
        border-collapse: collapse;
    }

    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }

    table th {
        background: #eee;
    }
</style>

<h1>Список дел</h1>
<div style="float: left">
    <form method="POST">
        <input type="text" name="add_description" placeholder="Описание задачи" value="" />
        <input type="submit" name="save" value="Добавить" />
    </form>
</div>
<div style="float: left; margin-left: 20px;">
    <form method="POST">
        <label for="sort">Сортировать по:</label>
        <select name="sort_by">
            <option value="date_created">Дате добавления</option>
            <option value="is_done">Статусу</option>
            <option value="description">Описанию</option>
        </select>
        <input type="submit" name="sort" value="Отсортировать" />
    </form>
</div>
<div style="clear: both"></div>

<table>
    <tr>
        <th>Описание задачи</th>
        <th>Дата добавления</th>
        <th>Статус</th>
        <th></th>
    </tr>
    <tr>

        <?php
        if (!isset($arr)) {


            echo 'Пока нет новых дел';
            die();
        }
        ?>


        <?php foreach ($arr as $value): ?>
        <tr>
            <td><?= $value['description'] ?></td>
            <td><?= $value['date_added'] ?></td>

            <?php
            if ($value['is_done'] == 0) {

                $status = 'Не выполнено';
            } else {
                $status = 'Выполнено';
            }
            ?>
            <td><span style='color: green;'><?= $status ?></span></td>


            <td>
                <a href='?id=<?= $value['id'] ?>&action=edit'>Изменить</a>
                <a href='?id=<?= $value['id'] ?>&action=done'>Выполнить</a>
                <a href='?id=<?= $value['id'] ?>&action=delete'>Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tr>

</table>




