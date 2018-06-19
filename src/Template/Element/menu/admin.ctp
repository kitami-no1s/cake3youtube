<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
		<?= $this->Html->link("YoTube",["controller" => "Users"]
		,["class"=>"navbar-brand"]); ?>
		</div>
		
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<?= $this->Html->link(?=$this->Html->link("マイリスト","/admin/index"); ?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<p class="navbar-text">ようこそ、<?=$auth["email"]; ?></p>
				<li class="dropdown">
					<?= $this->Html->link("管理","#",["data-toggle"=>"dropdown"]); ?>
					<ul class="dropdown-menu">
						<li><?=$this->Html->link("ユーザ編集","/admin/users/edit")?></li>
						<li><?=$this->Html->link("ログアウト","/admin/users/logout")?></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
		