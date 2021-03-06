--TEST--
PHPUnit_Framework_MockObject_Generator::generateClassFromWsdl('GoogleSearch.wsdl', 'GoogleSearch', array('doGoogleSearch'))
--SKIPIF--
<?php 
if (!extension_loaded('soap')) die('SOAP extension is required');
?>
--FILE--
<?php
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/Framework.php';

print PHPUnit_Framework_MockObject_Generator::generateClassFromWsdl(
  dirname(dirname(dirname(__FILE__))) . '/_files/GoogleSearch.wsdl',
  'GoogleSearch',
  array('doGoogleSearch')
);
?>
--EXPECTF--
class GoogleSearch extends SOAPClient implements PHPUnit_Framework_MockObject_MockObject
{
    public function __construct($wsdl, array $options)
    {
        parent::__construct('%s/GoogleSearch.wsdl');
    }

    public function doGoogleSearch($key, $q, $start, $maxResults, $filter, $restrict, $safeSearch, $lr, $ie, $oe)
    {
    }
}
