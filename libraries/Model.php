<?php
class Model
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
     * do query that return result
     *
     * @param [string] $query
     * @return object
     */
    public function queryResult($query)
    {
        //setting the query
        $this->db->query($query);
        if ($this->db->excute()) {
            return $this->db->resultSet();
        } else {
            return false;
        }
    }


    /**
     * get record by value @example getby([id=>5])
     *
     * @param  array $bind
     *
     * @return void
     */
    public function getBy($bind)
    {
        return $this->getSingle('*', $bind);
    }

    /**
     * get record with WHERE condation with In
     *
     * @param  array $in values
     * @param  string $colomn
     *
     * @return void
     */
    public function getWhereIn($colomn, $in)
    {
        return $this->getWhereInTable($this->table, $colomn, $in);
    }

    /**
     * get record with WHERE condation with In
     *
     * @param  array $in values
     * @param  string $colomn
     *
     * @return void
     */
    public function getWhereInTable($table, $colomn, $in)
    {

        //get the id in PDO form @Example :id1,id2
        for ($index = 1; $index <= count($in); $index++) {
            $id_num[] = ":in" . $index;
        }
        //setting the query
        $this->db->query('SELECT * FROM  ' . $table . '  WHERE ' . $colomn . ' IN (' . implode(',', $id_num) . ')');
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
     * get data From Table
     *
     * @param  string $table required
     * @param  string $colomns
     * @param  array associative  $bind
     * @param  int $start
     * @param  int $perPage
     * @param  string $orderBy colomn
     * @param  string $order desc/asc
     *
     * @return object
     */
    public function get($colomns, $bind = '', $start = 1, $perPage = '', $table = null, $orderBy = 'create_date', $order = 'DESC')
    {
        $table ?: $table = $this->table;
        //check for pagination
        if (!empty($perPage)) {
            $limit = ' LIMIT :start, :perpage';
        } else {
            $limit = '';
        }
        //prepar condation for binding
        $cond = '';
        if (!empty($bind)) {
            $cond = ' WHERE ';
            foreach ($bind as $key => $value) {
                $cond .= "$key =:$key AND ";
            }
            $cond = rtrim($cond, 'AND ');
        }
        // prepare Query
        $query = 'SELECT ' . $colomns . ' FROM ' . $table . ' ' . $cond . ' ORDER BY ' . $orderBy . ' ' . $order . ' ' . $limit;
        $this->db->query($query);
        //bind values
        if (!empty($bind)) {
            foreach ($bind as $key => $value) {
                $this->db->bind(':' . $key, $value);
            }
        }
        // bind pagination LIMIT values
        if (!empty($perPage)) {
            $this->db->bind(':start', ($start - 1) * $perPage);
            $this->db->bind(':perpage', $perPage);
        }
        return $this->db->resultSet();
    }

    /**
     * get single record
     *
     * @param  string $colomns
     * @param  array $bind
     * @param  string $table
     *
     * @return object
     */
    public function getSingle($colomns, $bind = '', $table = null)
    {
        $table ?: $table = $this->table;
        //prepar condation for binding
        $cond = '';
        if (!empty($bind)) {
            $cond = ' WHERE ';
            foreach ($bind as $key => $value) {
                $cond .= "$key =:$key AND ";
            }
            $cond = rtrim($cond, 'AND ');
        }
        // prepare Query
        $query = 'SELECT ' . $colomns . ' FROM ' . $table . ' ' . $cond . ' ' . ' LIMIT 1 ';
        $this->db->query($query);
        //bind values
        if (!empty($bind)) {
            foreach ($bind as $key => $value) {
                $this->db->bind(':' . $key, $value);
            }
        }
        return $this->db->single();
    }
    /**
     * get From deferant Table same as get
     *
     * @param  string $table required
     * @param  string $colomns
     * @param  array associative  $bind
     * @param  int $start
     * @param  int $perPage
     * @param  string $orderBy colomn
     * @param  string $order desc/asc
     *
     * @return object
     */
    public function getFromTable($table, $colomns = '', $bind = '', $start = 1, $perPage = '', $orderBy = 'create_date', $order = 'DESC')
    {
        return $this->get($colomns, $bind, $start, $perPage, $table, $orderBy, $order);
    }
    /**
     * get count of all records
     * @param string $bind
     * @return array $table
     */
    public function countAll($bind = '', $table = null)
    {
        $table ?? $this->table;
        return $this->getSingle(' count(*) as count ', $bind, $table);
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
     * validate Image and upload
     *
     * @param  string $imageName
     * @return array name or error
     */
    public function validateImage($imageName)
    {
        if ($_FILES[$imageName]['error'] == 0) {
            $image = uploadImage($imageName, URLROOT . '/media/images/', 5000000, true);
            if (empty($image['error'])) {
                return [true, $image['filename']];
            } else {
                if (!isset($image['error']['nofile'])) {
                    return [false, implode(',', $image['error'])];
                }
            }
        }
    }
    /**
     * get the latest id
     * @return int id
     */
    public function lastId()
    {
        return $this->db->lastId();
    }

    /**
     * get all menu links from datatbase
     * @return object links data
     */
    public function getMenu()
    {
        return $this->getFromTable('menus', '*', ['status' => 1], '', '', 'arrangement', 'ASC');
    }

    /**
     * get Settings
     *
     * @param  mixed $type
     * @return void
     */
    public function getSettings($type = null)
    {
        if ($type) {
            return $this->getSingle('*', ['alias' => $type], 'settings');
        } else {
            return $this->getFromTable('settings');
        }
    }
}
