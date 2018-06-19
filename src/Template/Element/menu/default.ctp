<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<?=$this->Html->link("YouTube","/playlists/index",["class"=>"navbar-brand"]); ?>
			<table>
				<td><?=$this->Form->create("Videos",['type'=>'get','url'=>['controller'=>'Videos','action'=>'result']]); ?></td>
				<td><?=$this->Form->input('keyword',['label'=>false]); ?></td>
				<td><?=$this->Form->button("検索"); ?></td>
				<td><?=$this->Form->end(); ?></td>
			</table>
			<div id="start-menu">
				<p>
					<?= $this->Html->link("ログイン","/users/login"); ?>
				</p>
				<p>
					<?=$this->Html->link("ユーザ登録","/users/register");?>
				</p>
			</div>

</div>