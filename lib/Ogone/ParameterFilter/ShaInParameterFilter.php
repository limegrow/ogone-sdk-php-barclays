<?php

/*
 * This file is part of the Marlon Ogone package.
 *
 * (c) Marlon BVBA <info@marlon.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ogone\ParameterFilter;

/** @todo test this */
class ShaInParameterFilter implements ParameterFilter
{
    // @see \Ogone\AbstractRequest::$ogoneFields
    private $allowed = array(
        'ACCEPTURL', 'ADDMATCH', 'ADDRMATCH', 'ALIAS', 'ALIASOPERATION', 'ALIASPERSISTEDAFTERUSE', 'ALIASUSAGE',
        'ALLOWCORRECTION', 'AMOUNT', 'AMOUNTHTVA', 'AMOUNTTVA', 'BACKURL', 'BGCOLOR',
        'BRAND', 'BRANDVISUAL', 'BUTTONBGCOLOR', 'BUTTONTXTCOLOR', 'CANCELURL',
        'CARDNO', 'CATALOGURL', 'CERTID', 'CHECK_AAV', 'CIVILITY', 'CN', 'COM',
        'COMPLUS', 'COSTCENTER', 'CREDITCODE', 'CUID', 'CURRENCY', 'CVC', 'DATA',
        'DATATYPE', 'DATEIN', 'DATEOUT', 'DECLINEURL', 'DEVICE', 'DISCOUNTRATE', 'ECI', 'ECOM_BILLTO_POSTAL_CITY',
        'ECOM_BILLTO_POSTAL_COUNTRYCODE', 'ECOM_BILLTO_POSTAL_NAME_FIRST', 'ECOM_BILLTO_POSTAL_NAME_LAST',
        'ECOM_BILLTO_POSTAL_POSTALCODE', 'ECOM_BILLTO_POSTAL_STREET_LINE1', 'ECOM_BILLTO_POSTAL_STREET_LINE2',
        'ECOM_BILLTO_POSTAL_STREET_NUMBER', 'ECOM_CONSUMERID', 'ECOM_CONSUMERORDERID',
        'ECOM_CONSUMERUSERALIAS', 'ECOM_PAYMENT_CARD_EXPDATE_MONTH', 'ECOM_PAYMENT_CARD_EXPDATE_YEAR',
        'ECOM_PAYMENT_CARD_NAME', 'ECOM_PAYMENT_CARD_VERIFICATION', 'ECOM_SHIPTO_COMPANY',
        'ECOM_SHIPTO_DOB', 'ECOM_SHIPTO_ONLINE_EMAIL', 'ECOM_SHIPTO_POSTAL_CITY',
        'ECOM_SHIPTO_POSTAL_COUNTRYCODE', 'ECOM_SHIPTO_POSTAL_NAME_FIRST', 'ECOM_SHIPTO_POSTAL_NAME_LAST',
        'ECOM_SHIPTO_POSTAL_POSTALCODE', 'ECOM_SHIPTO_POSTAL_STREET_LINE1', 'ECOM_SHIPTO_POSTAL_STREET_LINE2',
        'ECOM_SHIPTO_POSTAL_STREET_NUMBER', 'ECOM_SHIPTO_TELECOM_FAX_NUMBER', 'ECOM_SHIPTO_TELECOM_PHONE_NUMBER',
        'ECOM_SHIPTO_TVA', 'ED', 'EMAIL', 'EXCEPTIONURL', 'EXCLPMLIST', 'FIRSTCALL',
        'FLAG3D', 'FONTTYPE', 'FORCECODE1', 'FORCECODE2', 'FORCECODEHASH', 'FORCETP',
        'GENERIC_BL', 'GIROPAY_ACCOUNT_NUMBER', 'GIROPAY_BLZ', 'GIROPAY_OWNER_NAME',
        'GLOBORDERID', 'GUID', 'HDFONTTYPE', 'HDTBLBGCOLOR', 'HDTBLTXTCOLOR', 'HEIGHTFRAME',
        'HOMEURL', 'HTTP_ACCEPT', 'HTTP_USER_AGENT', 'INCLUDE_BIN', 'INCLUDE_COUNTRIES',
        'INVDATE', 'INVDISCOUNT', 'INVLEVEL', 'INVORDERID', 'ISSUERID', 'LANGUAGE',
        'LEVEL1AUTHCPC', 'LIMITCLIENTSCRIPTUSAGE', 'LINE_REF', 'LIST_BIN', 'LIST_COUNTRIES',
        'LOGO', 'MERCHANTID', 'MODE', 'MTIME', 'MVER', 'OPERATION', 'OR_INVORDERID',
        'OR_ORDERID', 'ORDERID', 'ORIG', 'OWNERADDRESS', 'OWNERADDRESS2', 'OWNERCTY',
        'OWNERTELNO', 'OWNERTOWN', 'OWNERZIP', 'PAIDAMOUNT', 'PARAMPLUS', 'PARAMVAR',
        'PAYID', 'PAYMETHOD', 'PM', 'PMLIST', 'PMLISTPMLISTTYPE', 'PMLISTTYPE',
        'PMLISTTYPEPMLIST', 'PMTYPE', 'POPUP', 'POST', 'PSPID', 'PSWD', 'REF', 'REF_CUSTOMERID',
        'REF_CUSTOMERREF', 'REFER', 'REFID', 'REFKIND', 'REMOTE_ADDR', 'REQGENFIELDS', 'RTIMEOUT',
        'RTIMEOUTREQUESTEDTIMEOUT', 'SCORINGCLIENT', 'SETT_BATCH', 'SID', 'TAAL',
        'TBLBGCOLOR', 'TBLTXTCOLOR', 'TID', 'TITLE', 'TOTALAMOUNT', 'TP', 'TRACK2',
        'TXTBADDR2', 'TXTCOLOR', 'TXTOKEN', 'TXTOKENTXTOKENPAYPAL', 'TYPE_COUNTRY',
        'UCAF_AUTHENTICATION_DATA', 'UCAF_PAYMENT_CARD_CVC2', 'UCAF_PAYMENT_CARD_EXPDATE_MONTH',
        'UCAF_PAYMENT_CARD_EXPDATE_YEAR', 'UCAF_PAYMENT_CARD_NUMBER', 'USERID', 'USERTYPE',
        'VERSION', 'WBTU_MSISDN', 'WBTU_ORDERID', 'WEIGHTUNIT', 'WIN3DS', 'WITHROOT', 'CARD.PAYMENTMETHOD',
        'ACCOUNT.PSPID', 'ALIAS.ALIASID', 'ALIAS.ORDERID', 'ALIAS.STOREPERMANENTLY', 'PARAMETERS.ACCEPTURL',
        'PARAMETERS.EXCEPTIONURL', 'LAYOUT.TEMPLATENAME', 'LAYOUT.LANGUAGE',
        // Optional integration data: Order data ("ITEM" parameters).
        // https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/additional-data/order-data
        'ITEMATTRIBUTES*', 'ITEMCATEGORY*', 'ITEMCOMMENTS*', 'ITEMDESC*', 'ITEMDISCOUNT*',
        'ITEMID*', 'ITEMNAME*', 'ITEMPRICE*', 'ITEMQUANT*', 'ITEMQUANTORIG*',
        'ITEMUNITOFMEASURE*', 'ITEMVAT*', 'ITEMVATCODE*', 'ITEMWEIGHT*', 'TAXINCLUDED*',
        // Optional integration data: Travel data.
        // https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/additional-data/travel-data
        'DATATYPE', 'AIAIRNAME', 'AITINUM', 'AITIDATE', 'AICONJTI', 'AIPASNAME',
        'AIEXTRAPASNAME*', 'AICHDET', 'AIAIRTAX', 'AIVATAMNT', 'AIVATAPPL', 'AITYPCH',
        'AIEYCD', 'AIIRST', 'AIORCITY*', 'AIORCITYL*', 'AIDESTCITY*', 'AIDESTCITYL*',
        'AISTOPOV*', 'AICARRIER*', 'AIBOOKIND*', 'AIFLNUM*', 'AIFLDATE*', 'AICLASS*',
        // @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/directlink/request-a-new%20order#processing-transactions-with-stored-credentials
        'COF_INITIATOR', 'COF_SCHEDULE', 'COF_TRANSACTION',
        // @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/directlink-3-d/3-d%20secure%20v2
        'BROWSERACCEPTHEADER', 'BROWSERCOLORDEPTH', 'BROWSERJAVAENABLED', 'BROWSERLANGUAGE', 'BROWSERSCREENHEIGHT',
        'BROWSERSCREENWIDTH', 'BROWSERTIMEZONE', 'BROWSERUSERAGENT',
        'SHOPPINGCARTEXTENSIONID', 'ORIG',
        // Invoicing
        // @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/additional-data/delivery-and-invoicing-data
        // @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/klarna
        // @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/afterpay
        'ECOM_BILLTO_POSTAL_COUNTY','ECOM_SHIPTO_POSTAL_COUNTY',
        //'ECOM_SHIPTO_COUNTY',
        'ECOM_SHIPTO_POSTAL_STREET_NUMBER', 'ECOM_CONSUMER_GENDER',
        'ECOM_SHIPTO_POSTAL_NAME_PREFIX',
        'ECOM_SHIPTO_POSTAL_STATE',
        'ECOM_BILLTO_TVA', 'ECOM_SHIPTO_TVA',
        'ECOM_BILLTO_COMPANY', 'ECOM_SHIPTO_COMPANY',
        'ECOM_SHIPTO_TELECOM_FAX_NUMBER',
        'ECOM_SHIPTO_TELECOM_PHONE_NUMBER',
        'ORDERSHIPCOST', 'ORDERSHIPTAX', 'ORDERSHIPMETH', 'ORDERSHIPTAXCODE',
        'DATEIN', 'REF_CUSTOMERREF'
    );

    public function filter(array $parameters)
    {
        $parameters = array_change_key_case($parameters, CASE_UPPER);

        $result = [];
        foreach ($parameters as $parameter => $value) {
            if (in_array($parameter, $this->allowed)) {
                $result[$parameter] = $value;
                continue;
            }

            // Check if a string ends with a number
            // Check parameters is like ITEMID*
            $last = mb_substr($parameter, -1, 1, 'UTF-8');
            if (is_numeric($last) && in_array(rtrim($parameter, $last) . '*', $this->allowed)) {
                $result[$parameter] = $value;
            }
        }

        return $result;
    }
}
