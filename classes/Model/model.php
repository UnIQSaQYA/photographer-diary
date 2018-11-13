<?php

class model {
    private $_db;

    protected $tableName;
    protected $columnName;
    protected $primaryKey;
    protected $limit;
    protected $offset;

    public function __construct()
    {
        $this->_db = Database::instantiate();
    }

    /**
     * use to save and update data in database
     * @param  array  $data [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    public function save($data = array(), $id = NULL, $table = NULL)
    {
        if(!isset($this->tableName) && empty($data)) return false;

        if(!isset($id)) {
            return $this->_db->insert($this->tableName, $data);
        } elseif(isset($table) && !isset($id)) {
            return $this->_db->insert($table, $data);
        } elseif(isset($table) && isset($id)) {
            $id = (int)$id;
            return $this->_db->update($table, $data, $this->primaryKey . '=?', array($id));
        }

        $id = (int)$id;
        return $this->_db->update($this->tableName, $data, $this->primaryKey . '=?', array($id));
    }


    public function create($data = array(), $table = NULL) {
        if(!isset($table) && empty($data)) return false;

        if(isset($table) && isset($data)) {
            return $this->_db->insert($table, $data);
        }elseif(!isset($table)) {
            return $this->_db->insert($this->tableName, $data);
        }
    }

    public function update($data = array(), $id, $table = NULL, $primaryKey = NULL) {
        if(!isset($table) && empty($data) && isset($id)) return false;

        $id = (int)$id;
        if(isset($table) && isset($id) && !empty($data) && isset($primaryKey)) {
            return $this->_db->update($table, $data, $primaryKey . '=?', array($id));
        }elseif(!isset($table) && isset($id) && !empty($data) && isset($primaryKey)) {
            return $this->_db->update($this->tableName, $data, $primaryKey . '=?', array($id));
        }elseif(!isset($table) && isset($id) && !empty($data) && !isset($primaryKey)) {
            return $this->_db->update($this->tableName, $data, $this->primaryKey . '=?', array($id));
        }elseif(isset($table) && isset($id) && !empty($data) && !isset($primaryKey)) {
            return $this->_db->update($table, $data, $this->primaryKey . '=?', array($id));
        }        
    }

    public function savebytable($table, $data = array())
    {
        if(!isset($table) && empty($data)) return false;

        if(!isset($id)) {
            return $this->_db->insert($table, $data);
        }

        $id = (int)$id;
        return $this->_db->update($table, $data, $this->primaryKey . '=?', array($id));
    }

    /**
     * @param null $key
     * @return mixed
     */
    protected function get($key = NULL, $table = NULL, $primary = NULL, $clause = "")
    {
        if (isset($key) && !isset($table)) {
            return $this->_db->select($this->tableName, $this->columnName, $this->primaryKey . "=?", array($key));
        } elseif (isset($this->limit) && is_numeric($this->limit)) {
            $limit = (int)$this->limit;
            $offset = (int)$this->offset;
            return $this->_db->select($this->tableName, $this->columnName, "", [], "LIMIT " . $limit . " OFFSET " . $offset);
        } elseif (isset($key) && isset($table) && !isset($primary)) {
            return $this->_db->select($table, $this->columnName, $this->primaryKey . "=?", array($key));
        }elseif(isset($key) && isset($table) && isset($primary)) {
            return $this->_db->select($table, $this->columnName, $primary . "=?", array($key));
        }

        return $this->_db->select($this->tableName, $this->columnName);
    }

    /** This Function is to select the values from db are selected by other columns rather than id
     * @param string $criteria
     * @param array $bindValue
     * @param bool $unique
     * @return bool|mixed
     */
    protected function selectBy($criteria = "", $bindValue = [], $unique = false)
    {
        if (empty($criteria)) return false;
        $data = $this->_db->select($this->tableName, $this->columnName, $criteria, $bindValue);

        if ($unique === true) {
            if (count($data)) {
                return $data[0];
            }
        }


        return $data;

    }

    /** To handel the raw method of Database.php
     * @param string $query
     * @param array $bindValue
     * @return bool|mixed
     */
    protected function dbRaw($query = '', $bindValue = [])
    {
        if (empty($query)) return false;
        return $this->_db->raw($query, $bindValue);
    }


    /**Takes id from user.php and calls method delete of database.php to delete the user
     * @param null $id
     * @return bool
     */
    protected function delete($id = NULL, $table = Null)
    {
        if (!isset($id)) return false;
        if ((is_numeric($id)) && !isset($table)) {
            return $this->_db->delete($this->tableName, $this->primaryKey . "=?", array($id));
        }elseif((is_numeric($id)) && isset($table)){
            return $this->_db->delete($table, $this->primaryKey . "=?", array($id));
        }
        else{
            return $this->_db->delete($this->tableName,$this->primaryKey." IN ({$id})",[]);
        }
    }


    protected function rowCount($table = NULL, $criteria = "")
    {
        if (empty($criteria)) {

        }
        if(isset($table)) {
            return $this->_db->countRow($table, "", []);
        }else {
            return $this->_db->countRow($this->tableName, "", []);
        }
    }
} 