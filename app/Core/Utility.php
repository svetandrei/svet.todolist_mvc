<?php
namespace App\Core;

class Utility {
  /**
   * Check various function success of failure response
   * @param $response
   * @return bool
   */
  public function isSuccessResponse($response) {
    return isset($response['status']) && $response['status'] === 'success';
  }

  /**
   * Prepare Json response to send to browser
   * @param $response
   */
  public function jsonResponse($response) {
      header('Content-Type: application/json');
      echo json_encode($response);
  }
}
