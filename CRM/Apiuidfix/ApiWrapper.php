<?php

class CRM_Apiuidfix_ApiWrapper implements API_Wrapper {
  /**
   * the wrapper contains a method that allows you to alter the parameters of the api request (including the action and the entity)
   */
  public function fromApiInput($apiRequest) {
    $session = CRM_Core_Session::singleton();
    if (!empty($session->get('userID'))) {
      return $apiRequest;
    }
    
    $valid_user = FALSE;

    // Check and see if a valid secret API key is provided.
    $api_key = CRM_Utils_Request::retrieve('api_key', 'String', $store, FALSE, NULL, 'REQUEST');
    if (!$api_key || strtolower($api_key) == 'null') {
      return $apiRequest;
    }
    $valid_user = CRM_Core_DAO::getFieldValue('CRM_Contact_DAO_Contact', $api_key, 'id', 'api_key');

    // If we didn't find a valid user, die
    if (empty($valid_user)) {
      return $apiRequest;
    }
    //now set the UID into the session
    $session->set('userID', $valid_user);
    return $apiRequest;
  }
  /**
   * alter the result before returning it to the caller.
   */
  public function toApiOutput($apiRequest, $result) {
    return $result;
  }
}

