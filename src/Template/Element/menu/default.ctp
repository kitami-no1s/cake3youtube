<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
		<?=$this->Html->link("YouTube","/playslist/index",["class"=>"navbar-brand"]); ?>
		</div>
		<div class="collapse navbar-collapse">
			<form>
				<input type="text" id="keyword" value=" "/>
				<input type="submit" value="検索" id="btn" disabled="disabled" />
			</form>
			<ul class="nav navbar-nav">
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