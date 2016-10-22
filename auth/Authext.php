<?php
namespace PHPAuth;
include 'Auth.php';
include 'PHPMailer/PHPMailerAutoload.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Authext
 *
 * @author Christofyll
 */
class Authext  extends Auth{
    
    public function __construct(\PDO $dbh, $config, $language = "en_GB")
    {
        // call Grandpa's constructor
        parent::__construct($dbh, $config, $language);
    }
    
    
	
    public function isAdmin($uid) {
	
	$query = $this->dbh->prepare("SELECT admin FROM roloi WHERE hID = ?");
	$query->execute(array($uid));
	
	//echo "before rowcount";

		if ($query->rowCount() == 0) {
			return false;
		}
		
		return  $query->fetch(\PDO::FETCH_ASSOC)['admin'];
		
	
		
    }
    
    public function getNick($uid){
	$query = $this->dbh->prepare("SELECT nick FROM paragwgoi WHERE hID = ?");
	$query->execute(array($uid));
	
	//echo "before rowcount";

		if ($query->rowCount() == 0) {
			return false;
		}
		
		return  $query->fetch(\PDO::FETCH_ASSOC)['nick'];
    }
    
    
    
    public function hardDeleteUser($uid){
	
	$return['error'] = true;
	
	
		$query = $this->dbh->prepare("DELETE FROM {$this->config->table_users} WHERE id = ?");
	
		   

		if(!$query->execute(array($uid))) {
			$return['message'] = $this->lang["system_error"] . " #05";
			return $return;
		}

		$query = $this->dbh->prepare("DELETE FROM {$this->config->table_sessions} WHERE uid = ?");

		if(!$query->execute(array($uid))) {
			$return['message'] = $this->lang["system_error"] . " #06";
			return $return;
		}

		$query = $this->dbh->prepare("DELETE FROM {$this->config->table_requests} WHERE uid = ?");

		if(!$query->execute(array($uid))) {
			$return['message'] = $this->lang["system_error"] . " #07";
			return $return;
		}

		$return['error'] = false;
		$return['message'] = $this->lang["account_deleted"];

		return $return;
	
    }
    
    public function mailToUsers($head,$body,$adminOnly = false){
	
	 $mail = new \PHPMailer;
				if($this->config->smtp) {
					$mail->isSMTP();
					$mail->Host = $this->config->smtp_host;
					$mail->SMTPAuth = $this->config->smtp_auth;
					if(!is_null($this->config->smtp_auth)) {
	            			$mail->Username = $this->config->smtp_username;
	            			$mail->Password = $this->config->smtp_password;
	            		}
					$mail->Port = $this->config->smtp_port;
	
					if(!is_null($this->config->smtp_security)) {
						$mail->SMTPSecure = $this->config->smtp_security;
				}
			}
	
			$mail->From = $this->config->site_email;
			$mail->FromName = $this->config->site_name;
			$query;
			if ($adminOnly){
			$query = $this->dbh->prepare("SELECT email FROM users,roloi WHERE (users.id = roloi.hID) AND roloi.admin");
			}
			else {
			  $query = $this->dbh->prepare("SELECT email FROM users");  
			    
			}
			$query->execute();
	
	//echo "before rowcount";

		if ($query->rowCount() == 0) {
			return false;
		}
		
		
		
		while(  $i = $query->fetch(\PDO::FETCH_ASSOC)['email']){
		    $mail->addAddress($i);
		}
			
			
			// edw tha mpei while wste na stelnei se olous tous  admins
			$mail->isHTML(true);
			$mail->CharSet = "UTF-8";
			
			$mail->Subject = $head;//sprintf($this->lang['email_reset_subject'], $this->config->site_name);
				$mail->Body = $body;//sprintf($this->lang['email_reset_body'], $this->config->site_url, $this->config->site_password_reset_page, $key);
				$mail->AltBody = $body;//sprintf($this->lang['email_reset_altbody'], $this->config->site_url, $this->config->site_password_reset_page, $key);
		
				
				if(!$mail->send()) {
				//$this->deleteRequest($request_id);
	
				$return['message'] = $this->lang["system_error"] . " #666";
				return $return;
			}
        

		$return['error'] = false;
		return $return;
    }
   
}
