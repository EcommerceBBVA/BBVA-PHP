<?php

/**
 * Bancomer API v1 Client for PHP (version 1.0.0)
 * 
 * Copyright © BBVA Bancomer, S.A., Institución de Banca Múltiple, Grupo Financiero BBVA Bancomer All rights reserved.
 * http://www.bancomer.com/
 * bbva_bancomer@eglobal.com.mx
 */
class BancomerApiError extends Exception
{

    protected $description;
    protected $error_code;
    protected $category;
    protected $http_code;
    protected $request_id;
    protected $fraud_rules;

    public function __construct($message = null, $error_code = null, $category = null, $request_id = null, $http_code = null, $fraud_rules = null) {
        parent::__construct($message, $error_code);
        $this->description = $message;
        $this->error_code = isset($error_code) ? $error_code : 0;
        $this->category = isset($category) ? $category : '';
        $this->http_code = isset($http_code) ? $http_code : 0;
        $this->request_id = isset($request_id) ? $request_id : '';
        $this->fraud_rules = isset($fraud_rules) ? $fraud_rules : array();
    }

    public function getDescription() {
        return $this->description;
    }

    public function getErrorCode() {
        return $this->error_code;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getHttpCode() {
        return $this->http_code;
    }

    public function getRequestId() {
        return $this->request_id;
    }

    public function getFraudRules() {
        return $this->fraud_rules;
    }

}

// Authentication related Errors
class BancomerApiAuthError extends BancomerApiError
{
    
}

// Request related Error
class BancomerApiRequestError extends BancomerApiError
{
    
}

// Transaction related Errors
class BancomerApiTransactionError extends BancomerApiError
{
    
}

// Connection related Errors
class BancomerApiConnectionError extends BancomerApiError
{
    
}
