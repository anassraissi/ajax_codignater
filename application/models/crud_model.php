<?php
class crud_model extends CI_Model {


    public function insert_entry($data)
    {
           return $this->db->insert('crud', $data);
    }

    public function update_entry()
    {
            $this->title    = $_POST['title'];
            $this->content  = $_POST['content'];
            $this->date     = time();

            $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
    public function get_entry()
    {
          $row=$this->db->get('crud');
          if(count($row->result())>0){
              return $row->result();
          }

    }
    public function del_entry($id){
          return $this->db->delete('crud',array('id'=>$id));
         }

    public function edit_entry($id){
            $this->db->select('*');
            $this->db->from('crud');
            $this->db->where('id',$id);
            $qeury=$this->db->get();
            if(count($qeury->result())>0){
                return $qeury->result();
            }
            else{
                return false;
            }

           }

}
?>