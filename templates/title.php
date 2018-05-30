<div class="ui container">
<span class="ui huge  header">
<?php echo($title) ?>

</span>
<?php if (!$disableButton) { ?>
<a href="<?php echo("./add".substr($title, 0, -1))?>">
<button class="ui right floated labeled icon button">
  <i class="add icon"></i>
  Add <?php echo(substr($title, 0, -1)) ?>
</button>
</a>
</div>
<?php } ?>
<div class="ui divider"></div>