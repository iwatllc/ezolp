<?php
$username = array(
    'name'  => 'username',
    'id'    => 'username',
    'size'  => 30,
    'value' => set_value('username')
);

$password = array(
    'name'  => 'password',
    'id'    => 'password',
    'size'  => 30
);

$remember = array(
    'name'  => 'remember',
    'id'    => 'remember',
    'value' => 1,
    'checked'   => set_value('remember'),
    'style' => 'margin:0;padding:0'
);

?>

<?php echo form_open($this->uri->uri_string())?>
<?php echo $this->dx_auth->get_auth_error(); ?>


    <?php echo form_label('Username: ', $username['id']);?>
        <?php echo form_input($username)?>
    <?php echo form_error($username['name']); ?>
    
    <br /><br />
    
    <?php echo form_label('Password: ', $password['id']);?></dt>
        <?php echo form_password($password)?>
    <?php echo form_error($password['name']); ?>
    
    <br /><br />

    <?php echo form_checkbox($remember);?> <?php echo form_label('Remember me', $remember['id']);?> 

    <br /><br />

    <?php echo form_submit('login','Login');?>

<?php echo form_close()?>
