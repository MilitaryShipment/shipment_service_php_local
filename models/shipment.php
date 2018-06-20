<?php

require_once __DIR__ . '/../db_record_php_7/record.php';


class Shipment extends Record{

    const DRIVER = 'mssql';
    const DB = 'Sandbox';
    const TABLE = 'tbl_shipment_primary';
    const PRIMARYKEY = 'gbl_dps';

    public $id;
    public $gbl_dps;
    public $scac;
    public $registration_number;
    public $registration_date;
    public $shipment_management_date;
    public $crm_date;
    public $mc_tid;
    public $ccc_tid;
    public $driver_id;
    public $filed_rate;
    public $red_file;
    public $firearms;
    public $branch;
    public $rank;
    public $ssn;
    public $full_name;
    public $first_name;
    public $last_name;
    public $shipment_type;
    public $releasing_agent_name;
    public $releasing_agent_phone;
    public $receiving_agent_name;
    public $receiving_agent_phone;
    public $orig_agent_id;
    public $orig_address;
    public $orig_city;
    public $orig_state;
    public $orig_zip;
    public $orig_county;
    public $orig_phone;
    public $secondary_phone;
    public $orig_primary_mobile;
    public $orig_secondary_mobile;
    public $primary_email;
    public $secondary_email;
    public $dest_agent_id;
    public $dest_address;
    public $dest_city;
    public $dest_state;
    public $dest_zip;
    public $dest_county;
    public $hauler_agent_id;
    public $hauler_carrier_id;
    public $gbloc_orig;
    public $orig_gbloc_area;
    public $state_region;
    public $line_haul;
    public $gbloc_dest;
    public $dest_gbloc_area;
    public $dest_primary_phone;
    public $premove_survey_date;
    public $requested_pack_date;
    public $requested_pickup_date;
    public $requested_latest_pickup_date;
    public $requested_delivery_date;
    public $pack_date;
    public $pack_date_2;
    public $pack_date_3;
    public $pack_eta_early_time;
    public $pack_eta_late_time;
    public $pickup_date;
    public $pickup_type;
    public $load_eta_early_time;
    public $load_eta_late_time;
    public $final_load_eta_date;
    public $driver_eta_date;
    public $required_delivery_date;
    public $delivery_eta_date;
    public $early_delivery_eta_time;
    public $late_delivery_eta_time;
    public $delivery_warehouse_date;
    public $delivery_residence_date;
    public $residence_delivery;
    public $storage_delivery;
    public $g11_status;
    public $g11_authorized_date;
    public $g11_performed_date;
    public $sit_exp_date;
    public $sit_number;
    public $sit_conversion_date;
    public $premove_received;
    public $estimated_weight;
    public $actual_weight;
    public $gross_weight;
    public $tare_weight;
    public $progear;
    public $progear_weight;
    public $spouse_progear_weight;
    public $request_reweigh;
    public $reweigh_date;
    public $reweigh_gross_weight;
    public $reweigh_tare_weight;
    public $channel;
    public $code_of_service;
    public $special_items;
    public $remarks;
    public $vehicles;
    public $predicted_happy_rating;
    public $shipper_satisfied;
    public $survey_submitted;
    public $survey_date;
    public $tsp_score;
    public $text_opt_out;
    public $miles;
    public $booked;
    public $status;
    public $push_text;
    public $send_rdd_text;
    public $soft_phone;
    public $reg_dash;
    public $dateStr;
    public $fromAddr;
    public $subject;
    public $plainmsg;
    public $scheduled_delivery_out_date;
    public $updated_weight;
    public $guid;
    public $created_by;
    public $created_date;
    public $update_by;
    public $updated_date;
    public $status_id;

    public function __construct($gbl = null)
    {
        parent::__construct(self::DRIVER,self::DRIVER,self::DB,self::TABLE,self::PRIMARYKEY,$gbl);
    }
    public static function get($key,$value,$option){
        $data = array();
        $ids = array();
        $GLOBALS['db']
            ->suite(self::DRIVER)
            ->driver(self::DRIVER)
            ->database(self::DB)
            ->table(self::TABLE)
            ->select(self::PRIMARYKEY)
            ->where($key,"=",$value);
        switch (strtolower($option)){
            case 'active':
                $results = $GLOBALS['db']->andWhere("required_delivery_date",">","GETDATE()")->get();
                break;
            case 'history':
                $results = $GLOBALS['db']->andWhere("required_delivery_date","<","GETDATE()")->get();
                break;
            default:
                throw new Exception('Invalid Shipment Option');
        }
        while($row = sqlsrv_fetch_array($results,SQLSRV_FETCH_ASSOC)){
            $ids[] = $row[self::PRIMARYKEY];
        }
        foreach($ids as $id){
            $data[] = new self($id);
        }
        return $data;
    }
}