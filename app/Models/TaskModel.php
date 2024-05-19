<?php
namespace App\Models;

use App\Core\Database;
use App\Core\Utility;

class TaskModel extends Database {
  public $utilityObject;

  public function __construct()
  {
    parent::__construct();
    $this->utilityObject = new Utility();
  }

  /**
   * Get all rows from database
   * @return array
   */
  public function findAll(){
    $this->query('SELECT * FROM `task` ORDER BY `id` ASC');
    if ($this->execute()) {
      return $this->resultSet();
    }
    return $this->execute();
  }

  /**
   * Add the task
   * @param array $data
   * @return array|void
   */
  public function store($data = []) {
    if (!empty($data)){
      $this->query('INSERT INTO `task` (`title`) VALUES(:title)');
      return $this->execute($data);
    }
  }

  /**
   * Update the task
   * @param $id
   * @param array $data
   * @return array|void
   */
  public function update($id, $data = []) {
    if (!empty($id)) {
      $this->query('UPDATE `task` SET `title` = (:title) WHERE `id` = :id');
      return $this->execute(array("title" => $data['title'], "id" => (int)$id));
    }
  }

  /**
   * Delete the task
   * @param $id
   * @return array|void
   */

  public function delete($id) {
    if (!empty($id)){
      $this->query('DELETE FROM `task`
      WHERE `id` = :id');
      return $this->execute([':id' => $id]);
    }
  }
}
