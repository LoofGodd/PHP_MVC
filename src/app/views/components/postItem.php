<?php
   use App\Util\Image;
   ?>
<div class="bg-secondary bg-opacity-10 mx-2 py-3 rounded-5 row align-items-center text-center column-gap-3" >
   <!-- image -->
   <div class="col-1 overflow-hidden rounded-2">
      <img class="w-100 h-auto rounded-3" src="<?php echo Image::read($post_delete[IMAGE]) ?>" />
   </div>
   <!-- heading -->
   <div class="col-3">
      <h1 class="fs-4"><?php echo $post_delete[HEADING] ?? "" ?></h1>
   </div>
   <!-- caption -->
   <div class="col-4">
      <p class="fs-6"><?php echo $post_delete[DESCRIPTION] ?? "" ?></p>
   </div>
   <div class="col-3">
      <a  href="<?php echo createOrUpdateParams(ACTION_POST."=delete&id=".$post_delete[ID])?>" class="border-none bg-transparent btn text-info">
      <i class="bx bx-trash fs-1"></i>
      </a>
      <a href="<?php echo createOrUpdateParams(ACTION_POST."=edit&id=".$post_delete[ID])?>" class="border-none bg-transparent btn text-info"  data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tooltip on bottom">
      <i class="bx bx-edit fs-1"></i>
      </a>
   </div>
</div>
