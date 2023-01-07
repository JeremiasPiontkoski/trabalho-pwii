<?php

foreach ($faqs as $faq) {?>
<a href="<?= url("admin/responderFaq/id?id=" . $faq->id)?>"><?=$faq->question?></a>
<?php
}?>
