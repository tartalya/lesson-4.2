
<br><br>

<div style="float: left">
    <form name = "update_description" id = "upd_desc" method="POST">
        <input type="text" size="40" id = "new_description" name="new_description" placeholder="Новое описание задачи" value="" />
        <input type="submit" name="edit" value="Изменить" />
    </form>
</div>


<script type="text/javascript">

    document.getElementById('new_description').value = '<?php echo $result['description'] ?>';

</script>

