<!-- load more posts button component -->
<?php if($rows > 4 && $rows > $limit): ?>
    <div class="hidden-anchor">
        <a name="more-posts" href=""></a>
    </div>
    <div class="title">
        <a href="#more-posts" class="btn addMargin" id="load-more">Load more</a>
    </div>
<?php endif; ?>