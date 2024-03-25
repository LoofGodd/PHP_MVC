<?php
use App\Modal\MVCModal;

$mvcModal = new MVCModal();
$id = $_GET['id'] ?? "";
$data = $mvcModal->get($id);
?>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#exampleModal" id='deleteModal'>
        Launch demo modal
    </button>

    <?php
    if (count($data['data'])):
        $post_delete = $data['data'];
?>
    <!-- Modal -->
    <form method="post" action='remove'>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" onclick="goBack()">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?= "Delete Item with id: ". $post_delete['id']?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Item heading: "<?= $post_delete['heading'] ?>" are going to be deleted. are you so sure?
                    </div>
                    <div class="modal-footer">
                        <input type='text' hidden name='id' value="<?= $post_delete['id'] ?>" />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">I'm Positive</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    if (!empty($id) && $action == 'delete') {
        $triggerModal = <<<SCRIPT
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.getElementById("deleteModal").click();
                    });
                </script>
                SCRIPT;
                echo $triggerModal;
                }
            ?>
            <script>
  function goBack() {
    history.back();
  }
</script>
<?php endif; ?>
