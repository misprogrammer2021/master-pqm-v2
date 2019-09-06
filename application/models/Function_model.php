<?php
class Function_model extends CI_Model{

	public function __construct()
	{
		$this->load->model('Settings_model');
        $this->load->model('User_login_token_model');
        date_default_timezone_set("Asia/Kuala_Lumpur");
	}
    
    public function page_init()
	{
		
		$this->lang->load('langfile');
        $this->load->model('User_login_token_model');
        $this->load->model('Users_model');
        $this->load->model('State_model');

        //$where=array(),$orderBy="",$descasc="",$limit="")
        $statelist = $this->State_model->get_where(array(
            'is_deleted'=>0,
        ),"priority","ASC","","name");       
		
		//$statelist = array("Selangor","Kuala Lumpur","Labuan","Johor","Pahang","Negeri Sembilan","Melaka","Perak","Kedah","Terengganu","Kelantan","Pulau Pinang","Perlis","Sabah","Sarawak");		
        
        $salesman = '';
        $user_id = $this->isLogin();
        if($user_id !== FALSE) {
            $userdata = $this->Users_model->getOne(array('id'=>$user_id));            
        }else{
            $userdata = null;
        }       
		
		$array = array(
			'langu'				=> $this->lang->lang(),
			'lang'				=> $this->lang->language,
            'lang_js'			=> json_encode($this->lang->language),
            'current_url'       => $this->get_lang_chg_url($this->lang->lang()),
            'lang_type'         => ($this->lang->lang() == 'zh-cn')?'_zh':'',      
            'userdata'          => $userdata,
			'statelist'			=> $statelist,
		);
        
		return $array;
	}
    
    public function get_current_url() {

        $protocol = 'http';
        if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')) {
            $protocol .= 's';
            $protocol_port = $_SERVER['SERVER_PORT'];
        } else {
            $protocol_port = 80;
        }

        $host = $_SERVER['HTTP_HOST'];
        $port = $_SERVER['SERVER_PORT'];
        $request = $_SERVER['PHP_SELF'];
        //$query = isset($_SERVER['argv']) ? substr($_SERVER['argv'][0], strpos($_SERVER['argv'][0], ';') + 1) : '';

        $toret = $protocol . '://' . $host . ($port == $protocol_port ? '' : ':' . $port) . $request . (empty($query) ? '' : '?' . $query);

        return $toret;
    }
    
    public function get_lang_chg_url($langu){
        $url = array();
        $url = explode('/',$_SERVER['REQUEST_URI']);
       
        $string = '';
        foreach($url as $v):
            if($v == $langu){
                $string .= (($v=='en')?'zh':'zh').'/';
            }else if($string != ''){
                $string .= $v.'/';
            }
        endforeach;
        
        return $string;
    }
    
    public function item_per_page()
    {
        return 12;
    }
	
	public function isLogin(){
                             
		$token = $this->cookie->get("token");

        if(!empty($token)) {

            $tokenData = $this->User_login_token_model->getOne(array(
                'token' => $token,
                'expired >' => time(),
            ));
                                 
            if( !empty($tokenData) ){    
                //add point action here.
                //$this->load->model('Ihungryuserpoint_model'); 
                //$this->Ihungryuserpoint_model->pointEarnTrigger(__CLASS__.'/'.__FUNCTION__, $tokenData['user_id']); 

                return $tokenData['user_id'];   
            } else {
                return false;   
            }

        } else {
            return false;
        }
	}
	
	public function get_menu() {
		$data = array();
		$data = $this->category_model->get_parent_category('display');
		if(!empty($data)){
			foreach ($data as $k=>$v):
				$data[$k]['submenu'] =  $this->category_model->get_child_category($v['category_id'],'display');
				foreach ($data[$k]['submenu'] as $t=>$a):
					$article = $this->article_model->get_article_use_category($a['category_id']);
					$data[$k]['submenu'][$t]['article'] = $article;
				endforeach;
			endforeach;
		}
        return $data;
    }
	
	public function get_web_setting() {
		$array = array();
		$array = array(
			'web_title'			=> $this->Settings_model->get_web_title(),
			'web_footer'		=> $this->Settings_model->get_web_footer(),
			'web_meta'			=> $this->Settings_model->get_web_meta(),
			'web_mobile'		=> $this->Settings_model->get_web_mobile(),
			'web_address'		=> $this->Settings_model->get_web_address(),
			'web_email'			=> $this->Settings_model->get_web_email(),
			'homepage_slogan'	=> $this->Settings_model->get_homepage_slogan(),
		);
		return $array;
	}
	
	
	public function set_breadcrumb($array, $name, $link)
	{
		$array[] = array(
			'name'	=> $name,
			'link'	=> $link,
		);
		
		return $array;
	}
    
    public function get_paging($item_per_page,$pagenum,$total_item,$page,$url,$queryString="")
    {
    
        $start = (int)(($page-1)/$pagenum)*$pagenum+1;
        $end = $start+$pagenum-1;
        $next = $page+1;
        $pre = $page-1;
        
        $total_page = ceil( $total_item / $item_per_page );
                $paging = '';
        if($total_item > $item_per_page){
                    $paging .= '<ul class="pagination">';

                    if($page > 1){
                            $paging .= '<li><a href="'.$url.'1'.$queryString.'">&laquo;</a></li>';
                            $paging .= '<li><a href="'.$url.$pre.$queryString.'">&lsaquo;</li>';
                    }

                    if($total_page <= $pagenum){

                            for($i=$start;$i<=$total_page;$i++){
                                    if($i == $page){

                                            $paging .= '<li class="active"><a href="#">'.$i.'</a></li>';
                                    }else{

                                            $paging .= '<li><a href="'.$url.$i.$queryString.'">'.$i.'</a></li>';
                                    }
                            }
                    }else{
                            if($page > 5){
                                    $end = $page+4;
                                    if($end > $total_page){
                                            $end = $total_page;
                                    }

                                    $start = $end - ($pagenum - 1);

                                    for($i=$start;$i<=$end;$i++){
                                            if($i == $page){
                                                
                                                    $paging .= '<li class="active"><a href="#">'.$i.'</a></li>';
                                            }else{
                                                    $paging .= '<li><a  href="'.$url.$i.$queryString.'">'.$i.'</a></li>';
                                            }
                                    }
                            }else{
                                    if($end > $total_page){
                                            $end = $total_page;
                                    }

                                    for($i=$start;$i<=$end;$i++){
                                            if($i == $page){
                                                    $paging .= '<li class="active"><a href="#">'.$i.'</a></li>';
                                            }else{
                                                    $paging .= '<li><a href="'.$url.$i.$queryString.'">'.$i.'</a></li>';
                                            }
                                    }
                            }   
                    }
                    
                    
                    if($page < $total_page){
                            $paging .= '<li><a href="'.$url.$next.$queryString.'">&rsaquo;</a></li>';
                            $paging .= '<li><a href="'.$url.$total_page.$queryString.'">&raquo;</a></li>';
                            
                    }

                    $paging .= '</ul>';
                }
        
        return $paging;
    }
	
	
	
	
	public function get_pagingNew($item_per_page,$pagenum,$total_item,$page,$url,$queryString="")
    {
    
        $start = (int)(($page-1)/$pagenum)*$pagenum+1;
        $end = $start+$pagenum-1;
        $next = $page+1;
        $pre = $page-1;
        
        $total_page = ceil( $total_item / $item_per_page );
                $get_pagingNew = '';
        if($total_item > $item_per_page){
                    $get_pagingNew .= '<ul class="pagination jompasarpagination">';

                    if($page > 1){
                            $get_pagingNew .= '<li class="stitle"><a href="'.$url.'1'.$queryString.'">&laquo; First</a></li>';
                            $get_pagingNew .= '<li class="stitle"><a href="'.$url.$pre.$queryString.'">&lsaquo; Previous </li>';
                    }

                    if($total_page <= $pagenum){

                            for($i=$start;$i<=$total_page;$i++){
                                    if($i == $page){

                                            $get_pagingNew .= '<li class="active"><a href="#">'.$i.'</a></li>';
                                    }else{

                                            $get_pagingNew .= '<li><a href="'.$url.$i.$queryString.'">'.$i.'</a></li>';
                                    }
                            }
                    }else{
                            if($page > 5){
                                    $end = $page+4;
                                    if($end > $total_page){
                                            $end = $total_page;
                                    }

                                    $start = $end - ($pagenum - 1);

                                    for($i=$start;$i<=$end;$i++){
                                            if($i == $page){
                                                
                                                    $get_pagingNew .= '<li class="active"><a href="#">'.$i.'</a></li>';
                                            }else{
                                                    $get_pagingNew .= '<li><a  href="'.$url.$i.$queryString.'">'.$i.'</a></li>';
                                            }
                                    }
                            }else{
                                    if($end > $total_page){
                                            $end = $total_page;
                                    }

                                    for($i=$start;$i<=$end;$i++){
                                            if($i == $page){
                                                    $get_pagingNew .= '<li class="active"><a href="#">'.$i.'</a></li>';
                                            }else{
                                                    $get_pagingNew .= '<li><a href="'.$url.$i.$queryString.'">'.$i.'</a></li>';
                                            }
                                    }
                            }   
                    }
                    
                    
                    if($page < $total_page){
                            $get_pagingNew .= '<li class="stitle marginleft"><a href="'.$url.$total_page.$queryString.'">Last &raquo;</a></li>';
							$get_pagingNew .= '<li class="stitle marginleft"><a href="'.$url.$next.$queryString.'">Next &rsaquo;</a></li>';
                            
                    }

                    $get_pagingNew .= '</ul>';
                }
        
        return $get_pagingNew;
    }

    
    
    function get_current_page(){
        $url = $_SERVER['REQUEST_URI'];
        $array = array();
        $array = explode('/', $url);
		
        if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']=="www.spcind.com") {
            return $array[1];
        } else if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']=="spcind.com") {
            return $array[1];
		} else if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']=="spcind.local") {
			return $array[1];
        } else {
            return $array[2];
        }
        
    }
	
	public function upload_pdf($filename,$postname)
    {
        //$config['upload_path'] = './uploads/';
		$config['upload_path'] = './assets/uploads/';		
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['file_name'] = $filename;
        $config['overwrite'] = TRUE;
        $config['max_size'] = '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';   

        $this->load->library('upload', $config);

        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0755, TRUE);
        }

        if (!$this->upload->do_upload($postname)){ //Upload file
            redirect("errorhandler"); //If error, redirect to an error page
        }else{
            return $this->upload->data();
        }
    }
    
   public function upload($filename,$postname,$k="")
    {
        $config['upload_path'] = 'assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $filename;
        $config['overwrite'] = TRUE;
        $config['max_size'] = '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';   

        $this->load->library('upload', $config);

        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0755, TRUE);
        }
  

  if($k===""){
   
   if (!$this->upload->do_upload($postname)){ //Upload file
    redirect("errorhandler"); //If error, redirect to an error page
   }else{
    return $this->upload->data();
   }
   
   
  }else{
   
   if (!$this->upload->special_do_upload($postname,$k)){ //Upload file
    redirect("errorhandler"); //If error, redirect to an error page
   }else{
    return $this->upload->data();
   }   
  
  }
        
  
    }
    public function multi_upload($filename,$postname)
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $filename;
        $config['overwrite'] = TRUE;
        $config['max_size'] = '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';   

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0755, TRUE);
        }

        if (!$this->upload->do_multi_upload($postname, TRUE)){ //Upload file
            redirect("errorhandler"); //If error, redirect to an error page
        }else{
            return $this->upload->get_multi_upload_data();
        }
    }
         
    public function img_resize($upload_data,$nwidth,$nheight,$new_path){
        $image_config["image_library"] = "gd2";
        $image_config["source_image"] = $upload_data["full_path"];
        $image_config['create_thumb'] = FALSE;
        $image_config['maintain_ratio'] = FALSE;
        $image_config['new_image'] = $new_path;
        $image_config['quality'] = "70%";
        $image_config['width'] = $nwidth;
        $image_config['height'] = $nheight;
        $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
        $image_config['master_dim'] = ($dim > 0)? "height" : "width";

        $this->load->library('image_lib');
        $this->image_lib->initialize($image_config);

        if(!$this->image_lib->resize()){ //Resize image
            show_error("您上傳的照片無法被壓縮, 請確認您的照片是JPG或PNG的格式."); //If error, redirect to an error page
        }

    }
    
    public function cut_content($string,$length){
        $string = strip_tags($string); //去除HTML標籤
        $sub_content = mb_substr($string, 0, $length, 'UTF-8'); //擷取子字串

        //顯示 "......"
        if (strlen($string) > strlen($sub_content)) $sub_content."...";

        return $sub_content;
    }
    
    public function DateDiff($part, $begin, $end)
    {
        $diff = strtotime($end) - strtotime($begin) ;
       
        $hour=round(($diff)/3600);
        
        return $hour;
    }
    
    public function get_chinese_weekday($datetime)
    {
        $weekday  = date('w', strtotime($datetime));
        $weeklist = array('日', '一', '二', '三', '四', '五', '六');
        return '星期' . $weeklist[$weekday];
    }
    
    public function get_room_detail($roomDetail,$arrivalDate='',$departureDate='')
    {
        $this->load->model("frontend_acco_model");
        $roomDetail['images'] = $this->frontend_acco_model->room_images_load($roomDetail['id']);
        $roomDetail['prices_sell'] = explode(",", $roomDetail['prices_sell']);

        $facilities_temp = array();
        $facilities_temp = explode(",", $roomDetail['amenities']);
        $facilities = array();
        if(!empty($facilities_temp)){
            foreach($facilities_temp as $f):

                $ftemp = $this->frontend_acco_model->get("amenities",array('ami_id' => $f));
                if(isset($ftemp['id'])){
                    $facilities[] = $ftemp['name'];
                }
            endforeach;

            $roomDetail['facilities'] = $facilities;
        }
        
        $bedType = $this->frontend_acco_model->get("amenities",array('ami_id' => $roomDetail['id']));
        if(isset($bedType['id'])){
            $roomDetail['bedType'] = $bedType['name'];
        }
        
        if($arrivalDate != "" && $departureDate != ""){
            $startdate=strtotime($arrivalDate);
            $enddate=strtotime($departureDate);    //上面的php时间日期函数已经把日期变成了时间戳，就是变成了秒。这样只要让两数值相减，然后把秒变成天就可以了，比较的简单，如下：
            $days=round(($enddate-$startdate)/3600/24) ;
            $roomDetail['total_day'] = $days;    //days为得到的天数;

            //計算每天的價格
            $datePrice = array();
            $totalPrice = 0;
            for($i=$startdate;$i<$enddate;$i+=(24*3600)){
                $weekday  = date('w', $i);
                if($weekday == 0){
                    $weekday = 7;
                }

                $datePrice[] = array(
                    'date'  => date('Y-m-d',$i).', '.$this->get_chinese_weekday(date('Y-m-d',$i)),
                    'price' => $roomDetail['prices_sell'][$weekday-1],
                );

                $totalPrice += $roomDetail['prices_sell'][$weekday-1];
            }
            $roomDetail['priceList'] = $datePrice;
            $roomDetail['total_price'] = $totalPrice;
        }

        return $roomDetail;
    }
    
    public function getlastMonthDays($date){
        $timestamp=strtotime($date);
        $firstday=date('Y-m-01',strtotime(date('Y',$timestamp).'-'.date('m',$timestamp).'-01'));
        $lastday=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
        return array($firstday,$lastday);
    }
    
    
}
?>