<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="top">
	<div class="container-fluid">
		<div class="navbar-header">
	      <?=$this->Html->link("YouTube",'/',["class"=>"navbar-brand","id"=>"header"]); ?>
	      <?= $this->Html->image('nikukyu.png'); ?>
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav_target">
	        <span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
	    </div>
	    <div class="collapse navbar-collapse" id="nav_target">
          <?=$this->Form->create("Videos",
		  ['type'=>'get','url'=>['controller'=>'Videos','action'=>'result'],'class'=>"navbar-form navbar-left",'id'=>'search']); ?>
	      <div class="form-group">
		   <?php if(isset($keyword)){ ?>
				<?= $this->Form->input('keyword',['label'=>false,'class'=>"form-control",'default'=>$keyword]); ?>
			<?php }else{ ?>
				<?= $this->Form->input('keyword',['label'=>false,'class'=>"form-control"]); ?>
			<?php } ?>
	      </div>
		  <?=$this->Form->button('検索',['type'=>'submit','id'=>'search_btn','class'=>'btn btn-info','disabled'=>false]); ?>
		  <?=$this->Form->end(); ?>  
	      <div>
	    	<ul class="nav navbar-nav navbar-right">    
              <li><?= $this->Html->link("ログイン","/users/login"); ?></li>
              <li><?=$this->Html->link("ユーザ登録","/users/register");?></li>
            </ul>
          </div>
	   </div>
    </div>
</nav>