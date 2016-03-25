<?php


namespace Modules\Members\Models;


use Core\Model;

class Members extends Model
{
    /**
     * Get all accounts that were activated
     * @return array
     */
    public function getActivatedAccounts()
    {
        return $this->db->select('SELECT * FROM '.PREFIX.'users WHERE isactive = true');
    }

    /**
     * Get all accounts that are on the Online table
     * @return array
     */
    public function getOnlineAccounts()
    {
        return $this->db->select('SELECT * FROM '.PREFIX.'users_online ');
    }

    /**
     * Get all members that are activated with info
     * @return array
     */
    public function getMembers()
    {
        return $this->db->select("
				SELECT
					u.userID,
					u.username,
					u.firstName,
					u.isactive,
					ug.userID,
					ug.groupID,
					g.groupID,
					g.groupName,
					g.groupFontColor,
					g.groupFontWeight
				FROM
					".PREFIX."users u
				LEFT JOIN
					".PREFIX."users_groups ug
					ON u.userID = ug.userID
				LEFT JOIN
					".PREFIX."groups g
					ON ug.groupID = g.groupID
				WHERE
					u.isactive = true
				GROUP BY
					u.userID
				ORDER BY
					u.userID ASC, g.groupID DESC");
    }

    /**
     * Get all info on members that are online
     * @return array
     */
    public function getOnlineMembers()
    {
        return $this->db->select("
				SELECT
					u.userID,
					u.username,
					u.firstName,
					uo.userID,
					ug.userID,
					ug.groupID,
					g.groupID,
					g.groupName,
					g.groupFontColor,
					g.groupFontWeight
				FROM
					uap_users_online uo
				LEFT JOIN
					uap_users u
					ON u.userID = uo.userID
				LEFT JOIN
					uap_users_groups ug
					ON uo.userID = ug.userID
				LEFT JOIN
					uap_groups g
					ON ug.groupID = g.groupID
				GROUP BY
					u.userID
				ORDER BY
					u.userID ASC, g.groupID DESC");
    }

    /**
     * Get specific user's info
     * @param $username
     * @return array
     */
    public function getUserProfile($username)
    {
        return $this->db->select("
					SELECT
						u.userID,
						u.username,
						u.firstName,
						u.gender,
						u.userImage,
						u.LastLogin,
						u.SignUp,
						u.website,
						u.aboutme
					FROM " . PREFIX . "users u
					WHERE u.username = :username",
            array(':username' => $username));
    }

    public function getUserName($id)
    {
        return $this->db->select("SELECT userID,username FROM ".PREFIX."users WHERE userID=:id",array(":id"=>$id));
    }

    public function updateProfile($u_id, $firstName, $gender, $website, $userImage, $aboutme)
    {
        return $this->db->update(PREFIX.'users', array('firstName' => $firstName, 'gender' => $gender, 'userImage' => $userImage, 'website' => $website, 'aboutme' => $aboutme), array('userID' => $u_id));
    }
}