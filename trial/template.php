<?php 
require_once("/var/www/take/files/thekey.php");

//ONE HAS TO FIX THIS LINE;;SEE IF IT CAN BE DONE WITHOUT USING DIRECT FILE NAMES AND FOLDER NAMES
?>
<html>
<head>
<script src="<?=$JQUERY?>/jquery.tools.min.js"></script>
<style>
body{background-image:url(<?=$IMAGE?>/basic.png);}
#complete{float:right;
          
          width:83%;
          height:100%;
          overflow:hidden;
          border-style:groove;
	       }
#container{float:center;
           overflow:hidden;
           width:100%;
           height:82%;
          
           margin-top:0px;
           margin-bottom:1px;
           margin-left:0px;
           margin-right:0px;
           }	       
#headbar{width:100%;
			float:center;
			height:7%;
			border-style:groove;
			background-color:#9999CC;
			opacity:0.7;}  
#panelbar{width:100%;
			height:10%;
			border-style:groove;
			border-bottom:none;
			
			}

.panel{width:40%;
		height:94%;
		border-left:none;
		border:none;
		}
.paneltabs{width:27%;
				height:91%;
				border-style:outset;
				float:left;
				background-color:silver;
				border-left:none;
			}
div.paneltabs.current{background-color:#999999;border-bottom:none;height:96%;border-style:groove;opacity:1.0;}				
.panes{
		width:100%;
		height:99%;
		border-style:ridge;
		border-color:silver;
		border-left:none;
		border-right:none;
		}
.panes div{display:none;
				}
.panecontents{width:100%;
					height:100%;
					border-style:ridge;
					border-color:silver;
					border-left:none;
					border-right:none;
					}								         
#accordion{
	
	width:1300px;
	margin-top:2px;
	margin-bottom:5px;
	padding-right:7px;
	height:18%;
	float:left;
	border-top-style:groove;
	border-top-color:silver;
	overflow:hidden;
	}
#accordion img {
	float:left;
	margin-right:-1px;
	margin-left:5px;
	margin-top: 2px;
	cursor:pointer;
	opacity:0.5;
	filter: alpha(opacity=50);
	}
	
	
#accordion img.current {
	cursor:default;
	opacity:1;
	filter: alpha(opacity=100);
}

.insideaccordion{
	width:0px;
	float:left;	
	display:none;		
	margin-right:10px;
}
</style>
</head>
<body>
<div id="complete">
	<div id="container">
		<div id="headbar">
		</div>
		<div id="panelbar">
			<div class="panel">
					<div class="paneltabs"></div>
					<div class="paneltabs"></div>
               <div class="paneltabs"></div>
			</div>
		</div>
		<div class="panes">
			<div class="panecontents">1
			</div>
			<div class="panecontents">2
			</div>
			<div class="panecontents">3
			</div>
		</div>
		
		<script >


$(function() {
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("div.panel").tabs("div.panes > div");
});
</script>		
		
	</div>
	<div id="accordion">
   	<img src="<?=$IMAGE?>/formaccordionguest.png" class="tabes" alt="guest" >  
      <div class="insideaccordion" style="width:410px;height:100px;margin-top:5px;background-color:#666699;">
       <p style="font-size:10px;">
       <PRE>
        LIBRARY PLAYLISTS MY QUEUES     
       </PRE>       
       </p>      
      </div>
   
    <img src="<?=$IMAGE?>/formaccordionsignin.png" class="tabes" alt="sign-in" >  
      <div class="insideaccordion" style="width:410px;height:100px;margin-top:5px;background-color:#666699;">
       <p style="font-size:10px;">
         
        </pre>                   
       </p>      
      </div>
      
     <img src="<?=$IMAGE?>/formaccordionsignup.png" class="tabes" alt="sign-up" >  
      <div class="insideaccordion" style="width:410px;height:100px;margin-top:5px;background-color:#666699;">
       <p>
       
                    
       </p>      
      </div>
</div>
           <script> 
                $(function() {
 
                       $("#accordion").tabs(".insideaccordion", {
	                   tabs: '.tabes', 
	                    effect: 'horizontal'
                        });
                });
           </script>
<script type="text/javascript" >
</div>

</div>

</body>
</html>