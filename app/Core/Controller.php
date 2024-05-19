<?php
namespace App\Core;

class Controller {

  public $utilityObject;
  protected $db;

  public function __construct()
  {
    $this->utilityObject = new Utility();
    $this->db = new Database;
  }

  /**
   * Load and instantiate a model.
   * @param string $model The name of the model to load.
   * @return object An instance of the specified model.
   */
  public function model($model)
  {
    require_once '../app/Models/' . $model . '.php';
    return new $model($this->db);
  }

  /**
   * Redirect to a specified URL.
   * @param string $url The URL to redirect to.
   */
  public function redirect($url)
  {
    header("Location: $url");
    exit;
  }
}
