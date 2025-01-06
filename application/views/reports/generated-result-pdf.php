<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

.text-center{
    text-align: center;
}
.table-full{
    width: 100%;
}
</style>
<div class="m-t-25">
<div class="text-center">
<span>Republic of the Philippines</span>
<h3>DEPARTMENT OF SCIENCE AND TECHNOLOGY</h3>
</div>

EXTERNAL AND INTERNAL CUSTOMER SATISFACTION SURVEY REPORT <br>
Year: <?=$params['year']?> <br>
<?php
        if ($params['typeselector'] == 'semester') {
            if ($params['semesterid'] != "all") {
                echo "Semester : ";
                if ($params['semesterid'] == 1) {
                    echo "1st Semester";
                }else{
                    echo "2nd Semester";
                }
            }
        }

        if ($params['typeselector'] == 'quarter') {
            echo "Quarter : ";
            switch ($params['quarterid']) {
                case 1:
                    echo "1st Quarter";
                    break;
                    case 2:
                        echo "2nd Quarter";
                        break;case 3:
                            echo "3rd Quarter";
                            break;case 4:
                                echo "4th Quarter";
                                break;
                default:
                    break;
            }
        }
    ?>
    <br>
Office: <?=$officename['name']?> <br>
    <h5>Part I. Respondents Demographic Profile</h5>
    <table class="table table-bordered table-full table-full">
        <thead>
            <tr class="text-center">
                <th></th>
                <th>External</th>
                <th>Internal</th>
                <th>Overall</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4"><b>Client Type</b></td>
            </tr>
            <?php
                            foreach ($clienttype as $clienttypeRow) { ?>
                                <tr>
                                    <td>
                                        <?php echo isset($clienttypeRow['name']) ? $clienttypeRow['name'] : ''; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $externalCount = isset($clienttypeRow['external_count']) ? $clienttypeRow['external_count'] : 0;
                                        $ctypeTotalExternal = isset($ctype_total_external) ? $ctype_total_external : 0;
                                        $percentExternal = $ctypeTotalExternal != 0 
                                            ? round(($externalCount / $ctypeTotalExternal) * 100, 1) 
                                            : 0;
                                        echo $externalCount . ' <small>(' . $percentExternal . '%)</small>';
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $internalCount = isset($clienttypeRow['internal_count']) ? $clienttypeRow['internal_count'] : 0;
                                        $ctypeTotalInternal = isset($ctype_total_internal) ? $ctype_total_internal : 0;
                                        $percentInternal = $ctypeTotalInternal != 0 
                                            ? round(($internalCount / $ctypeTotalInternal) * 100, 1) 
                                            : 0;
                                        echo $internalCount . ' <small>(' . $percentInternal . '%)</small>';
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $externalCount = isset($clienttypeRow['external_count']) ? $clienttypeRow['external_count'] : 0;
                                        $internalCount = isset($clienttypeRow['internal_count']) ? $clienttypeRow['internal_count'] : 0;
                                        $totalOverall = isset($clienttypeRow['total_overall']) ? $clienttypeRow['total_overall'] : 0;
                                        $totalPerCtype = isset($clienttypeRow['total_per_ctype']) ? $clienttypeRow['total_per_ctype'] : 0;
                                        $totalCount = $externalCount + $internalCount;
                                        $percentOverall = $totalOverall != 0 
                                            ? round(($totalPerCtype / $totalOverall) * 100, 1) 
                                            : 0;
                                        echo $totalCount . ' <small>(' . $percentOverall . '%)</small>';
                                        ?>
                                    </td>
                                </tr>

                                <?php
                            }
                        ?>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4"><b>Age Distribution</b></td>
            </tr>
            <?php
                            foreach ($agegroup as $agegroupRow) { ?>
                                <tr>
                                    <td>
                                        <?php echo isset($agegroupRow['agegroup']) ? $agegroupRow['agegroup'] : ''; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $externalCount = isset($agegroupRow['external_count']) ? $agegroupRow['external_count'] : 0;
                                        $ctypeTotalExternal = isset($ctype_total_external) ? $ctype_total_external : 0;
                                        $percentExternal = $ctypeTotalExternal != 0 
                                            ? round(($externalCount / $ctypeTotalExternal) * 100, 1) 
                                            : 0;
                                        echo $externalCount . ' <small>(' . $percentExternal . '%)</small>';
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $internalCount = isset($agegroupRow['internal_count']) ? $agegroupRow['internal_count'] : 0;
                                        $ctypeTotalInternal = isset($ctype_total_internal) ? $ctype_total_internal : 0;
                                        $percentInternal = $ctypeTotalInternal != 0 
                                            ? round(($internalCount / $ctypeTotalInternal) * 100, 1) 
                                            : 0;
                                        echo $internalCount . ' <small>(' . $percentInternal . '%)</small>';
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $externalCount = isset($agegroupRow['external_count']) ? $agegroupRow['external_count'] : 0;
                                        $internalCount = isset($agegroupRow['internal_count']) ? $agegroupRow['internal_count'] : 0;
                                        $totalOverall = isset($agegroupRow['total_overall']) ? $agegroupRow['total_overall'] : 0;
                                        $totalPerCtype = isset($agegroupRow['total_per_agegroup']) ? $agegroupRow['total_per_agegroup'] : 0;
                                        $totalCount = $externalCount + $internalCount;
                                        
                                        $percentOverall = $totalOverall != 0 
                                            ? round(($totalPerCtype / $totalOverall) * 100, 1) 
                                            : 0;
                                        
                                            echo $totalCount . ' <small>(' . $percentOverall . '%)</small>';
                                        ?>
                                    </td>
                                </tr>

                                <?php
                            }
                        ?>



        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4"><b>Vulnerable Sector Served</b></td>
        </tr>
        <tr>
    <td>Senior Citizen</td>
    <td class="text-center">
        <?php
        $senior_citizen_external_count = isset($vulsector['Senior_Citizen_External_Count']) ? $vulsector['Senior_Citizen_External_Count'] : 0;
        $external_total = isset($vulsector['external_total']) ? $vulsector['external_total'] : 0;
        $percent_external = $external_total != 0 ? round(($senior_citizen_external_count / $external_total) * 100, 1) : 0;
        echo $senior_citizen_external_count . ' <small>(' . $percent_external . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $senior_citizen_internal_count = isset($vulsector['Senior_Citizen_Internal_Count']) ? $vulsector['Senior_Citizen_Internal_Count'] : 0;
        $internal_total = isset($vulsector['internal_total']) ? $vulsector['internal_total'] : 0;
        $percent_internal = $internal_total != 0 ? round(($senior_citizen_internal_count / $internal_total) * 100, 1) : 0;
        echo $senior_citizen_internal_count . ' <small>(' . $percent_internal . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $senior_citizen_total_count = isset($vulsector['Senior_Citizen_Total_Count']) ? $vulsector['Senior_Citizen_Total_Count'] : 0;
        $overall_total = isset($vulsector['overall_total']) ? $vulsector['overall_total'] : 0;
        $percent_overall = $overall_total != 0 ? round(($senior_citizen_total_count / $overall_total) * 100, 1) : 0;
        echo $senior_citizen_total_count . ' <small>(' . $percent_overall . '%)</small>';
        ?>
    </td>
</tr>
<tr>
    <td>Persons with Disabilities</td>
    <td class="text-center">
        <?php
        $pwd_external_count = isset($vulsector['PWD_External_Count']) ? $vulsector['PWD_External_Count'] : 0;
        $external_total = isset($vulsector['external_total']) ? $vulsector['external_total'] : 0;
        $percent_external = $external_total != 0 ? round(($pwd_external_count / $external_total) * 100, 1) : 0;
        echo $pwd_external_count . ' <small>(' . $percent_external . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $pwd_internal_count = isset($vulsector['PWD_Internal_Count']) ? $vulsector['PWD_Internal_Count'] : 0;
        $internal_total = isset($vulsector['internal_total']) ? $vulsector['internal_total'] : 0;
        $percent_internal = $internal_total != 0 ? round(($pwd_internal_count / $internal_total) * 100, 1) : 0;
        echo $pwd_internal_count . ' <small>(' . $percent_internal . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $pwd_total_count = isset($vulsector['PWD_Total_Count']) ? $vulsector['PWD_Total_Count'] : 0;
        $overall_total = isset($vulsector['overall_total']) ? $vulsector['overall_total'] : 0;
        $percent_overall = $overall_total != 0 ? round(($pwd_total_count / $overall_total) * 100, 1) : 0;
        echo $pwd_total_count . ' <small>(' . $percent_overall . '%)</small>';
        ?>
    </td>
</tr>
<tr>
    <td>4Ps Beneficiaries</td>
    <td class="text-center">
        <?php
        $beneficiaries_external_count = isset($vulsector['4Ps_Beneficiaries_External_Count']) ? $vulsector['4Ps_Beneficiaries_External_Count'] : 0;
        $external_total = isset($vulsector['external_total']) ? $vulsector['external_total'] : 0;
        $percent_external = $external_total != 0 ? round(($beneficiaries_external_count / $external_total) * 100, 1) : 0;
        echo $beneficiaries_external_count . ' <small>(' . $percent_external . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $beneficiaries_internal_count = isset($vulsector['4Ps_Beneficiaries_Internal_Count']) ? $vulsector['4Ps_Beneficiaries_Internal_Count'] : 0;
        $internal_total = isset($vulsector['internal_total']) ? $vulsector['internal_total'] : 0;
        $percent_internal = $internal_total != 0 ? round(($beneficiaries_internal_count / $internal_total) * 100, 1) : 0;
        echo $beneficiaries_internal_count . ' <small>(' . $percent_internal . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $beneficiaries_total_count = isset($vulsector['4Ps_Beneficiaries_Total_Count']) ? $vulsector['4Ps_Beneficiaries_Total_Count'] : 0;
        $overall_total = isset($vulsector['overall_total']) ? $vulsector['overall_total'] : 0;
        $percent_overall = $overall_total != 0 ? round(($beneficiaries_total_count / $overall_total) * 100, 1) : 0;
        echo $beneficiaries_total_count . ' <small>(' . $percent_overall . '%)</small>';
        ?>
    </td>
</tr>
<tr>
    <td>Indigenous People</td>
    <td class="text-center">
        <?php
        $indigenous_external_count = isset($vulsector['Indigenous_People_External_Count']) ? $vulsector['Indigenous_People_External_Count'] : 0;
        $external_total = isset($vulsector['external_total']) ? $vulsector['external_total'] : 0;
        $percent_external = $external_total != 0 ? round(($indigenous_external_count / $external_total) * 100, 1) : 0;
        echo $indigenous_external_count . ' <small>(' . $percent_external . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $indigenous_internal_count = isset($vulsector['Indigenous_People_Internal_Count']) ? $vulsector['Indigenous_People_Internal_Count'] : 0;
        $internal_total = isset($vulsector['internal_total']) ? $vulsector['internal_total'] : 0;
        $percent_internal = $internal_total != 0 ? round(($indigenous_internal_count / $internal_total) * 100, 1) : 0;
        echo $indigenous_internal_count . ' <small>(' . $percent_internal . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $indigenous_total_count = isset($vulsector['Indigenous_People_Total_Count']) ? $vulsector['Indigenous_People_Total_Count'] : 0;
        $overall_total = isset($vulsector['overall_total']) ? $vulsector['overall_total'] : 0;
        $percent_overall = $overall_total != 0 ? round(($indigenous_total_count / $overall_total) * 100, 1) : 0;
        echo $indigenous_total_count . ' <small>(' . $percent_overall . '%)</small>';
        ?>
    </td>
</tr>
<tr>
    <td>Did Not Specify</td>
    <td class="text-center">
        <?php
        $na_external = isset($vulsector['NA_External']) ? $vulsector['NA_External'] : 0;
        $external_total = isset($vulsector['external_total']) ? $vulsector['external_total'] : 0;
        $percent_external = $external_total != 0 ? round(($na_external / $external_total) * 100, 1) : 0;
        echo $na_external . ' <small>(' . $percent_external . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $na_internal = isset($vulsector['NA_Internal']) ? $vulsector['NA_Internal'] : 0;
        $internal_total = isset($vulsector['internal_total']) ? $vulsector['internal_total'] : 0;
        $percent_internal = $internal_total != 0 ? round(($na_internal / $internal_total) * 100, 1) : 0;
        echo $na_internal . ' <small>(' . $percent_internal . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $na_total = isset($vulsector['NA_Total']) ? $vulsector['NA_Total'] : 0;
        $overall_total = isset($vulsector['overall_total']) ? $vulsector['overall_total'] : 0;
        $percent_overall = $overall_total != 0 ? round(($na_total / $overall_total) * 100, 1) : 0;
        echo $na_total . ' <small>(' . $percent_overall . '%)</small>';
        ?>
    </td>
</tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4"><b>Sex</b></td>
        </tr>
        <tr>
    <td>Male</td>
    <td class="text-center">
        <?php
        $external_male = isset($sex['external_male']) ? $sex['external_male'] : 0;
        $total_external = isset($sex['total_external']) ? $sex['total_external'] : 0;
        $percent_external = $total_external != 0 ? round(($external_male / $total_external) * 100, 1) : 0;
        echo $external_male . ' <small>(' . $percent_external . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $internal_male = isset($sex['internal_male']) ? $sex['internal_male'] : 0;
        $total_internal = isset($sex['total_internal']) ? $sex['total_internal'] : 0;
        $percent_internal = $total_internal != 0 ? round(($internal_male / $total_internal) * 100, 1) : 0;
        echo $internal_male . ' <small>(' . $percent_internal . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $total_male = isset($sex['total_male']) ? $sex['total_male'] : 0;
        $all_total = isset($sex['all_total']) ? $sex['all_total'] : 0;
        $percent_all = $all_total != 0 ? round(($total_male / $all_total) * 100, 1) : 0;
        echo $total_male . ' <small>(' . $percent_all . '%)</small>';
        ?>
    </td>
</tr>
<tr>
    <td>Female</td>
    <td class="text-center">
        <?php
        $external_female = isset($sex['external_female']) ? $sex['external_female'] : 0;
        $total_external = isset($sex['total_external']) ? $sex['total_external'] : 0;
        $percent_external = $total_external != 0 ? round(($external_female / $total_external) * 100, 1) : 0;
        echo $external_female . ' <small>(' . $percent_external . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $internal_female = isset($sex['internal_female']) ? $sex['internal_female'] : 0;
        $total_internal = isset($sex['total_internal']) ? $sex['total_internal'] : 0;
        $percent_internal = $total_internal != 0 ? round(($internal_female / $total_internal) * 100, 1) : 0;
        echo $internal_female . ' <small>(' . $percent_internal . '%)</small>';
        ?>
    </td>
    <td class="text-center">
        <?php
        $total_female = isset($sex['total_female']) ? $sex['total_female'] : 0;
        $all_total = isset($sex['all_total']) ? $sex['all_total'] : 0;
        $percent_all = $all_total != 0 ? round(($total_female / $all_total) * 100, 1) : 0;
        echo $total_female . ' <small>(' . $percent_all . '%)</small>';
        ?>
    </td>
</tr>
        </tbody>
    </table>

    <h5>Part II. Results of Citizen's Charter Questions</h5>
    <table class="table table-bordered table-full">
        <thead>
            <tr>
                <th>Citizen's Charter Answers</th>
                <th class="text-center">Responses</th>
                <th class="text-center">Percentage</th>
            </tr>
        </thead>
        <tbody>
    <tr>
        <td><b>CC1. Which of the following describes your awareness of the CC?</b></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>1. I know what a CC is and I saw this office's CC.</td>
        <td class="text-center">
            <?= isset($cc['4_CC1']) ? $cc['4_CC1'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_4 = isset($cc['4_CC1']) ? $cc['4_CC1'] : 0;
            $total_cc1 = isset($cc['Total_CC1']) ? $cc['Total_CC1'] : 0;
            $percent_cc_4 = $total_cc1 != 0 ? round(($cc_4 / $total_cc1) * 100, 1) : 0;
            echo $percent_cc_4 . '%';
            ?>
        </td>
    </tr>
    <tr>
        <td>2. I know what a CC is but I did not see this office's CC.</td>
        <td class="text-center">
            <?= isset($cc['3_CC1']) ? $cc['3_CC1'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_3 = isset($cc['3_CC1']) ? $cc['3_CC1'] : 0;
            $percent_cc_3 = $total_cc1 != 0 ? round(($cc_3 / $total_cc1) * 100, 1) : 0;
            echo $percent_cc_3 . '%';
            ?>
        </td>
    </tr>
    <tr>
        <td>3. I learned of the CC only when I saw this office's CC.</td>
        <td class="text-center">
            <?= isset($cc['2_CC1']) ? $cc['2_CC1'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_2 = isset($cc['2_CC1']) ? $cc['2_CC1'] : 0;
            $percent_cc_2 = $total_cc1 != 0 ? round(($cc_2 / $total_cc1) * 100, 1) : 0;
            echo $percent_cc_2 . '%';
            ?>
        </td>
    </tr>
    <tr>
        <td>4. I do not know what a CC is and I did not see this office's CC.</td>
        <td class="text-center">
            <?= isset($cc['1_CC1']) ? $cc['1_CC1'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_1 = isset($cc['1_CC1']) ? $cc['1_CC1'] : 0;
            $percent_cc_1 = $total_cc1 != 0 ? round(($cc_1 / $total_cc1) * 100, 1) : 0;
            echo $percent_cc_1 . '%';
            ?>
        </td>
    </tr>
    <tr>
        <td><b>CC2. If aware of CC, would you say that the CC of this office was...?</b></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>1. Easy to see</td>
        <td class="text-center">
            <?= isset($cc['4_CC2']) ? $cc['4_CC2'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_4_cc2 = isset($cc['4_CC2']) ? $cc['4_CC2'] : 0;
            $total_cc2 = isset($cc['Total_CC2']) ? $cc['Total_CC2'] : 0;
            $percent_cc_4_cc2 = $total_cc2 != 0 ? round(($cc_4_cc2 / $total_cc2) * 100, 1) : 0;
            echo $percent_cc_4_cc2 . '%';
            ?>
        </td>
    </tr>
    <tr>
        <td>2. Somewhat easy to see</td>
        <td class="text-center">
            <?= isset($cc['3_CC2']) ? $cc['3_CC2'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_3_cc2 = isset($cc['3_CC2']) ? $cc['3_CC2'] : 0;
            $percent_cc_3_cc2 = $total_cc2 != 0 ? round(($cc_3_cc2 / $total_cc2) * 100, 1) : 0;
            echo $percent_cc_3_cc2 . '%';
            ?>
        </td>
    </tr>
    <tr>
        <td>3. Difficult to see</td>
        <td class="text-center">
            <?= isset($cc['2_CC2']) ? $cc['2_CC2'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_2_cc2 = isset($cc['2_CC2']) ? $cc['2_CC2'] : 0;
            $percent_cc_2_cc2 = $total_cc2 != 0 ? round(($cc_2_cc2 / $total_cc2) * 100, 1) : 0;
            echo $percent_cc_2_cc2 . '%';
            ?>
        </td>
    </tr>
    <tr>
        <td>4. Not visible at all</td>
        <td class="text-center">
            <?= isset($cc['1_CC2']) ? $cc['1_CC2'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_1_cc2 = isset($cc['1_CC2']) ? $cc['1_CC2'] : 0;
            $percent_cc_1_cc2 = $total_cc2 != 0 ? round(($cc_1_cc2 / $total_cc2) * 100, 1) : 0;
            echo $percent_cc_1_cc2 . '%';
            ?>
        </td>
    </tr>
    <tr>
        <td><b>CC3. If aware of CC, how much did the CC help you in your transaction?</b></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>1. Helped very much</td>
        <td class="text-center">
            <?= isset($cc['3_CC3']) ? $cc['3_CC3'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_3_cc3 = isset($cc['3_CC3']) ? $cc['3_CC3'] : 0;
            $total_cc3 = isset($cc['Total_CC3']) ? $cc['Total_CC3'] : 0;
            $percent_cc_3_cc3 = $total_cc3 != 0 ? round(($cc_3_cc3 / $total_cc3) * 100, 1) : 0;
            echo $percent_cc_3_cc3 . '%';
            ?>
        </td>
    </tr>
    <tr>
        <td>2. Somewhat helped</td>
        <td class="text-center">
            <?= isset($cc['2_CC3']) ? $cc['2_CC3'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_2_cc3 = isset($cc['2_CC3']) ? $cc['2_CC3'] : 0;
            $percent_cc_2_cc3 = $total_cc3 != 0 ? round(($cc_2_cc3 / $total_cc3) * 100, 1) : 0;
            echo $percent_cc_2_cc3 . '%';
            ?>
        </td>
    </tr>
    <tr>
        <td>3. Did not help</td>
        <td class="text-center">
            <?= isset($cc['1_CC3']) ? $cc['1_CC3'] : 0 ?>
        </td>
        <td class="text-center">
            <?php
            $cc_1_cc3 = isset($cc['1_CC3']) ? $cc['1_CC3'] : 0;
            $percent_cc_1_cc3 = $total_cc3 != 0 ? round(($cc_1_cc3 / $total_cc3) * 100, 1) : 0;
            echo $percent_cc_1_cc3 . '%';
            ?>
        </td>
    </tr>
</tbody>

    </table>
    <h5>Part III. Score Per Service</h5>
    <table class="table table-bordered table-full">
        <thead>
            <tr class="text-center">
                <th>Services</th>
                <th>No. of Respondents</th>
                <th>% share to overall <br> no. of responses</th>
                <th>No. of Responses with rating <br> of VS and above*</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan=5><strong>External Services</strong></td>
            </tr>
            <?php foreach ($services_external as $services_externalRow) { ?>
                <tr>
                    <td><?php echo $services_externalRow['name'] . ($services_externalRow['unit'] ? " - " : '') . $services_externalRow['unit'] . ($services_externalRow['is_cc'] == 1 ? "*" : ''); ?></td>
                    <td class="text-center"><?=$services_externalRow['xcount']?></td>
                    <td class="text-center"><?=$services_externalRow['percentx']."%"?></td>
                    <td class="text-center"><?=$services_externalRow['vs_xcount']?></td>
                    <td class="text-center"><?=$services_externalRow['xx']."%"?></td>
                </tr>
            <?php }?>
            <tr>
                <td colspan=5><strong>Internal Services</strong></td>
            </tr>
            <?php foreach ($services_internal as $services_internalRow) { ?>
                <tr>
                    <td><?php echo $services_internalRow['name'] . ($services_internalRow['name'] && $services_internalRow['unit'] ? " - " : '') . $services_internalRow['unit'] . ($services_internalRow['is_cc'] == 1 ? "*" : ''); ?></td>
                    <td class="text-center"><?=$services_internalRow['xcount']?></td>
                    <td class="text-center"><?=$services_internalRow['percentx']."%"?></td>
                    <td class="text-center"><?=$services_internalRow['vs_xcount']?></td>
                    <td class="text-center"><?=$services_internalRow['xx']."%"?></td>
                </tr>
            <?php }?>
        </tbody>
    </table>
    <h5>Part IV. Results of Service Quality Dimensions</h5>
    <table class="table table-bordered table-full" style="margin-bottom: 30px;">
        <thead>
            <tr class="text-center">
                <th>Service Quality Dimensions</th>
                <th>Strongly Agree</th>
                <th>Agree</th>
                <th>Neither Agree or Disagree</th>
                <th>Disagree</th>
                <th>Strongly Disagree</th>
                <th>Total Responses</th>
                <th>Overall</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">SQD0</td>
                <?php 
    // Loop through values from 5 to 1
    for ($i = 5; $i >= 1; $i--) { 
        // Print the count for each category
        $key = $i . '_SQD0';
        $count = isset($sqd[$key]) ? $sqd[$key] : 0;
        echo '<td class="text-center">' . $count . '</td>';
    } 
    ?>
    <td class="text-center">
        <?= isset($sqd['Total_SQD0']) ? $sqd['Total_SQD0'] : 0 ?>
    </td>
                <td class="text-center">
                    <?php $highest_possible_score = $sqd['Total_SQD0']*5;
                            $xtotal = 0;
                            for ($i=1; $i <= 5; $i++) { 
                                $xtotal += $sqd[$i.'_SQD0']*$i;
                            }

                            $sqd0_percentage = ($highest_possible_score != 0) ? round(($xtotal / $highest_possible_score) * 100, 1) : 0;
                            echo $sqd0_percentage . '%';
                        ?>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-full">
        <thead>
            <tr class="text-center">
                <th>Service Quality Dimensions</th>
                <th>Strongly Agree</th>
                <th>Agree</th>
                <th>Neither Agree or Disagree</th>
                <th>Disagree</th>
                <th>Strongly Disagree</th>
                <th>Total Responses</th>
                <th>Overall</th>
            </tr>
        </thead>
        <tbody>
        <?php
            function generateRow($title, $sqd, $sqdKey) {
                ?>
                                       <tr>
    <td><?= $title ?></td>
    <?php for ($i = 5; $i >= 1; $i--) { ?>
        <td class="text-center"><?= isset($sqd[$i . '_' . $sqdKey]) ? $sqd[$i . '_' . $sqdKey] : 0 ?></td>
    <?php } ?>
    <td class="text-center"><?= isset($sqd['Total_' . $sqdKey]) ? $sqd['Total_' . $sqdKey] : 0 ?></td>
    <td class="text-center">
        <?php 
        $xsum = 0;
        for ($i = 5; $i >= 1; $i--) {
            $temp = $i * (isset($sqd[$i . '_' . $sqdKey]) ? $sqd[$i . '_' . $sqdKey] : 0);
            $xsum += $temp;
        }
        $total = isset($sqd['Total_' . $sqdKey]) ? $sqd['Total_' . $sqdKey] : 0;
        $max_possible_score = $total * 5;
        $percentage = ($max_possible_score != 0) ? round(($xsum / $max_possible_score) * 100, 1) : 0;
        echo $percentage . '%';
        ?>
    </td>
</tr>
                <?php
            }
            ?>

                <!-- Usage Example -->
                <?php
                generateRow('Responsiveness', $sqd, 'SQD1');
                generateRow('Reliability', $sqd, 'SQD2');
                generateRow('Access and Facilities', $sqd, 'SQD3');
                generateRow('Communication', $sqd, 'SQD4');
                generateRow('Costs', $sqd, 'SQD5');
                generateRow('Integrity', $sqd, 'SQD6');
                generateRow('Assurance', $sqd, 'SQD7');
                generateRow('Outcome', $sqd, 'SQD8');
                ?>
            <tr>
    <td><b>Overall</b></td>
    <td class="text-center">
        <?php 
        $overall_sum = $sum_5 = 0; 
        for ($i = 1; $i <= 8; $i++) { 
            $sum_5 += isset($sqd['5_SQD' . $i]) ? $sqd['5_SQD' . $i] : 0;
        } 
        $overall_sum += $sum_5; 
        ?>
        <strong><?= $sum_5 ?></strong>
    </td>
    <td class="text-center">
        <?php 
        $sum_4 = 0; 
        for ($i = 1; $i <= 8; $i++) { 
            $sum_4 += isset($sqd['4_SQD' . $i]) ? $sqd['4_SQD' . $i] : 0;
        } 
        $overall_sum += $sum_4;
        ?>
        <strong><?= $sum_4 ?></strong>
    </td>
    <td class="text-center">
        <?php 
        $sum_3 = 0; 
        for ($i = 1; $i <= 8; $i++) { 
            $sum_3 += isset($sqd['3_SQD' . $i]) ? $sqd['3_SQD' . $i] : 0;
        } 
        $overall_sum += $sum_3;
        ?>
        <strong><?= $sum_3 ?></strong>
    </td>
    <td class="text-center">
        <?php 
        $sum_2 = 0; 
        for ($i = 1; $i <= 8; $i++) { 
            $sum_2 += isset($sqd['2_SQD' . $i]) ? $sqd['2_SQD' . $i] : 0;
        } 
        $overall_sum += $sum_2; 
        ?>
        <strong><?= $sum_2 ?></strong>
    </td>
    <td class="text-center">
        <?php 
        $sum_1 = 0; 
        for ($i = 1; $i <= 8; $i++) { 
            $sum_1 += isset($sqd['1_SQD' . $i]) ? $sqd['1_SQD' . $i] : 0;
        } 
        $overall_sum += $sum_1;
        ?>
        <strong><?= $sum_1 ?></strong>
    </td>
    <td class="text-center">
        <strong><?= $overall_sum ?></strong>
    </td>
    <td class="text-center">
        <strong>
        <?php 
        $highest_possible_score = $overall_sum * 5;
        $xtotal = 0;
        for ($i = 1; $i <= 5; $i++) { 
            $xtotal += ${'sum_' . $i} * $i;
        }
        $percentage = ($highest_possible_score != 0) ? round(($xtotal / $highest_possible_score) * 100, 1) : 0;
        echo $percentage . '%';
        ?>
        </strong>
    </td>
</tr>

        </tbody>
    </table>
    <h5>Part V. Repondents Demographic Profile</h5>
    <p><?=$officename['name']?> Overall Customer Satisfaction  Rating for
    
    <?php
        if ($params['typeselector'] == 'semester') {
            if ($params['semesterid'] != "all") {
                if ($params['semesterid'] == 1) {
                    echo "1st Semester -";
                }else{
                    echo "2nd Semester -";
                }
            }
        }

        if ($params['typeselector'] == 'quarter') {
            switch ($params['quarterid']) {
                case 1:
                    echo "1st Quarter -";
                    break;
                    case 2:
                        echo "2nd Quarter -";
                        break;case 3:
                            echo "3rd Quarter -";
                            break;case 4:
                                echo "4th Quarter -";
                                break;
                default:
                    break;
            }
        }
    ?>
    <?=$params['year']?> is <strong><?=$sqd0_percentage?>%</strong></p>

    <p><b>The interpretation of the results are as follows:</b></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Percentage</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Below 60.0%</td>
                <td>Poor</td>
            </tr>
            <tr>
                <td>60.0% - 79.9%</td>
                <td>Fair</td>
            </tr>
            <tr>
                <td>80.0% - 89.9%</td>
                <td>Satisfactory</td>
            </tr>
            <tr>
                <td>90.0% - 94.9%</td>
                <td>Very Satisfactory</td>
            </tr>
            <tr>
                <td>95% - 100%</td>
                <td>Outstanding</td>
            </tr>
        </tbody>
    </table>
    <h5>Annex. Comments or suggestions from the clients or customers.</h5>
</div>