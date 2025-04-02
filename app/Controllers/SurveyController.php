<?php

namespace App\Controllers;

class SurveyController extends BaseController
{
    public $SurveyModel; 

    public function __construct()
    {
        $this->SurveyModel = new \App\Models\SurveyModel();
    }
    public function index()
    {
        return view('welcome_message');
    }

    public function external()
    {
        $filter = array(
            'is_active' => 1,
            'is_external' => 1
        );

        $data['services'] = $this->SurveyModel->get_services($filter);
        $data['clienttype'] = $this->SurveyModel->get_all_data('tblclienttype');
        $data['offices'] = $this->SurveyModel->get_all_data('tbloffice');
        $data['agegroup'] = $this->SurveyModel->get_all_data('tblagegroup');

        if (empty($data['services']) || empty($data['clienttype']) || empty($data['offices'])) {
            // handle empty results, e.g. show an error message
        }
        $data['surveytype'] = 'external';
        return view('survey/survey-form', $data);
    }

    public function internal()
    {
        $filter = array(
            'is_active' => 1,
            'is_external' => 0
        );

        $data['services'] = $this->SurveyModel->get_services($filter);
        $data['clienttype'] = $this->SurveyModel->get_all_data('tblclienttype');
        $data['offices'] = $this->SurveyModel->get_all_data('tbloffice');
        $data['agegroup'] = $this->SurveyModel->get_all_data('tblagegroup');

        $data['surveytype'] = 'external';
        return view('survey/survey-form-internal', $data);
    }

    public function save()
    {
        $form1data = $this->request->getPost('form1');
        $form2data = $this->request->getPost('form2');
        $form3data = $this->request->getPost('form3');



        
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


        // get the quarter from the form1data['date']
        $date = $form1_data_transformed['date'];
        $date = date_create($date);
        $month = date_format($date, 'm');
        $quarterid = 0;
        if ($month >= 1 && $month <= 3) {
            $quarterid = 1;
        } elseif ($month >= 4 && $month <= 6) {
            $quarterid = 2;
        } elseif ($month >= 7 && $month <= 9) {
            $quarterid = 3;
        } elseif ($month >= 10 && $month <= 12) {
            $quarterid = 4;
        }

        unset($form1data['vul_sector']);
        $form1_data_transformed['vul_sector'] = implode(", ", $vul_sectorArr);
        unset($form1data['dost_info']);
        $form1_data_transformed['dost_info'] = implode(", ", $dost_infoArr);

        $form1_data_transformed['quarterid'] = $quarterid;
        $form1_data_transformed['year'] = date('Y');

        if ($this->session->get('officeid')) {
            $form1_data_transformed['officeid'] = $this->session->get('officeid');
        }

        $summaryid = $this->SurveyModel->insert_data('tblcss_summary', $form1_data_transformed);

        // START PROCESS FORM2
        foreach ($form2data as $key => $value) {
            $form2_data_transformed[$value['name']] = $value['value'];
        }

        $form2_data_transformed['csssummaryid'] = $summaryid;
        $save = $this->SurveyModel->insert_data('tblcss_details_cc', $form2_data_transformed);

        // START PROCESS FORM3
        foreach ($form3data as $key => $value) {
            $form3_data_transformed[$value['name']] = $value['value'];
        }

        $form3_data_transformed['csssummaryid'] = $summaryid;
        $save = $this->SurveyModel->insert_data('tblcss_details_sqd', $form3_data_transformed);

        if ($save > 0) {
            echo "SUCCESS";
        }
    }


    public function thank_you()
    {
        return view('survey/thank-you');
    }
}
