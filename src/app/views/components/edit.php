<?php
use App\Util\Image;
?>

<form class="bg-secondary bg-opacity-10 mx-2 py-3 rounded-5 row align-items-end  text-center column-gap-3" action="/update" method="POST" enctype="multipart/form-data">
    <div class='col-2 row'>
        <input type='text' hidden name=<?= ID ?> value="<?= $post_delete[ID] ?>" />
        <input type="file" class="form-control col-5" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name=<?=IMAGE ?>>
        <?php if (Image::read($post_delete[IMAGE])): ?>
        <div class="overflow-hidden rounded-2 mt-1 col-5">
            <img class="w-100 h-auto rounded-3" src="<?php echo Image::read($post_delete[IMAGE]) ?>" />
        </div>
        <?php endif; ?>
    </div>
    <div class="col-3">
        <input type="text" name=<?= HEADING ?> class="form-control" id="headingId" value="<?php echo $post_delete[HEADING] ?>" />
    </div>
    <div class="col-3">
        <input type="text" name=<?= DESCRIPTION ?> class="form-control" id="descriptionId" value="<?php echo $post_delete[DESCRIPTION] ?>">
    </div>
    <div class='col-3'>
        <button type="submit" class="btn btn-primary">Good To Go</button>
        <a href='<?php echo removeParams([ID, ACTION_POST]) ?>' type="submit" class="btn btn-secondary">Cancel</a>
    </div>
</form>
