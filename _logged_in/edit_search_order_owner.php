<?php $r = explode(",",$row['search_order']); ?>

<ul id="sortablesearch" class="order owner">

  <li id="<?= $r[0]; ?>" class="ct sert <?php if ($r[0] == "1") {echo "google";} if ($r[0] == "2") {echo "url";} if ($r[0] == "3") {echo "bing";} if ($r[0] == "4") {echo "reference";} if ($r[0] == "5") {echo "youtube";} ?>"><?php 
    if ($r[0] == "1") {require '_includes_static/static_google.php';}
    if ($r[0] == "2") {require '_includes_static/static_url.php';}
    if ($r[0] == "3") {require '_includes_static/static_bing.php';}
    if ($r[0] == "4") {
      ?><div id="dic-row" class="<?php if ($row['reference'] == "1") { echo "selected"; } ?>"><?php
      require '_includes_static/static_dictionary.php';
      ?></div>
      <div id="the-row" class="<?php if ($row['reference'] == "2") { echo "selected"; } ?>">
      <?php
      require '_includes_static/static_thesaurus.php'; 
      ?></div><?php
  }
    if ($r[0] == "5") {require '_includes_static/static_youtube.php';} 

    ?></li>

  <li id="<?= $r[1] ?>" class="ct sert <?php if ($r[1] == "1") {echo "google";} if ($r[1] == "2") {echo "url";} if ($r[1] == "3") {echo "bing";} if ($r[1] == "4") {echo "reference";} if ($r[1] == "5") {echo "youtube";} ?>"><?php 
    if ($r[1] == "1") {require '_includes_static/static_google.php';}
    if ($r[1] == "2") {require '_includes_static/static_url.php';}
    if ($r[1] == "3") {require '_includes_static/static_bing.php';}
    if ($r[1] == "4") {
      ?><div id="dic-row" class="<?php if ($row['reference'] == "1") { echo "selected"; } ?>"><?php
      require '_includes_static/static_dictionary.php';
      ?></div>
      <div id="the-row" class="<?php if ($row['reference'] == "2") { echo "selected"; } ?>">
      <?php
      require '_includes_static/static_thesaurus.php'; 
      ?></div><?php
  }
    if ($r[1] == "5") {require '_includes_static/static_youtube.php';} 

    ?></li>

  <li id="<?= $r[2] ?>" class="ct sert <?php if ($r[2] == "1") {echo "google";} if ($r[2] == "2") {echo "url";} if ($r[2] == "3") {echo "bing";} if ($r[2] == "4") {echo "reference";} if ($r[2] == "5") {echo "youtube";} ?>"><?php 
    if ($r[2] == "1") {require '_includes_static/static_google.php';}
    if ($r[2] == "2") {require '_includes_static/static_url.php';}
    if ($r[2] == "3") {require '_includes_static/static_bing.php';}
    if ($r[2] == "4") {
      ?><div id="dic-row" class="<?php if ($row['reference'] == "1") { echo "selected"; } ?>"><?php
      require '_includes_static/static_dictionary.php';
      ?></div>
      <div id="the-row" class="<?php if ($row['reference'] == "2") { echo "selected"; } ?>">
      <?php
      require '_includes_static/static_thesaurus.php'; 
      ?></div><?php
  }
    if ($r[2] == "5") {require '_includes_static/static_youtube.php';} 

    ?></li>

  <li id="<?= $r[3] ?>" class="ct sert <?php if ($r[3] == "1") {echo "google";} if ($r[3] == "2") {echo "url";} if ($r[3] == "3") {echo "bing";} if ($r[3] == "4") {echo "reference";} if ($r[3] == "5") {echo "youtube";} ?>"><?php 
    if ($r[3] == "1") {require '_includes_static/static_google.php';}
    if ($r[3] == "2") {require '_includes_static/static_url.php';}
    if ($r[3] == "3") {require '_includes_static/static_bing.php';}
    if ($r[3] == "4") {
      ?><div id="dic-row" class="<?php if ($row['reference'] == "1") { echo "selected"; } ?>"><?php
      require '_includes_static/static_dictionary.php';
      ?></div>
      <div id="the-row" class="<?php if ($row['reference'] == "2") { echo "selected"; } ?>">
      <?php
      require '_includes_static/static_thesaurus.php'; 
      ?></div><?php
  }
    if ($r[3] == "5") {require '_includes_static/static_youtube.php';} 

    ?></li>

<li class="static">

  <?php $inner_nav_context = "owner";
  $layout_context = "edit_searches"; ?>
  <ul class="inner-nav">
    <?php require 'nav/inner_nav.php'; ?>
  </ul>
<?php show_session_variables(); ?>
  <div class="search-instructions">
    <ol id="default">
      <li>Drag &amp; drop the order of your search fields for this project. Whatever you put at the top will be ready for your search when you visit.</li>
      <li>Select which reference field to use as a default:</li>
    </ol>

    <div class="td-form">
      <form action="dictionary_thesaurus_01.php" method="post" class="ajax">
        <input type="hidden" name="the_dic" value="1">

          <a id="d" class="<?php if ($row['reference'] == "1") { echo "selected"; } ?> td static" onclick="$(this).closest('form').submit()"><span id="dict" class="<?php if ($row['reference'] == "1") { echo "selected"; } ?>"><i class="fas fa-check"></i></span> Dictionary</a>
      </form>

      <form action="dictionary_thesaurus_01.php" method="post" class="ajax">
        <input type="hidden" name="the_dic" value="2">
          <a id="t" class="<?php if ($row['reference'] == "2") { echo "selected"; } ?> td static" onclick="$(this).closest('form').submit()"><span id="thes" class="<?php if ($row['reference'] == "2") { echo "selected"; } ?>"><i class="fas fa-check"></i></span> Thesaurus</a>
      </form>
    </div>

  </div><!-- .search-instructions -->
</li>

  <li id="<?= $r[4] ?>" class="ct sert <?php if ($r[4] == "1") {echo "google";} if ($r[4] == "2") {echo "url";} if ($r[4] == "3") {echo "bing";} if ($r[4] == "4") {echo "reference";} if ($r[4] == "5") {echo "youtube";} ?>"><?php 
    if ($r[4] == "1") {require '_includes_static/static_google.php';}
    if ($r[4] == "2") {require '_includes_static/static_url.php';}
    if ($r[4] == "3") {require '_includes_static/static_bing.php';}
    if ($r[4] == "4") {
      ?><div id="dic-row" class="<?php if ($row['reference'] == "1") { echo "selected"; } ?>"><?php
      require '_includes_static/static_dictionary.php';
      ?></div>
      <div id="the-row" class="<?php if ($row['reference'] == "2") { echo "selected"; } ?>">
      <?php
      require '_includes_static/static_thesaurus.php'; 
      ?></div><?php
  }
    if ($r[4] == "5") {require '_includes_static/static_youtube.php';} 

    ?></li>

</ul>
<form action=""><input type="hidden" id="search_order"></form>