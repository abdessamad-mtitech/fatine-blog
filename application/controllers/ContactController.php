<?php

class ContactController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->contact = 'current-menu-item';
    }

    public function contactmeAction()
    {
		$post = $_POST; 

		$to  = 'elmehdilaaroussi@mediatuch.com';
		$subject = $post['subject'];

		$message_body = '<html><body>' .$post['message']. '<br><br> Tel: ' .$post['numtel'].  '</body></html>';

		/*$file_tmp_name    = $_FILES['file']['tmp_name'];
        $file_name        = $_FILES['file']['name'];
        $file_size        = $_FILES['file']['size'];
        $file_type        = $_FILES['file']['type'];
        $file_error       = $_FILES['file']['error'];*/

        /*$handle = fopen($file_tmp_name, "r");
        $content = fread($handle, $file_size);
        fclose($handle);
        $encoded_content = chunk_split(base64_encode($content));*/

        $boundary = "-----=".md5(rand());
        $headers  = "MIME-Version: 1.0\r\n"; 
        $headers .= 'From: ' . $post['name'] .'<' . $post['email'] . '>' . "\r\n";
        $headers .= "Reply-To: ".$to."" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=$boundary" ."\r\n"; 
        $headers .= 'To: Fatine Benaguida <' . $to . '>' . "\r\n";

        //plain text 
        $body  = "--$boundary\r\n";
        $body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
        $body .= chunk_split(base64_encode($message_body)); 
        
        //attachment
        /*if(isset($_FILES['file'])) {
	        $body .= "--$boundary\r\n";
	        $body .="Content-Type: $file_type; name=\"$file_name\"\r\n";
	        $body .="Content-Disposition: attachment; filename=\"$file_name\"\r\n";
	        $body .="Content-Transfer-Encoding: base64\r\n";
	        $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
	        $body .= $encoded_content; 
    	}
*/
        $send_mail = mail($to, $subject, $body, $headers);
	
		print_r($body);
		die();
    }

}

