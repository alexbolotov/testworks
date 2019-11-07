<?php
class Comments_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}


	public function add_comment()
	{
       $data = array(
       'nik' => $this->input->post('nik'),
       'email' => $this->input->post('email'),
       'message' => $this->input->post('message'),
       'data' => date("Y-m-d H:m:s")
    );
    
        if ($data['nik'] == "" ) {
			$data['nik'] = stristr($data['email'], '@', true);
		}
		
        return $this->db->insert('comments', $data);
	}


   public function record_count() {
       return $this->db->count_all('comments');
   }

   
   public function get_comments($limit, $start) {
       $this->db->limit($limit, $start);
       $this->db->order_by('id', 'DESC');
       $query = $this->db->get('comments');
       if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
   }


}
