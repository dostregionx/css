<?php

namespace App\Controllers;

use App\Models\RegistryModel;

class RegistryController extends BaseController
{
    private $registryModel;

    public function __construct()
    {
        $this->registryModel = new RegistryModel();
    }

    public function signatories(){

        $data['offices'] = $this->registryModel->get_offices();
        $data['signatories'] = $this->registryModel->get_signatories_not_approver();
        $data['approver'] = $this->registryModel->get_signatory_approver();

        return view('admin/signatories', $data);
    }

    public function saveSignatory(){
        $data = $this->request->getPost();

        $save = $this->registryModel->insert_data('tblsignatories', $data);

        if ($save) {
            return redirect()->to('/registry/signatories');
        }
    }

    public function updateSignatory()
    {
        $data = $this->request->getPost();

        $signatoryId = $data['id'];
        unset($data['id']);

        $this->registryModel->update_data('tblsignatories', $data, ['signatoryid' => $signatoryId]);

        // Optionally set flashdata for confirmation
        session()->setFlashdata('update', true);

        // Redirect back or to another page
        return redirect()->back();
    }

    public function deleteSignatory($id = null)
    {
        if ($id !== null) {
            $deleted = $this->registryModel->delete_data('tblsignatories', ['signatoryid' => $id]);
            session()->setFlashdata('deleted', true);
            return redirect()->back();
        }

        return redirect()->back()->with('error', 'Invalid ID.');
    }

}



