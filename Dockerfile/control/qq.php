<?php
require_once('common.php');
C('webtitle','控制台');
C('pageid','control');
include_once 'common.head.php';
?>
<div class="templatemo-content-widget orange-bg">			
			<?php if($rows=$db->get_results("select * from ".C('DB_PREFIX')."qqs where uid='$userrow[uid]' order by qid desc")){ foreach($rows as $row){?>
				
                <i class="fa fa-times"></i>                
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <a href="qqlist.php?qid=<?=$row[qid]?>"><img class="media-object img-circle" src="http://q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?=$row[qq]?>&src_uin=<?=$row[qq]?>&fid=<?=$row[qq]?>&spec=100&url_enc=0&referer=bu_interface&term_type=PC" alt="<?=$row[qq]?>"></a>
					                    </a>
                  </div>
                  <div class="media-body">
					<h2 class="media-heading text-uppercase"><?=$row[qq]?></h2>
					<p>SID<?php if($row[sidzt]){echo"<font color='red'>失效</font>";}else{echo"<font color='green'>正常</font>";}?>/SKEY<?php if($row[skeyzt]){echo"<font color='red'>失效</font>";}else{echo"<font color='green'>正常</font>";}?>.</p>
				</div>        
                </div>                
                                 
            
				<?php }}?>    
				</div>
		<?php
include_once 'common.foot.php';
?>