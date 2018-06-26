<div class="navbar navbar-default navbar-fixed-top" role="navigation" id="top">
	<div class="container-fluid">
		<div class="navbar-header">
			<?=$this->Html->link("DogSearch",
['controller'=>'playlists','action'=>'index'],["class"=>"navbar-brand","id"=>"header"]); ?>
<?= $this->Html->image('nikukyu.png') ?>
		</div>
		<?=$this->Form->create("Videos",
['type'=>'get','url'=>['controller'=>'Videos','action'=>'result'],'class'=>"navbar-form navbar-left"]); ?>
		<div class="form-group">
			<?=$this->Form->input('keyword',['label'=>false,'class'=>"form-control"]); ?>
		</div>
			<?=$this->Form->button('検索',['type'=>'submit','id'=>'btn','class'=>'btn btn-info','disabled'=>false]); ?>
			<?=$this->Form->end(); ?>
		<div>
			<ul class="nav navbar-nav navbar-right">
			<p class="navbar-text">ようこそ、<?=$auth["name"]; ?>さん</p>
				<li class="dropdown">
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