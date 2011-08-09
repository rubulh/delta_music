function confirmPost()
{var agree=confirm("Are you sure you want to delete?");if(agree)
return true;else
return false;}
function update_alexa(alexa_option){var alexa_option=alexa_option;document.getElementById("graph_image").innerHTML='<img class="thumb2" id="alexa_thumb" width="594" height="220" src="'+alexa_option+'" alt="" border="0" />';}
function submitform()
{document.forms["myform"].submit();}
function checkTab(el){if((document.all)&&(9==event.keyCode)){el.selection=document.selection.createRange();setTimeout("processTab('"+el.id+"')",0)}}
function processTab(id){document.all[id].selection.text=String.fromCharCode(9)
document.all[id].focus()}
function setSelectionRange(input,selectionStart,selectionEnd){if(input.setSelectionRange){input.focus();input.setSelectionRange(selectionStart,selectionEnd);}
else if(input.createTextRange){var range=input.createTextRange();range.collapse(true);range.moveEnd('character',selectionEnd);range.moveStart('character',selectionStart);range.select();}}
function replaceSelection(input,replaceString){if(input.setSelectionRange){var selectionStart=input.selectionStart;var selectionEnd=input.selectionEnd;input.value=input.value.substring(0,selectionStart)+
replaceString+input.value.substring(selectionEnd);if(selectionStart!=selectionEnd){setSelectionRange(input,selectionStart,selectionStart+
replaceString.length);}else{setSelectionRange(input,selectionStart+
replaceString.length,selectionStart+replaceString.length);}}else if(document.selection){var range=document.selection.createRange();if(range.parentElement()==input){var isCollapsed=range.text=='';range.text=replaceString;if(!isCollapsed){range.moveStart('character',-replaceString.length);range.select();}}}}
function catchTab(item,e){if(navigator.userAgent.match("Gecko")){c=e.which;}else{c=e.keyCode;}
if(c==9){var scrollCurrent=item.scrollTop;replaceSelection(item,String.fromCharCode(9));stopEvent(e);item.scrollTop=scrollCurrent;return false;}}
function stopEvent(e){if(e.preventDefault){e.preventDefault();}
if(e.stopPropagation){e.stopPropagation();}
e.stopped=true;}
function fliprows(from,to)
{var cells=document.getElementsByTagName('tr');var i;for(i=0;i<cells.length;i++)
{var cell=cells.item(i);if(cell.className==from)
cell.className=to;}}
function showold()
{fliprows('new','hidenew');fliprows('hideold','old');document.getElementById('oldlink').style.background="#ddd";document.getElementById('newlink').style.background="";document.getElementById('bothlink').style.background="";}
function shownew()
{fliprows('hidenew','new');fliprows('old','hideold');document.getElementById('oldlink').style.background="";document.getElementById('newlink').style.background="#ddd";document.getElementById('bothlink').style.background="";}
function showboth()
{fliprows('hidenew','new');fliprows('hideold','old');document.getElementById('oldlink').style.background="";document.getElementById('newlink').style.background="";document.getElementById('bothlink').style.background="#ddd";}
var js={text:{lines:function(text)
{return this.getLines(text).length;},getLines:function(text)
{var split=text.split("\n");return split;}},textElement:{value:function(element)
{return element.value.replace(/\r/g,"");},caretPosition:function(element)
{var caretPos={};if(document.selection)
{var range=document.selection.createRange();var range_all=document.body.createTextRange();range_all.moveToElementText(element);var sel_start;for(sel_start=0;range_all.compareEndPoints('StartToStart',range)<0;sel_start++)
{range_all.moveStart('character',1);}
caretPos.start=sel_start;caretPos.end=sel_start+range.text.replace(/\r/g,"").length;}
else if(element.selectionStart||element.selectionStart==0)
{caretPos.start=element.selectionStart;caretPos.end=element.selectionEnd;}
return caretPos;},setCaretPosition:function(element,position)
{element.focus();if(element.setSelectionRange)
{element.setSelectionRange(position.start,position.end);}
else if(element.createTextRange)
{var range=element.createTextRange();range.moveStart('character',position.start);range.moveEnd('character',position.end);range.select();}}}}
function highlight(element)
{var position=js.textElement.caretPosition(element);if(!position.start&&!position.end)
return;var lines=js.text.getLines(js.textElement.value(element));var start=0,end=0;var text="";var inRange=false;var addOrRemove=0;for(var x in lines)
{end=start+lines[x].length;if(position.start>=start&&position.start<=end)
inRange=true;if(inRange)
{var hasHighlight=(lines[x].substr(0,3)=="@h@");if(!addOrRemove)
{if(hasHighlight)
addOrRemove=1;else
addOrRemove=2;}
if(addOrRemove==1&&hasHighlight)
lines[x]=lines[x].substr(3,lines[x].length-3);else if(addOrRemove==2&&!hasHighlight)
text+="@h@";}
text=text+lines[x]+"\n";if(position.end>=start&&position.end<=end)
inRange=false;start=end+1;}
element.value=text.substring(0,text.length-1);var pos=position.start+(addOrRemove==1?-3:3);js.textElement.setCaretPosition(element,{start:pos,end:pos});}