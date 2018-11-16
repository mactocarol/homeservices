<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Form validation extended rules for CodeIgniter
 *
 * A list of useful rules for your form validating process.
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Joseba Juaniz <patroklo@gmail.com>
 * @author			Jeroen van Meerendonk <hola@jeroen.bz>
 * @author			devbro <devbro@devbro.com> (until v2.1)
 * @license			GNU General Public License (GPL)
 * @link			https://github.com/jeroen/codeigniter-extended-rules
 * @version 		3.0
 * 
 * 
 * Rules supported
 * ---------------------------------------------------------------------------------------------
 * file_required Checks if the a required file is uploaded.
 * file_size_max[size]			Returns FALSE if the file is bigger than the given size.
 * file_size_min[size]			Returns FALSE if the file is smaller than the given size.
 * file_allowed_type[type]		Tests the file extension for valid file types. You can put a group too (image,
 *								application, word_document, code, zip).
 * file_disallowed_type[type]	Tests the file extension for no-valid file types
 * file_image_maxdim[x,y]		Returns FALSE if the image is smaller than given dimension.
 * file_image_mindim[x,y]		Returns FALSE if the image is bigger than given dimension.
 * file_image_exactdim[x,y]		Returns FALSE if the image is not the given dimension.
 * is_exactly[list]				Check if the field's value is in the list (separated by comas).
 * is_not[list]					Check if the field's value is not permitted (separated by comas).
 * valid_hour[hour]				Check if the field's value is a valid 24 hour. [24H or 12H]
 * valid_date[format]				Check if the field's value has a valid date format.
 * valid_range_date[format]			Check if the field's value has a valid range of two date
 * 
 * 
 * Info
 * ---------------------------------------------------------------------------------------------
 * Size can be in format of 20KB (kilo Byte) or 20Kb(kilo bit) or 20MB or 20GB or ....
 * Size with no unit is assume as KB
 * Type is evaluated based on the file extention. 
 * Type can be given as several types seperated by comma
 * Type can be one of the groups of: image, application, php_code, word_document, compressed
 * 
 * 
 * Change Log
 * ---------------------------------------------------------------------------------------------
 * 4.1:
 *  Now the error field message shows all the error messages that it has and not only the first one.
 * 4.0:
 *  Where there is a file upload, now file_required and required force the user to upload a file.
 *  Added image icon mimes.
 *  Added valid_date method that checks if a field has a valid date format.
 *  Added valid_range_date method that checks if a field has a valid range of two dates.
 * 3.2:
 *  Bug fixes
 * 3.1:
 *  Added 'valid_hour'
 * 3.0:
 * 	Working with CI 2.1.
 * 	Separated the error messages from the library
 * 	Added 'is_exactly' and 'is_not'
 * 2.1:
 * 	fixed the issue: http://codeigniter.com/forums/viewthread/123816/P30/#629711
 * 
 */
class VW_Form_validation extends CI_Form_validation {

    private $mime_types;

    public function __construct() {
        parent::__construct();
    }

    function run($group = '') {
        $rc = FALSE;
        log_message('DEBUG', 'called MY_form_validation:run()');
        if (count($_POST) === 0 AND count($_FILES) > 0) {//does it have a file only form?
            //add a dummy $_POST
            $_POST['DUMMY_ITEM'] = '';
            $rc = parent::run($group);
            unset($_POST['DUMMY_ITEM']);
        } else {
            //we are safe just run as is
            $rc = parent::run($group);
        }

        return $rc;
    }

    function file_upload_error_message($field, $error_code) {
        switch ($error_code) {
            case UPLOAD_ERR_INI_SIZE:
                return $this->CI->lang->line('error_max_filesize_phpini');
            case UPLOAD_ERR_FORM_SIZE:
                return $this->CI->lang->line('error_max_filesize_form');
            case UPLOAD_ERR_PARTIAL:
                return $this->CI->lang->line('error_partial_upload');
            case UPLOAD_ERR_NO_FILE:
                $line = $this->CI->lang->line('file_required');
                return sprintf($line, $this->_translate_fieldname($field));
            case UPLOAD_ERR_NO_TMP_DIR:
                return $this->CI->lang->line('error_temp_dir');
            case UPLOAD_ERR_CANT_WRITE:
                return $this->CI->lang->line('error_disk_write');
            case UPLOAD_ERR_EXTENSION:
                return $this->CI->lang->line('error_stopped');
            default:
                return $this->CI->lang->line('error_unexpected') . $error_code;
        }
    }

    function _execute($row, $rules, $postdata = NULL, $cycles = 0) {

        log_message('DEBUG', 'called MY_form_validation::_execute ' . $row['field']);
        //changed based on
        //http://codeigniter.com/forums/viewthread/123816/P10/#619868
        if (isset($_FILES[$row['field']])) {// it is a file so process as a file
            log_message('DEBUG', 'processing as a file');
            $postdata = $_FILES[$row['field']];

            //required bug
            //if some stupid like me never remember that it's file_required and not required
            //this will save a lot of var_dumping time.
            if (in_array('required', $rules)) {
                $rules[array_search('required', $rules)] = 'file_required';
            }
            //before doing anything check for errors
            if ($postdata['error'] !== UPLOAD_ERR_OK) {
                //If the error it's 4 (ERR_NO_FILE) and the file required it's deactivated don't call an error
                if ($postdata['error'] != UPLOAD_ERR_NO_FILE) {
                    $this->_error_array[$row['field']] = $this->file_upload_error_message($row['label'], $postdata['error']);
                    return FALSE;
                } elseif ($postdata['error'] == UPLOAD_ERR_NO_FILE and in_array('file_required', $rules)) {
                    $this->_error_array[$row['field']] = $this->file_upload_error_message($row['label'], $postdata['error']);
                    return FALSE;
                }
            }

            $_in_array = FALSE;

            // If the field is blank, but NOT required, no further tests are necessary
            $callback = FALSE;
            if (!in_array('file_required', $rules) AND $postdata['size'] == 0) {
                // Before we bail out, does the rule contain a callback?
                if (preg_match("/(callback_\w+)/", implode(' ', $rules), $match)) {
                    $callback = TRUE;
                    $rules = (array('1' => $match[1]));
                } else {
                    return;
                }
            }

            foreach ($rules as $rule) {
                /// COPIED FROM the original class
                // Is the rule a callback?			
                $callback = FALSE;
                if (substr($rule, 0, 9) == 'callback_') {
                    $rule = substr($rule, 9);
                    $callback = TRUE;
                }

                // Strip the parameter (if exists) from the rule
                // Rules can contain a parameter: max_length[5]
                $param = FALSE;
                if (preg_match("/(.*?)\[(.*?)\]/", $rule, $match)) {
                    $rule = $match[1];
                    $param = $match[2];
                }

                // Call the function that corresponds to the rule
                if ($callback === TRUE) {
                    if (!method_exists($this->CI, $rule)) {
                        continue;
                    }

                    // Run the function and grab the result
                    $result = $this->CI->$rule($postdata, $param);

                    // Re-assign the result to the master data array
                    if ($_in_array == TRUE) {
                        $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                    } else {
                        $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                    }

                    // If the field isn't required and we just processed a callback we'll move on...
                    if (!in_array('file_required', $rules, TRUE) AND $result !== FALSE) {
                        return;
                    }
                } else {
                    if (!method_exists($this, $rule)) {
                        // If our own wrapper function doesn't exist we see if a native PHP function does. 
                        // Users can use any native PHP function call that has one param.
                        if (function_exists($rule)) {
                            $result = $rule($postdata);

                            if ($_in_array == TRUE) {
                                $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                            } else {
                                $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                            }
                        }

                        continue;
                    }

                    $result = $this->$rule($postdata, $param);

                    if ($_in_array == TRUE) {
                        $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                    } else {
                        $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                    }
                }

                //this line needs testing !!!!!!!!!!!!! not sure if it will work
                //it basically puts back the tested values back into $_FILES
                //$_FILES[$row['field']] = $this->_field_data[$row['field']]['postdata'];
                // Did the rule test negatively?  If so, grab the error.
                if ($result === FALSE) {
                    if (!isset($this->_error_messages[$rule])) {
                        if (FALSE === ($line = $this->CI->lang->line($rule))) {
                            $line = 'Unable to access an error message corresponding to your field name.';
                        }
                    } else {
                        $line = $this->_error_messages[$rule];
                    }

                    // Is the parameter we are inserting into the error message the name
                    // of another field?  If so we need to grab its "field label"
                    if (isset($this->_field_data[$param]) && isset($this->_field_data[$param]['label'])) {
                        $param = $this->_field_data[$param]['label'];
                    }

                    // Build the error message
                    $message = sprintf($line, $this->_translate_fieldname($row['label']), $param);

                    // Save the error message
                    $this->_field_data[$row['field']]['error'] = $message;

                    $this->_error_array[$row['field']][] = $message;


                    return;
                }
            }
        } else {
            log_message('DEBUG', 'Called parent _execute');
            parent::_execute($row, $rules, $postdata, $cycles);
        }
    }

    /**
     * Future function. To return error message of choice.
     * It will use $msg if it cannot find one in the lang files
     * 
     * @param string $msg the error message
     */
    function set_error($msg) {
        $CI = & get_instance();
        $CI->lang->load('upload');
        return ($CI->lang->line($msg) == FALSE) ? $msg : $CI->lang->line($msg);
    }

    // --------------------------------------------------------------------

    /**
     * Checks if the a required file is uploaded
     *
     * @access	public
     * @param	mixed $file
     * @return	bool
     */
    function file_required($file) {
        if ($file['size'] === 0) {
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Returns FALSE if the file is bigger than the given size
     *
     * @access	public
     * @param	mixed $file
     * @param	string
     * @return	bool
     */
    function file_size_max($file, $max_size) {
        $max_size_bit = $this->let_to_bit($max_size);
        if ($file['size'] > $max_size_bit) {
            return FALSE;
        }
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Returns FALSE if the file is smaller than the given size
     *
     * @access	public
     * @param	mixed $file
     * @param	string
     * @return	bool
     */
    function file_size_min($file, $min_size) {
        $min_size_bit = $this->let_to_bit($min_size);
        if ($file['size'] < $min_size_bit) {
            return FALSE;
        }
        return TRUE;
    }

    // ----------------------

    function load_mimes() {
        // Get mime types for later
        if (defined('ENVIRONMENT') AND file_exists(APPPATH . 'config/' . ENVIRONMENT . '/mimes.php')) {
            include APPPATH . 'config/' . ENVIRONMENT . '/mimes.php';
        } else {
            include APPPATH . 'config/mimes.php';
        }

        $this->mime_types = $mimes;
    }

    // --------------------------------------------------------------------

    /**
     * Tests the file extension for valid file types
     *
     * @access	public
     * @param	mixed $file
     * @param	mixed
     * @return	bool
     */
    function file_allowed_type($file, $type) {

        //is type of format a,b,c,d? -> convert to array
        $exts = explode(',', $type);

        //is $type array? run self recursively
        if (count($exts) > 1) {
            foreach ($exts as $v) {
                $rc = $this->file_allowed_type($file, $v);
                if ($rc === TRUE) {
                    return TRUE;
                }
            }
        }

        //is type a group type? image, application, word_document, code, zip .... -> load proper array
        $ext_groups = array();
        $ext_groups['image'] = array('jpg', 'jpeg', 'gif', 'png');
        $ext_groups['image_icon'] = array('jpg', 'jpeg', 'gif', 'png', 'ico', 'image/x-icon');
        $ext_groups['application'] = array('exe', 'dll', 'so', 'cgi');
        $ext_groups['php_code'] = array('php', 'php4', 'php5', 'inc', 'phtml');
        $ext_groups['word_document'] = array('rtf', 'doc', 'docx');
        $ext_groups['compressed'] = array('zip', 'gzip', 'tar', 'gz');
        $ext_groups['document'] = array('txt', 'text', 'doc', 'docx', 'dot', 'dotx', 'word', 'rtf', 'rtx');

        //if there is a group type in the $type var and not a ext alone, we get it
        if (array_key_exists($exts[0], $ext_groups)) {
            $exts = $ext_groups[$exts[0]];
        }

        $this->load_mimes();


        $exts_types = array_flip($exts);
        $intersection = array_intersect_key($this->mime_types, $exts_types);

        //if we can use the finfo function to check the mime AND the mime
        //exists in the mime file of codeigniter...
        if (function_exists('finfo_open') and ! empty($intersection)) {
            $exts = array();

            foreach ($intersection as $in) {
                if (is_array($in)) {
                    $exts = array_merge($exts, $in);
                } else {
                    $exts[] = $in;
                }
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $file['tmp_name']);
        } else {
            //get file ext
            $file_type = strtolower(strrchr($file['name'], '.'));
            $file_type = substr($file_type, 1);
        }

        if (!in_array($file_type, $exts)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Tests the file extension for no-valid file types
     *
     * @access	public
     * @param	mixed $file
     * @param	mixed
     * @return	bool
     */
    function file_disallowed_type($file, $type) {
        if ($this->file_allowed_type($file, $type) == FALSE) {
            return TRUE;
        }

        return FALSE;
    }

    // --------------------------------------------------------------------

    /**
     * Given an string in format of ###AA converts to number of bits it is assignin
     *
     * @access	public
     * @param	string
     * @return	integer number of bits
     */
    function let_to_bit($sValue) {
        // Split value from name
        if (!preg_match('/([0-9]+)([ptgmkb]{1,2}|)/ui', $sValue, $aMatches)) { // Invalid input
            return FALSE;
        }

        if (empty($aMatches[2])) { // No name -> Enter default value
            $aMatches[2] = 'KB';
        }

        if (strlen($aMatches[2]) == 1) { // Shorted name -> full name
            $aMatches[2] .= 'B';
        }

        $iBit = (substr($aMatches[2], -1) == 'B') ? 1024 : 1000;
        // Calculate bits:

        switch (strtoupper(substr($aMatches[2], 0, 1))) {
            case 'P':
                $aMatches[1] *= $iBit;
            case 'T':
                $aMatches[1] *= $iBit;
            case 'G':
                $aMatches[1] *= $iBit;
            case 'M':
                $aMatches[1] *= $iBit;
            case 'K':
                $aMatches[1] *= $iBit;
                break;
        }

        // Return the value in bits
        return $aMatches[1];
    }

    // --------------------------------------------------------------------

    /**
     * Returns FALSE if the image is bigger than given dimension
     *
     * @access	public
     * @param	string
     * @param	array
     * @return	bool
     */
    function file_image_maxdim($file, $dim) {
        log_message('debug', 'MY_form_validation: file_image_maxdim ' . $dim);
        $dim = explode(',', $dim);

        if (count($dim) !== 2) {
            // Bad size given
            log_message('error', 'MY_Form_validation: invalid rule, expected similar to 150,300.');
            return FALSE;
        }

        log_message('debug', 'MY_form_validation: file_image_maxdim ' . $dim[0] . ' ' . $dim[1]);

        //get image size
        $d = $this->get_image_dimension($file['tmp_name']);

        log_message('debug', $d[0] . ' ' . $d[1]);

        if (!$d) {
            log_message('error', 'MY_Form_validation: dimensions not detected.');
            return FALSE;
        }

        if ($d[0] <= $dim[0] && $d[1] <= $dim[1]) {
            return TRUE;
        }

        return FALSE;
    }

    // --------------------------------------------------------------------

    /**
     * Returns FALSE if the image is smaller than given dimension
     *
     * @access	public
     * @param	mixed
     * @param	array
     * @return	bool
     */
    function file_image_mindim($file, $dim) {
        $dim = explode(',', $dim);

        if (count($dim) !== 2) {
            // Bad size given
            log_message('error', 'MY_Form_validation: invalid rule, expected similar to 150,300.');
            return FALSE;
        }

        //get image size
        $d = $this->get_image_dimension($file['tmp_name']);

        if (!$d) {
            log_message('error', 'MY_Form_validation: dimensions not detected.');
            return FALSE;
        }

        log_message('debug', $d[0] . ' ' . $d[1]);

        if ($d[0] >= $dim[0] && $d[1] >= $dim[1]) {
            return TRUE;
        }

        return FALSE;
    }

    // --------------------------------------------------------------------

    /**
     * Returns FALSE if the image is not the given dimension
     *
     * @access	public
     * @param	mixed
     * @param	array
     * @return	bool
     */
    function file_image_exactdim($file, $dim) {
        $dim = explode(',', $dim);

        if (count($dim) !== 2) {
            // Bad size given
            log_message('error', 'MY_Form_validation: invalid rule, expected similar to 150,300.');
            return FALSE;
        }

        //get image size
        $d = $this->get_image_dimension($file['tmp_name']);

        if (!$d) {
            log_message('error', 'MY_Form_validation: dimensions not detected.');
            return FALSE;
        }

        log_message('debug', $d[0] . ' ' . $d[1]);

        if ($d[0] == $dim[0] && $d[1] == $dim[1]) {
            return TRUE;
        }

        return FALSE;
    }

    // --------------------------------------------------------------------

    /**
     * Attempts to determine the image dimension
     *
     * @access	public
     * @param	mixed
     * @return	array
     */
    function get_image_dimension($file_name) {
        log_message('debug', $file_name);
        if (function_exists('getimagesize')) {
            $D = @getimagesize($file_name);

            return $D;
        }

        return FALSE;
    }

    // --------------------------------------------------------------------

    /**
     * Check if the field's value is in the list
     *
     * @access	public
     * @param	string
     * @param	string
     * @return	bool
     */
    function is_exactly($str, $list) {
        $list = str_replace(', ', ',', $list); // Just taking some precautions
        $list = explode(',', $list);

        if (!in_array(trim($str), $list)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Check if the field's value is not permitted
     *
     * @access	public
     * @param	string
     * @param	string
     * @return	bool
     */
    function is_not($str, $list) {
        $list = str_replace(', ', ',', $list); // Just taking some precautions
        $list = explode(',', $list);

        if (in_array(trim($str), $list)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Error String
     *
     * Returns the error messages as a string, wrapped in the error delimiters
     *
     * @param   string
     * @param   string
     * @return  string
     */
    public function error_string($prefix = '', $suffix = '') {
        // No errors, validation passes!
        if (count($this->_error_array) === 0) {
            return '';
        }

        if ($prefix === '') {
            $prefix = $this->_error_prefix;
        }

        if ($suffix === '') {
            $suffix = $this->_error_suffix;
        }

        // Generate the error string
        $str = '';
        foreach ($this->_error_array as $val) {
            if ($val !== '') {
                //if field has more than one error, then all will be listed
                if (is_array($val)) {
                    foreach ($val as $v) {
                        $str .= $prefix . $v . $suffix . "\n";
                    }
                } else {
                    $str .= $prefix . $val . $suffix . "\n";
                }
            }
        }

        return $str;
    }

    public function wysiwyg_strip_tags($str) {
        return strip_tags($str, '<strong><b><p><ul><ol><li><a><span>');
    }

    // --------------------------------------------------------------------

    /**
     * Check if the field's value is a valid 24 hour
     *
     * @access	public
     * @param	string
     * @return	bool
     */
    function valid_hour($hour, $type) {
        if (substr_count($hour, ':') >= 2) {
            $has_seconds = TRUE;
        } else {
            $has_seconds = FALSE;
        }

        $pattern = "/^" . (($type == '24H') ? "([1-2][0-3]|[01]?[1-9])" : "(1[0-2]|0?[1-9])") . ":([0-5]?[0-9])" . (($has_seconds) ? ":([0-5]?[0-9])" : "") . (($type == '24H') ? '' : '( AM| PM| am| pm)') . "$/";

        if (preg_match($pattern, $hour)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // Function that simulates a date_parse_from_format for PHP versions 5.2 or lower.
    // snippet of code thanks to http://stackoverflow.com/questions/6668223/php-date-parse-from-format-alternative-in-php-5-2
    // thanks to Jeremy: http://stackoverflow.com/users/1955094/jeremy
    // thanks to Rudie: http://stackoverflow.com/users/247372/rudie

    private function _date_parse_from_format($format, $date) {
        // reverse engineer date formats
        $keys = array(
            'Y' => array('year', '\d{4}'),
            'y' => array('year', '\d{2}'),
            'm' => array('month', '\d{2}'),
            'n' => array('month', '\d{1,2}'),
            'M' => array('month', '[A-Z][a-z]{3}'),
            'F' => array('month', '[A-Z][a-z]{2,8}'),
            'd' => array('day', '\d{2}'),
            'j' => array('day', '\d{1,2}'),
            'D' => array('day', '[A-Z][a-z]{2}'),
            'l' => array('day', '[A-Z][a-z]{6,9}'),
            'u' => array('hour', '\d{1,6}'),
            'h' => array('hour', '\d{2}'),
            'H' => array('hour', '\d{2}'),
            'g' => array('hour', '\d{1,2}'),
            'G' => array('hour', '\d{1,2}'),
            'i' => array('minute', '\d{2}'),
            's' => array('second', '\d{2}')
        );

        // convert format string to regex
        $regex = '';
        $chars = str_split($format);
        foreach ($chars AS $n => $char) {
            $lastChar = isset($chars[$n - 1]) ? $chars[$n - 1] : '';
            $skipCurrent = '\\' == $lastChar;
            if (!$skipCurrent && isset($keys[$char])) {
                $regex .= '(?P<' . $keys[$char][0] . '>' . $keys[$char][1] . ')';
            } else if ('\\' == $char) {
                $regex .= $char;
            } else {
                $regex .= preg_quote($char);
            }
        }

        $dt = array();

        // now try to match it
        if (preg_match('#^' . $regex . '$#', $date, $dt)) {
            foreach ($dt AS $k => $v) {
                if (is_int($k)) {
                    unset($dt[$k]);
                }
            }
            if (!checkdate($dt['month'], $dt['day'], $dt['year'])) {
                $dt['error_count'] = 1;
            } else {
                $dt['error_count'] = 0;
            }
        } else {
            $dt['error_count'] = 1;
        }

        $dt['errors'] = array();
        $dt['fraction'] = '';
        $dt['warning_count'] = 0;
        $dt['warnings'] = array();
        $dt['is_localtime'] = 0;
        $dt['zone_type'] = 0;
        $dt['zone'] = 0;
        $dt['is_dst'] = '';

        return $dt;
    }

    // --------------------------------------------------------------------

    /**
     * Check if the field's value has a valid date format, if not provided,
     * it will use the $_standard_date_format value
     *
     * @access	public
     * @param	string
     * @return	bool
     */
    public function valid_date($str, $format = NULL) {
        if (is_null($format) or $format === FALSE) {
            $format = $this->_standard_date_format;
        }

        if (function_exists('date_parse_from_format')) {
            $parsed = date_parse_from_format($format, $str);
        } else {
            $parsed = $this->_date_parse_from_format($format, $str);
        }

        if ($parsed['warning_count'] > 0 or $parsed['error_count'] > 0) {
            return FALSE;
        }
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Check if the field's value has a valid range of two date format, if not provided,
     * it will use the $_standard_date_format value
     *
     * @access	public
     * @param	string
     * @return	bool
     */
    public function valid_range_date($str, $format = NULL) {
        $CI =& get_instance();
        $_standard_date_format = $CI->config->item('date_with_time');
        if (is_null($format) or $format === FALSE) {
            $format = $_standard_date_format;
        }

        $separation_char = '-';


        $exploded = explode($separation_char, $str);

        foreach ($exploded as $key => $e) {
            $exploded[$key] = trim($e);
        }

        if (count($exploded) > 2) {
            //in case we are using dates like Y-m-d and separation char is - etc...

            $sub_exploded = $exploded;
            $count_rows = count($exploded);

            $exploded = array();

            $vector_exploded = array();

            for ($i = 0; $i < ($count_rows / 2); $i++) {
                $vector_exploded[] = $sub_exploded[$i];
            }

            $exploded[0] = implode($separation_char, $vector_exploded);
            $vector_exploded = array();

            for ($i = ($count_rows / 2); $i < $count_rows; $i++) {
                $vector_exploded[] = $sub_exploded[$i];
            }

            $exploded[1] = implode($separation_char, $vector_exploded);
        }

        $dates = array();
        $valid_dates = TRUE;
        foreach ($exploded as $e) {
            if (function_exists('date_parse_from_format')) {
                $parsed = date_parse_from_format($format, $e);
            } else {
                $parsed = $this->_date_parse_from_format($format, $e);
            }


            $dates[] = $parsed;
            if ($parsed['warning_count'] > 0 or $parsed['error_count'] > 0) {
                $valid_dates = FALSE;
            }
        }
        if ($valid_dates == FALSE) {
            return FALSE;
        }
        //why use strtotime when you can get hardcore!
        if (mktime($dates[0]['hour'], $dates[0]['minute'], $dates[0]['second'], $dates[0]['month'], $dates[0]['day'], $dates[0]['year']) >
                mktime($dates[1]['hour'], $dates[1]['minute'], $dates[1]['second'], $dates[1]['month'], $dates[1]['day'], $dates[1]['year'])
        ) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Check the unique value of the input filed commonly used for register or 
     * at the place of new entry.
     * 
     * This accept two peramitter first will be send by the code form validation 
     * class and second should be combination of table and filed joint by .
     * 
     * so the string will table.filed (filed will the name of the filed inwhich we
     * need to check)
     * 
     * 
     * @param type $value
     * @param type $params 
     * @return boolean
     */
    function unique($value, $params) {

        $CI = & get_instance();
        $CI->load->database();

        $CI->form_validation->set_message('unique', 'The %s is already being used.');

        list($table, $field) = explode(".", $params, 2);

        $query = $CI->db->select($field)->from($table)->where($field, $value)->limit(1)->get();

        if ($query->row()) {
            return false;
        } else {
            return true;
        }
    }

    // check operator username
    function unique2($value, $params) {

        $CI = & get_instance();
        $CI->load->database();

        $CI->form_validation->set_message('unique2', 'The %s is already being used in Operator.');

        list($table, $field) = explode(".", $params, 2);

        $query = $CI->db->select($field)->from($table)->where($field, $value)->limit(1)->get();

        if ($query->row()) {
            return false;
        } else {
            return true;
        }
    }

    // check sub operator username
    function unique3($value, $params) {

        $CI = & get_instance();
        $CI->load->database();

        $CI->form_validation->set_message('unique3', 'The %s is already being used in Admin.');

        list($table, $field) = explode(".", $params, 2);

        $query = $CI->db->select($field)->from($table)
                        ->where($field, $value)->limit(1)->get();

        if ($query->row()) {
            return false;
        } else {
            return true;
        }
    }

    // check positiveprice[notneg.users.balance.idu] 
    function positiveprice($value) {

        $CI = & get_instance();
        $CI->load->database();

        $CI->form_validation->set_message('positiveprice', 'Please Enter Positive Ammount.');
        if ($value < 0) {
            return false;
        } else {
            return true;
        }
    }

    // check expiry date
    function expdate($value, $year) {
        $CI = & get_instance();
        $CI->load->database();

        $CI->form_validation->set_message('expdate', 'Expiry date not valid.');

        if ($year != date('Y')) {
            return true;
        } elseif ($value < date('m')) {
            return false;
        }
    }

    // check maximum amount less than monthly limit.
    function maxamount($value1, $Monthly_amt) {

        $CI = &get_instance();
        $CI->load->database();

        $CI->form_validation->set_message('maxamount', 'Please Enter Maximum Amount Less than Monthly Limit.');


        if ($value1 > $Monthly_amt) {
            return false;
        } else {
            return true;
        }
    }

    function is_unique($str, $field) {
        list($table, $field) = explode('.', $field);

        $this->CI->form_validation->set_message('is_unique', 'The %s is not available');

        if (isset($this->CI->db)) {
            $query = $this->CI->db->where($field, $str)->get($table);
            return $query->num_rows() === 0;
        }

        return false;
    }

    // check unique in database
    //parameter used unique[table.field.exlude]

    function ex_unique($str, $field) {
        list($table, $field, $exclude) = explode('.', $field);

        $this->CI->form_validation->set_message('ex_unique', 'The %s is not available');

        if (isset($this->CI->db)) {
            $query = $this->CI->db->where($field, $str)->where($field . " != ", $exclude)->get($table);
            return $query->num_rows() === 0;
        }

        return false;
    }

    /**
     * This function will help to check a strong password used or not according to the validation
     * this will check a special charector a uppercase a lowercase and a number should include
     * into the password.
     * 
     * @param type $candidate
     * @return boolean
     */
//    function password_check($candidate) {
//        $uppercase = preg_match('#[A-Z]#', $candidate);
//        $lowercase = preg_match('#[a-z]#', $candidate);
//        $number = preg_match('#[0-9]#', $candidate);
//        $special = preg_match('#[\W]{1,}#', $candidate);
//        $length = strlen($candidate) >= 8;
//
//        if (!$uppercase || !$lowercase || !$number ||!$special || !$length) {
//            $this->CI->form_validation->set_message('password_check', 'The %s  should be combination of uppercase, lowercase and special character');
//            return false;
//        } else {
//            return true;
//        }
//    }
    
    function password_check($password)
    {
    if( 
        ctype_alnum($password) && strlen($password)>7 && strlen($password)<9 
        && preg_match('`[A-Z]`',$password) // at least one upper case 
        && preg_match('`[a-z]`',$password) // at least one lower case 
        && preg_match('`[0-9]`',$password) // at least one digit 
        )  
    { 
        return true;
    }
    else
    { 
       $this->CI->form_validation->set_message('password_check', 'The %s  should be a combination of 6 numbers and 2 characters one capital and one lower case.'); 
       return false;
       
    }
    }
    
    function n_password_check($password)
    {
        
    if( 
        //I want to change this first line so that I am also checking for at least 1 symbol.
        ctype_alnum($password) && strlen($password)>7 && strlen($password)<9 
        && preg_match('`[A-Z]`',$password) // at least one upper case 
        && preg_match('`[a-z]`',$password) // at least one lower case 
        && preg_match('`[0-9]`',$password) // at least one digit 
        )
    { 
        echo 'valid';

    }
    else
    { 
        $this->CI->form_validation->set_message('password_check', 'The %s  should be combination of uppercase, lowercase and special character');
    }
    }
    
    function pin_check($pin){        
		$length     = strlen($pin) == 8;
                
                $part1      = substr($pin,0,3);
                $part2      = substr($pin,3,2);
                $part3      = substr($pin,5,2);
                
                $number1    = preg_match('#[0-9]#', $part1);
                $number2    = preg_match('#[0-9]#', $part3);
                
                $uppercase = preg_match('#[A-Z]#', $part2);
		$lowercase = preg_match('#[a-z]#', $part2);
		
		if(!$number1 || !$uppercase || !$lowercase || !$number2 || !$length) {
			$this->CI->form_validation->set_message('pin_check', 'The %s  is not in correct given format.');
			return false;
		}else{
			 return true;
		}
    }
    
    function phone_check($phone){        
		//echo $phone = '+91-000001111';
                if(strlen($phone)>12 && strlen($phone)<18 &&
                    preg_match("[^[+]{1}?([\d]{0,3})[-]{1}?[\(\.\-\s]?([\d]{0,3})[\)\.\-\s]*([\d]{3})[\.\-\s]?([\d]{0,8})$]",$phone)
                    )
                { 
                    return true;
                }
                else
                { 
                    $this->CI->form_validation->set_message('phone_check', 'The %s  is not correct in international format.');
			return false;
                }
		
            }
    

    function validateCreditcard_number($cc_num, $cc_type) {
        $CI = & get_instance();
        $credit_card_number = $this->sanitize($cc_num);
        // Get the first digit
        $data = array();
        $firstnumber = substr($credit_card_number, 0, 1);

        $cc_type_arr = array('visa', 'mc', 'switch', 'amex', 'laser', 'diner', 'delta', 'solo', 'discover');
        $chK_arr = array();

        // Make sure it is the correct amount of digits. Account for dashes being present.
        switch ($firstnumber) {
            case 3:
                $data['card_type'] = "American Express";
                $chK_arr[] = "amex";
                $chK_arr[] = "AmericanExpress";
                $chK_arr[] = "American Express";
                $chK_arr[] = "american express";

                if (!in_array($cc_type, $chK_arr)) {
                    $CI->form_validation->set_message('validateCreditcard_number', 'The card type and card number do not match.');
                    return FALSE;
                }
                if (!preg_match('/^3\d{3}[ \-]?\d{6}[ \-]?\d{5}$/', $credit_card_number)) {
                    //return ‘This is not a valid American Express card number’;
                    //$data['status']='false';
                    //return $data;
                    $CI->form_validation->set_message('validateCreditcard_number', 'The %s field should content a valid american express card number.');
                    return FALSE;
                }
                break;
            case 4:
                $data['card_type'] = "Visa";
                $chK_arr[] = "visa";
                $chK_arr[] = "Visa";
                $chK_arr[] = "VISA ELECTRON";


                if (!in_array($cc_type, $chK_arr)) {
                    $CI->form_validation->set_message('validateCreditcard_number', 'The card type and card number do not match.');
                    return FALSE;
                }

                if (!preg_match('/^4\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number)) {
                    //return ‘This is not a valid Visa card number’;	
                    //$data['status']='false';
                    //return $data;
                    $CI->form_validation->set_message('validateCreditcard_number', 'The %s field should content a valid visa card number.');
                    return FALSE;
                }
                break;
            case 5:
                $data['card_type'] = "MasterCard";
                $chK_arr[] = "MasterCard";
                $chK_arr[] = "mc";
                $chK_arr[] = "MASTERCARD ELECTRONIC";
                $chK_arr[] = "Master Card";

                if (!in_array($cc_type, $chK_arr)) {
                    $CI->form_validation->set_message('validateCreditcard_number', 'The card type and card number do not match.');
                    return FALSE;
                }
                if (!preg_match('/^5\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number)) {
                    //return ‘This is not a valid MasterCard card number’;
                    //$data['status']='false';
                    //return $data;
                    $CI->form_validation->set_message('validateCreditcard_number', 'The %s field should content a valid master card number.');
                    return FALSE;
                }
                break;
            case 6:
                $data['card_type'] = "Discover";
                $chK_arr[] = "discover";


                if (!in_array($cc_type, $chK_arr)) {
                    $CI->form_validation->set_message('validateCreditcard_number', 'The card type and card number do not match.');
                    return FALSE;
                }

                if (!preg_match('/^6011[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number)) {
                    //return ‘This is not a valid Discover card number’;
                    $CI->form_validation->set_message('validateCreditcard_number', 'The %s field should content a valid discover card number.');
                    //$data['status']='false';
                    //return $data;
                    return FALSE;
                }
                break;
            default:
                $CI->form_validation->set_message('validateCreditcard_number', 'The %s field should content a valid credit card number.');
                return FALSE;
        }
        // Here’s where we use the Luhn Algorithm
        $credit_card_number = str_replace('-', '', $credit_card_number);
        $map = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 2, 4, 6, 8, 1, 3, 5, 7, 9);
        $sum = 0;
        $last = strlen($credit_card_number) - 1;

        for ($i = 0; $i <= $last; $i++) {
            $count_num = ($last - $i);
            $sum += $map[$credit_card_number[$count_num] + ($i & 1) * 10];
        }
        if ($sum % 10 != 0) {
            //return ‘This is not a valid credit card number’;
            //$data['status']='false';
            //return $data;
            $CI->form_validation->set_message('validateCreditcard_number', 'The %s field should content a valid credit card number.');
            return FALSE;
        }
        // If we made it this far the credit card number is in a valid format
        return TRUE;
    }

    function validateCreditCardExpirationDate($mon, $yr) {
        $CI = & get_instance();
        $month = $this->sanitize($mon);
        $year = $this->sanitize($yr);
        if (!preg_match('/^\d{2}$/', $month)) {
            $CI->form_validation->set_message('validateCreditCardExpirationDate', 'The month should be two digit long.');
            return FALSE; // The month isn’t a one or two digit number
        } else if (!preg_match('/^\d{4}$/', $year)) {
            $CI->form_validation->set_message('validateCreditCardExpirationDate', 'The year should be four digits long');
            return FALSE; // The year isn’t four digits long
        } else if ($year < date("Y")) {
            $CI->form_validation->set_message('validateCreditCardExpirationDate', 'The card is already expired');
            return FALSE; // The card is already expired
        } else if ($month < date("m") && $year == date("Y")) {
            $CI->form_validation->set_message('validateCreditCardExpirationDate', 'The card is already expired');
            return FALSE; // The card is already expired
        }
        return TRUE;
    }

    function validateCVV($cc_num, $cc_cvv) {
        $CI = & get_instance();
        $cardNumber = $this->sanitize($cc_num);
        $cvv = $this->sanitize($cc_cvv);
        // Get the first number of the credit card so we know how many digits to look for
        $firstnumber = (int) substr($cardNumber, 0, 1);
        if ($firstnumber === 3) {
            if (!preg_match("/^\d{4}$/", $cvv)) {
                $CI->form_validation->set_message('validateCVV', 'The credit card is an American Express card but does not have a four digit CVV code.');
                // The credit card is an American Express card but does not have a four digit CVV code
                return FALSE;
            }
        } else if (!preg_match("/^\d{3}$/", $cvv)) {
            $CI->form_validation->set_message('validateCVV', 'The card type is eighter Visa or MasterCard or Discover Card and it shuld have three digit CVV code.');
            // The credit card is a Visa, MasterCard, or Discover Card card but does not have a three digit CVV code
            return FALSE;
        }
        return TRUE;
    }

    function sanitize($value) {
        return trim(strip_tags($value));
    }

    public function match_string_validation($str, $match_type = '') {
        $CI = & get_instance();

        $preg_match_with = '';
        $preg_match_msg = 'The %s field don\'t have a valid validation please check the validation type again.';
        $chk_for_match = explode('~', $match_type);
        if ($chk_for_match[0] == 'alphanumsp') {
            $preg_match_with = "/^([0-9a-zA-Z" . $chk_for_match[1] . "])+$/i";
            $preg_match_msg = 'The %s field may only contain alpha characters with the few special characters allowed by administrator.';
        }

        //regular expression array 
        $regularexp = array(
            'numeric_space_dash' => array('regu' => "/^([-0-9 ])+$/i", 'msg' => 'The %s field may only contain numeric characters, space and dashe.'),
            'alpha_numeric_dash_space' => array('regu' => "/^([a-z0-9- ", 'msg' => 'The %s field may only contain alpha characters, numeric characters, space and dash.'),
            'alpha_numeric_space' => array('regu' => "/^([a-z0-9 ])+$/i", 'msg' => 'The %s field may only contain alpha characters, numeric characters and space.'),
            'alpha_numeric_dash' => array('regu' => "/^([a-z0-9-])+$/i", 'msg' => 'The %s field may only contain alpha characters, numeric characters and dash.'),
            'alpha_numeric_dash_under_dot' => array('regu' => "/^([a-z0-9-_.])+$/i", 'msg' => 'The %s field may only contain alpha characters, numeric characters, dash, underscore and dot.'),
            'alpha_space' => array('regu' => "/^([a-zA-Z ])+$/i", 'msg' => 'The %s field may only contain alphabatic characters with space.'),
            'address' => array('regu' => "/^([0-9A-Za-z _.,&#\'-])+$/i", 'msg' => 'The %s field may only contain alpha characters, numeric characters and some special charectors which is allowed in address only like # - / .'),
        );

        if ($preg_match_with == '') {
            if (array_key_exists($match_type, $regularexp)) {
                $preg_match_with = $regularexp[$match_type]['regu'];
                $preg_match_msg = $regularexp[$match_type]['msg'];
            }
        }

        if ($preg_match_with != '') {
            if (!preg_match($preg_match_with, $str)) {
                $CI->form_validation->set_message('match_string_validation', $preg_match_msg);
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            $CI->form_validation->set_message('match_string_validation', $preg_match_msg);
            return FALSE;
        }
    }
    
    public function alpha_numeric_space($str){
		$CI =& get_instance();	
		if (! preg_match("/^([a-z0-9 ])+$/i", $str)){ 
			$CI->form_validation->set_message('alpha_numeric_space', 'The %s field may only contain alpha numeric characters and space.'); 
			return FALSE; 
		}else{ 
			return TRUE;
		}
	}
        
    public function alpha_numeric_dash($str){
		$CI =& get_instance();	
		if (! preg_match("/^([a-z0-9-])+$/i", $str)){ 
			$CI->form_validation->set_message('alpha_numeric_dash', 'The %s field may only contain alpha / numeric characters with dash.'); 
			return FALSE; 
		}else{ 
			return TRUE;
		}
	}
        
    public function alpha_numeric_dash_space($str){
		$CI =& get_instance();	
		if (! preg_match("/^([a-z0-9- ])+$/i", $str)){ 
			$CI->form_validation->set_message('alpha_numeric_dash_space', 'The %s field may only contain alpha / numeric characters with dash and space.'); 
			return FALSE; 
		}else{ 
			return TRUE;
		}
	}

    public function isString($str) {
        $CI = & get_instance();
        if (!is_string($str)) {
            $CI->form_validation->set_message('isString', 'The %s field is not a valid string.');
            return FALSE;
        }
        return true;
    }

    public function required_new($str, $check_for = '1') {
        $CI = & get_instance();
        if ($str == $check_for) {
            $CI->form_validation->set_message('required_new', 'The %s field is required.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function error_count() {
        return $this->_error_array;
    }

}

?>
  