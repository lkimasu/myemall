<?php
if (strpos(G5_URL, "http://") !== false) goto_url(str_replace("http://", "https://", G5_URL).$_SERVER['REQUEST_URI']);



