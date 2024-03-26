<?php
   use App\Util\Helper;
   $id = $_GET[ID] ?? '';
   $action = $_GET[ACTION_POST] ?? "";
   if (isset($_GET[SEARCH]) && empty($_GET[SEARCH])) {
       header('location:' . removeParams([SEARCH]));
       exit;
   } else {
       $oldSearch = $_GET[SEARCH] ?? "";
   }

   ?>
<main>
   <?php
      require __DIR__ . '/components/modal.php';
      require __DIR__ .'/components/search.php'
      ?>
   <div class="ms-auto me-3" style="width: fit-content">
      <a href="posts/create" class="btn btn-primary">Post Something</a>
   </div>
   <div class="mt-3 d-flex flex-column row-gap-3">
      <?php
         $posts = $posts ?? [];
         if(isset($posts['heading'])){
          $tempPost = $posts;
          unset($posts);
          $posts[] = $tempPost;
         }
         if (count($posts) == 0): ?>
      <h1>No Item Was found </h1>
      <?php else : ?>
      <?php
         $itemPerPage = 3;
         [$currentPage, $totalPages, $previousPage, $nextPage, $startItem, $endItem, $showPosts] = Helper::pagination($posts, $itemPerPage);
         foreach ($showPosts as $showPost) {
             if ($id == $showPost[ID] && $action == 'edit') {
                 require __DIR__ .'/components/edit.php';
             } else {
                 require __DIR__ .'/components/postItem.php';
             }
            }
         ?>
   </div>
   <?php require __DIR__ . "/components/pagination.php" ?>
   <?php endif; ?>
   <script>
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
   </script>
</main>
