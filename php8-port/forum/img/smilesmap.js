var mode  = 2
function paste(text, flag){
if ((document.selection)&&(flag)) {
        document.postform.message.focus();
        document.postform.document.selection.createRange().text = text;
} else document.postform.message.value += text;
}

function ibsmiles(){
        document.writeln('<map name=smilies>');
        document.writeln('<area shape="rect" coords="330,2,349,19" href="javascript:sm(\'%down%\')" alt="не одобр€ю">');
        document.writeln('<area shape="rect" coords="310,3,329,19" href="javascript:sm(\'%up%\')" alt="одобр€ю">');
        document.writeln('<area shape="rect" coords="291,3,309,19" href="javascript:sm(\'%kruto%\')" alt="круто">');
        document.writeln('<area shape="rect" coords="273,3,290,19" href="javascript:sm(\'%zlost%\')" alt="злость!">');
        document.writeln('<area shape="rect" coords="255,3,272,19" href="javascript:sm(\'%zuttt%\')" alt="жуть">');
        document.writeln('<area shape="rect" coords="238,3,254,19" href="javascript:sm(\'%draznit%\')" alt="дразню">');
        document.writeln('<area shape="rect" coords="221,3,237,19" href="javascript:sm(\'%rugat%\')" alt="ругаю">');
        document.writeln('<area shape="rect" coords="204,3,220,19" href="javascript:sm(\'%tashus%\')" alt="тащусь">');
        document.writeln('<area shape="rect" coords="187,3,203,19" href="javascript:sm(\'%gigi%\')" alt="гы-гы-гы!">');
        document.writeln('<area shape="rect" coords="170,3,186,19" href="javascript:sm(\'%xaxa%\')" alt="помираю со смеху!">');
        document.writeln('<area shape="rect" coords="153,3,169,19" href="javascript:sm(\'%slep%\')" alt="засыпаю">');
        document.writeln('<area shape="rect" coords="136,3,152,19" href="javascript:sm(\'%snob%\')" alt="снобизм">');
        document.writeln('<area shape="rect" coords="119,3,135,19" href="javascript:sm(\'%zamech%\')" alt="замешательство">');
        document.writeln('<area shape="rect" coords="102,3,118,19" href="javascript:sm(\'%ogorch%\')" alt="огорчение">');
        document.writeln('<area shape="rect" coords="85,3,101,19" href="javascript:sm(\'%shutka%\')" alt="подшучиваю">');
        document.writeln('<area shape="rect" coords="68,3,84,19" href="javascript:sm(\'%umnik%\')" alt="умник">');
        document.writeln('<area shape="rect" coords="51,3,67,19" href="javascript:sm(\'%glaza%\')" alt="закатывать глаза">');
        document.writeln('<area shape="rect" coords="34,3,50,19" href="javascript:sm(\'%nevseb%\')" alt="не в себе">');
        document.writeln('<area shape="rect" coords="17,3,33,19" href="javascript:sm(\'%podmig%\')" alt="подмигивание">');
        document.writeln('<area shape="rect" coords="0,3,16,19" href="javascript:sm(\'%ulibka%\')" alt="улыбка">');
        document.writeln('</map>');
        document.writeln('<img src="./im/images/smiles.gif" width="349" height="18" border=0 usemap="#smilies">');
}


