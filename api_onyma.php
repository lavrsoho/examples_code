<?php

class onymaAuthInfo
{
	public $username;
    public $password;

    public function __construct($name, $pass)
    {
        $this->username = $name;
        $this->password = $pass;
    }
}

class OnimaAPI {

    const url = 'https://sdn.onyma.ru:1443/services_onyma_api/service.htms?name=OnymaApi';
    public $auth;
    public $header;
    public static $client;

    function __construct($onimaLogin, $onimaPass)
    {
        $this->auth = new onymaAuthInfo($onimaLogin, $onimaPass);
        $this->header = new SoapHeader('http://www.onyma.ru/services/OnymaApi/heads/','t_credentials_header', $this->auth, false);
        if(OnimaAPI::$client == null)
        {
            OnimaAPI::$client = new SoapClient($_SERVER['DOCUMENT_ROOT'].'/WSDL/service.wsdl.xml',
                array(
                 'soap_version' => SOAP_1_1,
                 'trace'=>true
             ));
        }
    }

    function GetTokenForPdfDownload()
    {
        try
        {
            $parameters = array('onyma_api_uapi_oper_sess_get_ticket_request' => array('ptime' => 3600));
            $result = OnimaAPI::$client->__soapCall('onyma_api_uapi_oper_sess_get_ticket', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }
    
    //Не выдает список услуг, как нам нужно. А выдает список ресурсов.
    function GetServiceList($contractId)
    {
        try
        {
            $parameters = array('o_mdb_api_client_services_request' => array('dogid' => array('is' => $contractId)));
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_client_services', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }
    
    //Запрос. получить перечень платежных поручений, оплачивающих услуги за период по классу услуг
    function GetPaydocString($dogId,$begin, $end) {
        try
        {
            $parameters = array('o_mdb_api_func_get_paydoc_string_request' => array(
                'pdogid' => $dogId,
                'pbegdate' => $begin,
                'penddate' => $end                
                ));
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_func_get_paydoc_string', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }

    }
    
    //Запрос. получить сумму платежей за период по классу услуг
    function GetSumPayment($dogId, $begin, $end) {
        try
        {
            $parameters = array('o_mdb_api_func_get_sumpayment_request' => array(
                'pdogid' => $dogId,
                'pwhat' => 'pay',
                'pd1' => $begin,
                'pd2' => $end
                ));
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_func_get_sumpayment', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }

    }

    
    //Запрос. возвращает остаток на л/с для договора на дату (в валюте л/с)
    function GetBalanceForDateNow($dogid) {
        try
        {
            $parameters = array('o_mdb_api_func_get_remainder_dog_request' =>
            array(
                'pdogid' => $dogid,
                'pdate' => date('Y-m-d H:i:s')
            )
            );

            $result = OnimaAPI::$client->__soapCall('o_mdb_api_func_get_remainder_dog', $parameters, null,  $this->header);
            //var_dump(OnimaAPI::$client->__getLastRequest());
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }

    }

    //4. По каждой связи  можем получить отдельно значение атрибутов по slo_id 
    /* Атрибуты которые можно дергать:
SERVNAME    Название услуги
AMOUNT      Суммарная стоимость БЕЗ НДС
USEDATE     Дата начала услуги
NDS         НДС
AMOUNTNDS   Стоимость с НДС 
ENDDATE     Дата окончания услуги 
 
Нам лучше использовать счет -услуги, так как там есть такие атрибуты как: 
USE         потребление
COST1       цена за единицу
UNAME       единица измерения*/
    function GetAttribValueForLink($pobj_id, $pattr_name)
    {
        try
        {
            $parameters = array('o_obj_api_obj_get_attr_fmted_request' =>
            array(
                'pobj_id' => $pobj_id,
                'pattr_name' => $pattr_name
            )
            );

            $result = OnimaAPI::$client->__soapCall('o_obj_api_obj_get_attr_fmted', $parameters, null,  $this->header);
            
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }

    //Далее по id родительского объекта достаем дочерние id объектов связи, 
    //из которых уже будем вычитывать строки по услугам по фактуре
    function LinkRequest($flo_id)
    {
        try
        {
            $parameters = array('o_obj_api_obj_obj_link_request' => array('flo_id' => array('is' => $flo_id)));
            $result = OnimaAPI::$client->__soapCall('o_obj_api_obj_obj_link', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }

    // первый параметр идентификатор договора, второй - тип документа (1 - счет фактур, 6 - счет услуг)
    function GetBillDocuments($contractId, $dk_id, $fullnum)
    {
        try
        {
	        $requestParams = array('dogid' => array('is' => $contractId));
            if(isset($dk_id))
            		        {
            			        $requestParams['dk_id'] = array('is' => $dk_id);
            		        }
            if(isset($fullnum))
             {
             $requestParams['fullnum'] = array('is' => $fullnum);
             }
            $parameters = array('o_obj_api_obj_bill_request' => $requestParams);
            
            $result = OnimaAPI::$client->__soapCall('o_obj_api_obj_bill', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }
	//Запрос. Лицевой счет (по периодам)
    function GetBillSummary($contractId, $dateBegin, $dateEnd)
    {
        try
        {
            $mdate = array();
            if(isset($dateBegin))
            {
                $mdate["gt"] = $dateBegin;
            }
           if(isset($dateEnd))
            {
                $mdate["lt"] = $dateEnd;
            }


            $parameters = array('o_mdb_api_bills_summary_request' =>
                array('dogid' => array('is' => $contractId),
                'mdate' => $mdate)// array('gt' => $dateBegin, 'lt' => $dateEnd))
                );
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_bills_summary', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }
	
	function GetCommonContractAttributes($contractId)
    {
        try
        {
            $parameters = array('o_mdb_api_dog_type_request' => array('dogid' => array('is' => $contractId)));
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_dog_type', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }

    function GetContractAttributes($contractId)
    {
        try
        {
            $parameters = array('o_mdb_api_get_dog_get_add_dog_attr_list_request' => array('pdogid' => $contractId));
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_get_dog_get_add_dog_attr_list', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }
	
	function GetContractAttribute($contractId, $idAttr)
    {
        try
        {
            $parameters = array('o_mdb_api_func_get_add_dog_attrib_request' => array('pdogid' => $contractId, 'pattrid' => $idAttr, 'pdate' => date('Y-m-d H:i:s')));
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_func_get_add_dog_attrib', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }

    function GetContractList($contractId)
    {
        try
        {
            $parameters = array();
            if($contractId > 0)
                $parameters['o_mdb_api_dog_list_request'] = array('dogid' => array('is' => $contractId));
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_dog_list', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }

    function GetBillsAndServiceList($contractId)
    {
        try
        {
            $parameters = array('o_mdb_api_month_bills_full_request' => array('dogid' => array('is' => $contractId)));
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_month_bills_full', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }

    function GetTarifPlans($tmid)
    {
        try
        {
	    $reqParams = array();
	    if(isset($tmid)) $reqParams = array('tmid' => array('is' => $tmid));

            $parameters = array('o_mdb_api_tm_list_request' => $reqParams); 
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_tm_list', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }
    
    function GetServiceDescription($servid)
    {
        try
        {
	    $reqParams = array();
	    if(isset($servid)) $reqParams = array('servid' => array('is' => $servid));


            $parameters = array('o_mdb_api_services_request' => $reqParams);
            $result = OnimaAPI::$client->__soapCall('o_mdb_api_services', $parameters, null,  $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }

    function GetDocumentTypes()
    {
        try
        {
            $result = OnimaAPI::$client->__soapCall('o_obj_api_obj_document', array('o_obj_api_obj_document_request' => null), null, $this->header);
            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }


    function EndSession()
    {
        try
        {
            //$result = OnimaAPI::$client->onyma_api_close_session($this->header, null);
            $result = OnimaAPI::$client->__soapCall('onyma_api_close_session', array(), null, $this->header);
            return $result == null;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }

    function OpenSession()
    {
        try
        {
            $result = OnimaAPI::$client->onyma_api_open_session(
                array(
                    "username" =>  $this->auth->username,
                    "password" => $this->auth->password,
                    "onyma_api_open_session_request" =>
                array(
                    "username" =>  $this->auth->username,
                    "password" => $this->auth->password
                    )
                    )
             );



            //         !
            //$result = OnimaAPI::$client->onyma_api_open_session(array(
            //        "username" =>  $this->auth->username,
            //        "password" => $this->auth->password
            //    ), array(
            //    "onyma_api_open_session_request" => array(
            //        "username" =>  $this->auth->username,
            //        "password" => $this->auth->password
            //    )
            //    ));


            //         !
            //$result = $client->__soapCall('onyma_api_open_session', array(
            //    "onyma_api_open_session_request" => array(
            //        "username" =>  $this->auth->username,
            //        "password" => $this->auth->password
            //    )
            //    ), NULL, $this->header);

            return $result;
        }
        catch (SoapFault $e)
        {
            return $e->getMessage();
        }
    }
}
?>

