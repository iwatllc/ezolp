<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
    }
</style>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<?php $this->load->view('header'); ?>

<html>
    
<head>
    <title><?php echo $title; ?></title>
</head>
    
<body>
    
    <h1><?php echo $page_data['heading']; ?></h1>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Notes</th>
            <th>CC Last 4</th>
            <th>Amount</th>
            <th>Insert Date</th>
        </tr>
    <?php
        foreach ($transactions->result() as $trans)
        {
            ?><tr>
                <td><?php echo $trans->id; ?></td>
                <td><?php echo $trans->name; ?></td>
                <td><?php echo $trans->notes; ?></td>
                <td><?php echo $trans->cclast4; ?></td>
                <td><?php echo $trans->amount; ?></td>
                <td><?php echo $trans->InsertDate; ?></td>
            </tr><?php
        }
    ?>
    </table>
    
</body>



</html>

<?php $this->load->view('footer'); ?>

</html>