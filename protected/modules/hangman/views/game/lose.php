<?php $this->breadcrumbs =array('Hangman'=>array('game/play'), 'Lose',); ?>
<h2>You Lose!</h2>

<p>The word was: <?php echo $this->word; ?>.</p>

<p><?php echo CHtml::link('Start Again',array('play')); ?></p>
