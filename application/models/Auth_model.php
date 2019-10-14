<?php

class Auth_model extends CI_Model {



    public function checkUser($userData = array()){
        if(!empty($userData)){
            // Check whether user data already exists in database
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('oauth_provider',$userData['link']);
            $this->db->where('oauth_uid',$userData['username']);
            $data=$this->db->get('user')->row();
            return $data;
        }else{
            return $data='Something Went Wrong';
        }
    }
    

    public function update($userData=array()){
        if(!empty($userData)){
        $data=array(
                'first_name'=>$userData['first_name'],
                'last_name'=>$userData['last_name'],
                'email'=>$userData['email'],
                'picture'=>$userData['picture'],
                'access_token'=>$userData['access_token'],
                'link'=>$userData['link'],
            );
        $this->db->set('modified','CURRENT_TIMESTAMP',false);
        $this->db->where('oauth-provider',$userData['link']);
        $this->db->where('oauth_id',$userData['username']);
        $this->db->update('user',$data);
        
        $this->db->where('oauth_id',$userData['username']);
        $return=$this->db->get('user')->row();
        return $return;
        }else{
            return $data='Something Went Wrong';
        }

    }    
        
public function insert($userData=array()){
        $data=array(
                'oauth_uid' => $userData['username'],
                'oauth_provider'=>$userData['link'],
                'first_name'=>$userData['first_name'],
                'last_name'=>$userData['last_name'],
                'email'=>$userData['email'],
                'picture'=>$userData['picture'],
                'access_token'=>$userData['access_token'],
                'link'=>$userData['link'],
            );   

        $this->db->set('modified','CURRENT_TIMESTAMP',false);
        $this->db->insert('user',$data);
        $this->db->where('oauth_uid',$userData['oauth_uid']); 
        $return= $this->db->get()->row();
        return $return;  

}

    
}
?>


