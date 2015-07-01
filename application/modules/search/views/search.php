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
    
    <?php echo form_open('Search/execute_search'); ?>
    
    <p>
        <label>Payment Transaction ID </label>
        <?php echo form_input(array('name'=>'PaymentTransactionId', 'placeholder'=>'ID')); ?>
    </p>
    <p>
        <label>Payment Source</label>
        <?php echo form_input(array('name'=>'PaymentSource', 'placeholder'=>'Source')); ?>
    </p>
    <p>
        <label>Auth Code</label>
        <?php echo form_input(array('name'=>'AuthCode', 'placeholder'=>'Code')); ?>
    </p>
    <p>
        <label>Transaction Amount</label>
        <?php echo form_input(array('name'=>'TransactionAmount', 'placeholder'=>'Amount')); ?>
    </p>
    
    <?php
        echo form_submit('search_submit', 'Search'); 
        echo form_close();  
    ?>
    
    
    <?php if (isset($results))
    { ?>    
            <?php
                if ($results->num_rows() > 0)
                { ?>
                    <table>
                        <caption>Search Results</caption>
                        <tbody>
                            <tr>
                                <th>Payment Transaction ID</th>
                                <th>Payment Source</th>
                                <th>Auth Code</th>
                                <th>Transaction Amount</th>
                            </tr>
                    <?php
                    foreach ($results->result() as $result)
                    {
                        echo "<tr>";
                            echo "<td>";
                                echo $result->PaymentTransactionId;
                            echo "</td>";
                            echo "<td>";
                                echo $result->PaymentSource;
                            echo "</td>";
                            echo "<td>";
                                echo $result->AuthCode;
                            echo "</td>";
                            echo "<td>";
                                echo $result->TransactionAmount;
                            echo "</td>";
                        echo "<tr>";
                    } ?>
                        </tbody>
                    </table>
                <?php
                } else
                {
                    echo 'Search resulted with no records found';                    
                }
                ?>

    <?php } ?>
    
</body>



</html>

<?php $this->load->view('footer'); ?>

</html>