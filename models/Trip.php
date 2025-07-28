<?php
require_once __DIR__ . '/BaseModel.php';
class Trip extends BaseModel {
    public function __construct($db) {
        parent::__construct($db, 'trips');
    }
}
?>