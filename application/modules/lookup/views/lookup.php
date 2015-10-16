<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
<head>
    <title><?php echo $page_data['title']; ?></title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open('lookup/execute_lookup'); ?>

<!--<label>Unique ID</label>-->
<?php
    // echo form_input(array('name'=>'unique_id', 'value'=>set_value(''), 'placeholder'=>'ID', 'class'=>'form-control'));

    //  echo form_submit('search_submit', 'Submit', "class='btn btn-sm btn-success'", "id='submit'");
    // echo form_close();
?>

<table border="1px solid black" cellpadding="15px">
    <?php
    foreach($results->result() as $row){
    ?>
    <tr>
        <td><?php echo $row->id?></td>
        <td><?php echo $row->name?></td>
        <td><?php echo $row->notes?></td>
        <td><?php echo $row->cclast4?></td>
        <td><?php echo $row->amount?></td>
        <td><?php echo $row->InsertDate?></td>
    </tr>
    <?php
    }
    ?>
</table>

</body>
</html>