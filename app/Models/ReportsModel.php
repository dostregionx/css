<?php

namespace App\Models;

use CodeIgniter\Model;


class ReportsModel extends Model
{

    protected $DBGroup = 'default'; // Specify the default database group
    protected $table = 'tblclienttype';

    protected $db;
    public function __construct()
    {
        $db = db_connect();
        parent::__construct();
    }

    public function get_all_data($tablename)
    {
        $query = $this->db->table($tablename)->get();
        return $query->getResultArray();
    }


    public function get_responses($params)
    {
        $builder = $this->db->table('tblcss_summary css');

        // Select statement
        $builder->select('
            css.csssummaryid,
            css.officeid,
            css.quarterid,
            css.servicesid,
            css.dost_personnel,
            css.clienttypeid,
            css.typeofmarket,
            css.rstlservice_availed,
            css.name AS summary_name,
            css.date AS summary_date,
            css.sex AS summary_sex,
            css.age AS summary_age,
            css.vul_sector AS summary_vul_sector,
            css.address AS summary_address,
            css.dost_info AS summary_dost_info,
            css.year AS summary_year,
            css.date_created AS summary_date_created,
            cc.cssdetailsccid,
            cc.cc1,
            cc.cc2,
            cc.cc3,
            sqd.cssdetailssqd,
            sqd.sqd0,
            sqd.sqd1,
            sqd.sqd2,
            sqd.sqd3,
            sqd.sqd4,
            sqd.sqd5,
            sqd.sqd6,
            sqd.sqd7,
            sqd.sqd8,
            sqd.sqd9,
            sqd.sqd10,
            sqd.recommend,
            sqd.email AS sqd_email,
            sqd.suggestions,
            office.name AS office_name,
            quarters.quarter AS quarter_name,
            clienttype.name AS client_type_name,
            services.name AS service_name,
            services.unit AS service_unit,
            services.is_external AS service_is_external,
            services.is_active AS service_is_active,
            services.is_cc AS service_is_cc,
            agegroup.agegroup as agegroup,
            css.others_remarks

        ');

        // Joins
        $builder->join('tblcss_details_cc cc', 'css.csssummaryid = cc.csssummaryid', 'left');
        $builder->join('tblcss_details_sqd sqd', 'css.csssummaryid = sqd.csssummaryid', 'left');
        $builder->join('tbloffice office', 'css.officeid = office.officeid', 'left');
        $builder->join('tblquarters quarters', 'css.quarterid = quarters.quarterid', 'left');
        $builder->join('tblclienttype clienttype', 'css.clienttypeid = clienttype.clienttypeid', 'left');
        $builder->join('tblservices services', 'css.servicesid = services.servicesid', 'left');
        $builder->join('tblagegroup agegroup', 'css.age = agegroup.agegroupid', 'left');

        // Where conditions
        $builder->where('css.year', $params['year']);
        
        if ($params['is_external'] !== 'all') {
            $builder->where('services.is_external', $params['is_external']);
        }

        if ($params['quarterid'] !== 'all') {
            $builder->where('css.quarterid', $params['quarterid']);
        }

        if ($params['officeid'] !== 'all') {
            $builder->where('css.officeid', $params['officeid']);
        }

        // Order by
        $builder->orderBy('css.date_created', 'DESC');

        // Execute the query and return the results
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function get_office_name($params)
    {
        $query = $this->db->table('tbloffice')->where('officeid', $params['officeid'])->get();
        return $query->getRowArray();
    }

    public function gen_client_type($params)
    {
        // Prepare initial query
        $final_query = "SELECT 
                    `cl`.*, 
                    `co`.`external_count`, 
                    `co`.`internal_count`, 
                    `co`.`total_per_ctype`, 
                    `xto`.`total_overall`
                    FROM 
                    `tblclienttype` `cl`
                    LEFT JOIN (
                        SELECT 
                        `clienttypeid`, 
                        SUM(CASE WHEN `is_external` = 1 THEN 1 ELSE 0 END) AS `external_count`, 
                        SUM(CASE WHEN `is_external` = 0 THEN 1 ELSE 0 END) AS `internal_count`, 
                        COUNT(*) AS `total_per_ctype`
                        FROM (
                        SELECT 
                            `cs`.`clienttypeid`, 
                            `cs`.`year`, 
                            `cs`.`officeid`, 
                            `cs`.`quarterid`, 
                            `ser`.`is_external`, 
                            `quar`.`semesterid`
                        FROM 
                            `tblcss_summary` `cs`
                            JOIN `tblservices` `ser` ON `ser`.`servicesid` = `cs`.`servicesid`
                            JOIN `tblquarters` `quar` ON `quar`.`quarterid` = `cs`.`quarterid`
                        WHERE 
                            `cs`.`year` = :year:";  // Bind parameter
        
        // Check if officeid is not 'all' and append to the query
        if ($params['officeid'] != 'all') {
            $final_query .= ' AND cs.officeid = :officeid:';
        }
        
        // Filter based on semester or quarter
        if ($params['typeselector'] === 'semester') {
            if ($params['semesterid'] != 'all') {
                $final_query .= ' AND quar.semesterid = :semesterid:';
            }
        }
        
        if ($params['typeselector'] === 'quarter') {
            $final_query .= ' AND quar.quarterid = :quarterid:';
        }

        // Close first subquery
        $final_query .= ") as css_data
                        GROUP BY `clienttypeid`
                    ) as co ON `cl`.`clienttypeid` = `co`.`clienttypeid`
                    JOIN (
                        SELECT 
                        COUNT(*) AS `total_overall`
                        FROM (
                        SELECT 
                            `cs`.`clienttypeid`, 
                            `cs`.`year`, 
                            `cs`.`officeid`, 
                            `cs`.`quarterid`, 
                            `ser`.`is_external`, 
                            `quar`.`semesterid`
                        FROM 
                            `tblcss_summary` `cs`
                            JOIN `tblservices` `ser` ON `ser`.`servicesid` = `cs`.`servicesid`
                            JOIN `tblquarters` `quar` ON `quar`.`quarterid` = `cs`.`quarterid`
                        WHERE 
                            `cs`.`year` = :year:";
        
        // Apply the same conditions for officeid, semesterid, and quarterid
        if ($params['officeid'] != 'all') {
            $final_query .= ' AND cs.officeid = :officeid:';
        }

        if ($params['typeselector'] === 'semester') {
            if ($params['semesterid'] != 'all') {
                $final_query .= ' AND quar.semesterid = :semesterid:';
            }
        }

        if ($params['typeselector'] === 'quarter') {
            $final_query .= ' AND quar.quarterid = :quarterid:';
        }

        // Close the second subquery
        $final_query .= " ) as css_data
                    ) as xto ON 1=1";

        // Use CodeIgniter's database connection to execute the query
        $query = $this->db->query($final_query, [
            'year' => $params['year'],
            'officeid' => $params['officeid'],
            'semesterid' => $params['semesterid'],
            'quarterid' => $params['quarterid'],
        ]);

        // Return the result as an array
        return $query->getResultArray();
    }

    public function gen_agegroup($params)
    {
        $final_query = "SELECT 
                    `ag`.*, 
                    `co`.`external_count`, 
                    `co`.`internal_count`, 
                    `co`.`total_per_agegroup`, 
                    `xto`.`total_overall`
                    FROM 
                    `tblagegroup` `ag`
                    LEFT JOIN (
                        SELECT 
                        `age`, 
                        SUM(CASE WHEN `is_external` = 1 THEN 1 ELSE 0 END) AS `external_count`, 
                        SUM(CASE WHEN `is_external` = 0 THEN 1 ELSE 0 END) AS `internal_count`, 
                        COUNT(*) AS `total_per_agegroup`
                        FROM (
                        SELECT 
                            `cs`.`age`, 
                            `cs`.`year`, 
                            `cs`.`officeid`, 
                            `cs`.`quarterid`, 
                            `ser`.`is_external`, 
                            `quar`.`semesterid`
                        FROM 
                            `tblcss_summary` `cs`
                            JOIN `tblservices` `ser` ON `ser`.`servicesid` = `cs`.`servicesid`
                            JOIN `tblquarters` `quar` ON `quar`.`quarterid` = `cs`.`quarterid`
                        WHERE 
                            `cs`.`year` = ".$params['year'];


                        if ($params['officeid'] != 'all') {
                            $final_query .= ' AND cs.officeid = ' . $params['officeid'];
                        }


                        if ($params['typeselector'] === 'semester') {
                            if ($params['semesterid'] != 'all') {
                                $final_query .= ' AND quar.semesterid = '.$params['semesterid'];
                            }
                        }

                        if ($params['typeselector'] === 'quarter') {
                            $final_query .= ' AND quar.quarterid = '.$params['quarterid'];
                        }    

        $final_query .=                ") as css_data
                        GROUP BY `age`
                    ) as co ON `ag`.`agegroupid` = `co`.`age`
                    JOIN (
                        SELECT 
                        COUNT(*) AS `total_overall`
                        FROM (
                        SELECT 
                            `cs`.`clienttypeid`, 
                            `cs`.`year`, 
                            `cs`.`officeid`, 
                            `cs`.`quarterid`, 
                            `ser`.`is_external`, 
                            `quar`.`semesterid`
                        FROM 
                            `tblcss_summary` `cs`
                            JOIN `tblservices` `ser` ON `ser`.`servicesid` = `cs`.`servicesid`
                            JOIN `tblquarters` `quar` ON `quar`.`quarterid` = `cs`.`quarterid`
                        WHERE 
                            `cs`.`year` = ".$params['year'];
                            if ($params['officeid'] != 'all') {
                                $final_query .= ' AND cs.officeid = ' . $params['officeid'];
                            }
    
    
                            if ($params['typeselector'] === 'semester') {
                                if ($params['semesterid'] != 'all') {
                                    $final_query .= ' AND quar.semesterid = '.$params['semesterid'];
                                }
                            }
    
                            if ($params['typeselector'] === 'quarter') {
                                $final_query .= ' AND quar.quarterid = '.$params['quarterid'];
                            } 

        $final_query .= " ) as css_data
                    ) as xto ON 1=1";

        $query = $this->db->query($final_query);

        return $query->getResultArray();

    }

    public function gen_sex($params) {
        // Start building the query
        $builder = $this->db->table('tblcss_summary csssum');
        $builder->select('
            SUM(CASE WHEN csssum.sex = "Male" AND ser.is_external = 1 THEN 1 ELSE 0 END) AS external_male,
            SUM(CASE WHEN csssum.sex = "Female" AND ser.is_external = 1 THEN 1 ELSE 0 END) AS external_female,
            SUM(CASE WHEN ser.is_external = 1 THEN 1 ELSE 0 END) AS total_external,
            SUM(CASE WHEN csssum.sex = "Male" AND ser.is_external = 0 THEN 1 ELSE 0 END) AS internal_male,
            SUM(CASE WHEN csssum.sex = "Female" AND ser.is_external = 0 THEN 1 ELSE 0 END) AS internal_female,
            SUM(CASE WHEN ser.is_external = 0 THEN 1 ELSE 0 END) AS total_internal');

        $builder->join('tblservices ser', 'ser.servicesid = csssum.servicesid', 'inner');
        $builder->join('tblquarters quar', 'quar.quarterid = csssum.quarterid', 'inner');
        $builder->join('tblsemesters sem', 'sem.semesterid = quar.semesterid', 'inner');
        
        // Where conditions
        $builder->where('csssum.year', $params['year']);
    
        if ($params['typeselector'] === 'semester') {
            if ($params['semesterid'] != 'all') {
                $builder->where('quar.semesterid', $params['semesterid']);
            }
        }
    
        if ($params['typeselector'] === 'quarter') {
            $builder->where('csssum.quarterid', $params['quarterid']);
        }
    
        if ($params['officeid'] != 'all') {
            $builder->where('csssum.officeid', $params['officeid']);
        }
    
        // Execute the query
        $query = $builder->get();
    
        // Return the result as an associative array
        return $query->getRowArray();
    }

    public function gen_age_distribution($params)
    {
        // Define age groups
        $ageGroups = [
            ['age_group' => '19 or lower', 'min_age' => 0, 'max_age' => 19],
            ['age_group' => '20-34', 'min_age' => 20, 'max_age' => 34],
            ['age_group' => '35-49', 'min_age' => 35, 'max_age' => 49],
            ['age_group' => '50-64', 'min_age' => 50, 'max_age' => 64],
            ['age_group' => '65 or higher', 'min_age' => 65, 'max_age' => 150],
        ];

        // Create age_groups temp table
        $this->db->query('CREATE TEMPORARY TABLE age_groups (age_group VARCHAR(20), min_age INT, max_age INT)');
        foreach ($ageGroups as $group) {
            $this->db->table('age_groups')->insert($group);
        }

        // Create css_summary temp table
        $css_summary = $this->db->table('tblcss_summary')
            ->select('tblcss_summary.age, ser.is_external')
            ->join('tblquarters quar', 'quar.quarterid = tblcss_summary.quarterid', 'left')
            ->join('tblservices ser', 'ser.servicesid = tblcss_summary.servicesid', 'left')
            ->where('tblcss_summary.year', $params['year']);

        // Add additional filters
        if ($params['officeid'] != 'all') {
            $css_summary->where('tblcss_summary.officeid', $params['officeid']);
        }

        if ($params['typeselector'] === 'semester' && $params['semesterid'] != 'all') {
            $css_summary->where('quar.semesterid', $params['semesterid']);
        }

        if ($params['typeselector'] === 'quarter' && $params['quarterid'] != 'all') {
            $css_summary->where('quar.quarterid', $params['quarterid']);
        }

        // Insert into temporary table
        $this->db->query('CREATE TEMPORARY TABLE css_summary AS ' . $css_summary->getCompiledSelect());

        // Create total_counts temp table
        $total_counts = $this->db->table('tblcss_summary')
            ->select('SUM(CASE WHEN ser.is_external = 1 THEN 1 ELSE 0 END) AS total_external_count, 
                      SUM(CASE WHEN ser.is_external = 0 THEN 1 ELSE 0 END) AS total_internal_count')
            ->join('tblquarters quar', 'quar.quarterid = tblcss_summary.quarterid', 'left')
            ->join('tblservices ser', 'ser.servicesid = tblcss_summary.servicesid', 'left')
            ->where('tblcss_summary.year', $params['year']);

        if ($params['officeid'] != 'all') {
            $total_counts->where('tblcss_summary.officeid', $params['officeid']);
        }

        if ($params['typeselector'] === 'semester' && $params['semesterid'] != 'all') {
            $total_counts->where('quar.semesterid', $params['semesterid']);
        }

        if ($params['typeselector'] === 'quarter' && $params['quarterid'] != 'all') {
            $total_counts->where('quar.quarterid', $params['quarterid']);
        }

        // Insert into total_counts temporary table
        $this->db->query('CREATE TEMPORARY TABLE total_counts AS ' . $total_counts->getCompiledSelect());

        // Main query
        $sql = '
            SELECT 
                SUM(CASE WHEN ag.age_group = "19 or lower" AND cs.is_external = 1 THEN 1 ELSE 0 END) AS external_19_or_lower,
                SUM(CASE WHEN ag.age_group = "20-34" AND cs.is_external = 1 THEN 1 ELSE 0 END) AS external_20_34,
                SUM(CASE WHEN ag.age_group = "35-49" AND cs.is_external = 1 THEN 1 ELSE 0 END) AS external_35_49,
                SUM(CASE WHEN ag.age_group = "50-64" AND cs.is_external = 1 THEN 1 ELSE 0 END) AS external_50_64,
                SUM(CASE WHEN ag.age_group = "65 or higher" AND cs.is_external = 1 THEN 1 ELSE 0 END) AS external_65_or_higher,
                SUM(CASE WHEN ag.age_group = "19 or lower" AND cs.is_external = 0 THEN 1 ELSE 0 END) AS internal_19_or_lower,
                SUM(CASE WHEN ag.age_group = "20-34" AND cs.is_external = 0 THEN 1 ELSE 0 END) AS internal_20_34,
                SUM(CASE WHEN ag.age_group = "35-49" AND cs.is_external = 0 THEN 1 ELSE 0 END) AS internal_35_49,
                SUM(CASE WHEN ag.age_group = "50-64" AND cs.is_external = 0 THEN 1 ELSE 0 END) AS internal_50_64,
                SUM(CASE WHEN ag.age_group = "65 or higher" AND cs.is_external = 0 THEN 1 ELSE 0 END) AS internal_65_or_higher,
                tc.total_external_count,
                tc.total_internal_count
            FROM 
                age_groups ag
                LEFT JOIN css_summary cs ON (cs.age BETWEEN ag.min_age AND ag.max_age)
                CROSS JOIN total_counts tc
        ';

        // Run the main query
        $query = $this->db->query($sql);

        // Return the result as an array
        return $query->getRowArray();
    }

    public function gen_vulsector($params) {
        // Start building the query
        $builder = $this->db->table('tblcss_summary csssum');
        $builder->select('
            COUNT(CASE WHEN ser.is_external = 1 AND FIND_IN_SET("Senior Citizen", csssum.vul_sector) THEN 1 END) AS Senior_Citizen_External_Count,
            COUNT(CASE WHEN ser.is_external = 0 AND FIND_IN_SET("Senior Citizen", csssum.vul_sector) THEN 1 END) AS Senior_Citizen_Internal_Count,
            COUNT(CASE WHEN FIND_IN_SET("Senior Citizen", csssum.vul_sector) THEN 1 END) AS Senior_Citizen_Total_Count,

            COUNT(CASE WHEN ser.is_external = 1 AND FIND_IN_SET("Persons with Disability", csssum.vul_sector) THEN 1 END) AS PWD_External_Count,
            COUNT(CASE WHEN ser.is_external = 0 AND FIND_IN_SET("Persons with Disability", csssum.vul_sector) THEN 1 END) AS PWD_Internal_Count,
            COUNT(CASE WHEN FIND_IN_SET("Persons with Disability", csssum.vul_sector) THEN 1 END) AS PWD_Total_Count,

            COUNT(CASE WHEN ser.is_external = 1 AND FIND_IN_SET("4P\'s Beneficiary", csssum.vul_sector) THEN 1 END) AS 4Ps_Beneficiaries_External_Count,
            COUNT(CASE WHEN ser.is_external = 0 AND FIND_IN_SET("4P\'s Beneficiary", csssum.vul_sector) THEN 1 END) AS 4Ps_Beneficiaries_Internal_Count,
            COUNT(CASE WHEN FIND_IN_SET("4P\'s Beneficiary", csssum.vul_sector) THEN 1 END) AS 4Ps_Beneficiaries_Total_Count,

            COUNT(CASE WHEN ser.is_external = 1 AND FIND_IN_SET("Indigenous People", csssum.vul_sector) THEN 1 END) AS Indigenous_People_External_Count,
            COUNT(CASE WHEN ser.is_external = 0 AND FIND_IN_SET("Indigenous People", csssum.vul_sector) THEN 1 END) AS Indigenous_People_Internal_Count,
            COUNT(CASE WHEN FIND_IN_SET("Indigenous People", csssum.vul_sector) THEN 1 END) AS Indigenous_People_Total_Count,

            COUNT(CASE WHEN ser.is_external = 1 AND IFNULL(csssum.vul_sector, "") = "" THEN 1 END) AS NA_External,
            COUNT(CASE WHEN ser.is_external = 0 AND IFNULL(csssum.vul_sector, "") = "" THEN 1 END) AS NA_Internal,
            COUNT(CASE WHEN IFNULL(csssum.vul_sector, "") = "" THEN 1 END) AS NA_Total
        ');

        // Set the joins
        $builder->join('tblquarters quar', 'quar.quarterid = csssum.quarterid', 'left');
        $builder->join('tblservices ser', 'ser.servicesid = csssum.servicesid', 'left');

        // Add where conditions
        $builder->where('csssum.year', $params['year']);

        if ($params['typeselector'] === 'semester') {
            if ($params['semesterid'] != 'all') {
                $builder->where('quar.semesterid', $params['semesterid']);
            }
        }

        if ($params['typeselector'] === 'quarter') {
            $builder->where('csssum.quarterid', $params['quarterid']);
        }

        if ($params['officeid'] != 'all') {
            $builder->where('csssum.officeid', $params['officeid']);
        }

        // Execute the query
        $query = $builder->get();

        return $query->getRowArray();
    }

     public function gen_comments($params){
        $builder = $this->db->table('tblservices sera');
        $builder->select('sera.servicesid, sera.name, sera.unit, GROUP_CONCAT( DISTINCT sqd.suggestions SEPARATOR ";;") AS aggregated_suggestions');
        $builder->join('tblcss_summary csssum', 'csssum.servicesid = sera.servicesid', 'inner');
        $builder->join('tblcss_details_sqd sqd', 'sqd.csssummaryid = csssum.csssummaryid', 'inner');
        $builder->join('tblquarters qua', 'qua.quarterid = csssum.quarterid', 'inner');
        $builder->where('sqd.suggestions !=', '');
        $builder->where('csssum.year', $params['year']);

        // Add conditions based on parameters
        if ($params['typeselector'] === 'semester' && $params['semesterid'] != 'all') {
            $builder->where('qua.semesterid', $params['semesterid']);
        }
        if ($params['typeselector'] === 'quarter') {
            $builder->where('csssum.quarterid', $params['quarterid']);
        }
        if ($params['officeid'] != 'all') {
            $builder->where('csssum.officeid', $params['officeid']);
        }

        $builder->groupBy('sera.servicesid');

        $query = $builder->get();

        return $query->getResultArray();

    }

    public function gen_services_external($params, $is_external){

        $quarteridExt = $semesteridExt = $officeidExt = '';
        
        if ($params['typeselector'] === 'semester') {
            if ($params['semesterid'] != 'all') {
                $semesteridExt = " AND qua.semesterid = ".$params['semesterid'];
            }
        }

        if ($params['typeselector'] === 'quarter') {
            $quarteridExt = " AND csssum.quarterid = ".$params['quarterid'];
        }

       
        if ($params['officeid'] != 'all') {
            $officeidExt = " AND csssum.officeid = ".$params['officeid'];
        }

        $query = $this->db->query("SELECT 
            ser.servicesid,
            ser.name,
            ser.unit,
            ser.is_cc,
            COALESCE(sc.xcount, 0) AS xcount,
            tc.total_xcount,
            ROUND(COALESCE(sc.xcount, 0) / NULLIF(tc.total_xcount, 0) * 100, 1) AS percentx,
            COALESCE(vc.vs_xcount, 0) AS vs_xcount,
            COALESCE(xx.xx, 0) AS xx,
            (
                SELECT 
                    CONCAT(GROUP_CONCAT(IF(csssqd.suggestions != '', CONCAT(csssqd.suggestions), NULL) SEPARATOR ';;'))
                FROM tblcss_details_sqd csssqd 
                JOIN tblcss_summary csssum ON csssum.csssummaryid = csssqd.csssummaryid 
                JOIN tblquarters qua ON qua.quarterid = csssum.quarterid
                WHERE csssum.servicesid = ser.servicesid AND csssum.year = ".$params['year'] . $semesteridExt . $quarteridExt . $officeidExt ."
            ) AS comments
        FROM tblservices ser
        LEFT JOIN (
            SELECT servicesid, COUNT(*) AS xcount
            FROM (
                SELECT csssum.servicesid, csssum.quarterid, qua.semesterid, csssum.year, sqd.sqd0
                FROM tblcss_summary csssum
                JOIN tblquarters qua ON qua.quarterid = csssum.quarterid
                LEFT JOIN tblcss_details_sqd sqd ON sqd.csssummaryid = csssum.csssummaryid
                WHERE csssum.year = ".$params['year'] . $semesteridExt . $quarteridExt . $officeidExt
            .") AS css_summary
            GROUP BY servicesid
        ) AS sc ON ser.servicesid = sc.servicesid
        LEFT JOIN (
            SELECT COUNT(*) AS total_xcount
            FROM (
                SELECT csssum.servicesid, csssum.quarterid, qua.semesterid, csssum.year, sqd.sqd0
                FROM tblcss_summary csssum
                JOIN tblquarters qua ON qua.quarterid = csssum.quarterid
                LEFT JOIN tblcss_details_sqd sqd ON sqd.csssummaryid = csssum.csssummaryid
                WHERE csssum.year = ".$params['year']. $semesteridExt . $quarteridExt . $officeidExt
                .") AS css_summary
            JOIN tblservices serx ON serx.servicesid = css_summary.servicesid
            WHERE serx.is_external = ".$is_external.") AS tc ON 1=1
        LEFT JOIN (
            SELECT servicesid, COUNT(*) AS vs_xcount
            FROM (
                SELECT csssum.servicesid, csssum.quarterid, qua.semesterid, csssum.year, sqd.sqd0
                FROM tblcss_summary csssum
                JOIN tblquarters qua ON qua.quarterid = csssum.quarterid
                LEFT JOIN tblcss_details_sqd sqd ON sqd.csssummaryid = csssum.csssummaryid
                WHERE csssum.year = ".$params['year'] . $semesteridExt . $quarteridExt . $officeidExt
                .") AS css_summary
            WHERE sqd0 >= 4
            GROUP BY servicesid
        ) AS vc ON ser.servicesid = vc.servicesid
        LEFT JOIN (
            SELECT servicesid, ROUND(IFNULL( SUM(CASE WHEN sqd0 >= 4 THEN 5 ELSE sqd0 END) / NULLIF(COUNT(*), 0), 0) * 20, 1) AS xx
            FROM (
                SELECT csssum.servicesid, csssum.quarterid, qua.semesterid, csssum.year, sqd.sqd0
                FROM tblcss_summary csssum
                JOIN tblquarters qua ON qua.quarterid = csssum.quarterid
                LEFT JOIN tblcss_details_sqd sqd ON sqd.csssummaryid = csssum.csssummaryid
                WHERE csssum.year = ".$params['year']. $semesteridExt . $quarteridExt . $officeidExt
                .") AS css_summary
            GROUP BY servicesid
        ) AS xx ON ser.servicesid = xx.servicesid
        WHERE ser.is_external = ".$is_external." AND ser.is_active = 1");

        return $query->getResultArray();
    }

    public function gen_services($params,$is_external){

        $quarteridExt = $semesteridExt = '';
        
        if ($params['typeselector'] === 'semester') {
            if ($params['semesterid'] != 'all') {
                $semesteridExt = " AND qua.semesterid = ".$params['semesterid'];
            }
        }

        if ($params['typeselector'] === 'quarter') {
            $quarteridExt = " AND csssum.quarterid = ".$params['quarterid'];
        }

        $query = $this->db->query("SELECT 
            ser.servicesid,
            ser.name,
            ser.unit,
            ser.is_cc,
            COALESCE(sc.xcount, 0) AS xcount,
            tc.total_xcount,
            ROUND(COALESCE(sc.xcount, 0) / NULLIF(tc.total_xcount, 0) * 100, 1) AS percentx,
            COALESCE(vc.vs_xcount, 0) AS vs_xcount,
            COALESCE(xx.xx, 0) AS xx,
            (
                SELECT 
                    CONCAT(GROUP_CONCAT(IF(csssqd.suggestions != '', CONCAT(csssqd.suggestions), NULL) SEPARATOR ';;'))
                FROM tblcss_details_sqd csssqd 
                JOIN tblcss_summary csssum ON csssum.csssummaryid = csssqd.csssummaryid
                JOIN tblquarters qua ON qua.quarterid = csssum.quarterid
                WHERE csssum.servicesid = ser.servicesid AND csssum.year = ".$params['year'] . $semesteridExt . $quarteridExt ."
            ) AS comments
        FROM tblservices ser
        LEFT JOIN (
            SELECT servicesid, COUNT(*) AS xcount
            FROM (
                SELECT csssum.servicesid, csssum.quarterid, qua.semesterid, csssum.year, sqd.sqd0
                FROM tblcss_summary csssum
                JOIN tblquarters qua ON qua.quarterid = csssum.quarterid
                LEFT JOIN tblcss_details_sqd sqd ON sqd.csssummaryid = csssum.csssummaryid
                WHERE csssum.year = ".$params['year'] . $semesteridExt . $quarteridExt
            .") AS css_summary
            GROUP BY servicesid
        ) AS sc ON ser.servicesid = sc.servicesid
        LEFT JOIN (
            SELECT COUNT(*) AS total_xcount
            FROM (
                SELECT csssum.servicesid, csssum.quarterid, qua.semesterid, csssum.year, sqd.sqd0
                FROM tblcss_summary csssum
                JOIN tblquarters qua ON qua.quarterid = csssum.quarterid
                LEFT JOIN tblcss_details_sqd sqd ON sqd.csssummaryid = csssum.csssummaryid
                WHERE csssum.year = ".$params['year']. $semesteridExt . $quarteridExt
                .") AS css_summary
            JOIN tblservices serx ON serx.servicesid = css_summary.servicesid
            WHERE serx.is_external = ".$is_external.") AS tc ON 1=1
        LEFT JOIN (
            SELECT servicesid, COUNT(*) AS vs_xcount
            FROM (
                SELECT csssum.servicesid, csssum.quarterid, qua.semesterid, csssum.year, sqd.sqd0
                FROM tblcss_summary csssum
                JOIN tblquarters qua ON qua.quarterid = csssum.quarterid
                LEFT JOIN tblcss_details_sqd sqd ON sqd.csssummaryid = csssum.csssummaryid
                WHERE csssum.year = ".$params['year'] . $semesteridExt . $quarteridExt
                .") AS css_summary
            WHERE sqd0 >= 4
            GROUP BY servicesid
        ) AS vc ON ser.servicesid = vc.servicesid
        LEFT JOIN (
            SELECT servicesid, ROUND(IFNULL( SUM(CASE WHEN sqd0 >= 4 THEN 5 ELSE sqd0 END) / NULLIF(COUNT(*), 0), 0) * 20, 1) AS xx
            FROM (
                SELECT csssum.servicesid, csssum.quarterid, qua.semesterid, csssum.year, sqd.sqd0
                FROM tblcss_summary csssum
                JOIN tblquarters qua ON qua.quarterid = csssum.quarterid
                LEFT JOIN tblcss_details_sqd sqd ON sqd.csssummaryid = csssum.csssummaryid
                WHERE csssum.year = ".$params['year']. $semesteridExt . $quarteridExt
                .") AS css_summary
            GROUP BY servicesid
        ) AS xx ON ser.servicesid = xx.servicesid
        WHERE ser.is_external = ".$is_external." AND ser.is_active = 1");

        return $query->getResultArray();
    }

    public function gen_cc($params) {
        
        
        // Build the query
        $builder = $this->db->table('tblcss_details_cc cc');
        $builder->select('
            COUNT(CASE WHEN cc1 = 4 THEN 1 END) AS 4_CC1,
            COUNT(CASE WHEN cc1 = 3 THEN 1 END) AS 3_CC1,
            COUNT(CASE WHEN cc1 = 2 THEN 1 END) AS 2_CC1,
            COUNT(CASE WHEN cc1 = 1 THEN 1 END) AS 1_CC1,
            COUNT(cc1) AS Total_CC1,
            COUNT(CASE WHEN cc2 = 4 THEN 1 END) AS 4_CC2,
            COUNT(CASE WHEN cc2 = 3 THEN 1 END) AS 3_CC2,
            COUNT(CASE WHEN cc2 = 2 THEN 1 END) AS 2_CC2,
            COUNT(CASE WHEN cc2 = 1 THEN 1 END) AS 1_CC2,
            COUNT(cc2) AS Total_CC2,
            COUNT(CASE WHEN cc3 = 3 THEN 1 END) AS 3_CC3,
            COUNT(CASE WHEN cc3 = 2 THEN 1 END) AS 2_CC3,
            COUNT(CASE WHEN cc3 = 1 THEN 1 END) AS 1_CC3,
            COUNT(cc3) AS Total_CC3
        ');
    
        // Set the joins
        $builder->join('tblcss_summary csssum', 'csssum.csssummaryid = cc.csssummaryid', 'left');
        $builder->join('tblquarters quar', 'quar.quarterid = csssum.quarterid', 'left');
        $builder->join('tblservices ser', 'ser.servicesid = csssum.servicesid', 'left');
    
        // Add where conditions
        $builder->where('csssum.year', $params['year']);
    
        if ($params['typeselector'] === 'semester') {
            if ($params['semesterid'] != 'all') {
                $builder->where('quar.semesterid', $params['semesterid']);
            }
        }
    
        if ($params['typeselector'] === 'quarter') {
            $builder->where('csssum.quarterid', $params['quarterid']);
        }
    
        if ($params['officeid'] != 'all') {
            $builder->where('csssum.officeid', $params['officeid']);
        }
    
        // Execute the query
        $query = $builder->get();
    
        return $query->getRowArray();
    }

    public function gen_sqd($params) {
        // Build the query
        $builder = $this->db->table('tblcss_details_sqd sqd');
        $builder->select('
            COUNT(CASE WHEN SQD0 = 5 THEN 1 END) AS 5_SQD0,
            COUNT(CASE WHEN SQD0 = 4 THEN 1 END) AS 4_SQD0,
            COUNT(CASE WHEN SQD0 = 3 THEN 1 END) AS 3_SQD0,
            COUNT(CASE WHEN SQD0 = 2 THEN 1 END) AS 2_SQD0,
            COUNT(CASE WHEN SQD0 = 1 THEN 1 END) AS 1_SQD0,
            COUNT(SQD0) AS Total_SQD0,
            COUNT(CASE WHEN SQD1 = 5 THEN 1 END) AS 5_SQD1,
            COUNT(CASE WHEN SQD1 = 4 THEN 1 END) AS 4_SQD1,
            COUNT(CASE WHEN SQD1 = 3 THEN 1 END) AS 3_SQD1,
            COUNT(CASE WHEN SQD1 = 2 THEN 1 END) AS 2_SQD1,
            COUNT(CASE WHEN SQD1 = 1 THEN 1 END) AS 1_SQD1,
            COUNT(SQD1) AS Total_SQD1,
            COUNT(CASE WHEN SQD2 = 5 THEN 1 END) AS 5_SQD2,
            COUNT(CASE WHEN SQD2 = 4 THEN 1 END) AS 4_SQD2,
            COUNT(CASE WHEN SQD2 = 3 THEN 1 END) AS 3_SQD2,
            COUNT(CASE WHEN SQD2 = 2 THEN 1 END) AS 2_SQD2,
            COUNT(CASE WHEN SQD2 = 1 THEN 1 END) AS 1_SQD2,
            COUNT(SQD2) AS Total_SQD2,
            COUNT(CASE WHEN SQD3 = 5 THEN 1 END) AS 5_SQD3,
            COUNT(CASE WHEN SQD3 = 4 THEN 1 END) AS 4_SQD3,
            COUNT(CASE WHEN SQD3 = 3 THEN 1 END) AS 3_SQD3,
            COUNT(CASE WHEN SQD3 = 2 THEN 1 END) AS 2_SQD3,
            COUNT(CASE WHEN SQD3 = 1 THEN 1 END) AS 1_SQD3,
            COUNT(SQD3) AS Total_SQD3,
            COUNT(CASE WHEN SQD4 = 5 THEN 1 END) AS 5_SQD4,
            COUNT(CASE WHEN SQD4 = 4 THEN 1 END) AS 4_SQD4,
            COUNT(CASE WHEN SQD4 = 3 THEN 1 END) AS 3_SQD4,
            COUNT(CASE WHEN SQD4 = 2 THEN 1 END) AS 2_SQD4,
            COUNT(CASE WHEN SQD4 = 1 THEN 1 END) AS 1_SQD4,
            COUNT(SQD4) AS Total_SQD4,
            COUNT(CASE WHEN SQD5 = 5 THEN 1 END) AS 5_SQD5,
            COUNT(CASE WHEN SQD5 = 4 THEN 1 END) AS 4_SQD5,
            COUNT(CASE WHEN SQD5 = 3 THEN 1 END) AS 3_SQD5,
            COUNT(CASE WHEN SQD5 = 2 THEN 1 END) AS 2_SQD5,
            COUNT(CASE WHEN SQD5 = 1 THEN 1 END) AS 1_SQD5,
            COUNT(SQD5) AS Total_SQD5,
            COUNT(CASE WHEN SQD6 = 5 THEN 1 END) AS 5_SQD6,
            COUNT(CASE WHEN SQD6 = 4 THEN 1 END) AS 4_SQD6,
            COUNT(CASE WHEN SQD6 = 3 THEN 1 END) AS 3_SQD6,
            COUNT(CASE WHEN SQD6 = 2 THEN 1 END) AS 2_SQD6,
            COUNT(CASE WHEN SQD6 = 1 THEN 1 END) AS 1_SQD6,
            COUNT(SQD6) AS Total_SQD6,
            COUNT(CASE WHEN SQD7 = 5 THEN 1 END) AS 5_SQD7,
            COUNT(CASE WHEN SQD7 = 4 THEN 1 END) AS 4_SQD7,
            COUNT(CASE WHEN SQD7 = 3 THEN 1 END) AS 3_SQD7,
            COUNT(CASE WHEN SQD7 = 2 THEN 1 END) AS 2_SQD7,
            COUNT(CASE WHEN SQD7 = 1 THEN 1 END) AS 1_SQD7,
            COUNT(SQD7) AS Total_SQD7,
            COUNT(CASE WHEN SQD8 = 5 THEN 1 END) AS 5_SQD8,
            COUNT(CASE WHEN SQD8 = 4 THEN 1 END) AS 4_SQD8,
            COUNT(CASE WHEN SQD8 = 3 THEN 1 END) AS 3_SQD8,
            COUNT(CASE WHEN SQD8 = 2 THEN 1 END) AS 2_SQD8,
            COUNT(CASE WHEN SQD8 = 1 THEN 1 END) AS 1_SQD8,
            COUNT(SQD8) AS Total_SQD8,
            COUNT(CASE WHEN SQD9 = 5 THEN 1 END) AS 5_SQD9,
            COUNT(CASE WHEN SQD9 = 4 THEN 1 END) AS 4_SQD9,
            COUNT(CASE WHEN SQD9 = 3 THEN 1 END) AS 3_SQD9,
            COUNT(CASE WHEN SQD9 = 2 THEN 1 END) AS 2_SQD9,
            COUNT(CASE WHEN SQD9 = 1 THEN 1 END) AS 1_SQD9,
            COUNT(SQD9) AS Total_SQD9,
            COUNT(CASE WHEN SQD10 = 5 THEN 1 END) AS 5_SQD10,
            COUNT(CASE WHEN SQD10 = 4 THEN 1 END) AS 4_SQD10,
            COUNT(CASE WHEN SQD10 = 3 THEN 1 END) AS 3_SQD10,
            COUNT(CASE WHEN SQD10 = 2 THEN 1 END) AS 2_SQD10,
            COUNT(CASE WHEN SQD10 = 1 THEN 1 END) AS 1_SQD10,
            COUNT(SQD10) AS Total_SQD10
        ');

        // Set the joins
        $builder->join('tblcss_summary csssum', 'csssum.csssummaryid = sqd.csssummaryid', 'left');
        $builder->join('tblquarters quar', 'quar.quarterid = csssum.quarterid', 'left');
        $builder->join('tblservices ser', 'ser.servicesid = csssum.servicesid', 'left');

        // Add where conditions
        $builder->where('csssum.year', $params['year']);

        if ($params['typeselector'] === 'semester') {
            if ($params['semesterid'] != 'all') {
                $builder->where('quar.semesterid', $params['semesterid']);
            }
        }

        if ($params['typeselector'] === 'quarter') {
            $builder->where('csssum.quarterid', $params['quarterid']);
        }

        if ($params['officeid'] != 'all') {
            $builder->where('csssum.officeid', $params['officeid']);
        }

        // Execute the query
        $query = $builder->get();

        return $query->getRowArray();
    }
}
