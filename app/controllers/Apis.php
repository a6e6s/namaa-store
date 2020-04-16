<?php

class Apis extends Controller
{
    private $apiModel;
    public $donorModel;
    public function __construct()
    {
        $this->apiModel = $this->model('Api');
    }

    public function index()
    {
        $data = [
            'status' => 'error',
            'code' => 000,
            'msg' => 'bad request',
        ];
        echo json_encode($data);
    }
    /**
     * donation API 
     *
     * @return json
     */
    public function donations()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($_POST['api_key']) && isset($_POST['api_user'])) { // check if credential is sent
            $api_settings = json_decode($this->apiModel->getSettings('api')->value); // load API settings
            if ($api_settings->api_enable) {
                //validate credential
                if ($api_settings->api_key == $_POST['api_key'] && $api_settings->api_user == $_POST['api_user']) {
                    isset($_POST['start']) ? $start = (int) $_POST['start'] : $start = 0;
                    isset($_POST['count']) ? $count = (int) $_POST['count'] : $count = 100;
                    $donations = $this->apiModel->getDonations($start, $count);
                    $data = [
                        'status' => 'success',
                        'code' => 100,
                        'msg' => 'Successfully connected',
                        'donations' => $donations,
                    ];
                } else { // wrong user or key
                    $data = [
                        'status' => 'error',
                        'code' => 102,
                        'msg' => 'Wrong Credential check user and API key',
                    ];
                }
            } else { // API not enabled
                $data = [
                    'status' => 'error',
                    'code' => 103,
                    'msg' => 'API not enabled',
                ];
            }
        } else { // no credential
            $data = [
                'status' => 'error',
                'code' => 101,
                'msg' => 'Invalid Credential',
            ];
        }
        echo json_encode($data);
    }
}
