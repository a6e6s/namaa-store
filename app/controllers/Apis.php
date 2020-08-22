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
            $auth = $this->apiModel->auth($_POST['api_user'], $_POST['api_key']); // load API settings
            if ($auth['enable']) {
                //validate credential
                if ($auth['authorized']) {
                    isset($_POST['start']) ? $start = (int) $_POST['start'] : $start = 0;
                    isset($_POST['count']) ? $count = (int) $_POST['count'] : $count = 20;
                    isset($_POST['status']) ? $status = ' AND donations.status =' . (int) $_POST['status'] : $status = '';
                    isset($_POST['donation_id']) ? $donation_id = ' AND donations.donation_id =' . (int) $_POST['donation_id'] : $donation_id = '';
                    isset($_POST['project_id']) ? $project_id = ' AND donations.project_id =' . (int) $_POST['project_id'] : $project_id = '';
                    isset($_POST['order_id']) ? $order_id = ' AND donations.order_id =' . (int) $_POST['order_id'] : $order_id = '';
                    isset($_POST['API_status']) ? $API_status = ' AND donations.API_status ="' . $_POST['API_status'] . '"' : $API_status = '';

                    $donations = $this->apiModel->getDonations($start, $count, $status, $donation_id, $project_id, $order_id, $API_status);
                    $data = [
                        'status' => 'success',
                        'code' => 100,
                        'msg' => 'Successfully connected',
                        'count' => count($donations),
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

    /**
     * Order API 
     *
     * @return json
     */
    public function orders()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($_POST['api_key']) && isset($_POST['api_user'])) { // check if credential is sent
            $auth = $this->apiModel->auth($_POST['api_user'], $_POST['api_key']); // load API settings
            if ($auth['enable']) {
                //validate credential
                if ($auth['authorized']) {
                    isset($_POST['start']) ? $start = (int) $_POST['start'] : $start = 0;
                    isset($_POST['count']) ? $count = (int) $_POST['count'] : $count = 20;
                    isset($_POST['status']) ? $status = ' AND ord.status =' . (int) $_POST['status'] : $status = '';
                    isset($_POST['order_identifier']) ? $order_identifier = ' AND ord.order_identifier =' . (int) $_POST['order_identifier'] : $order_identifier = '';
                    isset($_POST['order_id']) ? $order_id = ' AND ord.order_id =' . (int) $_POST['order_id'] : $order_id = '';
                    isset($_POST['custom_status_id']) ? $custom_status_id = ' AND ord.status_id =' . (int) $_POST['custom_status_id'] : $custom_status_id = '';
                    isset($_POST['API_status']) ? $API_status = ' AND ord.API_status ="' . $_POST['API_status'] . '"' : $API_status = '';
                    isset($_POST['payment_method']) ? $payment_method = ' AND ord.payment_method_id =' . (int) $_POST['payment_method'] : $payment_method = '';

                    // load orders
                    $orders = $this->apiModel->getOrders($start, $count, $status, $order_identifier, $order_id, $API_status, $custom_status_id, $payment_method);
                    $newOrders = [];
                    foreach ($orders as $index => $order) {
                        $newOrders[$index] = $order;
                        $newOrders[$index]->meta = json_decode($order->meta);
                        $newOrders[$index]->donations = $this->apiModel->getDonationByOrderId($order->order_id);
                    }
                    $data = [
                        'status' => 'success',
                        'code' => 100,
                        'msg' => 'Successfully connected',
                        'count' => count($orders),
                        'orders' => $newOrders,
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
        // echo str_replace('"||','', str_replace('||"',"\n",json_encode($data)));
        echo json_encode($data);
    }


    public function orderupdate()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($_POST['api_key']) && isset($_POST['api_user'])) { // check if credential is sent
            $auth = $this->apiModel->auth($_POST['api_user'], $_POST['api_key']); // load API settings
            if ($auth['enable']) {
                //validate credential
                if ($auth['authorized']) {
                    $filter = [];
                    isset($_POST['status']) ?           $filter['status'] =  (int) $_POST['status']                       : '';
                    isset($_POST['order_identifier']) ? $filter['order_identifier'] =  (int) $_POST['order_identifier']   : '';
                    isset($_POST['order_id']) ?         $filter['order_id'] =  (int) $_POST['order_id']                   : '';
                    isset($_POST['custom_status_id']) ? $filter['status_id'] =  (int) $_POST['custom_status_id']          : '';
                    isset($_POST['API_status']) ?       $filter['API_status'] =  $_POST['API_status'] . '"'               : '';
                    isset($_POST['payment_method']) ?   $filter['payment_method_id'] = (int) $_POST['payment_method']        : '';
                    $orders = false;
                    if (isset($_POST['set_status'])) {
                        switch ($_POST['set_status']) {
                            case 'read':
                                $orders = $this->apiModel->updatetOrders($filter, 'read');
                                break;
                            case 'unread':
                                $orders = $this->apiModel->updatetOrders($filter, 'unread');
                                break;
                            default:
                                break;
                        }
                    }
                    // update orders
                    if ($orders) {
                        $msg = 'Successfully updated ' . $orders . ' record';
                    } else {
                        $msg = 'Not updated there are an error or ther is nothing to update. please try again later';
                    }
                    $data = [
                        'status' => 'success',
                        'code' => 100,
                        'msg' => $msg,
                        'orders' => $orders,
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
