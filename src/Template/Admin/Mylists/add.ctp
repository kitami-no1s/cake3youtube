<h1 class="page-header">プレイリスト新規追加</h1>
<?php
echo $this->Form->create($playlist);
echo $this->Form->input('title');
echo $this->Form->input('public',
                          [ 'type' => 'radio','options' => [['0' => '非公開'],['1' => '公開']],
                          ]);
echo $this->Form->button("登録");
echo $this->Form->end();
?>