<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 17/12/2018
 * Time: 01:59
 */

class Ohkr_model extends CI_Model
{
    //default table if not defined in conf/sacids.php
    private static $table_name_diseases = "ohkr_diseases";
    private static $table_name_species = "ohkr_species";
    private static $table_name_symptoms = "ohkr_symptoms";
    private static $table_disease_symptoms = "ohkr_disease_symptoms";
    private static $table_name_faq = "ohkr_faq";
    private static $table_name_response_sms = "ohkr_response_sms";
    private static $table_name_sent_sms = "ohkr_sent_sms";
    private static $table_name_users = "users";
    private static $table_name_user_groups = "groups";
    private static $table_name_users_groups = "users_groups";
    private static $table_name_districts = "district";
    private static $table_name_detected_diseases = "ohkr_detected_diseases";


    function __construct()
    {
        parent::__construct();
    }

    public function find_diseases_by_symptoms_code($code = array())
    {

        if (!is_array($code)) {
            return FALSE;
        } else {
            $this->db->select("d.title as disease_name, count(d.title) as occurrence_count, d.id as disease_id, sds.*,ds.*");
            $this->db->from(self::$table_disease_symptoms . " sds");
            $this->db->join(self::$table_name_diseases . " d", "d.id = sds.disease_id");
            $this->db->join(self::$table_name_symptoms . " ds", "ds.id = sds.symptom_id");
            $this->db->where_in("code", $code);
            $this->db->group_by("d.title");
            return $this->db->get()->result();
        }
    }

    //post symptoms
    public function post_symptoms_request($query_params)
    {

        $url = base_url("api/v3/intel/disease");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($query_params))
        );

        $response = curl_exec($ch);
        $http_response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ($http_response_code == 200 || $http_response_code == 300) ? $response : FALSE;
    }
}