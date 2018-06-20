<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<?=$this->Html->link("YouTube","/playlists/index",["class"=>"navbar-brand"]); ?>
			<table>
				<td><?=$this->Form->create("Videos",['type'=>'get','url'=>['controller'=>'Videos','action'=>'result']]); ?></td>
				<td><?=$this->Form->input('keyword',['label'=>false]); ?></td>
				<td><?=$this->Form->button("検索"); ?></td>
				<td><?=$this->Form->end(); ?></td>
			</table>
			<p class="navbar-text">ようこそ、<?=$auth["email"]; ?></p>

			<div id="login-menu">
			<p><?=$this->Html->link("マイプレイリスト","/admin/mylists/index");?></p>	
				<div class="dropdown">
					<?= $this->Html->link("管理","#",["data-toggle"=>"dropdown"]); ?>
					<div class="dropdown-menu">
						<p><?=$this->Html->link("ユーザ編集","/admin/users/edit")?></li>
						<p><?=$this->Html->link("ログアウト","/admin/users/logout")?></li>
					</div>
				</div>
		</div>
</div>
		