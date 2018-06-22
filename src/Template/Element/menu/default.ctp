<div class="top">
		<p id="inu">
		<?=$this->Html->link("DogSearch",['controller'=>'playlists','action'=>'index']); ?>
		</p>
			<table>
				<td><?=$this->Form->create("Videos",['type'=>'get','url'=>['controller'=>'Videos','action'=>'result']]); ?></td>
				<td><?=$this->Form->input('keyword',['label'=>false,'style'=>'margin-top: 15px']); ?></td>
				<td><?=$this->Form->button($this->html->image('inu.png'),['type'=>'submit','id'=>'btn']); ?></td>
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