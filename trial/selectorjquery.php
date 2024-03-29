<!DOCTYPE html>
<html>
<head>
  <script src="http://localhost/take/jquery/jquery.tools.min.js"></script>
</head>
<body>
  <ul class="nav">
   <li>List 1, item 1</li>
   <li>List 1, item 2</li>
   <li>List 1, item 3</li>
</ul>
<ul class="nav">
  <li>List 2, item 1</li>
  <li>List 2, item 2</li>
  <li>List 2, item 3</li>
</ul>

<script>
// applies yellow background color to a single <li>
$("ul.nav li:eq(1)").css( "backgroundColor", "#ff0" );

// applies italics to text of the second <li> within each <ul class="nav">
$("ul.nav").each(function(index) {
  $(this).find("li:eq(1)").css( "fontStyle", "italic" );
});

// applies red text color to descendants of <ul class="nav">
// for each <li> that is the second child of its parent
$("ul.nav li:nth-child(3)").css( "color", "red" );
</script>

</body>
</html>
