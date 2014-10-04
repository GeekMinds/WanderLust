<?php session_start();
/* 
 * Template Name: comfirmar
 */
if(isset($_GET['AccessKey']))
{
    global $wpdb;

    $d = $GLOBALS['Wander-Admin']->encrypt_decrypt('decrypt', $_GET['AccessKey']);
    $userId = explode('|', $d);
    $id = $wpdb->get_row("SELECT * FROM _inv_users where email_inv_userscol = '$userId[0]';");
    if($id){
        if($id->valid_inv_userscol == 0){
            $wpdb->update('_inv_users', array('valid_inv_userscol' => 1), array( 'email_inv_userscol' => $userId[0]) );
            $_SESSION['validEmail'] = 1;
            $_SESSION['email'] = $userId[0];
            $_SESSION['islogin'] = 1;
            $_SESSION['username'] = $id->name_inv_userscol .' ' .$id->last_name_inv_userscol ;
            
            print "<meta http-equiv=\"refresh\" content=\"0;URL='/perfil-zapato/'\">";
        }
        else
        {
            $_SESSION['validEmail'] = 2;
            print "<meta http-equiv=\"refresh\" content=\"0;URL='/'\">";
        }
    }
    else
    {
            $_SESSION['validEmail'] = 3;
            print "<meta http-equiv=\"refresh\" content=\"0;URL='/'\">";
    }
}