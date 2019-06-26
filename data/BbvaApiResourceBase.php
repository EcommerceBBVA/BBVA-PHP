<?php

/**
 * Bbva API v1 Client for PHP (version 1.0.0)
 *
 * Copyright © BBVA, S.A., Institución de Banca Múltiple, Grupo Financiero BBVA All rights reserved.
 * http://www.bbva.com/
 * bbva@eglobal.com.mx
 */
abstract class BbvaApiResourceBase
{

    protected $id;
    protected $parent;
    protected $resourceName = '';
    protected $serializableData;
    protected $noSerializableData;
    protected $derivedResources;

    protected function __construct($resourceName, $params = array()) {
        $this->resourceName = $resourceName;
        $this->serializableData = array();
        $this->noSerializableData = array();

        if (!is_array($params)) {
            throw new BbvaApiError("Invalid parameter type detected when instantiating an Bbva resource (passed '".gettype($params)."', array expected)");
        }

        foreach ($params as $key => $value) {
            if ($key == 'id') {
                $this->id = $value;
                continue;
            }
            if ($key == 'parent') {
                $this->parent = $value;
                continue;
            }
            $this->serializableData[$key] = $value;
        }

        if ($derived = $this->derivedResources) {
            foreach ($derived as $k => $v) {
                $name = strtolower($k).'s';
                $this->derivedResources[$name] = $this->processAttribute($k, $v);

                // unsets the original attribute
                unset($this->derivedResources[$k]);
            }
        }
    }

    protected static function getInstance($resourceName, $props = null) {
        BbvaConsole::trace('BbvaApiResourceBase @getInstance > '.$resourceName);
        if (!class_exists($resourceName)) {
            throw new BbvaApiError("Invalid Bbva resource type (class resource '".$resourceName."' is invalid)");
        }
        if (is_string($props)) {
            $props = array('id' => $props);
        } else if (!is_array($props)) {
            $props = array();
        }
        $resource = new $resourceName($resourceName, $props);
        return $resource;
    }

    // ---------------------------------------------------------
    // ------------------  PRIVATE FUNCTIONS  ------------------

    private function isList($var) {
        if (!is_array($var))
            return false;

        foreach (array_keys($var) as $k) {
            if (!is_numeric($k))
                return false;
        }
        return true;
    }

    private function processAttribute($k, $v) {
        BbvaConsole::trace('BbvaApiResourceBase @processAttribute > '.$k);
        $value = null;

        $resourceName = $this->getResourceName($k);
        if ($this->isResource($resourceName)) {
            // check is its a resource list
            if ($this->isList($v)) {
                $list = BbvaApiDerivedResource::getInstance($resourceName);
                $list->parent = $this;
                foreach ($v as $index => $objData) {
                    $list->add($objData);
                }
                $value = $list;
            } else {
                $resource = self::getInstance($resourceName);
                $resource->parent = $this;
                $resource->refreshData($v);
                $value = $resource;

                if ($resourceName != $this->resourceName) {
                    $this->registerInParent($resource);
                }
            }
        } else {
            if (is_array($v)) {
                // if it's an array, then is an object an instance a standar class

                $object = new stdClass();
                foreach ($v as $key => $value) {
                    $object->$key = $value;
                }
                $value = $object;
            } else {
                $value = $v;
            }
        }
        return $value;
    }

    private function getResourceName($name) {
        BbvaConsole::trace('BbvaApiResourceBase @getResourceName');
        if (substr($name, 0, strlen('Bbva')) == 'Bbva') {
            return $name;
        }
        return 'Bbva' .ucfirst($name);
    }

    private function isResource($resourceName) {
        BbvaConsole::trace('BbvaApiResourceBase @isResource > '.$resourceName);
// 		$resourceName = $this->getResourceName($name);

        return class_exists($resourceName);
    }

    private function registerInParent($resource) {
        BbvaConsole::trace('BbvaApiResourceBase @registerInParent');
        $parent = $this->parent;
        if ($parent instanceof BbvaApiDerivedResource) {
            $parent = $this->parent->parent;
        }

        if (!is_object($parent)) {
            return;
        }

        if ($container = $parent->getResource($resource->resourceName)) { // $resourceName
            if ($container instanceof BbvaApiDerivedResource && method_exists($container, 'addResource')) {
                BbvaConsole::trace('BbvaApiResourceBase @registerInParent > registering derived resource in parent');
                $container->addResource($resource);
            }
        }
    }

    private function getSerializeParameters() {
        BbvaConsole::trace('BbvaApiResourceBase @getSerializeParameters');
        return $this->serializableData;
    }

    private function getResource($resourceName) {
        foreach ($this->derivedResources as $resource) {
            if ($resource->resourceName == $resourceName) {
                return $resource;
            }
        }
        return false;
    }

    // ---------------------------------------------------------
    // -----------------  PROTECTED FUNCTIONS  -----------------

    protected function refreshData($data) {
        BbvaConsole::trace('BbvaApiResourceBase @refreshData');

        if (!$data) {
            return $this;
        }

        if (!is_array($data)) {
            throw new BbvaApiError("Invalid data received for processing, cannot update the Bbva resource");
        }

        // unsets the unused attributes
        $removed = array_diff(array_keys($this->serializableData), array_keys($data));
        if (count($removed)) {
            BbvaConsole::debug('BbvaApiResourceBase @refreshData > removing unused data');
            foreach ($removed as $k) {
                if ($this->serializableData[$k]) {
                    unset($this->serializableData[$k]);
                }
                if ($this->noSerializableData[$k]) {
                    $this->noSerializableData[$k] = null;
                }
                if ($this->derivedResources[$k]) {
                    //$this->derivedResources[$k] = null;
                }
            }
        }

        foreach ($data as $k => $v) {
            $k = strtolower($k);

            $value = $this->processAttribute($k, $v);

            if ($k == 'id') {
                if (!isset($this->id)) {
                    $this->id = $v;
                }
                continue;

                // by default, only protected vars & serializable data will be refresh
                // in this version, noSerializableData does not store any value
            } else if (property_exists($this, $k)) {
                $this->$k = $value;
                //if ($this->noSerializableData[$k]) {
                //	$this->noSerializableData[$k] = $value;
                //}
            } else {
                $this->serializableData[$k] = $value;
            }
        }
        return $this;
    }

    protected function getResourceUrlName($pluralize = true) {
        $class = $this->resourceName;
        if (substr($class, 0, strlen('Bbva')) == 'Bbva') {
            $class = substr($class, strlen('Bbva'));
        }
        if (substr($class, -1 * strlen('List')) == 'List') {
            $class = substr($class, 0, -1 * strlen('List'));
        }
        return strtolower(urlencode($class)).($pluralize ? 's' : '');
    }

    protected function validateParams($params) {
        BbvaConsole::trace('BbvaApiResourceBase @validateParams');
        if (!is_array($params)) {
            throw new BbvaApiRequestError("Invalid parameters type detected (type '".gettype($params)."' received, Array expected)");
        }
    }

    protected function validateId($id) {
        BbvaConsole::trace('BbvaApiResourceBase @validateId');
        if (!is_string($id) || !preg_match('/^[a-z][a-z0-9]{0,20}$/i', $id)) {
            throw new BbvaApiRequestError("Invalid ID detected (value '".$id."' received, alphanumeric string not longer than 20 characters expected)");
        }
    }

    protected function _create($resourceName, $params, $props = null) {

        $resource = self::getInstance($resourceName, $props);
        $resource->validateParams($params);

        // TODO: handle errors, not return anything
        $response = BbvaApiConnector::request('post', $resource->getUrl(), $params);
        return $resource->refreshData($response);
    }

    protected function _retrieve($resourceName, $id, $props = null) {
        if ($props && is_array($props)) {
            $props['id'] = $id;
        } else {
            $props = array('id' => $id);
        }

        $resource = self::getInstance($resourceName, $props);
        $resource->validateId($id);

        $response = BbvaApiConnector::request('get', $resource->getUrl());
        return $resource->refreshData($response);
    }

    protected function _find($resourceName, $params, $props = null) {

        $resource = self::getInstance($resourceName, $props);
        $resource->validateParams($params);

        $list = array();
        $response = BbvaApiConnector::request('get', $resource->getUrl(), $params);
        if ($this->isList($response)) {
            foreach ($response as $v) {
                $item = self::getInstance($resourceName);
                $item->refreshData($v);
                array_push($list, $item);
            }
        }
        return $list;
    }

    protected function _update() {
        $params = $this->getSerializeParameters();

        if (count($params)) {
            $response = BbvaApiConnector::request('put', $this->getUrl(), $params);
            return $this->refreshData($response);
        }
    }

    protected function _updateCharge($params) {
        if (count($params)) {
            $response = BbvaApiConnector::request('put', $this->getResourceUrl(), $params);
            return $this->refreshData($response);
        }
    }

    protected function _delete() {
        BbvaApiConnector::request('delete', $this->getUrl(), null);

        // remove from list, if parent is a list
        if ($this->id && $this->parent && method_exists($this->parent, 'removeResource')) {
            $this->parent->removeResource($this->id);
        }
        //$this->empty(); // TODO
    }

    protected function _getAttributes($param) {
        $url = $this->getUrl().'/'.$param;
        $response = BbvaApiConnector::request('get', $url, null);
        return json_decode(json_encode($response));
    }

    // ---------------------------------------------------------
    // ------------------  PUBLIC FUNCTIONS  -------------------

    public function getUrl() { // $includeId = true
        BbvaConsole::trace('BbvaApiResourceBase @getUrl > class/parent: '.get_class($this).'/'.($this->parent ? 'true' : 'false'));
        $parentUrl = '';

        if ($this->parent) {
            $parentUrl = $this->parent->getUrl();
            if ($this->parent instanceof BbvaApiDerivedResource) {
                return $parentUrl.($this->id ? '/'.$this->id : '');
            }
        }
        $resourceUrlName = $this->getResourceUrlName();
        return ($parentUrl != '' ? $parentUrl : '').($resourceUrlName != '' ? '/'.$resourceUrlName : '').($this->id ? '/'.$this->id : '');
    }

    // ---------------------------------------------------------
    // --------------------  MAGIC METHODS  --------------------

    public function __set($key, $value) {
        BbvaConsole::trace('BbvaApiResourceBase @__set > '.$key.' = '.$value);
        if ($value === '' || !$value) {
            error_log("[BANCOMER Notice] The property '".$key."' will be set to en empty string which will be intepreted ad a NULL in request");
        }
        if (isset($this->$key) && is_array($value)) {
            // TODO: handle this properly, eg: interpret the array as an object and replace value as
            // $this->$key->replaceWith($value);
            throw new BbvaApiError("The property '".$key."' cannot be assigned directly with an array");
            //} else if (property_exists($this, $key)) {
            //	$this->$key = $value;
        } else if (isset($this->serializableData[$key])) {
            $this->serializableData[$key] = $value;
        } elseif (isset($this->derivedResources[$key])) {
            $this->derivedResources[$key] = $value;
        }
    }

    public function __get($key) {
        if (property_exists($this, $key)) {
            return $this->$key;
        } else if (array_key_exists($key, $this->serializableData)) {
            return $this->serializableData[$key];
        } else if (array_key_exists($key, $this->derivedResources)) {
            return $this->derivedResources[$key];
        } else if (array_key_exists($key, $this->noSerializableData)) {
            return $this->noSerializableData[$key];
        } else {
            $resourceName = get_class($this);
            error_log("[BANCOMER Notice] Undefined property of $resourceName instance: $key"); // TODO error_log?
            return null;
        }
    }

}

?>