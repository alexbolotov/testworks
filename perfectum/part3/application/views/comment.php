
	
<main role="main" class="container">	
	
<div class="starter-template">
<?php echo validation_errors(); ?>

<?php echo form_open('comments/index'); ?>
<h5>Введите Ваш коментарий</h5>
<div class="form-row">
	 <div class="form-group col-md-6">
	    <input type="text" class="form-control text-center" name="nik" value="<?php echo set_value('nik'); ?>" size="50" placeholder="ФИО/никнейм" />
	 </div>
	 <div class="form-group col-md-6">
	    <input type="text" class="form-control text-center" name="email" value="<?php echo set_value('email'); ?>" size="50" placeholder="емайл" required />
	 </div>
</div>
      <div class="form-group">
        <textarea rows="5" class="form-control text-center" cols="100" name="message" placeholder="текст комментария" required><?php echo set_value('message'); ?></textarea>
      </div>
      <div class="right_butn">
		  <input type="submit" class="btn btn-outline-dark btn-lg" value="Отправить" />
	  </div>
</form>

<hr>

<?php foreach ($comments as $comment): ?>

  <div class="row">
    <div class="col-10">
        <h5><?php echo $comment->nik ?></h5>
    </div>
  <div class="col right_butn">       
        <h5><?php echo date('m.d.Y', strtotime($comment->data)) ?></h5>
    </div>
  </div>       
  <div class="main">
            <?php echo $comment->message ?>
  </div>
  
<hr>

<?php endforeach; ?>

<div class="right_butn">
<?php echo $pagination ?>
</div>

</div>

</main>
