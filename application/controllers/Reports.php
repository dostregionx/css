<?php

class Reports extends CI_Controller
{
    public $reportsModel; 

    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in()) {
            redirect('login'); // Redirect to login page if not logged in
        }
        $this->load->model('ReportsModel','reportsModel');
    }
    public function responses()
    {
        $params = $this->input->get();

        $params['is_external'] = $params['servicetype'];
        unset($params['servicetype']);

        $data['reponses'] = $this->reportsModel->get_responses($params);
        $data['quarters'] = $this->reportsModel->get_all_data('tblquarters');
        $data['offices'] = $this->reportsModel->get_all_data('tbloffice');

        $data['content'] = 'reports/responses-view';
        $this->load->view('admin/main', $data);
    }

    public function generate()
    {
        $data['quarters'] = $this->reportsModel->get_all_data('tblquarters');
        $data['offices'] = $this->reportsModel->get_all_data('tbloffice');
        $data['semesters'] = $this->reportsModel->get_all_data('tblsemester');

        $data['content'] = 'reports/generate-view';
        $this->load->view('admin/main', $data);
    }

    public function gen_result()
    {
        $params = $this->input->post();

        $data['params'] = $params;
        $data['officename'] = $this->reportsModel->get_office_name($params);

        if ($data['officename'] == NULL) {
            $data['officename']['name'] = 'DOST 10';
        }

        $data['clienttype'] = $this->reportsModel->gen_client_type($params);
        $data['agegroup'] = $this->reportsModel->gen_agegroup($params);
        $data['sex'] = $this->reportsModel->gen_sex($params);
        $data['age_distribution'] = $this->reportsModel->gen_age_distribution($params);
        $data['vulsector'] = $this->reportsModel->gen_vulsector($params);

        $ctype_total_external = $ctype_total_internal = 0;

        foreach ($data['clienttype'] as $ctypeRow) {
            $ctype_total_external += $ctypeRow['external_count'];
            $ctype_total_internal += $ctypeRow['internal_count'];
        }

        $data['ctype_total_external'] = $ctype_total_external;
        $data['ctype_total_internal'] = $ctype_total_internal;

        $data['services_external'] = $this->reportsModel->gen_services_external($params, 1);
        $data['services_internal'] = $this->reportsModel->gen_services($params, 0);

        $data['sex']['total_male'] = $data['sex']['external_male'] + $data['sex']['internal_male'];
        $data['sex']['total_female'] = $data['sex']['external_female'] + $data['sex']['internal_female'];
        $data['sex']['all_total'] = $data['sex']['total_external'] + $data['sex']['total_internal'];

        $data['age_distribution']['total_19_or_lower'] = $data['age_distribution']['external_19_or_lower'] + $data['age_distribution']['internal_19_or_lower'];
        $data['age_distribution']['total_20_34'] = $data['age_distribution']['external_20_34'] + $data['age_distribution']['internal_20_34'];
        $data['age_distribution']['total_35_49'] = $data['age_distribution']['external_35_49'] + $data['age_distribution']['internal_35_49'];
        $data['age_distribution']['total_50_64'] = $data['age_distribution']['external_50_64'] + $data['age_distribution']['internal_50_64'];
        $data['age_distribution']['total_65_or_higher'] = $data['age_distribution']['external_65_or_higher'] + $data['age_distribution']['internal_65_or_higher'];
        $data['age_distribution']['all_total'] = $data['age_distribution']['total_external_count'] + $data['age_distribution']['total_internal_count'];

        $data['vulsector']['external_total'] = 
            $data['vulsector']['Senior_Citizen_External_Count']
            + $data['vulsector']['PWD_External_Count']
            + $data['vulsector']['4Ps_Beneficiaries_External_Count']
            + $data['vulsector']['Indigenous_People_External_Count']
            + $data['vulsector']['NA_External'];

        $data['vulsector']['internal_total'] = 
            $data['vulsector']['Senior_Citizen_Internal_Count']
            + $data['vulsector']['PWD_Internal_Count']
            + $data['vulsector']['4Ps_Beneficiaries_Internal_Count']
            + $data['vulsector']['Indigenous_People_Internal_Count']
            + $data['vulsector']['NA_Internal'];

        $data['vulsector']['overall_total'] = 
            $data['vulsector']['Senior_Citizen_Total_Count']
            + $data['vulsector']['PWD_Total_Count']
            + $data['vulsector']['4Ps_Beneficiaries_Total_Count']
            + $data['vulsector']['Indigenous_People_Total_Count']
            + $data['vulsector']['NA_Total'];

        $data['cc'] = $this->reportsModel->gen_cc($params);
        $data['sqd'] = $this->reportsModel->gen_sqd($params);

        $this->load->view('reports/generated-result-view', $data);
    }

    public function gen_pdf()
    {
        $params = $this->input->get();

        $data['params'] = $params;
        $data['officename'] = $this->reportsModel->get_office_name($params);

        if ($data['officename'] == NULL) {
            $data['officename']['name'] = 'DOST 10';
        }

        $data['clienttype'] = $this->reportsModel->gen_client_type($params);
        $data['agegroup'] = $this->reportsModel->gen_agegroup($params);
        $data['sex'] = $this->reportsModel->gen_sex($params);
        $data['age_distribution'] = $this->reportsModel->gen_age_distribution($params);
        $data['vulsector'] = $this->reportsModel->gen_vulsector($params);

        $ctype_total_external = $ctype_total_internal = 0;

        foreach ($data['clienttype'] as $ctypeRow) {
            $ctype_total_external += $ctypeRow['external_count'];
            $ctype_total_internal += $ctypeRow['internal_count'];
        }

        $data['ctype_total_external'] = $ctype_total_external;
        $data['ctype_total_internal'] = $ctype_total_internal;

        $data['services_external'] = $this->reportsModel->gen_services_external($params, 1);
        $data['services_internal'] = $this->reportsModel->gen_services($params, 0);

        $data['sex']['total_male'] = $data['sex']['external_male'] + $data['sex']['internal_male'];
        $data['sex']['total_female'] = $data['sex']['external_female'] + $data['sex']['internal_female'];
        $data['sex']['all_total'] = $data['sex']['total_external'] + $data['sex']['total_internal'];

        $data['age_distribution']['total_19_or_lower'] = $data['age_distribution']['external_19_or_lower'] + $data['age_distribution']['internal_19_or_lower'];
        $data['age_distribution']['total_20_34'] = $data['age_distribution']['external_20_34'] + $data['age_distribution']['internal_20_34'];
        $data['age_distribution']['total_35_49'] = $data['age_distribution']['external_35_49'] + $data['age_distribution']['internal_35_49'];
        $data['age_distribution']['total_50_64'] = $data['age_distribution']['external_50_64'] + $data['age_distribution']['internal_50_64'];
        $data['age_distribution']['total_65_or_higher'] = $data['age_distribution']['external_65_or_higher'] + $data['age_distribution']['internal_65_or_higher'];
        $data['age_distribution']['all_total'] = $data['age_distribution']['total_external_count'] + $data['age_distribution']['total_internal_count'];

        $data['vulsector']['external_total'] = 
            $data['vulsector']['Senior_Citizen_External_Count']
            + $data['vulsector']['PWD_External_Count']
            + $data['vulsector']['4Ps_Beneficiaries_External_Count']
            + $data['vulsector']['Indigenous_People_External_Count']
            + $data['vulsector']['NA_External'];

        $data['vulsector']['internal_total'] = 
            $data['vulsector']['Senior_Citizen_Internal_Count']
            + $data['vulsector']['PWD_Internal_Count']
            + $data['vulsector']['4Ps_Beneficiaries_Internal_Count']
            + $data['vulsector']['Indigenous_People_Internal_Count']
            + $data['vulsector']['NA_Internal'];

        $data['vulsector']['overall_total'] = 
            $data['vulsector']['Senior_Citizen_Total_Count']
            + $data['vulsector']['PWD_Total_Count']
            + $data['vulsector']['4Ps_Beneficiaries_Total_Count']
            + $data['vulsector']['Indigenous_People_Total_Count']
            + $data['vulsector']['NA_Total'];

        $data['cc'] = $this->reportsModel->gen_cc($params);
        $data['sqd'] = $this->reportsModel->gen_sqd($params);

        $this->load->view('reports/generated-result-pdf', $data);
    }

    public function service_generate(){
        $param = $this->uri->segment(4);

        $data['quarters'] = $this->reportsModel->get_all_data('tblquarters');
        $data['offices'] = $this->reportsModel->get_all_data('tbloffice');

        $data['content'] = 'reports/generate-service-result';
        $this->load->view('admin/main', $data);
    }
}
