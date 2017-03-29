<?php
namespace mirec\cngroup;
/**
 * @author Miroslav Kanovsky
 * 
 * Simple php json-rpc request call implementation with HTTP/PHP-Curl. Version 0
 */

class JSONRPC {

    private $data;
    private $type;
    private $mode;
    private $request;

    /**
     * Constructs the class to object :)
     * @param int|string $id id of the request call for async request/response pairing (optional)
     */
    public function __construct($id = 0) {
        $this->data = array('id' => $id, 'method' => '', 'params' => array());
    }


    /**
     * @param Requst $request object to perform server call
     */
    public function setRequest(\mirec\cngroup\Request\Request $request) {
        $this->request = $request;
    }


    /**
     * @param int|string $id id of the request call for async request/response pairing
     **/
    public function setId($id) {
        $this->data['id'] = $id;

        return $this;
    }

    /**
     * @param string $method method to perform/call on remote server
     */
    public function setMethod($method) {
        $this->data['method'] = $method;
        return $this;
    }

    /**
     * @param string $key name of the parameter for method
     * @param string|null $value value of the parameter for method
     */
    public function addParam($key, $value = null) {
        if (is_null($value)) {
            $this->data['params'][] = $key;
        } else {
            $this->data['params'][$key] = $value;
        }

        return $this;
    }

    /**
     * @param string $key name of the parameter for method
     */
    public function getParam($key) {
        if (isset($this->data['params'][$key]))
            return $this->data['params'][$key];

        throw new Exception('Invalid parameter');
    }

    
    /**
     *  @return string|json response in json format
     */    
    public function getJson() {
        return json_encode($this->data);
    }


    /**
     *  @param string $url url to pefrom request on
     *  @return string|json response of remote server call
     */
    public function request($url) {
        $this->request->setData($this->getJson());
        $this->request->setUrl($url);
        return $this->request->call();
    }

    
}