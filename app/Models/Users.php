<?php

namespace Models;

/**
 * Class Users
 * @package Models
 */
use Core\Model;
use DateTime;

class Users extends Model
{
    /**
     * Add user to online table
     * @param $userID
     */
    public function add($userID)
    {
		$data = array('userId' => $userID ,'lastAccess' => date('Y-m-d G:i:s'));
        $this->db->insert(PREFIX."users_online",$data);

    }

    /**
     * Update user to latest login time
     * @param $userID
     */
    public function update($userID)
    {
        $query = $this->db->select('SELECT * FROM '.PREFIX.'users_online WHERE userId = :userID ', array(':userID' => $userID));
        $count = count($query);
        if($count == 0){
            $this->add($userID);
        }else{
            $data = array('lastAccess' => date('Y-m-d G:i:s'));
            $where = array('userId' => $userID);
            $this->db->update(PREFIX."users_online",$data,$where);
        }
    }

    /**
     * Get current user's id from database
     * @param $where_username
     * @return int
     */
    public function getUserID($where_username)
    {
        $data = $this->db->select("SELECT userID FROM ".PREFIX."users WHERE username = :username",
            array(':username' => $where_username));
        return $data[0]->userID;
    }

    /**
     * Remove user from online status - Logged Out or Idle
     * @param $userID
     * @return int
     */
    public function remove($userID)
    {
        return $this->db->delete(PREFIX.'users_online', array('userId' => $userID));
    }

    /**
     * Removes users that were 15 minutes inactive and remove them from the table
     * @return int
     */
    public function cleanOfflineUsers()
    {
        $removed = 0;
        $onlines = $this->db->select('SELECT * FROM '.PREFIX.'users_online');
        foreach($onlines as $online){
            $format = 'Y-m-d H:i:s';
            $date = DateTime::createFromFormat($format, $online->lastAccess);
            if(date_add($date, date_interval_create_from_date_string('15 minute')) < new DateTime("now")){
                $this->remove($online->userId);
                $removed++;
            }
        }
        return $removed;
    }
}