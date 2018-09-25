<?php
//Question Entity in database
class question extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_quizquestions() {
        $this->db->order_by('Order ASC');
        $query = $this->db->get('QuizQuestions');
        return $query->result();
    }

    public function insert_quizquestion($data) {
        $output = null;
        
        $query = $this->db->insert('QuizQuestions', $data);

        $output = $this->db->insert_id();

        return $output;
    }
}

?>