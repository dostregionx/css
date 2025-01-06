<?php

class Survey extends CI_Controller
{

    public $surveyModel; 

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SurveyModel','surveyModel');
    }

    public function external()
    {
        $filter = array(
            'is_active' => 1,
            'is_external' => 1
        );

        $data['services'] = $this->surveyModel->get_services($filter);
        $data['clienttype'] = $this->surveyModel->get_all_data('tblclienttype');
        $data['offices'] = $this->surveyModel->get_all_data('tbloffice');
        $data['agegroup'] = $this->surveyModel->get_all_data('tblagegroup');

        if (empty($data['services']) || empty($data['clienttype']) || empty($data['offices'])) {
            // handle empty results, e.g. show an error message
        }
        $data['surveytype'] = 'external';
        $this->load->view('survey/survey-form', $data);
    }

    public function internal()
    {
        $param = array(
            'is_active' => 1,
            'is_external' => 0
        );
        $data['offices'] = $this->surveyModel->get_all_data('tbloffice');
        $data['services'] = $this->surveyModel->get_services($param);
        $data['clienttype'] = $this->surveyModel->get_all_data('tblclienttype');
        
        $data['surveytype'] = 'internal';
        $this->load->view('survey/survey-form', $data);
    }

    public function save()
    {
        $quarterid = $this->surveyModel->get_active_quarter()['quarterid'];

        $form1data = $this->input->post('form1');
        $form2data = $this->input->post('form2');
        $form3data = $this->input->post('form3');

        // START PROCESS FORM1
        $form1_data_transformed = array();
        $vul_sectorArr = array();
        $dost_infoArr = array();

        foreach ($form1data as $key => $value) {
            $form1_data_transformed[$value['name']] = $value['value'];

            if ($value['name'] == 'vul_sector') {
                array_push($vul_sectorArr, $value['value']);
            }

            if ($value['name'] == 'dost_info') {
                array_push($dost_infoArr, $value['value']);
            }
        }

        unset($form1data['vul_sector']);
        $form1_data_transformed['vul_sector'] = implode(", ", $vul_sectorArr);
        unset($form1data['dost_info']);
        $form1_data_transformed['dost_info'] = implode(", ", $dost_infoArr);

        $form1_data_transformed['quarterid'] = $quarterid;
        $form1_data_transformed['year'] = date('Y');

        if ($this->session->userdata('officeid')) {
            $form1_data_transformed['officeid'] = $this->session->userdata('officeid');
        }

        $summaryid = $this->surveyModel->insert_data('tblcss_summary', $form1_data_transformed);

        // START PROCESS FORM2
        foreach ($form2data as $key => $value) {
            $form2_data_transformed[$value['name']] = $value['value'];
        }

        $form2_data_transformed['csssummaryid'] = $summaryid;
        $save = $this->surveyModel->insert_data('tblcss_details_cc', $form2_data_transformed);

        // START PROCESS FORM3
        foreach ($form3data as $key => $value) {
            $form3_data_transformed[$value['name']] = $value['value'];
        }

        $form3_data_transformed['csssummaryid'] = $summaryid;
        $save = $this->surveyModel->insert_data('tblcss_details_sqd', $form3_data_transformed);

        if ($save > 0) {
            echo "SUCCESS";
        }
    }

    public function thank_you()
    {
        $this->load->view('survey/thank-you');
    }
}
