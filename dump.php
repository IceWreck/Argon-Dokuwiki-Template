<!-- ********** HEADER ********** -->
<div id="dokuwiki__header">
    <div class="pad">

        <div class="headings">
            <h1><?php tpl_link(wl(), $conf['title'], 'accesskey="h" title="[H]"')?></h1>
            <?php /* how to insert logo instead (if no CSS image replacement technique is used):
upload your logo into the data/media folder (root of the media manager) and replace 'logo.png' accordingly:
tpl_link(wl(),'<img src="'.ml('logo.png').'" alt="'.$conf['title'].'" />','id="dokuwiki__top" accesskey="h" title="[H]"') */?>
            <?php if ($conf['tagline']): ?>
            <p class="claim"><?php echo $conf['tagline'] ?></p>
            <?php
endif?>

            <ul class="a11y skip">
                <li><a href="#dokuwiki__content"><?php echo $lang['skip_to_content'] ?></a></li>
            </ul>
            <div class="clearer"></div>
        </div>

        <div class="tools">
            <!-- USER TOOLS -->
            <?php if ($conf['useacl'] && $showTools): ?>
            <div id="dokuwiki__usertools">
                <h3 class="a11y"><?php echo $lang['user_tools'] ?></h3>
                <ul>
                    <?php
                    if (!empty($_SERVER['REMOTE_USER'])) {
                        echo '<li class="user">';
                        tpl_userinfo(); /* 'Logged in as ...' */
                        echo '</li>';
                    }
                    ?>
                    <?php /* the optional second parameter of tpl_action() switches between a link and a button,
e.g. a button inside a <li> would be: tpl_action('edit', 0, 'li') */
?>

                </ul>
            </div>
            <?php
endif?>

            <!-- SITE TOOLS -->
            <div id="dokuwiki__sitetools">
                <h3 class="a11y"><?php echo $lang['site_tools'] ?></h3>
                <?php tpl_searchform()?>
                <ul>
                    <?php tpl_toolsevent('sitetools', array(
                        'recent' => tpl_action('recent', 1, 'li', 1),
                        'media' => tpl_action('media', 1, 'li', 1),
                        'index' => tpl_action('index', 1, 'li', 1),
                    ));?>
                </ul>
            </div>

        </div>
        <div class="clearer"></div>

        

        <div class="clearer"></div>
        <hr class="a11y" />
    </div>
</div>


<!-- /header -->



























              <!-- ********** ASIDE ********** -->
              <?php if ($showSidebar): ?>
                  <div id="dokuwiki__aside"><div class="pad aside include group">
                      <?php tpl_includeFile('sidebarheader.html') ?>
                      <?php tpl_include_page($conf['sidebar'], 1, 1) /* includes the nearest sidebar page */ ?>
                      <?php tpl_includeFile('sidebarfooter.html') ?>
                      <div class="clearer"></div>
                  </div></div><!-- /aside -->
              <?php
              endif; ?>
              <hr/>



              <!-- ********** CONTENT ********** -->
              <div id="dokuwiki__content">
                <div class="pad">
                  <?php tpl_flush() /* flush the output buffer */ ?>
                  <?php tpl_includeFile('pageheader.html') ?>

                  <div class="page">
                      <!-- wikipage start -->
                      <?php tpl_content() /* the main content */ ?>
                      <!-- wikipage stop -->
                      <div class="clearer"></div>
                  </div>

                  <?php tpl_flush() ?>
                  <?php tpl_includeFile('pagefooter.html') ?>
              </div>
              </div>
              <!-- /content -->





















              <div id="dokuwiki__top"
              class="site <?php echo tpl_classes(); ?> <?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>"> 
            </div>
              <?php html_msgarea() /* occasional error and info messages on top of the page */ ?>
              <?php tpl_includeFile('header.html') ?>












              <?php

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
header('X-UA-Compatible: IE=edge,chrome=1');

$showTools = !tpl_getConf('hideTools') || ( tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']) );
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT=='show');
?>





















<?php if ($showTools): ?>
                      <div id="dokuwiki__pagetools" class="ct-toc-item active">
                       <a class="ct-toc-link"><?php echo $lang['page_tools'] ?></a>
                       <ul class="nav ct-sidenav">
                              <?php tpl_toolsevent('pagetools', array(
                                'edit' => tpl_action('edit', 1, 'li', 1) ,
                                'revisions' => tpl_action('revisions', 1, 'li', 1) ,
                                'backlink' => tpl_action('backlink', 1, 'li', 1) ,
                                'subscribe' => tpl_action('subscribe', 1, 'li', 1) ,
                                'revert' => tpl_action('revert', 1, 'li', 1) ,
                                'top' => tpl_action('top', 1, 'li', 1) ,
                              )); ?>
                          </ul>
                      </div>
                  <?php endif; ?>