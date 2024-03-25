<div>
   <!-- Pagination -->
   <nav aria-label="Page navigation example" class="mt-5 mx-auto" style="width: fit-content;">
      <ul class="pagination">
         <li class="page-item">
            <a class="page-link" href="<?php echo createOrUpdateParams(PAGINATION."=$previousPage") ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            </a>
         </li>
         <?php for ($i=1; $i <= $totalPages ; $i++):?>
         <li class="page-item <?php echo $i == $currentPage ? 'active': 'yse' ?>"><a class="page-link" href="<?php echo createOrUpdateParams(PAGINATION."=$i") ?>"><?php echo $i ?></a></li>
         <?php endfor; ?>
         <li class="page-item">
            <a class="page-link" href="<?php echo createOrUpdateParams(PAGINATION."=$nextPage") ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            </a>
         </li>
      </ul>
   </nav>
</div>
