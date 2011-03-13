<?php

class admin_multul_multul_multul extends ipsCommand {

    public function doExecute( ipsRegistry $registry ){

                $this->html = $this->registry->output->loadTemplate( 'cp_skin_multul' );
		$this->registry->getClass('output')->html_main .= $this->registry->getClass('output')->global_template->global_frame_wrapper();
                $this->registry->output->html .= $this->html->multul_overview();
                $this->registry->getClass('output')->sendOutput();
    }

    public static function multul_init(){
        require IPS_ROOT_PATH.'applications_addon\other\multul\extensions\lib\multul_lib.php';

	$user_id            	= ipsRegistry::member()->member_id;
	$user                   = ips_MemberRegistry::fetchMemberData();
	$multul_id		= ipsRegistry::$settings['multul_id'];
	$multul_key		= ipsRegistry::$settings['multul_key'];

	if ($user_id != 0 && $multul_id && $multul_key) {
		$config = array(
			'app_id'		=> $multul_id,
			'secret_key'            => $multul_key,
			'uid'			=> $user_id,
			'name'			=> $user['name'],
		);

		$multul = Multul::factory($config)->render();
		return $multul;
        }
    }
}