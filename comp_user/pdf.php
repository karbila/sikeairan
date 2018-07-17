<?php  
$judul = "Panduan Penggunaan SI Database Jaringan Pipa Air Bersih Kab. Kediri";
?>

<div id="box-judul">
    	<h3 class="heading"><i class="icon-kanan icon-white"></i> <?=$judul ?></h3>
</div>
<div class='box-tabel'>
	<a id="viewerPlaceHolder" style="width:auto;height:600px;display:block"></a>

	<script type="text/javascript" src="comp_user/flexpaper_flash.js"></script>
	<script type="text/javascript"> 
		var fp = new FlexPaperViewer(	
				 'comp_user/FlexPaperViewers',
				 'viewerPlaceHolder', { config : {
				 SwfFile : escape('comp_user/Panduan.swf'),
				 Scale : 0.6, 
				 ZoomTransition : 'easeOut',
				 ZoomTime : 0.5,
				 ZoomInterval : 0.2,
				 FitPageOnLoad : false,
				 FitWidthOnLoad : true,
				 FullScreenAsMaxWindow : false,
				 ProgressiveLoading : false,
				 MinZoomSize : 0.2,
				 MaxZoomSize : 5,
				 SearchMatchAll : false,
				 InitViewMode : 'Portrait',
				 PrintPaperAsBitmap : false,
				 PrintToolsVisible : false, 
				 ReadOnly : true,
				 PrintEnabled : false,
				 ViewModeToolsVisible : true,
				 ZoomToolsVisible : true,
				 NavToolsVisible : true,
				 CursorToolsVisible : true,
				 SearchToolsVisible : true,  						
	  			 localeChain: 'en_US'
				 }});
	</script>  
</div>      

