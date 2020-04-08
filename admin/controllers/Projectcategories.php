<?php

/*
 * Copyright (C) 2018 Easy CMS Framework Ahmed Elmahdy
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License
 * @license    https://opensource.org/licenses/GPL-3.0
 *
 * @package    Easy CMS MVC framework
 * @author     Ahmed Elmahdy
 * @link       https://ahmedx.com
 *
 * For more information about the author , see <http://www.ahmedx.com/>.
 */

class ProjectCategories extends ControllerAdmin
{

    private $projectcategoryModel;

    public function __construct()
    {
        $this->projectcategoryModel = $this->model('ProjectCategory');
    }

    /**
     * loading index view with latest projectcategories
     */
    public function index($current = '', $perpage = 50)
    {
        // get projectcategories
        $cond = 'WHERE status <> 2 ';
        $bind = [];

        //check user action if the form has submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //handling Delete
            if (isset($_POST['delete'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->projectcategoryModel->deleteById($_POST['record'], 'category_id')) {
                        flash('projectcategory_msg', 'تم حذف ' . $row_num . ' بنجاح');
                    } else {
                        flash('projectcategory_msg', 'لم يتم الحذف', 'alert alert-danger');
                    }
                }

                redirect('projectcategories');
            }

            //handling Publish
            if (isset($_POST['publish'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->projectcategoryModel->publishById($_POST['record'], 'category_id')) {
                        flash('projectcategory_msg', 'تم نشر ' . $row_num . ' بنجاح');
                    } else {
                        flash('projectcategory_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('projectcategories');
            }

            //handling Unpublish
            if (isset($_POST['unpublish'])) {

                if (isset($_POST['record'])) {
                    if ($row_num = $this->projectcategoryModel->unpublishById($_POST['record'], 'category_id')) {
                        flash('projectcategory_msg', 'تم ايقاف نشر ' . $row_num . ' بنجاح');
                    } else {
                        flash('projectcategory_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('projectcategories');
            }
        }

        //handling search
        $searches = $this->projectcategoryModel->searchHandling(['name', 'description', 'status'], $current);
        $cond .= $searches['cond'];
        $bind = $searches['bind'];

        // get all records count after search and filtration
        $recordsCount = $this->projectcategoryModel->allProjectCategoriesCount($cond, $bind);
        // make sure its integer value and its usable
        $current = (int) $current;
        $perpage = (int) $perpage;

        ($perpage == 0) ? $perpage = 20 : null;
        if ($current <= 0 || $current > ceil($recordsCount->count / $perpage)) {
            $current = 1;
            $limit = 'LIMIT 0 , :perpage ';
            $bindLimit[':perpage'] = $perpage;
        } else {
            $limit = 'LIMIT  ' . (($current - 1) * $perpage) . ', :perpage';
            $bindLimit[':perpage'] = $perpage;
        }
        //get all records for current projectcategory
        $projectcategories = $this->projectcategoryModel->getProjectCategories($cond, $bind, $limit, $bindLimit);

        $data = [
            'current' => $current,
            'perpage' => $perpage,
            'header' => '',
            'title' => 'الأقسام',
            'projectcategories' => $projectcategories,
            'recordsCount' => $recordsCount->count,
            'footer' => '',
        ];
        $this->view('projectcategories/index', $data);
    }

    /**
     * adding new projectcategory
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_title' => 'الأقسام',
                'name' => trim($_POST['name']),
                'alias' => preg_replace("([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])", "-", $_POST['name']),
                'description' => trim($_POST['description']),
                'categories' => $this->projectcategoryModel->getProjectCategories('WHERE status <> 2 ', '', '', '', 'category_id, name, level, parent_id'),
                'parent_id' => explode(',', $_POST['parent_id'])[0],
                'level' =>  explode(',', $_POST['parent_id'])[1],
                'image' => '',
                'meta_keywords' => trim($_POST['meta_keywords']),
                'meta_description' => trim($_POST['meta_description']),
                'status' => '',
                'arrangement' => trim($_POST['arrangement']),
                'back_home' => trim($_POST['back_home']),
                'background_image' => '',
                'background_color' => trim($_POST['background_color']),
                'featured' => trim($_POST['featured']),
                'parent_id_error' => '',
                'status_error' => '',
                'name_error' => '',
                'image_error' => '',
                'background_image_error' => '',
            ];
            // validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'هذا الحقل مطلوب';
            }
            // validate image
            if (!empty($_FILES['image'])) {
                $image = uploadImage('image', ADMINROOT . '/../media/images/', 5000000, true);
                if (empty($image['error'])) {
                    $data['image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['image_error'] = implode(',', $image['error']);
                    }
                }
            }
            // validate background image
            if (!empty($_FILES['background_image'])) {
                $image = uploadImage('background_image', ADMINROOT . '/../media/images/', 5000000, true);
                if (empty($image['error'])) {
                    $data['background_image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['background_image_error'] = implode(',', $image['error']);
                    }
                }
            }
            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
            //             mack sue there is no errors
            if (empty($data['status_error']) && empty($data['image_error']) && empty($data['name_error']) && empty($data['background_image_error'])) {
                //validated
                if ($this->projectcategoryModel->addProjectCategory($data)) {
                    flash('projectcategory_msg', 'تم الحفظ بنجاح');
                    redirect('projectcategories');
                } else {
                    flash('projectcategory_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('projectcategories/add', $data);
            }
        } else {
            $data = [
                'page_title' => 'اقسام المشروعات',
                'name' => '',
                'categories' => $this->projectcategoryModel->getProjectCategories('WHERE status <> 2 ', '', '', '', 'category_id, name, level, parent_id'),
                'parent_id' => '',
                'level' => '',
                'description' => '',
                'image' => '',
                'meta_keywords' => '',
                'meta_description' => '',
                'status' => 0,
                'arrangement' => 0,
                'back_home' => 0,
                'background_image' => '',
                'background_color' => '',
                'featured' => 0,
                'name_error' => '',
                'parent_id_error' => '',
                'status_error' => '',
                'image_error' => '',
                'background_image_error' => '',
            ];
        }

        //loading the add projectcategory view
        $this->view('projectcategories/add', $data);
    }

    /**
     * update projectcategory
     * @param integer $id
     */
    public function edit($id)
    {
        $id = (int) $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'category_id' => $id,
                'page_title' => 'الأقسام',
                'name' => trim($_POST['name']),
                'image' => '',
                'categories' => $this->projectcategoryModel->getProjectCategories('WHERE status <> 2 ', '', '', '', 'category_id, name, level, parent_id'),
                'parent_id' => explode(',', $_POST['parent_id'])[0],
                'level' =>  explode(',', $_POST['parent_id'])[1],
                'description' => trim($_POST['description']),
                'meta_keywords' => trim($_POST['meta_keywords']),
                'meta_description' => trim($_POST['meta_description']),
                'status' => trim($_POST['status']),
                'arrangement' => trim($_POST['arrangement']),
                'back_home' => trim($_POST['back_home']),
                'background_image' => '',
                'background_color' => trim($_POST['background_color']),
                'featured' => trim($_POST['featured']),
                'status_error' => '',
                'name_error' => '',
                'parent_id_error' => '',
                'image_error' => '',
                'background_image_error' => '',

            ];

            // validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'هذا الحقل مطلوب';
            }
            // validate image
            if (!empty($_FILES['image'])) {
                $image = uploadImage('image', ADMINROOT . '/../media/images/', 5000000, true);
                if (empty($image['error'])) {
                    $data['image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['image_error'] = implode(',', $image['error']);
                    }
                }
            }
            // validate background image
            if (!empty($_FILES['background_image'])) {
                $image = uploadImage('background_image', ADMINROOT . '/../media/images/', 5000000, true);
                if (empty($image['error'])) {
                    $data['background_image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['background_image_error'] = implode(',', $image['error']);
                    }
                }
            }
            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
            // mack sue there is no errors
            if (empty($data['status_error']) && empty($data['image_error']) && empty($data['name_error']) && empty($data['background_image_error'])) {
                //validated
                if ($this->projectcategoryModel->updateProjectCategory($data)) {
                    flash('projectcategory_msg', 'تم التعديل بنجاح');
                    isset($_POST['save']) ? redirect('projectcategories/edit/' . $id) : redirect('projectcategories');
                } else {
                    flash('projectcategory_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('projectcategories/edit', $data);
            }
        } else {
            // featch projectcategory
            if (!$projectcategory = $this->projectcategoryModel->getProjectCategoryById($id)) {
                flash('projectcategory_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
                redirect('projectcategories');
            }

            $data = [
                'page_title' => 'الأقسام',
                'category_id' => $id,
                'name' => $projectcategory->name,
                'categories' => $this->projectcategoryModel->getProjectCategories('WHERE status <> 2 ', '', '', '', 'category_id, name, level, parent_id'),
                'parent_id' => $projectcategory->parent_id,
                'level' =>  $projectcategory->level,
                'description' => $projectcategory->description,
                'image' => $projectcategory->image,
                'meta_keywords' => $projectcategory->meta_keywords,
                'meta_description' => $projectcategory->meta_description,
                'status' => $projectcategory->status,
                'arrangement' => $projectcategory->arrangement,
                'back_home' => $projectcategory->back_home,
                'background_image' => $projectcategory->background_image,
                'background_color' => $projectcategory->background_color,
                'featured' => $projectcategory->featured,
                'status_error' => '',
                'parent_id_error' => '',
                'name_error' => '',
                'image_error' => '',
                'background_image_error' => '',
            ];
            $this->view('projectcategories/edit', $data);
        }
    }

    /**
     * showing projectcategory details
     * @param integer $id
     */
    public function show($id)
    {
        if (!$projectcategory = $this->projectcategoryModel->getProjectCategoryById($id)) {
            flash('projectcategory_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
            redirect('projectcategories');
        }
        $data = [
            'page_title' => 'الأقسام',
            'projectcategory' => $projectcategory,
        ];
        $this->view('projectcategories/show', $data);
    }

    /**
     * delete record by id
     * @param integer $id
     */
    public function delete($id)
    {
        if ($row_num = $this->projectcategoryModel->deleteById([$id], 'category_id')) {
            flash('projectcategory_msg', 'تم حذف ' . $row_num . ' بنجاح');
        } else {
            flash('projectcategory_msg', 'لم يتم الحذف', 'alert alert-danger');
        }
        redirect('projectcategories');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function publish($id)
    {
        if ($row_num = $this->projectcategoryModel->publishById([$id], 'category_id')) {
            flash('projectcategory_msg', 'تم نشر ' . $row_num . ' بنجاح');
        } else {
            flash('projectcategory_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('projectcategories');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function unpublish($id)
    {
        if ($row_num = $this->projectcategoryModel->unpublishById([$id], 'category_id')) {
            flash('projectcategory_msg', 'تم ايقاف نشر ' . $row_num . ' بنجاح');
        } else {
            flash('projectcategory_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('projectcategories');
    }
}
