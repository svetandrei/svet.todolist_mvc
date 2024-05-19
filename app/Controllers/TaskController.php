<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\TaskModel;

class TaskController extends Controller {

  public $model = '';
  public $response = [];
  public function __construct()
  {
    parent::__construct();
    $this->model = new TaskModel();
  }

  /**
   * Show All task list.
   */
  public function index() {
    $this->response = $this->model->findAll();
    $this->utilityObject->jsonResponse($this->response);
  }

  /**
   * Add a task
   */
  public function add() {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!empty($_POST["title"])) {
        $title = trim(htmlspecialchars($_POST["title"]));
        $this->response = $this->model->store([
          ':title' => $title,
       ]);
      }
    }
    $this->utilityObject->jsonResponse($this->response);
  }

  /**
   * Update a task
   * @param $id
   */
  public function update($id) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!empty(current($id))) {
        $id = filter_var(current($id), FILTER_VALIDATE_INT);
        $title = trim(htmlspecialchars($_POST["title"]));
        $this->response = $this->model->update($id, ['title' => $title]);
      }
    }
    $this->utilityObject->jsonResponse($this->response);
  }

  /**
   * Delete task
   * @param $id
   */
  public function delete($id) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
      if (!empty(current($id))) {
        $id = filter_var(current($id), FILTER_VALIDATE_INT);
        $this->response = $this->model->delete($id);
      }
    }
    $this->utilityObject->jsonResponse($this->response);
  }
}
