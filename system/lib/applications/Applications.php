<?php

class SJB_Applications
{
    
    function getById($id)
    {
        $res = SJB_DB::query("select * from applications where id = ?s", $id);
        if (count($res) > 0)
            return array_shift($res);
        return false;
    }

    function getByJob($listing_id, $orderInfo = false, $score = false)
    {
        $order = SJB_Applications::generateOrderAndJoin($orderInfo);
        $apps = SJB_DB::query("select * from `applications` `a` {$order['join']} where `a`.`listing_id` = ?s  and `a`.`show_emp` = 1 {$order['order']}", $listing_id);
        if ($score) {
            foreach ($apps as $key => $app) {
                $jobInfo = SJB_ListingManager::getListingInfoBySID($app["listing_id"]);
                if (!empty($jobInfo['screening_questionnaire'])) {
                    $screening_questionnaire = SJB_ScreeningQuestionnaires::getInfoBySID($jobInfo['screening_questionnaire']);
                    $passing_score = 0;
                    switch ($screening_questionnaire['passing_score']) {
                        case 'acceptable':
                            $passing_score = 1;
                            break;
                        case 'good':
                            $passing_score = 2;
                            break;
                        case 'very_good':
                            $passing_score = 3;
                            break;
                        case 'excellent':
                            $passing_score = 4;
                            break;
                    }
                    if ($app['score'] < $passing_score && $score == "passed")
                        unset($apps[$key]);
                    elseif ($app['score'] > $passing_score && $score == "not_passed")
                        unset($apps[$key]);
                }
                else {
                    unset($apps[$key]);
                }
            }
        }
        return $apps;
    }

    function getByJobseeker($id, $orderInfo = false)
    {
        $order = SJB_Applications::generateOrderAndJoin($orderInfo);
        return SJB_DB::query("select a.* from `applications` a  {$order['join']} where a.`jobseeker_id` = ?s and `show_js` = 1 {$order['order']}", $id);
    }

    function generateOrderAndJoin($orderInfo = false)
    {
        $result['order'] = '';
        $result['join'] = '';
        if (isset($orderInfo['inner_join'])) {
            $result['join'] = " LEFT JOIN {$orderInfo['inner_join']['table']} ON  `{$orderInfo['inner_join']['table']}`.`{$orderInfo['inner_join']['field1']}`=a.`{$orderInfo['inner_join']['field2']}`";
            if (isset($orderInfo['sorting_field']))
                $result['order'] = " AND (`{$orderInfo['inner_join']['table']}`.`id`='{$orderInfo['sorting_field']}' OR `{$orderInfo['inner_join']['table']}`.`id` is NULL)  ORDER BY `{$orderInfo['inner_join']['table']}`.`value` {$orderInfo['sorting_order']}";
            if (isset($orderInfo['inner_join2'])) {
                $result['join'] .= " LEFT JOIN {$orderInfo['inner_join2']['table1']} ON  `{$orderInfo['inner_join2']['table1']}`.`{$orderInfo['inner_join2']['field1']}`=`{$orderInfo['inner_join2']['table2']}`.`{$orderInfo['inner_join2']['field2']}`";
                if (isset($orderInfo['sorting_field']))
                    $result['order'] = " AND (`{$orderInfo['inner_join2']['table1']}`.`id`='{$orderInfo['sorting_field']}' OR `{$orderInfo['inner_join2']['table1']}`.`id` is NULL)  ORDER BY `{$orderInfo['inner_join2']['table1']}`.`value` {$orderInfo['sorting_order']}";
            }
        }
        else {
            if (isset($orderInfo['sorting_field']))
                $result['order'] = 'ORDER BY a.`'.$orderInfo['sorting_field'].'` '.$orderInfo['sorting_order'];
            elseif (isset($orderInfo['sorting_fields']))
                $result['order'] = " ORDER BY a.`{$orderInfo['sorting_fields']['field1']}` a.`{$orderInfo['sorting_fields']['field2']}` {$orderInfo['sorting_order']}";
        }

        return $result;
    }

    function getByEmployer($companyId, $orderInfo, $score = false, $subuser = false)
    {
        $order = SJB_Applications::generateOrderAndJoin($orderInfo);
        $subuserFilter = '';
        if ($subuser !== false) {
            $subuserFilter = ' and `l`.`subuser_sid` = ' . SJB_DB::quote($subuser);
        }
        $apps = SJB_DB::query("
            select `a`.* from `applications` `a`
            inner join `listings` l on
                 `l`.`sid` = `a`.`listing_id`
                 {$order['join']}
            where `l`.`user_sid` = ?s and `a`.`show_emp` = 1 {$subuserFilter} {$order['order']}", $companyId);
        if ($score) {
            foreach ($apps as $key => $app) {
                $jobInfo = SJB_ListingManager::getListingInfoBySID($app["listing_id"]);
                if (!empty($jobInfo['screening_questionnaire'])) {
                    $screening_questionnaire = SJB_ScreeningQuestionnaires::getInfoBySID($jobInfo['screening_questionnaire']);
                    $passing_score = 0;
                    switch ($screening_questionnaire['passing_score']) {
                        case 'acceptable':
                            $passing_score = 1;
                            break;
                        case 'good':
                            $passing_score = 2;
                            break;
                        case 'very_good':
                            $passing_score = 3;
                            break;
                        case 'excellent':
                            $passing_score = 4;
                            break;
                    }
                    if ($app['score'] < $passing_score && $score == "passed")
                        unset($apps[$key]);
                    elseif ($app['score'] > $passing_score && $score == "not_passed")
                        unset($apps[$key]);
                }
                else {
                    unset($apps[$key]);
                }
            }
        }
        return $apps;
    }

    function getBySID($sid)
    {
        $apps = SJB_DB::query("
            select `a`.* from `applications` a
            inner join `listings` l on
					 `l`.`sid` = `a`.`listing_id`
			 	where a.`id` = ?n and a.`show_emp` = 1 ", $sid);
			$apps = $apps?array_pop($apps):array();
			return $apps;
    }

    function getAppGroupsByEmployer($companyId)
    {
        return SJB_DB::query("
            select a.listing_id, a.id, count(*) as count from `applications` a
            inner join `listings` l on
                 `l`.`sid` = `a`.`listing_id`
            where `user_sid` = ?s and `show_emp` = 1 GROUP BY `a`.`listing_id`", $companyId);
    }

    /**
     * Is user applied to job posting
     *
     * @param int $listing_id
     * @param int $jobseeker_id
     * @return bool
     */
    function isApplied($listing_id, $jobseeker_id)
    {
        // if anonymous user - return false (it not applied)
        if (!$jobseeker_id)
            return false;

        return count(SJB_DB::query("select * from applications where listing_id = ?s and jobseeker_id = ?s", $listing_id, $jobseeker_id)) > 0;
    }

    function isListingAppliedForCompany($listing_id, $company_id)
    {
        return count (SJB_DB::query("
            SELECT a. * , l.user_sid FROM `applications` a
            INNER JOIN `listings` l ON l.sid = a.`listing_id`
            WHERE user_sid = ?s AND resume_id = ?s", $company_id, $listing_id)) > 0;
    }

    function isUserOwnerApps($user_sid, $apps_sid)
    {
        return count (SJB_DB::query("
            SELECT a. * , l.user_sid FROM `applications` a
            INNER JOIN `listings` l ON l.sid = a.`listing_id`
            WHERE l.user_sid = ?n AND id = ?n", $user_sid, $apps_sid)) > 0;
    }
    
    /**
     * Check if user owns applications By AppJobId 
     *
     * @param int $user_sid
     * @param int $apps_sid
     * @return unknown
     */
	function isUserOwnsAppsByAppJobId($user_sid, $app_job_id)
    {
        return count (SJB_DB::query("
            SELECT a. * , l.user_sid FROM `applications` a
            INNER JOIN `listings` l ON l.sid = a.`listing_id`
            WHERE l.user_sid = ?n AND a.listing_id = ?n", $user_sid, $app_job_id)) > 0;
    }

    /**
     * Creates new application
     *
     * @param int $listing_id
     * @param int $jobseeker_id
     * @param int|string $resume
     * @param string $type
     * @return Application|bool
     */
    function create($listing_id, $jobseeker_id, $resume, $comments, $file, $mimeType, $file_sid, $anonymous, $notRegisteredUserData = false, $questionnaire = '', $score = 0)
    {
        if (SJB_Applications::isApplied($listing_id, $jobseeker_id) && !is_null($jobseeker_id))
            return false;

        $file_id = '';

        if ($file_sid != '') {
            $id = array_pop( SJB_DB::query("SELECT `id` FROM `uploaded_files` WHERE `sid` = ?s", $file_sid) );
            $file_id = $id['id'];
        }

        // если апликейшн от незарегенного пользователя, то в поле show_js сразу пропишем 0
        if ( empty($jobseeker_id) ) {
            $jobSeekerName  = $notRegisteredUserData['name'];
            $jobSeekerEmail = $notRegisteredUserData['email'];
            $res = SJB_DB::query("
                insert into applications(`listing_id`, `jobseeker_id`, `comments`, `date`, `resume`, `file`, `mime_type`, `anonymous`, `show_js`, `username`, `email`, `file_id`, `questionnaire`, `score`)
                values(?s, ?s, ?s, NOW(), ?s, ?s, ?s, ?s, ?n, ?s, ?s, ?s, ?s, ?s)", $listing_id, 0, $comments, $resume, $file, $mimeType, $anonymous, 0, $jobSeekerName, $jobSeekerEmail, $file_id, $questionnaire, $score);

            return $res;
        }

        $res = SJB_DB::query("
            insert into applications(`listing_id`, `jobseeker_id`, `comments`, `date`, `resume`, `file`, `mime_type`, `anonymous`, `file_id`, `questionnaire`, `score`)
            values(?s, ?s, ?s, NOW(), ?s, ?s, ?s, ?s, ?s, ?s, ?s)", $listing_id, $jobseeker_id, $comments, $resume, $file, $mimeType, $anonymous, $file_id, $questionnaire, $score);

        return $res;
    }

    function remove($id)
    {
        SJB_DB::query("delete from applications where id = ?s", $id);
    }

    function hideJS($applicationId)
    {
        SJB_DB::query("update applications set `show_js` = 0 where id = ?s", $applicationId);
        SJB_Applications::deleteEmptyApplication($applicationId);
    }

    function hideEmp($applicationId)
    {
        SJB_DB::query("update applications set `show_emp` = 0 where id = ?s", $applicationId);
        SJB_Applications::deleteEmptyApplication($applicationId);
    }

    function deleteEmptyApplication ($applicationId)
    {
        $file_id = array_pop(SJB_DB::query("SELECT `file_id` FROM `applications` WHERE `id` = ?s", $applicationId));
        $res = SJB_DB::query("DELETE FROM `applications` WHERE `show_js` = 0 AND `show_emp` = 0 AND id = ?s", $applicationId);
        if ($res === true && $file_id != '') {
            SJB_UploadFileManager::deleteUploadedFileByID($file_id['file_id']);
        }
    }

    function accept($applicationId)
    {
        SJB_DB::query("update applications set `status` = 'Approved' where id = ?s", $applicationId);
    }

    function reject($applicationId)
    {
        SJB_DB::query("update applications set `status` = 'Rejected' where id = ?s", $applicationId);
    }

    function saveNoteOnDB ($note, $applicationId)
    {
        return SJB_DB::query("update applications set `note` = ?s where id = ?s", $note, $applicationId);
    }
    
    /**
     * Gets an Application Email from Application Settings
     *
     * @param int $listing_id
     * @return string
     */
    public function getApplicationEmailbyListingId($listing_id)
    {
    	$application_email = SJB_DB::query("SELECT `value` FROM `listings_properties` WHERE `object_sid` = ?n AND `id` = ?s AND `add_parameter` = ?n AND `value` <> ''", $listing_id, 'ApplicationSettings', 1);
    	if (!empty($application_email) && is_array($application_email)) {
    		return array_pop(array_pop($application_email));
    	}
    	else {
    		return '';
    	}    	
    }

}
	
class SJB_Application
{

    var $id = 0;

    function SJB_Application($id)
    {
        $this->id = $id;
    }

    function accept()
    {
        return SJB_DB::query("update applications set status = 'Approved' where id = ?s", $this->id);
    }

    function reject()
    {
        return SJB_DB::query("update applications set status = 'Rejected' where id = ?s", $this->id);
    }

    function get()
    {
        $res = SJB_DB::query("select * from applications where id = ?s", $this->id);
        if (count($res) > 0)
            return $res[0];
        return false;
    }

    function getApplicationMeta()
    {
        $meta = array(
            "application" => array (
                "date" => array (
                    "type" => "date"
                    )
                )
            );
        return $meta;
    }

}
