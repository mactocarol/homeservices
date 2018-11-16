<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function CheckMemberPackageLimit($table="",$pcakge_feature="",$arr="")
{
	$CI =& get_instance();
	$ses_var = $CI->session->userdata('user_id');
	$ses_role = $CI->session->userdata('member_role');
	if($ses_var!="")
	{
		$member_package = $CI->user_model->GetJoinSingleRecords('member_package_roles','package','ot_member_package_roles.member_package = ot_package.p_id',array('member_package_roles.member_id'=>$ses_var,'member_package_roles.member_role'=>$ses_role,'member_package_roles.expiry_date >='=>date("Y-m-d"),'member_package_roles.package_status'=>1),'member_package_roles.m_p_id','asc','0','1','',array('member_package_roles.*','package.*'),'s');
		if($member_package!='')
		{
			if($member_package->expiry_date < date("Y-m-d"))
			{
				$CI->session->set_flashdata('err',"Your package limit has been expired please renew or upgrade your packgae.");
				redirect(base_url().'home/profile');
			}else
			{
			$num_member = $CI->user_model->getNumOnlyRecord($table,$arr);
			$package_feature = $CI->user_model->getSingleArrayRecord('member_package_balance',array('package_id'=>$member_package->member_package,'member_id'=>$ses_var,'feature_display_name'=>$pcakge_feature),'balance_id asc','s');
			
			
			if($package_feature!='x'){
				if($package_feature->feature_used_value > $package_feature->feature_value)
				{
					$CI->session->set_flashdata('err',"Your ".$pcakge_feature."  package feature limit has been finished.");
					redirect(base_url().'home/profile');
				}else
				{
					return TRUE;
				}
			}
			}
		}else
		{
			return TRUE;
		}
		
	}
}

function MemberPackageBalance($package="",$id="",$table="",$type="")
{
	$ci =& get_instance();
	$package_name = $ci->user_model->getSingleArrayRecord('package',array('p_id'=>$package,'package_status'=>0),'p_id asc','s');
	
	$feature_name = strtolower($package_name->package_name);
	
	$Package_feature = $ci->user_model->getSingleArrayRecord('package_features',array('features_status'=>0),'features_id asc','a');
	if($type=="add")
	{
	if($Package_feature!='x')
	{
		foreach($Package_feature as $feature)
		{
			
				$arr = array(
					'package_id'				=>$package,
					'member_id'					=>$id,
					'feature_display_name'		=>$feature->display_name,
					'feature_value'				=>$feature->$feature_name,
					'feature_used_value'		=>0,
					'add_date'					=>date("Y-m-d")
				);
				$rec = $ci->user_model->InsertRecords('member_package_balance',$arr);
		  }
		}
	}elseif($type=="update"){

		$Package_topup = $ci->user_model->getSingleArrayRecord('member_topup_package',array('topup_status'=>1,'package_id'=>$package,'member_id'=>$id,'package_quantity !='=>0),'topup_id asc','a');
		if($Package_topup!='x')
		{	
			foreach($Package_topup as $topup)
			{
				$Package_topup_bal = $ci->user_model->getSingleArrayRecord('member_package_balance',array('package_id'=>$package,'member_id'=>$id,'feature_display_name'=>$topup->feature_name),'balance_id asc','s');
				$arr = array(
					'feature_value'	=>$topup->package_quantity + $Package_topup_bal->feature_value
				);
				$rec = $ci->user_model->UpdateRecord('member_package_balance',$arr,'feature_display_name',$topup->feature_name,'');
			}
		}
		}
		if($rec)
		{
			return $rec;
		}else
		{
			return false;
		}
	
	//return print_r($Package_feature);	die;
}
function UpdatePackageValue($feature_name="",$table="",$value="")
{
	$ci = & get_instance();
	$id = $ci->session->userdata('user_id');
	
	$package = $ci->user_model->getSingleArrayRecord('member_package_roles',array('member_id'=>$id,'package_status'=>1,'expiry_date >='=>date("Y-m-d")),'m_p_id asc','s');	
	if($package!='x')
	{
		$Package_balance = $ci->user_model->getSingleArrayRecord($table,array('package_id'=>$package->member_package,'member_id'=>$id,'feature_display_name'=>$feature_name),'balance_id asc','s');
	$arr = array(
		'feature_used_value' =>$Package_balance->feature_used_value + $value,
	);
	$update = $ci->user_model->UpdateRecord('member_package_balance',$arr,'balance_id',$Package_balance->balance_id,'');
	return TRUE;
	}else
	{
		return FALSE;
	}
	
}


