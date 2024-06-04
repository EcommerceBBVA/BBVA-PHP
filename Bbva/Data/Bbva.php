<?php

namespace Bbva\Data;

class Bbva
{

    private static $instance = null;
    private static $id = '';
    private static $apiKey = '';
    private static $apiEndpoint = 'https://api.ecommercebbva.com/v1';
    private static $apiSandboxEndpoint = 'https://sand-api.ecommercebbva.com/v1';
    private static $sandboxMode = true;
    private static $publicIp;

    public function __construct()
    {

    }

    public static function getInstance($id = '', $apiKey = '', $publicIp)
    {
        if ($id != '') {
            self::setId($id);
        }
        if ($apiKey != '') {
            self::setApiKey($apiKey);
        }
        if(!is_null($publicIp)){
            self::setPublicIp($publicIp);
        }

        $instance = BbvaApi::getInstance(null);
        return $instance;
    }

    public static function setApiKey($key = '')
    {
        if ($key != '') {
            self::$apiKey = $key;
        }
    }

    public static function getApiKey()
    {
        $key = self::$apiKey;
        if (!$key) {
            $key = getenv('API_KEY');
        }
        return $key;
    }

    public static function setId($id = '')
    {
        if ($id != '') {
            self::$id = $id;
        }
    }

    public static function getId()
    {
        $id = self::$id;
        if (!$id) {
            $id = getenv('MERCHANT_ID');
        }
        return $id;
    }

    public static function setPublicIp($publicIp = null)
    {
        if (!is_null($publicIp)) {
            self::$publicIp = $publicIp;
        }
    }

    public static function getPublicIp() {
        return self::$publicIp;

    }

    public static function getSandboxMode()
    {
        $sandbox = self::$sandboxMode;
        if (getenv('PRODUCTION_MODE')) {
            $sandbox = (strtoupper(getenv('PRODUCTION_MODE')) == 'FALSE');
        }
        return $sandbox;
    }

    public static function setSandboxMode($mode)
    {
        self::$sandboxMode = $mode ? true : false;
    }

    public static function getProductionMode()
    {
        $sandbox = self::$sandboxMode;
        if (getenv('PRODUCTION_MODE')) {
            $sandbox = (strtoupper(getenv('PRODUCTION_MODE')) == 'FALSE');
        }
        return !$sandbox;
    }

    public static function setProductionMode($mode)
    {
        self::$sandboxMode = $mode ? false : true;
    }

    public static function getEndpointUrl()
    {
        return (self::getSandboxMode() ? self::$apiSandboxEndpoint : self::$apiEndpoint);
    }

}
