<?php

namespace Core;

class FileDB {

    private $file_uri;
    private $data;

    public function __construct($file_uri) {
        $this->file_uri = $file_uri;
        $this->data = null;
        $this->load();
    }

    public function setRow($table, $row_id, $row_data) {
        $this->data[$table][$row_id] = $row_data;
    }

    public function setRowColumn($table, $row_id, $column_id, $column_data) {
        $this->data[$table][$row_id][$column_id] = $column_data;
    }

    public function getRow($table, $row_id) {
        return $this->data[$table][$row_id]??false;
    }

    public function getRowColumn($table, $row_id, $column_id) {
        return $this->data[$table][$row_id][$column_id];
    }

    public function load() {
        if (!file_exists($this->file_uri)) {
            $this->data = [];
        } else {
            $json_data = file_get_contents($this->file_uri);
            $this->data = json_decode($json_data, true);
        }
    }

    public function save() {
        $data_json = json_encode($this->data);
        if (file_put_contents($this->file_uri, $data_json)) {
            return true;
        } else {
            throw new Exception('Neisejo issaugoti i faila.');
        }
    }

    public function getRows($table) {
        return $this->data[$table] ?? false;
    }

    public function deleteRow($table, $row_id) {
        unset($this->data[$table][$row_id]);
    }

    public function tableExists($table) {
        if (isset($this->data[$table])) {
            return true;
        }
        return false;
    }

    public function deleteRows($table) {
        if ($this->tableExists($table)) {
            $this->data[$table] = [];
            return true;
        } else {
            return false;
        }
    }
}
