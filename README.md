Bancomer PHP

PHP client for Bancomer API services (version 1.0.0)

This is a client implementing the payment services for Bancomer at bancomer.mx

What's new?
-----------

Compatibility
-------------

PHP 5.2 or later 

Requirements
------------
PHP 5.2 or later 
cURL extension for PHP
JSON extension for PHP
Multibyte String extension for PHP

Installation
------------
### Composer
The preferred method is via [composer](https://getcomposer.org). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require bancomer/sdk dev-master
```
Finally, be sure to include the autoloader:

```php
require_once '/path/to/your-project/vendor/autoload.php';
```

### Manual installation

To install, just:

  - Clone the repository or download the library and copy/create a folder named
    **'Bancomer'** inside your project folder structure. If you downloaded the 
    client library as a compressed file, uncompress it and create the proper 
    folder structure.
  - At the top of the PHP script in which the client library will be used (or 
    in the section you include other libraries), add the client's library main
    script:
    
```php
require(dirname(__FILE__) . '/Bancomer/Bancomer.php');
```

> NOTE: In the example above, the library is located in the directory named 
> Bancomer, located inside the same directory that the PHP file which is 
> including the cliente. Make sure to adjust the paths inside your project,
> otherwise the library will not work.

 
Implementation
--------------

#### Configuration #####

Before use the library will be necessary to set up your Merchant ID and
Private key. There are three options:

  - Use the methods **Bancomer::setId()** and **Bancomer::setApiKey()**. Just 
    pass the proper parameters to each function:
    
```php
Bancomer::setId('moiep6umtcnanql3jrxp');
Bancomer::setApiKey('sk_3433941e467c4875b178ce26348b0fac');
```
	
  - Pass Merchant ID and Private Key as parameters to the method **Bancomer::getInstance()**,
    which is the instance generator:
    
```php
$bancomer = Bancomer::getInstance('moiep6umtcnanql3jrxp', 'sk_3433941e467c4875b178ce26348b0fac');
```

  - Configure the Marchant ID and the Private Key as well, as environment 
    variables. This method has its own advantages as this sensitive data is not
    exposed directly in any script.
    
> NOTE: please, refer to PHP documentation for further information about this method.


##### Sandbox/Production Mode #####

By convenience and security, the sandbox mode is activated by default in the
client library. This allows you to test your own code when implementing
Bancomer, before charging any credit card in production environment. Once you
have finished your integration, use the method **Bancomer::setProductionMode(FLAG)** which
will allow you to active/inactivate the sandbox mode.

````php
Bancomer::setProductionMode(true);
````
Also you can use environment variables for this purpose:
````
SetEnv OPENPAY_PRODUCTION_MODE true
````

If its necessary, you can use the method **Bancomer::getProductionMode()** to 
determine anytime, which is the sandbox mode status:

````php
// will return TRUE/FALSE, depending on if sandbox mode is activated or not.
Bancomer::getProductionMode(); 
````

#### PHP client library intro #####

Once configured the library, you can use it to interact with Bancomer API 
services. The first step is get an instance with the generator:

````php
$bancomer = Bancomer::getInstance('mptdggroasfcmqs8plpy', 'sk_326c6d0443f6457aae29ffbd48f7d1be');
````

In this example **$bancomer** will be an instance of a merchant (root), wich 
will be used to call any derived child resource. According to the current version 
of the Bancomer API, these resources are:

  - charges
  - tokens

You can access all of these resources as public variables of the root instance, 
so, if you want to add a new customer you will be able to do it as follows:

````php
$bancomer->tokens->add(PARAMETERS);
````

Every call to any resource will return an instance of that resource. In the 
example above, calling the method **add()** in the resource **tokens** will 
return an instance of Token, calling the method **add()** in the resource **tokens**
will return an instance of Card, and so on. The only exception occurs when you retrieve
a list of resources using the method **getList()**, in which case an array of 
instances will be returned:

````
// a SINGLE instance of Customer will be returned
$charge = $bancomer->charges->add(PARAMETERS);


// an ARRAY of instances of Customers will be returned
chargersList = $bancomer->charges->getList(PARAMETERS);
````

On the other hand, the resources derived from Charge, according to Bancomer 
API documentation, are:

  - charges
  - tokens

#### Parameters ####

Those methods which receive more than one parameter (for example, when trying 
to add a new customer or a new customer's card), must be passed
as associatives arrays:

````php
array('PARAMETER_INTEGER' => VALUE,
      'PARAMETER_STRING'  => 'VALUE');
      'PARAMETER_DERIVED' => array('PARAMETER_INTEGER' => VALUE), 
                                   'PARAMETER_STRING'  => 'VALUE'));
````

> NOTE: Please refer to Bancomer API docuemntation to determine wich parameters 
> are accepted, wich required and which of those are optional, in every case. 


#### Error handling ####

The Bancomer API generates several types of errors depending on the situation,
to handle this, the PHP client has implemented five type of exceptions:

  - **BancomerApiTransactionError**. This category includes those errors ocurred when 
    the transaction does not complete successfully: declined card, insufficient
    funds, inactive destination account, etc.
  - **BancomerApiRequestError**. It refers to errors generated when a request to the
    API fail. Examples: invalid format in data request, incorrect parameters in
    the request, Bancomer internal servers errors, etc.
  - **BancomerApiConnectionError**. These exceptions are generated when the library 
    try to connect to the API but fails in the attempt. For example: timeouts, 
    domain name servers, etc.
  - **BancomerApiAuthError**. Errors which are generated when the authentication 
    data are specified in an invalid format or, if are not fully validated on
    the Bancomer server (Merchant ID or Private Key).
  - **BancomerApiError**. This category includes all generic errors when processing
    with the client library.

All these error exceptions make available all the information returned by the 
Bancomer API, with the following methods:

  - **getDescription()**: Error description generated by Bancomer server.
  - **getErrorCode()**: Error code generated by Bancomer server. When the error
    is generated before the request, this value is equal to zero.
  - **getCategory()**: Error category generated and determined by Bancomer server.
    When the error is generated before or during the request, this value is an 
    empty string.
  - **getHttpCode()**: HTTP error code generated when request the Bancomer
    server. When the error is generated before or during the request, this 
    value is equal to zero.
  - **getRequestId()**: ID generated by the Bancomer server when process a 
    request. When the error is generated before the request, this value is
    an empty string.

The following is an more complete example of error catching:

````php
try {
	Bancomer::setProductionMode(true);
	
	// the following line will generate an error because the
	// private key is empty. The exception generated will be
	// a BancomerApiAuthError
	$bancomer = Bancomer::getInstance('mptdggroasfcmqs8plpy', '');

	$customer = $bancomer->customers->get('a9ualumwnrcxkl42l6mh');
 	$customer->name = 'Juan';
 	$customer->last_name = 'Godinez';
 	$customer->save();

} catch (BancomerApiTransactionError $e) {
	error_log('ERROR on the transaction: ' . $e->getMessage() . 
	      ' [error code: ' . $e->getErrorCode() . 
	      ', error category: ' . $e->getCategory() . 
	      ', HTTP code: '. $e->getHttpCode() . 
	      ', request ID: ' . $e->getRequestId() . ']', 0);

} catch (BancomerApiRequestError $e) {
	error_log('ERROR on the request: ' . $e->getMessage(), 0);

} catch (BancomerApiConnectionError $e) {
	error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);

} catch (BancomerApiAuthError $e) {
	error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
	
} catch (BancomerApiError $e) {
	error_log('ERROR on the API: ' . $e->getMessage(), 0);
	
} catch (Exception $e) {
	error_log('Error on the script: ' . $e->getMessage(), 0);
}
````

Examples
--------

#### Customers ####

Add a new customer to a merchant:
````php
$bancomer = Bancomer::getInstance('mptdggroasfcmqs8plpy', 'sk_326c6d0443f6457aae29ffbd48f7d1be');

$customerData = array(
	'name' => 'Teofilo',
	'last_name' => 'Velazco',
	'email' => 'teofilo@payments.com',
	'phone_number' => '4421112233',
	'address' => array(
			'line1' => 'Privada Rio No. 12',
			'line2' => 'Co. El Tintero',
			'line3' => '',
			'postal_code' => '76920',
			'state' => 'Querétaro',
			'city' => 'Querétaro.',
			'country_code' => 'MX'));

````

#### Tokens ####

**On a merchant:**

Add a token:
````php
$bancomer = Bancomer::getInstance('mptdggroasfcmqs8plpy', 'sk_326c6d0443f6457aae29ffbd48f7d1be');

$tokenData = array(
	'holder_name' => 'Luis Pérez',
	'card_number' => '4111111111111111',
	'cvv2' => '123',
	'expiration_month' => '12',
	'expiration_year' => '15',
	'address' => array(
		'line1' => 'Av. 5 de Febrero No. 1',
		'line2' => 'Col. Felipe Carrillo Puerto',
		'line3' => 'Zona industrial Carrillo Puerto',
		'postal_code' => '76920',
		'state' => 'Querétaro',
		'city' => 'Querétaro',
		'country_code' => 'MX'));

$token = $bancomer->tokens->add($tokenData);
````

Get a token:
````php
$bancomer = Bancomer::getInstance('mptdggroasfcmqs8plpy', 'sk_326c6d0443f6457aae29ffbd48f7d1be');

$token = $bancomer->tokens->get('k9pn8qtsvr7k7gxoq1r5');
````
	
#### Charges ####

**On a Merchant:**

Make a charge on a merchant:
````php
$bancomer = Bancomer::getInstance('mptdggroasfcmqs8plpy', 'sk_326c6d0443f6457aae29ffbd48f7d1be');

$chargeData = array(
	'affiliation_bbva' => '781500',
	'amount' => 100,
	'currency' => 'MXN',
	'order_id' => 'ORDEN-00071',
	'customer' => array(
		'name' => 'Teofilo',
		'last_name' => 'Velazco',
		'email' => 'teofilo@payments.com',
		'phone_number' => '4421112233',
		'address' => array(
			'line1' => 'Privada Rio No. 12',
			'line2' => 'Co. El Tintero',
			'line3' => '',
			'postal_code' => '76920',
			'state' => 'Querétaro',
			'city' => 'Querétaro.',
			'country_code' => 'MX')),
	'description' => 'Cargo inicial a mi merchant'
	'redirect_url' => 'https://sand-portal.ecommercebbva.com/'
	);

$charge = $bancomer->charges->create($chargeData);
````
	
Get a charge:
````php
$bancomer = Bancomer::getInstance('mptdggroasfcmqs8plpy', 'sk_326c6d0443f6457aae29ffbd48f7d1be');

$charge = $bancomer->charges->get('tvyfwyfooqsmfnaprsuk');
````
	
Make a capture:
````php
$bancomer = Bancomer::getInstance('mptdggroasfcmqs8plpy', 'sk_326c6d0443f6457aae29ffbd48f7d1be');

$captureData = array('amount' => 150.00 );

$charge = $bancomer->charges->get('tvyfwyfooqsmfnaprsuk');
$charge->capture($captureData);
````
	
Make a refund:
````php
$bancomer = Bancomer::getInstance('mptdggroasfcmqs8plpy', 'sk_326c6d0443f6457aae29ffbd48f7d1be');

$refundData = array('description' => 'Devolución' );

$charge = $bancomer->charges->get('tvyfwyfooqsmfnaprsuk');
$charge->refund($refundData);
````