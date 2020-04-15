<?php

class Apis extends Controller
{
    public $meta;
    private $apiModel;
    public $donorModel;
    public function __construct()
    {
        $this->apiModel = $this->model('Api');
        $this->meta = new Meta;
    }

    public function index()
    {
        $data = [
            'contact_settings' => json_decode($this->apiModel->getSettings('contact')->value),
            'site_settings' => json_decode($this->apiModel->getSettings('site')->value),
            'pageTitle' => 'الرئيسية: ' . SITENAME,
        ];
    }

    /**
     * show api by id
     *
     * @param  int $id
     *
     * @return view
     */
    public function show($id = '', $start = 1, $perpage = 9)
    {
        $id = (int) $id;
        empty($id) ? redirect('api', true) : null;
        ($api = $this->apiModel->getApiById($id)) ?: flashRedirect('index', 'msg', ' هذا القسم غير موجود او ربما تم حذفه ');
        $data = [
            'api' => $api,
            'site_settings' => json_decode($this->apiModel->getSettings('site')->value),
            'contact_settings' => json_decode($this->apiModel->getSettings('contact')->value),
            'gift_settings' => json_decode($this->apiModel->getSettings('gift')->value),
            'collected_traget' => $this->apiModel->collectedTraget($id),
            'pagesLinks' => $this->apiModel->getMenu(),
            'moreapi' => $this->apiModel->moreApi($api->category_id),
            'payment_methods' => $this->apiModel->getSupportedPaymentMethods($api->payment_methods),
        ];
        $data['pageTitle'] = $data['api']->name . "  " . SITENAME;

        $this->meta->header_code = $api->header_code;
        $this->meta->keywords = $api->meta_keywords;
        $this->meta->title = $api->name;
        $this->meta->description = $api->meta_description;
        $this->meta->image = MEDIAURL . '/' . $api->secondary_image;
        $this->meta->background = $api->background_color . " url(' " . MEDIAURL . '/' . $api->background_image . "')";
        $this->view('api/show', $data);
    }



}
