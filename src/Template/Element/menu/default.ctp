<div class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-brand">
		<?=$this->Html->link("YouTube","/playlists/index",["class"=>"navbar-brand"]); ?>
			<div id="search">
			<?php

				echo $this->Form->create("Videos",['type'=>'get','url'=>['controller'=>'Videos','action'=>'result']]);
				echo $this->Form->input('keyword');
				echo $this->Form->button("検索");
				echo $this->Form->end();
			?>
			</div>
			<ul id="start-menu">
				<li>
					<?= $this->Html->link("ログイン","/users/login"); ?>
				</li>
				<li>
					<?=$this->Html->link("ユーザ登録","/users/register");?>
				</li>
			</ul>
</div>

</div>