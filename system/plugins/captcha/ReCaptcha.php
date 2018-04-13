<?php

class SJB_ReCaptcha extends Zend_Captcha_ReCaptcha
{
    public function render(Zend_View_Interface $view = null, $element = null, $windowType = null)
    {
    	if ($windowType == 'modal') {
    		$service = $this->getService();
    		return self::getHTML($service);
    	}
    	else
       		return $this->getService()->getHTML();
    }
    
    public static function getHTML($service)
    {
    	if ($service->getPublicKey() === null) {
            /** @see Zend_Service_ReCaptcha_Exception */
            require_once 'Zend/Service/ReCaptcha/Exception.php';

            throw new Zend_Service_ReCaptcha_Exception('Missing public key');
        }
        
    	$host = Zend_Service_ReCaptcha::API_SERVER;
		$params = $service->getParams();
        if ((bool) $params['ssl'] === true) {
            $host = Zend_Service_ReCaptcha::API_SECURE_SERVER;
        }
        
    	$htmlBreak = '<br>';
        $htmlInputClosing = '>';

        if ((bool) $params['xhtml'] === true) {
            $htmlBreak = '<br />';
            $htmlInputClosing = '/>';
        }

        $errorPart = '';

        if (!empty($params['error'])) {
            $errorPart = '&error=' . urlencode($params['error']);
        }

       $options = $service->getOptions();
       $return = '';
        if (!empty($options)) {
            $encoded = Zend_Json::encode($options);
            $encoded = substr($encoded, 1, -1).",callback: Recaptcha.focus_response_field";
            $return = <<<SCRIPT
<script type="text/javascript" src="https://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
<script type="text/javascript">
	function showRecaptcha() { 
      Recaptcha.create("{$service->getPublicKey()}", "recaptcha_div", {{$encoded}});
  }
  window.setTimeout(showRecaptcha, 900); 
</script>
SCRIPT;
            $return .= <<<HTML
<div id="recaptcha_div"></div>
HTML;
        }
        return $return;
    }
}