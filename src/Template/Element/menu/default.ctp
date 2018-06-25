<div class="navbar navbar-default navbar-fixed-top" id="top">
	<div class="container-fluid">
		<div class="navbar-header">
			<?=$this->Html->link("DogSearch",'/',["class"=>"navbar-brand","id"=>"header"]); ?>
		</div>
		<?=$this->Form->create("Videos",
['type'=>'get','url'=>['controller'=>'Videos','action'=>'result'],'class'=>"navbar-form navbar-left"]); ?>
		<div class="form-group">
			<?=$this->Form->input('keyword',['label'=>false,'class'=>"form-control"]); ?>
		</div>
		<?=$this->Form->button('検索',['type'=>'submit','id'=>'btn','class'=>'btn btn-info']); ?>
		<?=$this->Form->end(); ?>

		<div>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<?= $this->Html->link("ログイン","/users/login"); ?>
				</li>
				<li class="dropdown">
					<?=$this->Html->link("ユーザ登録","/users/register");?>
				</li>
			</ul>
		</div>
	</div>
</div>