<?php 

class Ajax extends CI_Controller {


    public function gmailSave(){
        $param      = $this->input->post( 'param' );    
        $cust_name  = $param['name'];
        $cust_email = $param['email'];
        $cust_hp    = $param['hp'];
        $cust_photo = $param['photoURL'];
        //check if exist
       $return = $this->Fypmodel->checkCustomer($cust_email);
       //$return = true;
        if ($return == 0) {
            # save into db
            $user_data = array(		
                'name' => $cust_name ,
                'emailx' => $cust_email ,
                'hp'	=> $cust_hp,
                'photourl' => $cust_photo 
            );
            $return = $this->Fypmodel->insertCustomer($user_data);
        }
            $set_data = array(		
                'nameC'     => $cust_name ,
                'emailC'    => $cust_email ,
                'hpC'	    => $cust_hp,
                'photourlC' => $cust_photo 
            );
            $this->session->set_userdata($set_data);

       echo json_encode(array('success' => true ,'data'=>'user available', 'return'=> $set_data ));

    }
    public function deleteitem(){
        $id = $this->input->post( 'id' );
        $this->Fypmodel->del_item($id);
        echo json_encode(array('success' => $id ,'return'=>'item deleted' ));

    }

    public function showitem(){
        $id = $this->input->post( 'id' );
        $this->Fypmodel->showitem($id);
        echo json_encode(array('success' => $id ,'return'=>'item showed' ));

    }

    public function hideitem(){
        $id = $this->input->post( 'id' );
        $this->Fypmodel->hideitem($id);
        echo json_encode(array('success' => $id ,'return'=>'item hide' ));

    }

    public function deletecart(){
        $id = $this->input->post( 'id' );
        $this->Fypmodel->del_cart($id);
        echo json_encode(array('success' => $id ,'return'=>'item deleted' ));

    }

    public function cartCompany(){
        $id = $this->input->post( 'id' );
        $return = $this->Fypmodel->getCompanyDetails($id);
        echo json_encode(array('success' => $id ,'return'=>$return ));

    }
    public function prepareItem(){
        $id = $this->input->post( 'id' );
        $this->Fypmodel->addItemWithOne($id);    
        $return = $this->Fypmodel->prepareItem($id);
        echo json_encode(array('success' => $id ,'return'=>$return ));

    }
    public function cancelItem(){
        $id = $this->input->post( 'id' );
        $reason = $this->input->post( 'reason' );
        $return = $this->Fypmodel->cancelItem($id, $reason);
        echo json_encode(array('success' => $id ,'return'=>$return ));

    }




}


?>