<script type="text/javascript">
  var variableToSend = 'fooggg';
  $.post('test3.php', {variable: variableToSend});
</script>
<?php

 $variable = $_POST['variable'];
 echo $variable;

 ?>
