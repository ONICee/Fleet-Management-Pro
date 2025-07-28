<?php
// New model: Setting.php – simple key-value store for application configuration.
class Setting {
    private $db;
    private $table = 'settings';

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Retrieve a setting value or return the provided default if key is absent.
     */
    public function get($key, $default = null) {
        $stmt = $this->db->prepare("SELECT `value` FROM {$this->table} WHERE `key` = ? LIMIT 1");
        $stmt->execute([$key]);
        $row = $stmt->fetch();
        return $row ? $row['value'] : $default;
    }

    /**
     * Persist a setting value; inserts or updates as needed.
     */
    public function set($key, $value) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (`key`, `value`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)");
        return $stmt->execute([$key, $value]);
    }
}
?>