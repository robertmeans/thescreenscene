<?php if ($s[0] == null || $s[1] == null || $s[2] == null || $s[3] == null || $s[4] == null) {
    require '_includes/search_stack_top_static.php';
} else { ?>
<ul id="top-search">
      <li id="<?= $s[0]; ?>" class="ct <?php if ($s[0] == "1") {echo "google";} if ($s[0] == "2") {echo "url";} if ($s[0] == "3") {echo "bing";} if ($s[0] == "4") {echo "reference";} if ($s[0] == "5") {echo "youtube";} ?>"><?php 
        if ($s[0] == "1") {require '_includes/search_google.php';}
        if ($s[0] == "2") {require '_includes/search_url.php';}
        if ($s[0] == "3") {require '_includes/search_bing.php';}
        if ($s[0] == "4") {
            if ($row['reference'] == 1) {
            require '_includes/search_dictionary.php';
            } else { require '_includes/search_thesaurus.php'; }
        }
        if ($s[0] == "5") {require '_includes/search_youtube.php';} 

        ?></li>

      <li id="<?= $s[1] ?>" class="ct <?php if ($s[1] == "1") {echo "google";} if ($s[1] == "2") {echo "url";} if ($s[1] == "3") {echo "bing";} if ($s[1] == "4") {echo "reference";} if ($s[1] == "5") {echo "youtube";} ?>"><?php 
        if ($s[1] == "1") {require '_includes/search_google.php';}
        if ($s[1] == "2") {require '_includes/search_url.php';}
        if ($s[1] == "3") {require '_includes/search_bing.php';}
        if ($s[1] == "4") {
            if ($row['reference'] == 1) {
            require '_includes/search_dictionary.php';
            } else { require '_includes/search_thesaurus.php'; }
        }
        if ($s[1] == "5") {require '_includes/search_youtube.php';} 

        ?></li>

      <li id="<?= $s[2] ?>" class="ct <?php if ($s[2] == "1") {echo "google";} if ($s[2] == "2") {echo "url";} if ($s[2] == "3") {echo "bing";} if ($s[2] == "4") {echo "reference";} if ($s[2] == "5") {echo "youtube";} ?>"><?php 
        if ($s[2] == "1") {require '_includes/search_google.php';}
        if ($s[2] == "2") {require '_includes/search_url.php';}
        if ($s[2] == "3") {require '_includes/search_bing.php';}
        if ($s[2] == "4") {
            if ($row['reference'] == 1) {
            require '_includes/search_dictionary.php';
            } else { require '_includes/search_thesaurus.php'; }
        }
        if ($s[2] == "5") {require '_includes/search_youtube.php';} 

        ?></li>

      <li id="<?= $s[3] ?>" class="ct <?php if ($s[3] == "1") {echo "google";} if ($s[3] == "2") {echo "url";} if ($s[3] == "3") {echo "bing";} if ($s[3] == "4") {echo "reference";} if ($s[3] == "5") {echo "youtube";} ?>"><?php 
        if ($s[3] == "1") {require '_includes/search_google.php';}
        if ($s[3] == "2") {require '_includes/search_url.php';}
        if ($s[3] == "3") {require '_includes/search_bing.php';}
        if ($s[3] == "4") {
            if ($row['reference'] == 1) {
            require '_includes/search_dictionary.php';
            } else { require '_includes/search_thesaurus.php'; }
        }
        if ($s[3] == "5") {require '_includes/search_youtube.php';} 

        ?></li>
</ul>
<?php } ?>