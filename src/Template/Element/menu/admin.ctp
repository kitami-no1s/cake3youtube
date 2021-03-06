<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="top">
	<div class="container-fluid">
		<div class="navbar-header">
		<p class="navbar-text">ようこそ、<?=$auth["name"]; ?>さん</p>
			<?=$this->Html->link("YouTube",
			['controller'=>'playlists','action'=>'index'],["class"=>"navbar-brand","id"=>"header"]); ?>
			<?= $this->Html->image('nikukyu.png'); ?>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav_target">
			   <span class="icon-bar"></span>
			   <span class="icon-bar"></span>
			   <span class="icon-bar"></span>
      		</button>
		</div>
		<div class="collapse navbar-collapse" id="nav_target">
			<?= $this->Form->create("Videos",
			['type'=>'get','url'=>['controller'=>'Videos','action'=>'result'],'class'=>"navbar-form navbar-left",'id'=>'search']); ?>
		  <div class="form-group">
		  	<?php if(isset($keyword)){ ?>
				<?= $this->Form->input('keyword',['label'=>false,'class'=>"form-control",'default'=>$keyword]); ?>
			<?php }else{ ?>
				<?= $this->Form->input('keyword',['label'=>false,'class'=>"form-control"]); ?>
			<?php } ?>
		  </div>
			<?= $this->Form->button('検索',['type'=>'submit','id'=>'search_btn','class'=>'btn btn-info','disabled'=>false]); ?>
			<?= $this->Form->end(); ?>
		  <div>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<?= $this->Html->link("マイプレイリスト","/admin/mylists/index"); ?>
				</li>
				<li class="dropdown">
					<?=$this->Html->link("ユーザー管理","#",["data-toggle"=>"dropdown"]);?>
					<div class="dropdown-menu">
						<ul><?=$this->Html->link("ユーザ編集","/admin/users/edit")?></ul>
						<ul><?=$this->Html->link("ログアウト","/admin/users/logout")?></ul>
					</div>
				</li>
			</ul>
		  </div>	
	  </div>
  </div>
</nav>