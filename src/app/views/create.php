<?php
$notify = unserialize($_COOKIE[ALERT] ?? "");
?>
<section class='p-5'>
  <?php if(!empty($notify)): ?>
        <div class="alert alert-<?=$notify['status']?> alert-dismissible fade show d-flex column-gap-3" role="alert">
            <strong class="d-flex flex-row column-gap-2 align-items-center">
            <?php if($notify['status'] == 'success'): ?>
                <i class='bx bxs-check-circle'></i>
            <?php else: ?>
                <i class='bx bxs-x-circle' ></i>
            <?php endif;?>
            <?= $notify['title'] ?>
        </strong>
        <?= $notify['description']?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
 <?php endif ?>

<form method="post" action="/create" enctype="multipart/form-data">
  <div class="mb-5">
    <label for="headingId" class="form-label">Title</label>
    <input type="text" class="form-control" id="headingId" name='heading'/>
  </div>
  <div class="mb-5">
    <label for="descriptionId" class="form-label">Description</label>
    <input type="text" class="form-control" id="descriptionId" name=<?= DESCRIPTION ?>>
  </div>
  <div class="input-group mb-5">
    <input type="file" class="form-control" id="inputGroupFile04" name='image'>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="/posts" class="btn btn-secondary">Cancel</a>
</form>
</section>
