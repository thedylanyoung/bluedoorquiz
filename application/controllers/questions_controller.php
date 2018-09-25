<?php 

class questions_controller extends CI_Controller {
    public function index() {
        echo 'Quiz Questions Controller';
    }

    public function get() {
        $this->load->model('question');

        $output['questions'] = $this->question->get_quizquestions();

        $output['status'] = 'success!';
        $this->output_to_json($output);
    }

    public function post() {
        $data = $this->input->post();
        $this->load->model('question');

        $output = [
            'Question' => $this->input->post('question'),
            'Order' => $this->input->post('order'),
            'Answer' => $this->input->post('answer'),
            'QuizID' => 1, //hard coded now - could implement functionality to create new quiz
            'CreatedBy' => "test",
            'CreatedDate' => date("Y-m-d H:i:s"),
            'LastModifiedBy' => "test",
            'LastModifiedDate' => date("Y-m-d H:i:s")
        ];

        $response = $this->question->insert_quizquestion($output);

        if($response){
            $output['QuestionID'] = $response;
            $output['status'] = 'success';
            $this->output_to_json($output);
        }
    }

    private function output_to_json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>