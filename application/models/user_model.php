<?php
/**
 * @author chenqing
 */

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function all_user($start,$offset)
    {
        $query = $this->db->get('user',$start ,$offset);
        return $query->result();
    }
	

	public function get_user_by_name($name)
	{
		$this->db->where('user_name',$name);
		return $this->db->get('user');
	}
	
	public function get_user_by_id($id)
	{
        $this->db->select('user_id, group_id,user_name,user_privilege,last_login,is_active ');
        $this->db->where('user_id',$id);
		$query = $this->db->get('user');
        return $query->result_array();
	}
	
	public function add_user($data)
	{
		$this->db->insert('user',$data);
		
		 if ($this->db->affected_rows() == 1 )
         {
             echo 1 ;
         }else
         {
             echo 0 ;
         }

	}

    public function get_user_privilege($data)
    {
        #$this->db->select('user_privilege');
        $this->db->where('user_name',$data);
        $query = $this->db->get('user');

        $row = $query->row();
        return $row->user_privilege;
    }

    public function validate_user()
    {
        $this->db->where('user_name',$this->input->post('username'));
        $this->db->where('user_password',sha1($this->input->post('password')));
        $query = $this->db->get('user');

        return ($query->num_rows() == 1)?true:false;
    }
	
	public function  delete_user($id)
	{
		$this->db->where('user_id',$id);
		$this->db->delete('user');
        if($this->db->affected_rows() == 1 ){
            return true;
        }else{
            return false;
        }
	}
	
	public function update_user($data,$id)
	{
		$this->db->where('user_id',$id);
		$this->db->update('user',$data);
        if($this->db->affected_rows() == 1 ){
            return true;
        }else{
            return false;
        }
	}
	
	public function get_group()
	{
		$query = $this->db->get('group');
        return $query->result();
	}
	
	
	

}