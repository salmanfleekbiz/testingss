<?php

	defined('BASEPATH') OR exit('No direct script access allowed');



	class Products extends MY_Controller {

		public function __construct(){

			parent::__construct();

			$this->load->model('Model_form','m_form');

			$this->load->library('user_agent');

			$this->load->library('cart'); 

			$this->load->library('session');

		}

		

		public function index($slug,$id){



			$viewdata['workout']=$this->m_form->get_tbl_whr_key_row('courses','slug',$id);

			$viewdata['workoutfeatures']=$this->Dmodel->get_tbl_whr_arr('course_features',array('course_id'=>$viewdata['workout']->id));

			$workoutplans=$this->Dmodel->get_tbl_whr_arr('course_plan',array('course_id'=>$viewdata['workout']->id));

			$viewdata['workoutprogram']=7 * count($workoutplans);

			if($userid=$this->session->userdata('user_id')):

				$user_orders=$this->Dmodel->get_tbl_whr_arr('orders',array('user_id'=>$userid));

				if(count($user_orders) > 0):

				foreach($user_orders as $user_order):

					$uord[]=$user_order['course_name'];

				endforeach;

				$viewdata['uorder']=$uord;

				endif;
			endif;



			$viewdata['course_images']=$this->m_form->get_tbl_whr_arr_limit('course_images',array('course_id'=>$viewdata['workout']->id ,'status'=>1),2);	

			



			$this->LoadView('products',$viewdata);

		}





		public function AddtoCart()

		{



			if(count($this->cart->contents()) > 0):



				foreach($this->cart->contents() as $items):

						   $data = array(

				            'rowid'   => $items['rowid'],

				            'qty'     => 0

				       		 );

        			$this->cart->update($data);

					endforeach;

			endif;

				$courseid=$_POST['id'];

				$course=$this->Dmodel->get_tbl_whr_row('courses',$courseid);
				$course_cat=$this->Dmodel->get_tbl_whr_row('parents',$course->parent_id);
				$data = array(

		        'id'      => $courseid,

		        'qty'     => 1,

		        'price'   => $course->price,

		        'name'    => $course->title,

		        'cat_name'    => $course_cat->title,

		        'image'   => $course->image,

		        'coupon'  => $coupon

				);



				$this->cart->insert($data);

			





		}

		 public function RemovetoCart()

		 {

		 	

		 	$rowid=$_POST['rowid'];

		 	   $data = array(

            'rowid'   => $rowid,

            'qty'     => 0

        );



        	$this->cart->update($data);

        	

        	echo 1;

		 

		 } 



		 public function CheckPromo()

		 {

		 	$data=$_POST;

		 	$promo=$this->m_form->get_tbl_whr_key_row('promo_code','code',$data['code']);

		 	if($this->Dmodel->IFExist('promo_code','code',$data['code'])){

				echo 2;

			}

			else if($this->session->userdata('code')!=""){

		 		echo json_encode($promo);

			}

		 		

			else{

				

				$this->session->set_userdata('code',$data['code']);

				$usage=$promo->code_usage;

				$times=$promo->valid_times;

				if($usage > $times):

					echo 1;

				else:

				$data['updated_at']=date_now;

				$data['code_usage']=$usage+1;	

				$exec=$this->Dmodel->update_data('promo_code',$data['code'],$data,'code');	

				echo json_encode($promo);	

				endif;	

				

			}





		 }

		

	}



