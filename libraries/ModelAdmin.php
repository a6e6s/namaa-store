<?php
class ModelAdmin
{
    protected $db;
    protected $table;
    /**
     * calling database object and setting table name
     */
    public function __construct($table)
    {
        $this->table = $table;
        $this->db = new Database;
    }

    /**
     * Delete one or more records by id
     * @param Array $ids
     * @param string colomn id
     * @return boolean or row count
     */
    public function deleteById($ids, $where)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($ids); $index++) {
            $id_num[] = ":id" . $index;
        }
        //setting the query
        $this->db->query('UPDATE ' . $this->table . ' SET status = 2 WHERE ' . $where . ' IN (' . implode(',', $id_num) . ')');
        //loop through the bind function to bind all the IDs
        foreach ($ids as $key => $id) {
            $this->db->bind(':id' . ($key + 1), $id);
        }
        if ($this->db->excute()) {
            return $this->db->rowCount();
        } else {
            return false;
        }
    }

    /**
     * publish one or more records by id
     * @param Array $ids
     * @param string colomn id
     * @return boolean or row count
     */
    public function publishById($ids, $where)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($ids); $index++) {
            $id_num[] = ":id" . $index;
        }
        //setting the query
        $this->db->query('UPDATE ' . $this->table . ' SET status = 1 WHERE ' . $where . ' IN (' . implode(',', $id_num) . ')');
        //loop through the bind function to bind all the IDs
        foreach ($ids as $key => $id) {
            $this->db->bind(':id' . ($key + 1), $id);
        }
        if ($this->db->excute()) {
            return $this->db->rowCount();
        } else {
            return false;
        }
    }

    /**
     * unpublish one or more records by id
     * @param Array $ids
     * @param string colomn id
     * @return boolean or row count
     */
    public function unpublishById($ids, $where)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($ids); $index++) {
            $id_num[] = ":id" . $index;
        }
        //setting the query
        $this->db->query('UPDATE ' . $this->table . ' SET status = 0 WHERE ' . $where . ' IN (' . implode(',', $id_num) . ')');
        //loop through the bind function to bind all the IDs
        foreach ($ids as $key => $id) {
            $this->db->bind(':id' . ($key + 1), $id);
        }
        if ($this->db->excute()) {
            return $this->db->rowCount();
        } else {
            return false;
        }
    }

    /**
     * featured one or more records by id
     * @param Array $ids
     * @param string colomn id
     * @return boolean or row count
     */
    public function featuredById($ids, $where)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($ids); $index++) {
            $id_num[] = ":id" . $index;
        }
        //setting the query
        $this->db->query('UPDATE ' . $this->table . ' SET featured = 1 WHERE ' . $where . ' IN (' . implode(',', $id_num) . ')');
        //loop through the bind function to bind all the IDs
        foreach ($ids as $key => $id) {
            $this->db->bind(':id' . ($key + 1), $id);
        }
        if ($this->db->excute()) {
            return $this->db->rowCount();
        } else {
            return false;
        }
    }

    /**
     * unfeatured one or more records by id
     * @param Array $ids
     * @param string colomn id
     * @return boolean or row count
     */
    public function unfeaturedById($ids, $where)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($ids); $index++) {
            $id_num[] = ":id" . $index;
        }
        //setting the query
        $this->db->query('UPDATE ' . $this->table . ' SET featured = 0 WHERE ' . $where . ' IN (' . implode(',', $id_num) . ')');
        //loop through the bind function to bind all the IDs
        foreach ($ids as $key => $id) {
            $this->db->bind(':id' . ($key + 1), $id);
        }
        if ($this->db->excute()) {
            return $this->db->rowCount();
        } else {
            return false;
        }
    }

    /**
     * get By Id
     *
     * @param  string $id
     * @param  string $where
     *
     * @return Object
     */
    public function getById($id, $where)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $where . '= :' . $where);
        $this->db->bind(':' . $where, $id);
        $row = $this->db->single();
        return $row;
    }

    /**
     * get WHERE In
     *
     * @param  array $in values
     * @param  string $colomn
     *
     * @return void
     */
    public function getWhereIn($colomn, $in)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($in); $index++) {
            $id_num[] = ":in" . $index;
        }
        //setting the query
        $this->db->query('SELECT * FROM  ' . $this->table . '  WHERE ' . $colomn . ' IN (' . implode(',', $id_num) . ')');
        //loop through the bind function to bind all the IDs
        foreach ($in as $key => $value) {
            $this->db->bind(':in' . ($key + 1), $value);
        }
        if ($this->db->excute()) {
            return $this->db->resultSet();
        } else {
            return false;
        }
    }

    /**
     * Set multiable value 
     *
     * @param [string] $target
     * @param [string] $value
     * @param [string] $colomn
     * @param [array] $in
     * @return void
     */
    public function setWhereIn($target, $value, $colomn, $in)
    {
        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($in); $index++) {
            $id_num[] = ":in" . $index;
        }
        //setting the query
        $this->db->query('UPDATE ' . $this->table . ' SET ' . $target . ' = :target WHERE ' . $colomn . ' IN (' . implode(',', $id_num) . ')');
        //loop through the bind function to bind all the IDs
        $this->db->bind(':target', $value);
        foreach ($in as $key => $val) {
            $this->db->bind(':in' . ($key + 1), $val);
        }
        if ($this->db->excute()) {
            return $this->db->rowCount();
        } else {
            return false;
        }
    }
    /**
     * searchHandling
     *
     * @param  array $searchColomns ['name','status']
     * @return array $cond $bind
     */
    public function searchHandling($searchColomns, $current = '')
    {
        // if user make a search
        if (isset($_POST['search'])) {
            // return to first
            $current = 1;
            return $this->handlingSearchCondition($searchColomns);
        } else {
            // if user didn't search
            // look for pagenation if not clear seassion
            if (empty($current)) {
                unset($_SESSION['search']);
                // if there is pagenation and value stored into session get it and prepare Condition and bind
            } else {
                return $this->handlingSearchSessionCondition($searchColomns);
            }
        }
        return ['cond' => '', 'bind' => ''];
    }

    /**
     * handling Search Condition, creating bind array and handling search session
     *
     * @param  array $searches
     * @return array of condation and bind array
     */
    public function handlingSearchCondition($searches)
    {
        //reset search session
        unset($_SESSION['search']);
        $cond = '';
        $bind = [];
        if (!empty($searches)) {
            foreach ($searches as $keyword) {
                $cond .= ' AND ' . $this->table . '.' . $keyword . ' LIKE :' . $keyword . ' ';
                $bind[':' . $keyword] = $_POST['search'][$keyword];
                $_SESSION['search'][$keyword] = $_POST['search'][$keyword];
            }
        }
        return $data = ['cond' => $cond, 'bind' => $bind];
    }

    /**
     * handling Search Condition on the stored session, creating bind array and handling search session
     *
     * @param  array $searches
     * @return array of condation and bind array
     */
    public function handlingSearchSessionCondition($searches)
    {
        $cond = '';
        $bind = [];
        foreach ($searches as $keyword) {
            if (isset($_SESSION['search'][$keyword])) {
                $cond .= ' AND ' . $this->table . '.' . $keyword . ' LIKE :' . $keyword;
                $bind[':' . $keyword] = $_SESSION['search'][$keyword];
            }
        }
        return $data = ['cond' => $cond, 'bind' => $bind];
    }
    /**
     * getAll data from database
     *
     * @param  string $cond
     * @param  array $bind
     * @param  string $limit
     * @param  array $bindLimit
     *
     * @return Object
     */
    public function getAll($query, $bind = '', $limit = '', $bindLimit = '')
    {
        $this->db->query($query . $limit);
        if (!empty($bind)) {
            foreach ($bind as $key => $value) {
                $this->db->bind($key, '%' . $value . '%');
            }
        }
        if (!empty($bindLimit)) {
            foreach ($bindLimit as $key => $value) {
                $this->db->bind($key, $value);
            }
        }
        return $this->db->resultSet();
    }

    /**
     * get count of all records
     * @param string $cond
     * @return array $bind
     */
    public function countAll($cond = '', $bind = '', $table = NULL)
    {
        if (!$table) $table = $this->table;
        $this->db->query('SELECT count(*) as count FROM ' . $table . ' ' . $cond);
        if (!empty($bind)) {
            foreach ($bind as $key => $value) {
                $this->db->bind($key, '%' . $value . '%');
            }
        }
        $this->db->excute();
        return $this->db->single();
    }

    /**
     * clear HTML string with html purifier
     * @param type $stringHTML
     * @return string HTML
     */
    public function cleanHTML($stringHTML)
    {
        if (!empty($stringHTML)) {
            require_once '../helpers/htmlpurifier/HTMLPurifier.auto.php';
            $config = HTMLPurifier_Config::createDefault();
            $config->set('HTML.SafeIframe', true);
            $config->set('URI.SafeIframeRegexp', '%^(https?:)?(\/\/www\.youtube(?:-nocookie)?\.com\/embed\/|\/\/player\.vimeo\.com\/)%');
            $purifier = new HTMLPurifier($config);
            return $purifier->purify($stringHTML);
        } else {
            return null;
        }
    }
    /**
     * validateImage
     *
     * @param  string $imageName
     * @return array name or error
     */
    public function validateImage($imageName, $pass =  ADMINROOT . '/../media/images/')
    {
        $uploadErrors = array(
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        );
        if ($_FILES[$imageName]['error'] == 0) {
            $image = uploadImage($imageName, $pass, 5000000, true);
            if (empty($image['error'])) {
                return [true, $image['filename']];
            } else {
                if (!isset($image['error']['nofile'])) {
                    return [false, implode(',', $image['error'])];
                }
            }
        } else {
            return [true, $uploadErrors[$_FILES[$imageName]['error']]];
        }
    }
    /**
     * loading setting
     *
     * @param [string] $settingType
     * @return object
     */
    public function getSettings($settingType = null)
    {
        if ($settingType) {
            return $this->getAll('SELECT * FROM settings WHERE settings.alias = "' . $settingType . '"')[0];
        } else {
            return $this->getAll('SELECT * FROM settings');
        }
    }

    /**
     * sending Html Email
     *
     * @param [string] $to
     * @param [string] $subject
     * @param [string] $msg
     * @return void
     */
    public function Email($to, $subject, $msg)
    {
        $emailSettings = $this->getSettings('email'); // load email setting 
        $email = json_decode($emailSettings->value);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $email->sending_name . '<' . $email->sending_email . '>' . "\r\n";
        $headers .= 'Cc: ' . $email->sending_email . '' . "\r\n";
        return mail($to, $subject, $msg, $headers); // sending Email
    }

    /**
     * Sending SMS message
     *
     * @param [string] $to
     * @param [string] $msg
     * @return void
     */
    public function SMS($to, $msg)
    {
        $smsSettings = $this->getSettings('sms'); // load sms setting 
        $sms = json_decode($smsSettings->value);
        if (!$sms->smsenabled) {
            flash('order_msg', 'هناك خطأ ما بوابة الارسال غير مفعلة', 'alert alert-danger');
            redirect('orders');
        }
        return sendSMS($sms->sms_username, $sms->sms_password, $msg, $to, $sms->sender_name, $sms->gateurl);
    }
}
