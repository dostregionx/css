<?php

namespace App\Controllers;

use App\Models\HomeModel;

class HomeController extends BaseController
{
    private $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }

    public function index()
    {
        return redirect()->to('/login');
    }

    public function login()
    {

     

        $session = session();
        if (strtolower($this->request->getMethod()) === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $check = $this->homeModel->get_data('tblusers', ['username' => $username]);
            $quarterid = 0;

            $currentMonth = date('n');
            if ($currentMonth >= 1 && $currentMonth <= 3) {
                $quarterid = 1;
            } elseif ($currentMonth >= 4 && $currentMonth <= 6) {
                $quarterid = 2;
            } elseif ($currentMonth >= 7 && $currentMonth <= 9) {
                $quarterid = 3;
            } else {
                $quarterid = 4;
            }

           

            if (!$check) {
                $session->setFlashdata('invalid', true);
            } else {

                if (password_verify($password, $check['password'])) {
                    $userdata = [
                        'userid'    => $check['userid'],
                        'username'  => $check['username'],
                        'office'    => $check['name'],
                        'officeid'  => $check['officeid'],
                        'logged_in' => true,
                        'usertype'  => $check['usertype']
                    ];
                    $session->set($userdata);


                    if ($check['usertype'] === 'admin') {
                        $path = '/reports/responses?servicetype=all&year=' . date('Y') . '&quarterid=' . $quarterid . '&officeid=all';
                        return redirect()->to(BASE . $path);
                    }
                } else {
                    $session->setFlashdata('invalid', true);
                }
            }
        }
        return view('login');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
