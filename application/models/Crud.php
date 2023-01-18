<?php
class Crud extends CI_Model
{
    public function InsertData($tableName, $data)
    {
        $res = $this->db->insert($tableName, $data);
        return $res;
    }
    public function DeleteData($tableName, $where)
    {
        $res = $this->db->delete($tableName, $where);
        return $res;
    }
    public function UpdateData($tableName, $data, $where)
    {
        $res = $this->db->update($tableName, $data, $where);
        return $res;
    }
}
