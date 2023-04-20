<?php

/*信用卡幕後授權非3D*/


//介接資訊
$oService = new NetworkService();	// // 初始化網路服務物件。
$oService->ServiceURL = 'https://einvoice-stage.ecpay.com.tw/B2CInvoice/Issue';
$szHashKey = '4g8XCNI6j3gjfmKi';
$szHashIV = 'jrcKpQ1hN2xIT3Kl';
//$szHashKey = 'ejCk326UnaZWKisg';
//$szHashIV = 'q9jcZX8Ib9LM8wYk';

/*************************************POST參數設置************************************************************/
//$szPlatformID = '3083192';
$szMerchantID = '2000132';
$szData = '';
$arData = array();
$item1 = array();
$item2 = array();
$item3 = array();
$arParameters = array();
$arFeedback = array();
$Timestamp=time();
$szRqHeader=array();
$RqID= guid();
$Revision='3.0.0';

date_default_timezone_set("Asia/Taipei");

/*************************************產生GUID****************************************************************/
function guid(){
    mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $uuid = substr($charid, 0, 8)
        .substr($charid, 8, 4)
        .substr($charid,12, 4)
        .substr($charid,16, 4)
        .substr($charid,20,12);
    return $uuid;
}

/*************************************判斷Json****************************************************************/
function isJson($data = '', $assoc = false) {
    $data = json_decode($data, $assoc);
    if ($data && (is_object($data)) || (is_array($data) && !empty($data))) {
        return $data;
    }
    return false;
}

/*************************************要傳遞的 ReHeader 參數**************************************************/
$szRqHeader=array(
'Timestamp' => $Timestamp,
'RqID' => $RqID,
'Revision' => $Revision,
);

/*************************************要傳遞的 item1 參數******************************************************/
$item1 = array(
	//商品序號
	'ItemSeq ' =>'1',
	
	//商品名稱
	'ItemName' => '測試商品1',
	
	//商品數量
	'ItemCount' => '1',
	
	//商品單位
	'ItemWord' => '個',
	
	//商品單價
	'ItemPrice' => '100',
	
	//商品課稅別(1:應稅 2:零稅率 3:免稅)，預設為空字串，當課稅類別[TaxType] = 9時，此欄位不可為空
	'ItemTaxType' => '1',
	
	//商品合計(ItemAmount=ItemPrice*ItemCount)
	'ItemAmount' => '100',
	
	//商品備註
	'ItemRemark' => '商品備註',
);

/*************************************要傳遞的 item2 參數******************************************************/
$item2 = array(
	//商品序號
	'ItemSeq ' =>'2',
	
	//商品名稱
	'ItemName' => '測試商品2',
	
	//商品數量
	'ItemCount' => '1',
	
	//商品單位
	'ItemWord' => '條',
	
	//商品單價
	'ItemPrice' => '100',
	
	//商品課稅別(1:應稅 2:零稅率 3:免稅)，預設為空字串，當課稅類別[TaxType] = 9時，此欄位不可為空
	'ItemTaxType' => '1',
	
	//商品合計(ItemAmount=ItemPrice*ItemCount)
	'ItemAmount' => '100',
	
	//商品備註
	'ItemRemark' => '商品備註',
);

/*************************************要傳遞的 item3 參數******************************************************/
$item3 = array(
	//商品序號
	'ItemSeq ' =>'3',
	
	//商品名稱
	'ItemName' => '測試商品3',
	
	//商品數量
	'ItemCount' => '1',
	
	//商品單位
	'ItemWord' => '支',
	
	//商品單價
	'ItemPrice' => '100',
	
	//商品課稅別(1:應稅 2:零稅率 3:免稅)，預設為空字串，當課稅類別[TaxType] = 9時，此欄位不可為空
	'ItemTaxType' => '1',
	
	//商品合計(ItemAmount=ItemPrice*ItemCount)
	'ItemAmount' => '100',
	
	//商品備註
	'ItemRemark' => '商品備註',
);

/*************************************要傳遞的 Data 參數******************************************************/
$arData = array(
	//會員編號
	'MerchantID' => $szMerchantID,
    	
	//自訂編號
	'RelateNumber' => date('YmdHis'),
     
	//客戶編號
	'CustomerID' => '',
     
	//統一編號
	'CustomerIdentifier' => '',
       
	//客戶名稱，當列印註記=1(列印)時，為必填
	'CustomerName' => '測試人',
    
	//客戶地址，當列印註記=1(列印)時，為必填
	'CustomerAddr' => '南港區三重路19-2號',
    
	//客戶手機號碼，當客戶電子信箱為空字串時，為必填
	'CustomerPhone' => '0912345678',
   
	//客戶電子信箱，當客戶手機號碼為空字串時，為必填
	'CustomerEmail' => 'test@tt.cc',
    
	//通關方式，當課稅類別[TaxType]=2(零稅率)時，為必填
	'ClearanceMark' => '', 

	//列印註記，0：不列印(捐贈註記=1(捐贈)時、載具類別有值時) 
	//			1：要列印(統一編號有值時)
    'Print' => '1',
	
    //捐贈註記，0：不捐贈(統一編號有值時、載具類別有值時)
	//			1：要捐贈
    'Donation' => '0',
	
	//捐贈碼，當捐贈註記=1時，為必填
	'LoveCode' => '',
	
	//載具類別
	'CarrierType' => '',
	
	//載具編號
	'CarrierNum'=>'',
	
	//課稅類別
	'TaxType'=>'1',
	
	//發票總金額(含稅)
	'SalesAmount'=>'300',
	
	//發票備註
	'InvoiceRemark'=>'發票備註',
	
	//商品
	'Items'=>[$item1,$item2,$item3],
	
	//字軌類別
	'InvType'=>'07',
	
	//商品單價是否含稅
	'vat'=>'',
);

/******************************************************************************************************************************************/

//轉Json格式
$szData = json_encode($arData);

//印出Data參數
echo "印出Data參數<br>";
echo $szData,"<br>","<br>";

//做urlencode
$szData = urlencode($szData);

//定義AES
$oCrypter = new AESCrypter($szHashKey, $szHashIV);
	
// 加密 Data 參數內容
$szData = $oCrypter->Encrypt($szData);

//印出Data加密結果
echo "印出Data加密結果<br>";
echo $szData,"<br>","<br>";

//要POST的參數
$arParameters = array(
	'PlatformID' =>$szPlatformID,
	'MerchantID' => $szMerchantID,
	'RqHeader' => $szRqHeader,
	'Data' => $szData
);

//轉Json格式
$arParameters = json_encode($arParameters);

//印出POST參數
echo "印出POST參數<br>";
echo $arParameters,"<br>","<br>";

// 傳遞參數至遠端。
$szResult = $oService->ServerPost($arParameters);

// 顯示接收的參數
echo "印出回傳結果<br>";
echo $szResult,"<br>","<br>";

//判斷回傳是否為Json格式
$ResultisJson=isJson($szResult);

if($ResultisJson==TRUE){
    $DataisNull=json_decode($szResult,true);
    if(isset($DataisNull["Data"])){
        if($DataisNull["Data"]!==''){
            //將Data解密
            $DataDec = $oCrypter->Decrypt($DataisNull["Data"]);
			$DataDec1=json_decode($DataDec,true);
            if(isset($DataDec1["RtnCode"])){ 
				if($DataDec1["RtnCode"]===1){
			//印出Data解密結果
				echo "成功<br>";
				echo $DataDec,"<br>";	
				}
				else{
					echo "失敗<br>";
					echo $DataDec,"<br>";
				}
			}
			else{
				echo "Data未含有RtnCode<br>";				
			}	
		}
        else{
            echo"Data回傳空值<br>";
        }
    }
    else{
        echo"回傳沒有Data<br>";
    }
}
else {
	echo "回傳格錯誤，非Json格式<br>";
}

/************************************服務類別*************************************************/


/**
 * 呼叫網路服務的類別。
 */
class NetworkService {

    /**
     * 網路服務類別呼叫的位址。
     */
    public $ServiceURL = 'ServiceURL';

    /**
     * 網路服務類別的建構式。
     */
    function __construct() {
        $this->NetworkService();
    }
    
    /**
     * 網路服務類別的實體。
     */
    function NetworkService() {

    }

    /**
     * 提供伺服器端呼叫遠端伺服器 Web API 的方法。
     */
    function ServerPost($parameters) {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $this->ServiceURL);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Content-Length: ' . strlen($parameters)));
        $rs = curl_exec($ch);

        curl_close($ch);

        return $rs;
		
    }
	
}

/**
 * AES 加解密服務的類別。
 */
class AesCrypter {

    private $Key = '4g8XCNI6j3gjfmKi';
    private $IV = 'jrcKpQ1hN2xIT3Kl';
    //private $Key = 'ejCk326UnaZWKisg';
    //private $IV = 'q9jcZX8Ib9LM8wYk';
    
    /**
     * AES 加解密服務類別的建構式。
     */
    function __construct($key, $iv) {
        $this->AesCrypter($key, $iv);
    }

    /**
     * AES 加解密服務類別的實體。
     */
    function AesCrypter($key, $iv) {
        $this->Key = $key;
        $this->IV = $iv;
    }

    /**
     * 加密服務的方法。
     */
    function Encrypt($data)
    {
        $szBlockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $szPad = $szBlockSize - (strlen($data) % $szBlockSize);
        $szData = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->Key, $data. str_repeat(chr($szPad), $szPad), MCRYPT_MODE_CBC, $this->IV);
        $szData = base64_encode($szData);

        return $szData;
    }
	
	/**
     * 解密服務的方法。
     */
    function Decrypt($data)
    {
		$szValue = base64_decode($data);
        $szValue = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->Key, $szValue, MCRYPT_MODE_CBC, $this->IV);
        $nLength = strlen($szValue);
        $nPadding = ord($szValue[$nLength - 1]);
        $szValue = substr($szValue, 0, $nLength - $nPadding);
		$szValue=urldecode($szValue);
        return $szValue;
    }
}

