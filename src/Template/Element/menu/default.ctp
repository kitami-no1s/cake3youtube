<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
		<?=$this->Html->link("YouTube","/playlists/index",["class"=>"navbar-brand"]); ?>
		</div>
			<?php
				echo $this->Form->create("Videos",['type'=>'get','url'=>['controller'=>'Videos','action'=>'result']]);
				echo $this->Form->input('keyword');
				echo $this->Form->button("検索");
				echo $this->Form->end();
			?>
			<ul id="">
				<li>
					<?= $this->Html->link("ログイン","/users/login"); ?>
				</li>
				<li>
					<?=$this->Html->link("ユーザ登録","/users/register");?>
				</li>
			</ul>
		</div>
	</div>
</div>