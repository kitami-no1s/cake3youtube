<h1 class="page-header">プレイリスト新規追加</h1>
<?php
echo $this->Form->create($playlist);
echo $this->Form->input('title');
echo $this->Form->input('public');
echo $this->Form->button("登録");
echo $this->Form->end();
?>