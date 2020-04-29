<!--
=========================================================
*  Argon Dokuwiki Template
*  Based on the Argon Design System by Creative Tim
*  Ported to Dokuwiki by Anchit (@IceWreck)
=========================================================
 -->

<?php
if (!defined('DOKU_INC')) {
    die();
}
/* must be run from within DokuWiki */
@require_once dirname(__FILE__) . '/tpl_functions.php'; /* include hook for template functions */

$showTools = !tpl_getConf('hideTools') || (tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']));
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT == 'show');
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
		<link rel="icon" type="image/png" href="assets/img/favicon.png">
		<title>
			<?php tpl_pagetitle()?> [
			<?php echo strip_tags($conf['title']) ?>]</title>
		<?php tpl_metaheaders()?>
		<?php echo tpl_favicon(array(
			'favicon',
			'mobile',
		))
		?>

		<?php tpl_includeFile('meta.html')?>

		<!-- 
		I know the CSS and JS imports can be done within the style.ini and script.js files,
		but I had some issues with styling (and import order) there, so I'm doing those imports here. 
		-->
		<!--     Fonts and icons  -->
		<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> -->
		<link href="<?php echo tpl_basedir(); ?>assets/css/fonts.css" rel="stylesheet">
		<!-- CSS Files -->
		<link href="<?php echo tpl_basedir(); ?>assets/css/doku.css" rel="stylesheet" />
		<!-- JS -->
		<script src="<?php echo tpl_basedir(); ?>assets/js/core/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php echo tpl_basedir(); ?>assets/js/argon-design-system.min.js" type="text/javascript"></script>

	</head>

	<body class="docs ">
		<div id="dokuwiki__site">


			<header
				class="navbar navbar-horizontal navbar-expand navbar-dark flex-row align-items-md-center ct-navbar bg-primary py-2">


				<div class="btn btn-neutral btn-icon">
					<span class="btn-inner--icon">
						<!-- <i class=""></i> -->
					</span>
					<span
						class="nav-link-inner--text"><?php tpl_link(wl(), $conf['title'], 'accesskey="h" title="[H]"')?></span>

				</div>


				<div class="d-none d-sm-block ml-auto">
					<ul class="navbar-nav ct-navbar-nav flex-row align-items-center">

						<?php
						$menu_items = (new \dokuwiki\Menu\UserMenu())->getItems();
						foreach($menu_items as $item) {
						echo '<li>'
							.'<a class="nav-link" href="'.$item->getLink().'" title="'.$item->getTitle().'">'
							.'<i class="argon-doku-navbar-icon">'.inlineSVG($item->getSvg()).'</i>'
							. '<span class="a11y">'.$item->getLabel().'</span>'
							. '</a></li>';
						}

						?>


						<li class="nav-item">
							<div class="search-form">
								<?php tpl_searchform()?>
							</div>
						</li>


					</ul>
				</div>
				<button class="navbar-toggler ct-search-docs-toggle d-block d-md-none ml-auto ml-sm-0" type="button"
					data-toggle="collapse" data-target="#ct-docs-nav" aria-controls="ct-docs-nav" aria-expanded="false"
					aria-label="Toggle docs navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

			</header>



			<div class="container-fluid">
				<div class="row flex-xl-nowrap">


					<?php
					// Render the content initially
					ob_start();
					tpl_content(false);
					$buffer = ob_get_clean();
					?>

					<!-- left sidebar -->
					<div class="col-12 col-md-3 col-xl-2 ct-sidebar">
						<nav class="collapse ct-links" id="ct-docs-nav">
							<?php
							if (!empty($_SERVER['REMOTE_USER'])) {
								echo '<li class="nav-item nav-link"> ';
								tpl_userinfo();
								echo '</li>';
							}
							?>
							<?php if ($showTools): ?>
							<div id="dokuwiki__pagetools" class="ct-toc-item active">
								<a class="ct-toc-link">
									<?php echo $lang['page_tools'] ?>
								</a>
								<ul class="nav ct-sidenav">
									<?php
									$menu_items = (new \dokuwiki\Menu\PageMenu())->getItems();
									foreach($menu_items as $item) {
									echo '<li>'
										.'<a class="" href="'.$item->getLink().'" title="'.$item->getTitle().'">'
										. $item->getLabel()
										. '</a></li>';
									}
									?>
								</ul>
							</div>
							<?php endif;?>

							<div class="ct-toc-item active">

								<a class="ct-toc-link">
									<?php echo $lang['site_tools'] ?>
								</a>
								<ul class="nav ct-sidenav">
									<?php
									$menu_items = (new \dokuwiki\Menu\SiteMenu())->getItems();
									foreach($menu_items as $item) {
									echo '<li>'
										.'<a class="" href="'.$item->getLink().'" title="'.$item->getTitle().'">'
										. $item->getLabel()
										. '</a></li>';
									}

									?>
								</ul>
							</div>



							<?php if ($showSidebar): ?>
							<div id="dokuwiki__aside" class="ct-toc-item active">
								<a class="ct-toc-link">
									<?php echo "Sidebar" ?>
								</a>
								<div class="leftsidebar">
									<?php tpl_includeFile('sidebarheader.html')?>
									<?php tpl_include_page($conf['sidebar'], 1, 1)?>
									<?php tpl_includeFile('sidebarfooter.html')?>
								</div>
							</div>
							<?php endif;?>
						</nav>
					</div>


					<!-- center content -->

					<main class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 ct-content dokuwiki" role="main">

						<div id="dokuwiki__top" class="site
						<?php echo tpl_classes(); ?>
						<?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>">
						</div>

						<?php html_msgarea()?>
						<?php tpl_includeFile('header.html')?>


						<!-- Trace/Navigation -->
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<?php if ($conf['breadcrumbs']) {?>
								<div class="breadcrumbs"><?php tpl_breadcrumbs()?></div>
								<?php }?>
								<?php if ($conf['youarehere']) {?>
								<div class="breadcrumbs"><?php tpl_youarehere()?></div>
								<?php }?>
							</ol>
						</nav>


						<!-- Wiki Contents -->
						<div id="dokuwiki__content">
							<div class="pad">

								<div class="page">

									<?php echo $buffer ?>
								</div>
							</div>							
						</div>

						<hr />
						
						<!-- Footer -->
						<div class="card footer-card">
							<div class="card-body">
								<div class="container">
									<div class="row">
										<div class="col">
											<div id="dokuwiki__footer">
												<div class="pad">
													<div class="doc">
														<?php tpl_pageinfo() /* 'Last modified' etc */ ?></div>
													<?php tpl_license('0') /* content license, parameters: img=*badge|button|0, imgonly=*0|1, return=*0|1 */ ?>
												</div>
											</div>
										</div>
									</div>
									<br/>
									<div class="row">

										<div class="footer-search">
											<?php tpl_searchform()?>
										</div>

									</div>
									<br/>
									<div class="row">
									<div class="argon-doku-footer-fullmenu">
										<?php
										$menu_items = (new \dokuwiki\Menu\MobileMenu())->getItems();
										foreach($menu_items as $item) {
										echo '<li>'
											.'<a class="" href="'.$item->getLink().'" title="'.$item->getTitle().'">'
											.'<i class="">'.inlineSVG($item->getSvg()).'</i>'
											. '<span class="a11y">'.$item->getLabel().'</span>'
											. '</a></li>';
										}
										?>
									</div>
									<?php tpl_includeFile('footer.html') ?>
									</div>

								</div>

							</div>
						</div>
						<?php tpl_indexerWebBug(); ?>
					</main>




					<!-- Right Sidebar -->
					<div class="d-none d-xl-block col-xl-2 ct-toc">
						<div>
							<?php tpl_toc()?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</body>

</html>
