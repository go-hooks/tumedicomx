<?php 

require_once("ini.php"); 

    $where = "mostrar = 1 AND elim = 0";
    $categorias = get_all_actived_inactived('categorias', $where, 'nombre');     

    $sql = " SELECT * FROM imagen";
    $imagen = get_one_sql($sql);     
    
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->

    <?php include("includes/metatags.php"); ?>

<style>

 /* Font Definitions */
 span.SpellE{
   color: #3C3C3C;
 }
 @font-face
    {font-family:Wingdings;
    panose-1:5 0 0 0 0 0 0 0 0 0;
    mso-font-charset:2;
    mso-generic-font-family:auto;
    mso-font-pitch:variable;
    mso-font-signature:0 268435456 0 0 -2147483648 0;}
@font-face
    {font-family:"Cambria Math";
    panose-1:2 4 5 3 5 4 6 3 2 4;
    mso-font-charset:1;
    mso-generic-font-family:roman;
    mso-font-format:other;
    mso-font-pitch:variable;
    mso-font-signature:0 0 0 0 0 0;}
@font-face
    {font-family:Calibri;
    panose-1:2 15 5 2 2 2 4 3 2 4;
    mso-font-charset:0;
    mso-generic-font-family:swiss;
    mso-font-pitch:variable;
    mso-font-signature:-536870145 1073786111 1 0 415 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
    {mso-style-unhide:no;
    mso-style-qformat:yes;
    mso-style-parent:"";
    margin-top:0cm;
    margin-right:0cm;
    margin-bottom:10.0pt;
    margin-left:0cm;
    line-height:115%;
    mso-pagination:widow-orphan;
    font-size:11.0pt;
    font-family:"Calibri","sans-serif";
    mso-ascii-font-family:Calibri;
    mso-ascii-theme-font:minor-latin;
    mso-fareast-font-family:Calibri;
    mso-fareast-theme-font:minor-latin;
    mso-hansi-font-family:Calibri;
    mso-hansi-theme-font:minor-latin;
    mso-bidi-font-family:"Times New Roman";
    mso-bidi-theme-font:minor-bidi;
    mso-ansi-language:EN-US;
    mso-fareast-language:EN-US;}
h3
    {mso-style-priority:9;
    mso-style-unhide:no;
    mso-style-qformat:yes;
    mso-style-link:"Título 3 Car";
    mso-margin-top-alt:auto;
    margin-right:0cm;
    mso-margin-bottom-alt:auto;
    margin-left:0cm;
    mso-pagination:widow-orphan;
    mso-outline-level:3;
    font-size:13.5pt;
    font-family:"Times New Roman","serif";
    mso-fareast-font-family:"Times New Roman";
    mso-ansi-language:EN-US;
    mso-fareast-language:EN-US;
    font-weight:bold;}
h4
    {mso-style-priority:9;
    mso-style-unhide:no;
    mso-style-qformat:yes;
    mso-style-link:"Título 4 Car";
    mso-margin-top-alt:auto;
    margin-right:0cm;
    mso-margin-bottom-alt:auto;
    margin-left:0cm;
    mso-pagination:widow-orphan;
    mso-outline-level:4;
    font-size:12.0pt;
    font-family:"Times New Roman","serif";
    mso-fareast-font-family:"Times New Roman";
    mso-ansi-language:EN-US;
    mso-fareast-language:EN-US;
    font-weight:bold;}
a:link, span.MsoHyperlink
    {mso-style-priority:99;
    color:blue;
    text-decoration:underline;
    text-underline:single;}
a:visited, span.MsoHyperlinkFollowed
    {mso-style-noshow:yes;
    mso-style-priority:99;
    color:purple;
    mso-themecolor:followedhyperlink;
    text-decoration:underline;
    text-underline:single;}
p
    {mso-style-priority:99;
    mso-margin-top-alt:auto;
    margin-right:0cm;
    mso-margin-bottom-alt:auto;
    margin-left:0cm;
    mso-pagination:widow-orphan;
    font-size:12.0pt;
    font-family:"Times New Roman","serif";
    mso-fareast-font-family:"Times New Roman";
    mso-ansi-language:EN-US;
    mso-fareast-language:EN-US;}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
    {mso-style-priority:34;
    mso-style-unhide:no;
    mso-style-qformat:yes;
    margin-top:0cm;
    margin-right:0cm;
    margin-bottom:10.0pt;
    margin-left:36.0pt;
    mso-add-space:auto;
    line-height:115%;
    mso-pagination:widow-orphan;
    font-size:11.0pt;
    font-family:"Calibri","sans-serif";
    mso-ascii-font-family:Calibri;
    mso-ascii-theme-font:minor-latin;
    mso-fareast-font-family:Calibri;
    mso-fareast-theme-font:minor-latin;
    mso-hansi-font-family:Calibri;
    mso-hansi-theme-font:minor-latin;
    mso-bidi-font-family:"Times New Roman";
    mso-bidi-theme-font:minor-bidi;
    mso-ansi-language:EN-US;
    mso-fareast-language:EN-US;}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
    {mso-style-priority:34;
    mso-style-unhide:no;
    mso-style-qformat:yes;
    mso-style-type:export-only;
    margin-top:0cm;
    margin-right:0cm;
    margin-bottom:0cm;
    margin-left:36.0pt;
    margin-bottom:.0001pt;
    mso-add-space:auto;
    line-height:115%;
    mso-pagination:widow-orphan;
    font-size:11.0pt;
    font-family:"Calibri","sans-serif";
    mso-ascii-font-family:Calibri;
    mso-ascii-theme-font:minor-latin;
    mso-fareast-font-family:Calibri;
    mso-fareast-theme-font:minor-latin;
    mso-hansi-font-family:Calibri;
    mso-hansi-theme-font:minor-latin;
    mso-bidi-font-family:"Times New Roman";
    mso-bidi-theme-font:minor-bidi;
    mso-ansi-language:EN-US;
    mso-fareast-language:EN-US;}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
    {mso-style-priority:34;
    mso-style-unhide:no;
    mso-style-qformat:yes;
    mso-style-type:export-only;
    margin-top:0cm;
    margin-right:0cm;
    margin-bottom:0cm;
    margin-left:36.0pt;
    margin-bottom:.0001pt;
    mso-add-space:auto;
    line-height:115%;
    mso-pagination:widow-orphan;
    font-size:11.0pt;
    font-family:"Calibri","sans-serif";
    mso-ascii-font-family:Calibri;
    mso-ascii-theme-font:minor-latin;
    mso-fareast-font-family:Calibri;
    mso-fareast-theme-font:minor-latin;
    mso-hansi-font-family:Calibri;
    mso-hansi-theme-font:minor-latin;
    mso-bidi-font-family:"Times New Roman";
    mso-bidi-theme-font:minor-bidi;
    mso-ansi-language:EN-US;
    mso-fareast-language:EN-US;}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
    {mso-style-priority:34;
    mso-style-unhide:no;
    mso-style-qformat:yes;
    mso-style-type:export-only;
    margin-top:0cm;
    margin-right:0cm;
    margin-bottom:10.0pt;
    margin-left:36.0pt;
    mso-add-space:auto;
    line-height:115%;
    mso-pagination:widow-orphan;
    font-size:11.0pt;
    font-family:"Calibri","sans-serif";
    mso-ascii-font-family:Calibri;
    mso-ascii-theme-font:minor-latin;
    mso-fareast-font-family:Calibri;
    mso-fareast-theme-font:minor-latin;
    mso-hansi-font-family:Calibri;
    mso-hansi-theme-font:minor-latin;
    mso-bidi-font-family:"Times New Roman";
    mso-bidi-theme-font:minor-bidi;
    mso-ansi-language:EN-US;
    mso-fareast-language:EN-US;}
span.Ttulo3Car
    {mso-style-name:"Título 3 Car";
    mso-style-priority:9;
    mso-style-unhide:no;
    mso-style-locked:yes;
    mso-style-link:"Título 3";
    mso-ansi-font-size:13.5pt;
    mso-bidi-font-size:13.5pt;
    font-family:"Times New Roman","serif";
    mso-ascii-font-family:"Times New Roman";
    mso-fareast-font-family:"Times New Roman";
    mso-hansi-font-family:"Times New Roman";
    mso-bidi-font-family:"Times New Roman";
    font-weight:bold;}
span.Ttulo4Car
    {mso-style-name:"Título 4 Car";
    mso-style-priority:9;
    mso-style-unhide:no;
    mso-style-locked:yes;
    mso-style-link:"Título 4";
    mso-ansi-font-size:12.0pt;
    mso-bidi-font-size:12.0pt;
    font-family:"Times New Roman","serif";
    mso-ascii-font-family:"Times New Roman";
    mso-fareast-font-family:"Times New Roman";
    mso-hansi-font-family:"Times New Roman";
    mso-bidi-font-family:"Times New Roman";
    font-weight:bold;}
span.apple-converted-space
    {mso-style-name:apple-converted-space;
    mso-style-unhide:no;}
span.SpellE
    {mso-style-name:"";
    mso-spl-e:yes;}
span.GramE
    {mso-style-name:"";
    mso-gram-e:yes;}
.MsoChpDefault
    {mso-style-type:export-only;
    mso-default-props:yes;
    font-family:"Calibri","sans-serif";
    mso-ascii-font-family:Calibri;
    mso-ascii-theme-font:minor-latin;
    mso-fareast-font-family:Calibri;
    mso-fareast-theme-font:minor-latin;
    mso-hansi-font-family:Calibri;
    mso-hansi-theme-font:minor-latin;
    mso-bidi-font-family:"Times New Roman";
    mso-bidi-theme-font:minor-bidi;
    mso-ansi-language:EN-US;
    mso-fareast-language:EN-US;}
.MsoPapDefault
    {mso-style-type:export-only;
    margin-bottom:10.0pt;
    line-height:115%;}
@page WordSection1
    {size:612.0pt 792.0pt;
    margin:72.0pt 72.0pt 72.0pt 72.0pt;
    mso-header-margin:35.4pt;
    mso-footer-margin:35.4pt;
    mso-paper-source:0;}
div.WordSection1
    {page:WordSection1;}
 /* List Definitions */
 @list l0
    {mso-list-id:13654878;
    mso-list-type:hybrid;
    mso-list-template-ids:-400420806 134873089 134873091 134873093 134873089 134873091 134873093 134873089 134873091 134873093;}
@list l0:level1
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:81.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l0:level2
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:117.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l0:level3
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:153.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l0:level4
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:189.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l0:level5
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:225.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l0:level6
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:261.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l0:level7
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:297.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l0:level8
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:333.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l0:level9
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:369.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l1
    {mso-list-id:121971559;
    mso-list-type:hybrid;
    mso-list-template-ids:-1601780346 134873089 134873091 134873093 134873089 134873091 134873093 134873089 134873091 134873093;}
@list l1:level1
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:81.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l1:level2
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:117.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l1:level3
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:153.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l1:level4
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:189.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l1:level5
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:225.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l1:level6
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:261.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l1:level7
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:297.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l1:level8
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:333.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l1:level9
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:369.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l2
    {mso-list-id:164396641;
    mso-list-template-ids:1782081012;}
@list l2:level1
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:36.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l2:level2
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:72.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l2:level3
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:108.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l2:level4
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:144.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l2:level5
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:180.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l2:level6
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:216.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l2:level7
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:252.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l2:level8
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:288.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l2:level9
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:324.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l3
    {mso-list-id:173496608;
    mso-list-type:hybrid;
    mso-list-template-ids:-266059934 134873089 134873091 134873093 134873089 134873091 134873093 134873089 134873091 134873093;}
@list l3:level1
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:81.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l3:level2
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:117.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l3:level3
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:153.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l3:level4
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:189.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l3:level5
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:225.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l3:level6
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:261.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l3:level7
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:297.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l3:level8
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:333.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l3:level9
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:369.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l4
    {mso-list-id:967397705;
    mso-list-template-ids:1627964902;}
@list l4:level1
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:36.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l4:level2
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:72.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l4:level3
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:108.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l4:level4
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:144.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l4:level5
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:180.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l4:level6
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:216.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l4:level7
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:252.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l4:level8
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:288.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l4:level9
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:324.0pt;
    mso-level-number-position:left;
    text-indent:-18.0pt;
    mso-ansi-font-size:10.0pt;
    font-family:"Courier New";
    mso-bidi-font-family:"Times New Roman";}
@list l5
    {mso-list-id:1939749363;
    mso-list-type:hybrid;
    mso-list-template-ids:-515596840 134873089 134873091 134873093 134873089 134873091 134873093 134873089 134873091 134873093;}
@list l5:level1
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:81.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l5:level2
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:117.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l5:level3
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:153.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l5:level4
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:189.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l5:level5
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:225.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l5:level6
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:261.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
@list l5:level7
    {mso-level-number-format:bullet;
    mso-level-text:\F0B7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:297.0pt;
    text-indent:-18.0pt;
    font-family:Symbol;}
@list l5:level8
    {mso-level-number-format:bullet;
    mso-level-text:o;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:333.0pt;
    text-indent:-18.0pt;
    font-family:"Courier New";}
@list l5:level9
    {mso-level-number-format:bullet;
    mso-level-text:\F0A7;
    mso-level-tab-stop:none;
    mso-level-number-position:left;
    margin-left:369.0pt;
    text-indent:-18.0pt;
    font-family:Wingdings;}
ol
    {margin-bottom:0cm;}
ul
    {margin-bottom:0cm;}

</style>
<body 
    class="aviso" 
    

     <?php if(isset($imagen['terminos_imagen']) && $imagen['terminos_imagen'] != ""): ?>
     style="background: url(<?php echo UP_IMG_PATH . $imagen['terminos_imagen'] ?>) no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover; -o-background-size: cover;background-size: cover;"
     <?php endif; ?>
         
    
>
	<!--[if lt IE 7]>
            <p class="chromeframe">Tu navegador es <strong>Obsoleto</strong>. Por favor <a href="http://browsehappy.com/">actualizalo</a> ó <a href="http://www.google.com/chromeframe/?redirect=true">instala el componente Google Chrome Frame</a> para mejorar tu experiencia.</p>
    <![endif]-->
    <div id="header">
        <div class="logo"><a href="index.php"><img src="img/logo.png" width="120px"></a></div>
        <!--<div class="title">Live Better</div>-->
    </div>
                
    <div id="content" class="aviso">
        
        
        <?php include("includes/header.php"); ?>  
        
        <?php 
            
            if(isset($imagen['terminos_color']) && $imagen['terminos_color'] != ""):
                
            endif;           
            list($r, $g, $b) = sscanf($imagen['terminos_color'], "#%02x%02x%02x");                               

        ?>
        
        <div class="wrap" style="background-color: rgba(<?php echo $r ?>, <?php echo $g ?>, <?php echo $b ?>, 0.80);padding: 10px;">
        

<div class=WordSection1>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Los presentes&nbsp;<b>“Términos
y Condiciones”</b>&nbsp;describen detalladamente el funcionamiento de&nbsp;<b>“www.tumedicolaguna.com/LiveBetter”
</b>extensión del sitio web </span><b style='mso-bidi-font-weight:normal'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'>“</span></b><span lang=EN-US><a
href="http://www.tumedicolaguna.com"><b style='mso-bidi-font-weight:normal'><span
lang=ES-MX style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX;text-decoration:none;text-underline:none'>www.tumedicolaguna.com</span></b></a></span><b
style='mso-bidi-font-weight:normal'><span style='font-size:10.5pt;font-family:
"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191;mso-ansi-language:ES-MX'>”</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'> </span><span style='font-size:10.5pt;font-family:
"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";color:#3C3C3C;
mso-ansi-language:ES-MX'>propiedad de&nbsp;<b>tumedicolaguna</b>,&nbsp;(en adelante
el&nbsp;<b>&quot;Blog”</b>), además de regular las relaciones entre el&nbsp;<b>“Blog”</b>,
los&nbsp;<b>&quot;Usuarios&quot;</b>&nbsp;y&nbsp;<b>&quot;Terceros&quot;</b>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>El contenido de&nbsp;“<b>www.tumedicolaguna.com/LiveBetter”</b>&nbsp;es
sólo para fines informativos y educativos y no pretende ser el sustituto de
consejos médicos profesionales, de diagnóstico o de tratamiento, por lo que <b
style='mso-bidi-font-weight:normal'>tumedicolaguna </b>hace requerido consultar
a su médico para cualquier pregunta que pueda tener sobre una condición médica,
por lo que nunca desatiendas los consejos de tu médico profesional ni retrases
el tratamiento que te recomienda debido a un artículo, noticia o consejo que se
incluya en <b>“www.tumedicolaguna.com/LiveBetter”.</b><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>La misión de este
sitio web&nbsp;<b>www.tumedicolaguna.com/LiveBetter</b>, es la creación y
gestión de un blog de noticias que incluya consejos y <span class=SpellE>tips</span>
relacionados con la salud que permitan a los&nbsp;<b>“Usuarios”</b>&nbsp;de
este sitio web acceder de manera general y específica a los artículos
informativos que sean publicados por <b style='mso-bidi-font-weight:normal'>tumedicolaguna</b>
y/o <b style='mso-bidi-font-weight:normal'>“Terceros”</b> o cualquier otra
información que&nbsp;<b>tumedicolaguna </b>considere ofrecer.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:0cm;margin-bottom:
12.0pt;margin-left:22.5pt;text-align:justify;line-height:normal;mso-outline-level:
3'><b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#919191;mso-ansi-language:ES-MX'>Capítulo
1 - Definición de Conceptos<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Para efectos del
presente apartado, <b style='mso-bidi-font-weight:normal'>“Las Partes”</b>
acuerdan que los conceptos que a continuación se describen y que se utilizan en
el texto del presente, se entenderá de conformidad con las siguientes
definiciones:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Blog:</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>&nbsp;Se refiere a la
extensión del sitio web&nbsp;“<b>www.tumedicolaguna.com/LiveBetter”</b>&nbsp;el
cual ofrece al usuario ingresar de manera gratuita, fácil y rápida para hacer
uso de una serie de recursos informativos y educativos además de tener acceso a
servicios de publicidad (aplican costos extras).<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Usuarios:</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>&nbsp;Son todas
aquellas personas físicas independientemente de su nacionalidad o país de
residencia, siempre que haya aceptado expresamente los presentes&nbsp;<b>“Términos
y Condiciones”</b>, quién tendrá acceso a toda la información con la que cuente
el&nbsp;<b>“Blog”</b>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Terceros:</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>&nbsp;Son aquellas
personas o instituciones legalmente inscritas a la SHCP (Secretaría de Hacienda
y Crédito Público) o a un organismo que regule sus actividades comerciales y
fiscales dentro de su país de registro que tienen relación directa o indirecta
con <b>tumedicolaguna</b>, donde sus contenidos pueden aparecer dentro
del&nbsp;<b>&quot;Blog&quot;</b>&nbsp;de manera informativa o que desean
solicitar <b>&quot;Servicios&quot;</b>&nbsp;dentro del&nbsp;<b>“Blog”</b>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Servicios:</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>&nbsp;Se refiere al
conjunto de servicios comerciales y/o informativos disponibles para los&nbsp;<b>&quot;Usuarios&quot;</b>&nbsp;y&nbsp;<b>&quot;Terceros&quot;</b>&nbsp;dentro
del <b>&quot;Blog&quot;</b>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Empresa prestadora de
servicios:</span></b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>&nbsp;tumedicolaguna.com<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Las Partes:</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>&nbsp;Se refiere a la
relación entre los&nbsp;<b>&quot;Usuarios&quot;</b>,&nbsp;<b>&quot;Terceros&quot;</b>&nbsp;y&nbsp;<b>tumedicolaguna.</b><o:p></o:p></span></p>

<div class=MsoNormal style='margin-top:12.0pt;margin-right:0cm;margin-bottom:
12.0pt;margin-left:0cm;line-height:normal'><span lang=EN-US style='font-size:
10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman"'>

<hr size=1 width="100%" noshade style='color:#3C3C3C' align=left>

</span></div>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:0cm;margin-bottom:
12.0pt;margin-left:22.5pt;text-align:justify;line-height:normal;mso-outline-level:
3'><b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#919191;mso-ansi-language:ES-MX'>Capítulo
2 - Condiciones generales | Aceptación<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Las condiciones
generales (en adelante, las&nbsp;<b>&quot;Condiciones Generales&quot;</b>) regulan
el uso del servicio del sitio web&nbsp;<b>&quot;tumedicolaguna.com/<span
class=SpellE>LiveBetter</span>&quot; </b>(en adelante, el&nbsp;<b>&quot;Blog&quot;</b>).<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:15.95pt;margin-right:0cm;margin-bottom:
15.95pt;margin-left:0cm;text-align:justify;line-height:14.7pt;mso-outline-level:
4'><b><u><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Objeto</span></u></b><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>A través de&nbsp;<b>&quot;www.tumedicolaguna.com/<span
class=SpellE>LiveBetter</span>&quot;</b>,&nbsp;<span class=SpellE><b>tumedicolaguna</b></span>&nbsp;facilita
a <span class=GramE>los</span>&nbsp;<b>&quot;Usuarios&quot; y
&quot;Terceros&quot;</b>&nbsp;el acceso y la utilización de servicios y contenidos
puestos a disposición.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=GramE><b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>tumedicolaguna</span></b></span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>&nbsp;se reserva el
derecho a modificar unilateralmente, en cualquier momento y sin aviso previo,
la presentación y configuración del&nbsp;<b>&quot;Blog&quot;</b>, así como
también se reserva el derecho a modificar o eliminar, en cualquier momento y
sin previo aviso, los&nbsp;<b>&quot;Servicios&quot;</b>&nbsp;y las condiciones
requeridas para acceder y/o utilizar el&nbsp;<b>&quot;Blog&quot;</b>&nbsp;y
sus&nbsp;<b>&quot;Servicios&quot;</b>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:15.95pt;margin-right:0cm;margin-bottom:
15.95pt;margin-left:0cm;text-align:justify;line-height:14.7pt;mso-outline-level:
4'><b><u><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Condiciones
de acceso y utilización del Blog</span></u></b><b><span style='font-size:10.5pt;
font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
color:#3C3C3C;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>El carácter de acceso
y utilización del&nbsp;<b>&quot;Blog&quot;</b>&nbsp;es gratuito para los&nbsp;<b>“Usuarios”.</b><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:15.95pt;margin-right:0cm;margin-bottom:
15.95pt;margin-left:0cm;text-align:justify;line-height:14.7pt;mso-outline-level:
4'><b><u><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Obligación
de hacer un uso correcto del Blog y de los Servicios</span></u></b><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Los&nbsp;<b>“Usuarios”
</b>se comprometen a utilizar el&nbsp;<b>&quot;Blog&quot;</b>&nbsp;y los&nbsp;<b>&quot;Servicios&quot;</b>&nbsp;de
manera conforme a la ley, y a lo dispuesto en estas&nbsp;<b>&quot;Condiciones
Generales&quot;</b>, la moral y buenas costumbres generalmente aceptadas y el
orden público. Se obligan a abstenerse de utilizar el&nbsp;<b>&quot;Blog&quot;</b>&nbsp;y
los&nbsp;<b>&quot;Servicios&quot;</b>&nbsp;con fines o efectos ilícitos,
contrarios a lo establecido por el presente, lesivos de los derechos e
intereses de&nbsp;<b>&quot;Terceros&quot;</b>, o que de cualquier forma puedan
dañar, inutilizar, sobrecargar o deteriorar el&nbsp;<b>&quot;Blog&quot;</b>&nbsp;y
los&nbsp;<b>&quot;Servicios&quot;</b>&nbsp;o impedir la normal utilización y
disfrute por parte de los&nbsp;<b>&quot;Usuarios&quot;</b>&nbsp;y/o<b> Terceros&quot;</b>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:0cm;margin-bottom:
12.0pt;margin-left:0cm;line-height:normal'><span style='font-size:10.5pt;
font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-ansi-language:ES-MX'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:0cm;margin-bottom:
12.0pt;margin-left:22.5pt;text-align:justify;line-height:normal;mso-outline-level:
3'><b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#919191;mso-ansi-language:ES-MX'>Capítulo
4<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:15.95pt;margin-right:0cm;margin-bottom:
15.95pt;margin-left:0cm;text-align:justify;line-height:14.7pt;mso-outline-level:
4'><b><u><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Política
de Privacidad</span></u></b><b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=GramE><b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>tumedicolaguna</span></b></span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>&nbsp;se compromete a
respetar la confidencialidad de aquellos datos personales que los&nbsp;<b>“Usuarios”
</b><span style='mso-bidi-font-weight:bold'>pudiesen proporcionar a <b>tumedicolaguna.</b></span><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:15.95pt;margin-right:0cm;margin-bottom:
15.95pt;margin-left:0cm;text-align:justify;line-height:14.7pt;mso-outline-level:
4'><b><u><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Contenidos</span></u></b><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:14.7pt'><span class=GramE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C'>&#61623;</span><span style='font-size:10.5pt;
font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
color:#3C3C3C;mso-ansi-language:ES-MX'><span style='mso-spacerun:yes'>  </span><b>Propios</b></span></span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=GramE><b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>tumedicolaguna</span></b></span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>&nbsp;ofrece sus
contenidos como&nbsp;<b>&quot;Servicios&quot;</b>&nbsp;a los&nbsp;<b>“Usuarios”
y &quot;Terceros&quot;</b>, por lo tanto deberán ser usados con carácter informativo
y/o comercial sea el caso;&nbsp;<b>tumedicolaguna</b>&nbsp;no tiene
responsabilidad en los errores u omisiones de estos materiales. Tampoco
garantiza, explícita o implícitamente, los contenidos del&nbsp;<b>&quot;Blog&quot;</b>,
incluyendo, pero no limitando a la exactitud o confiabilidad de los textos,
gráficos, enlaces y otros elementos accesibles en su servidor de Internet.<o:p></o:p></span></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:14.7pt'><span class=GramE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C'>&#61623;</span><span style='font-size:10.5pt;
font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
color:#3C3C3C;mso-ansi-language:ES-MX'><span style='mso-spacerun:yes'>  </span><b>De</b></span></span><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'> terceros</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=GramE><b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>tumedicolaguna</span></b></span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>&nbsp;advierte que al
no ser de su titularidad toda la información contenida en el&nbsp;<b>&quot;Blog&quot;</b>,
algunos de los textos, gráficos, vínculos y/o el contenido de algunos artículos
incluidos en el mismo, podrían no ser veraces o no estar actualizados; asimismo
tampoco garantiza el cumplimiento de las normas vigentes en relación con dichos
contenidos.&nbsp;<span class=GramE><b>tumedicolaguna</b></span>&nbsp;no será
responsable por el cumplimiento con la legislación vigente en materia de
propiedad intelectual o veracidad y exactitud de los contenidos ofrecidos a
través del&nbsp;<b>&quot;Blog&quot;</b>&nbsp;o que de algún modo estén
vinculados al&nbsp;<b>&quot;Blog&quot;</b>&nbsp;y que sean provistos por&nbsp;<b>&quot;Terceros&quot;
</b><span style='mso-bidi-font-weight:bold'>y/o por los <b>“Usuarios”</b></span><b
style='mso-bidi-font-weight:normal'>.</b> Asimismo, <b>tumedicolaguna</b>&nbsp;no
puede controlar o editar los contenidos provistos por&nbsp;<b>&quot;Terceros&quot;</b>&nbsp;antes
de ser publicados, como tampoco puede asegurar la remoción del material
inapropiado luego de su publicación. Las publicaciones de los <b
style='mso-bidi-font-weight:normal'>“Usuarios”</b> y/o&nbsp;<b>&quot;Terceros&quot;</b>&nbsp;no
representan la opinión, creencia o intención de tumedicolaguna. Las imágenes
y/o contenidos propiedad de&nbsp;<b>&quot;Terceros&quot; </b><span
style='mso-bidi-font-weight:bold'>y/o <b>“Usuarios”</b></span>&nbsp;que&nbsp;<b>tumedicolaguna
</b>pudiera mostrar dentro del&nbsp;<b>&quot;Portal&quot;</b>&nbsp;son de
carácter informativo y no tienen fines lucrativos.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:14.7pt'><span class=GramE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C'>&#61623;</span><span style='font-size:10.5pt;
font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
color:#3C3C3C;mso-ansi-language:ES-MX'><span style='mso-spacerun:yes'>  </span><b>Uso</b></span></span><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'> del Blog</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Este&nbsp;<b>&quot;Blog&quot;</b>&nbsp;(o
cualquier porción de este&nbsp;<b>Blog</b>) no puede ser reproducido,
duplicado, copiado, vendido, revendido o explotado con otros fines distintos de
aquellos expresamente permitidos por&nbsp;<b>tumedicolaguna</b>. Tanto el
acceso al <b style='mso-bidi-font-weight:normal'>“Blog”,</b> así como el uso
que pueda hacerse de la información contenida en el mismo son exclusiva
responsabilidad de quien los realiza.&nbsp;<span class=GramE><b>tumedicolaguna</b></span>&nbsp;no
responderá por los daños y perjuicios, ya sean directos o indirectos, derivados
del mal funcionamiento de los&nbsp;<b>&quot;Servicios&quot;</b>&nbsp;ofrecidos
en el&nbsp;<b>&quot;Blog&quot;</b>&nbsp;que se basen en causas, de cualquier
naturaleza, ajenas a su voluntad y/o su control.<o:p></o:p></span></p>

<p class=MsoListParagraph align=center style='margin-top:12.0pt;margin-right:
30.0pt;margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:
center;text-indent:-18.0pt;line-height:14.7pt;mso-list:l5 level1 lfo1'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-ansi-language:ES-MX'><span
style='mso-list:Ignore'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Código de conducta de
&quot;usuarios&quot;<span style='mso-spacerun:yes'>  </span>y
&quot;terceros&quot;<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>Al utilizar o acceder
al &quot;Blog&quot;, usted acepta a:<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no
utilizar el <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b> en
contravención de las presentes Condiciones de Uso;</span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:166;
mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no
utilizar los <b style='mso-bidi-font-weight:normal'>&quot;Servicios&quot;</b>
para fines comerciales;</span><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no enviar
&quot;correo basura&quot; (spam) ni utilizar técnicas de &quot;pescadores
cibernéticos&quot; para obtener información personal de ajenos;</span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:166;
mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no
perturbar ni interferir con la seguridad del <b style='mso-bidi-font-weight:
normal'>&quot;Blog&quot;</b> o de ninguna de sus partes, ni abusar del mismo de
alguna otra manera;</span><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no
cargar, publicar o de alguna otra manera transmitir a través del <b
style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b> ningún tipo de virus u
otros archivos dañinos, perturbadores o destructivos;</span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:166;
mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no
utilizar marcos, enmarcar ni servirse de técnicas de enmarcado para contener
ninguna de las partes del <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b>
sin la previa autorización expresa y por escrito de </span><span class=SpellE><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>tumedicolaguna</span></b></span><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>.</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:166;
mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no
utilizar ningún otro tipo de &quot;texto oculto&quot; que se sirvan de Marcas
Comerciales sin la previa autorización expresa y por escrito de </span><span
class=SpellE><b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>tumedicolaguna</span></b></span><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>.</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:166;
mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no crear
ni utilizar una identificación falsa para recopilar o almacenar datos
personales de otras personas;</span><span style='font-size:10.5pt;font-family:
"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:166;mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no
intentar obtener acceso no autorizado al <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b>
o a ninguna de sus partes que estén restringidas al acceso general;</span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:166;
mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no
transmitir ningún material que sea falso y/o difamatorio, inexacto, abusivo,
vulgar, odioso, acosador, obsceno, profano, de orientación sexual,
intimidatorio o invasivo de la privacidad de las personas, que infrinja los
derechos de propiedad exclusiva de terceros o que quebrante leyes o
reglamentos;</span><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l3 level1 lfo3'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:166;mso-ansi-language:ES-MX;mso-fareast-language:ES-MX'>no
publicar ningún material de derecho de autor, de marca registrada o de
propiedad exclusiva a menos que usted sea el propietario del derecho de autor,
de la marca registrada, del derecho de publicidad o de otros derechos de
propiedad exclusiva aplicables; o que tenga todos los derechos necesarios para
hacerlo y para otorgar a las Partes Autorizadas (según la definición que se da
más adelante) los derechos estipulados en estas Condiciones de Uso;</span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:166;
mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:14.7pt'><span class=GramE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C'>&#61623;</span><span style='font-size:10.5pt;
font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
color:#3C3C3C;mso-ansi-language:ES-MX'><span style='mso-spacerun:yes'>  </span><b>Duración</b></span></span><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'> y terminación</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-ansi-language:ES-MX'>La prestación del
servicio de&nbsp;<b>&quot;Blog&quot;</b>&nbsp;y de los demás&nbsp;<b>&quot;Servicios&quot;</b>&nbsp;tienen
una duración indefinida,&nbsp;<b>tumedicolaguna</b>, no obstante, está
facultado para dar por terminada, suspender o interrumpir unilateralmente, en
cualquier momento y sin necesidad de previo aviso, la prestación del servicio
del&nbsp;<b>&quot;Blog&quot;</b>&nbsp;y/o de cualquiera de los&nbsp;<b>&quot;Servicios&quot;</b>,
sin perjuicio de lo que se hubiere dispuesto al respecto en las
correspondientes <b style='mso-bidi-font-weight:normal'>“Condiciones Generales”.<o:p></o:p></b></span></p>

<p class=MsoListParagraph align=center style='margin-top:12.0pt;margin-right:
30.0pt;margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:
center;text-indent:-18.0pt;line-height:14.7pt;mso-list:l1 level1 lfo5'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
166;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:166;
mso-ansi-language:ES-MX'>Las Aportaciones de los &quot;Usuarios&quot; y/o
&quot;Terceros&quot;<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=SpellE><span lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";
color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'>Ciertos</span></span><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>apartados</span> de
<span class=SpellE><span class=GramE>este</span></span> </span><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'>&quot;Blog&quot;</span></b><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> le <span class=SpellE>permiten</span> <span
class=SpellE>enviar</span>, <span class=SpellE>publicar</span>, <span
class=SpellE>transmitir</span> o <span class=SpellE>cargar</span> <span
class=SpellE>contenidos</span> <span class=SpellE>que</span> <span
class=SpellE>usted</span> <span class=SpellE>haya</span> <span class=SpellE>creado</span>
(&quot;<span class=SpellE>Aportaciones</span> de <span class=SpellE>Usuario</span>&quot;),
entre los <span class=SpellE>que</span> se <span class=SpellE>incluyen</span>,
de <span class=SpellE>modo</span> no <span class=SpellE>exclusivo</span>, <span
class=SpellE>fotografías</span>, <span class=SpellE>información</span>, <span
class=SpellE>textos</span>, <span class=SpellE>imágenes</span>, <span
class=SpellE>gráficos</span>, videos, <span class=SpellE>comentarios</span>, <span
class=SpellE>sugerencias</span>, ideas (inclusive ideas para <span
class=SpellE>productos</span> y <span class=SpellE>publicidad</span>), <span
class=SpellE>publicar</span> <span class=SpellE>mensajes</span> <span
class=SpellE>en</span> <span class=SpellE>noticias</span>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=SpellE><span lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";
color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'>En</span></span><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>relación</span> con
<span class=SpellE>las</span> <span class=SpellE>Aportaciones</span> de <span
class=SpellE>Usuario</span>, <span class=SpellE>usted</span> <span
class=SpellE>acepta</span> <span class=SpellE>que</span> no <span class=SpellE>presentará</span>
<span class=SpellE>Aportaciones</span> de <span class=SpellE>Usuario</span> <span
class=SpellE>que</span>:</span><b style='mso-bidi-font-weight:normal'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoListParagraphCxSpFirst style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l1 level1 lfo5'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
191;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span class=SpellE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>Incluyan</span></span><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>materiales</span> <span
class=SpellE>protegidos</span> <span class=SpellE>por</span> <span
class=SpellE>derechos</span> de <span class=SpellE>autor</span> o <span
class=SpellE>por</span> el <span class=SpellE>secreto</span> <span
class=SpellE>comercial</span> o <span class=SpellE>que</span> <span
class=SpellE>estén</span> <span class=SpellE>sujetos</span> de <span
class=SpellE>alguna</span> <span class=SpellE>otra</span> forma a <span
class=SpellE>derechos</span> de <span class=SpellE>propiedad</span> <span
class=SpellE>exclusiva</span> (<span class=SpellE>incluso</span>, de forma no <span
class=SpellE>limitativa</span>, los <span class=SpellE>derechos</span> de <span
class=SpellE>marca</span> <span class=SpellE>comercial</span>, de <span
class=SpellE>privacidad</span> y de <span class=SpellE>publicidad</span>) a <span
class=SpellE>menos</span> <span class=SpellE>que</span> <span class=SpellE>usted</span>
sea el <span class=SpellE>propietario</span> de <span class=SpellE>dichos</span>
<span class=SpellE>derechos</span> o <span class=SpellE>tenga</span> <span
class=SpellE>permiso</span> <span class=SpellE>expreso</span> del <span
class=SpellE>propietario</span> <span class=SpellE>legítimo</span> para <span
class=SpellE>publicar</span> el material y conceder los <span class=SpellE>derechos</span>
<span class=SpellE>otorgados</span> <span class=SpellE>en</span> el <span
class=SpellE>presente</span> <span class=SpellE>documento</span>;</span><b
style='mso-bidi-font-weight:normal'><span style='font-size:10.5pt;font-family:
"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l1 level1 lfo5'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
191;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span class=SpellE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>incluyan</span></span><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>materiales</span> <span
class=SpellE>que</span> de <span class=SpellE>por</span> <span class=SpellE>sí</span>,
o <span class=SpellE>por</span> <span class=SpellE>su</span> <span
class=SpellE>utilización</span> de <span class=SpellE>conformidad</span> con lo
<span class=SpellE>que</span> <span class=SpellE>permiten</span> <span
class=SpellE>las</span> <span class=SpellE>presentes</span> <span class=SpellE>Condiciones</span>
de <span class=SpellE>Uso</span>, <span class=SpellE>contravengan</span>, <span
class=SpellE>malversen</span> o <span class=SpellE>quebranten</span> los <span
class=SpellE>derechos</span> de <span class=SpellE>cualquier</span> persona o <span
class=SpellE>entidad</span>, o <span class=SpellE>cualesquiera</span> <span
class=SpellE>Leyes</span> <span class=SpellE>Aplicables</span>;</span><b
style='mso-bidi-font-weight:normal'><span style='font-size:10.5pt;font-family:
"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l1 level1 lfo5'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
191;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span class=SpellE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>sean</span></span><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>ilegales</span>, <span
class=SpellE>obscenas</span>, <span class=SpellE>difamatorias</span>, <span
class=SpellE>calumniosas</span>, <span class=SpellE>intimidadoras</span>, <span
class=SpellE>pornográficas</span>, <span class=SpellE>acosadoras</span>, <span
class=SpellE>odiosas</span> o <span class=SpellE>ofensivas</span> <span
class=SpellE>por</span> <span class=SpellE>motivos</span> de <span
class=SpellE>raza</span> o <span class=SpellE>etnia</span> o <span
class=SpellE>que</span> <span class=SpellE>promuevan</span> <span class=SpellE>comportamientos</span>
<span class=SpellE>que</span> se <span class=SpellE>consideren</span> <span
class=SpellE>delitos</span> <span class=SpellE>penales</span>, <span
class=SpellE>que</span> <span class=SpellE>conlleven</span> <span class=SpellE>responsabilidad</span>
civil, <span class=SpellE>que</span> <span class=SpellE>contravengan</span> <span
class=SpellE>cualquier</span> ley o <span class=SpellE>que</span> <span
class=SpellE>sean</span> <span class=SpellE>inadecuadas</span> de <span
class=SpellE>alguna</span> <span class=SpellE>otra</span> <span class=SpellE>manera</span>.</span><b
style='mso-bidi-font-weight:normal'><span style='font-size:10.5pt;font-family:
"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l1 level1 lfo5'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
191;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span class=SpellE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>contengan</span></span><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>anuncios</span> o <span
class=SpellE>peticiones</span> de <span class=SpellE>fondos</span>, <span
class=SpellE>artículos</span> o <span class=SpellE>servicios</span>;</span><b
style='mso-bidi-font-weight:normal'><span style='font-size:10.5pt;font-family:
"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l1 level1 lfo5'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
191;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span class=SpellE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>sean</span></span><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>comunicaciones</span>
<span class=SpellE>hechas</span> <span class=SpellE>por</span> un <span
class=SpellE>usuario</span> <span class=SpellE>que</span> se <span
class=SpellE>haga</span> <span class=SpellE>pasar</span> <span class=SpellE>por</span>
<span class=SpellE>otro</span>;</span><b style='mso-bidi-font-weight:normal'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoListParagraphCxSpLast style='margin-top:12.0pt;margin-right:30.0pt;
margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:justify;
text-indent:-18.0pt;line-height:14.7pt;mso-list:l1 level1 lfo5'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
191;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span class=SpellE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>contengan</span></span><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>información</span>
personal, <span class=SpellE>como</span>, <span class=SpellE>por</span> <span
class=SpellE>ejemplo</span>, <span class=SpellE>mensajes</span> <span
class=SpellE>que</span> <span class=SpellE>revelen</span> <span class=SpellE>números</span>
<span class=SpellE>telefónicos</span>, <span class=SpellE>números</span> de <span
class=SpellE>seguro</span> social, <span class=SpellE>números</span> de <span
class=SpellE>cuenta</span> o <span class=SpellE>direcciones</span>; o <span
class=SpellE>que</span> <span class=SpellE>puedan</span> <span class=SpellE>considerarse</span>
<span class=SpellE>como</span> <span class=SpellE>comunicaciones</span> <span
class=SpellE>masivas</span> no <span class=SpellE>solicitadas</span>.</span><b
style='mso-bidi-font-weight:normal'><span style='font-size:10.5pt;font-family:
"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>No se le <span class=SpellE>deberán</span>
<span class=GramE>a</span> <span class=SpellE>usted</span> <span class=SpellE>ni</span>
<span class=SpellE>créditos</span>, <span class=SpellE>ni</span> <span
class=SpellE>aprobaciones</span>, <span class=SpellE>ni</span> <span
class=SpellE>compensaciones</span> <span class=SpellE>debido</span> al <span
class=SpellE>Uso</span> <span class=SpellE>que</span> le demos a <span
class=SpellE>las</span> <span class=SpellE>Aportaciones</span> de <span
class=SpellE>Usuario</span> <span class=SpellE>que</span> <span class=SpellE>presente</span>
<span class=SpellE>usted</span>. Las <span class=SpellE>Partes</span> <span
class=SpellE>Autorizadas</span> <span class=SpellE>además</span> <span
class=SpellE>tienen</span> el derecho, <span class=SpellE>pero</span> no la <span
class=SpellE>obligación</span>, de <span class=SpellE>Utilizar</span> <span
class=SpellE>su</span> <span class=SpellE>nombre</span> de <span class=SpellE>usuario</span>
(y <span class=SpellE>su</span> <span class=SpellE>nombre</span> <span
class=SpellE>verdadero</span>, <span class=SpellE>imagen</span>, <span
class=SpellE>semejanza</span>, <span class=SpellE>leyenda</span>, <span
class=SpellE>información</span> de <span class=SpellE>ubicación</span> o <span
class=SpellE>cualquier</span> <span class=SpellE>otra</span> <span
class=SpellE>información</span> <span class=SpellE>que</span> lo <span
class=SpellE>identifique</span>, <span class=SpellE>si</span> se <span
class=SpellE>proveyeron</span> <span class=SpellE>en</span> <span class=SpellE>relación</span>
con <span class=SpellE>sus</span> <span class=SpellE>Aportaciones</span> de <span
class=SpellE>Usuario</span>), <span class=SpellE>en</span> <span class=SpellE>relación</span>
con la <span class=SpellE>emisión</span>, <span class=SpellE>impresión</span>, <span
class=SpellE>uso</span> <span class=SpellE>en</span> <span class=SpellE>línea</span>
o <span class=SpellE>cualquier</span> <span class=SpellE>otro</span> <span
class=SpellE>Uso</span> de <span class=SpellE>sus</span> <span class=SpellE>Aportaciones</span>
de <span class=SpellE>Usuario</span>. <span class=SpellE>Todas</span> <span
class=SpellE>las</span> <span class=SpellE>Aportaciones</span> de <span
class=SpellE>Usuario</span> se <span class=SpellE>convierten</span> <span
class=SpellE>en</span> <span class=SpellE>propiedad</span> con <span
class=SpellE>licencia</span> sin <span class=SpellE>restricciones</span> de <span
class=SpellE>las</span> <span class=SpellE>Partes</span> <span class=SpellE>Autorizadas</span>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=SpellE><span lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";
color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'>Usted</span></span><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>declara</span> y <span
class=SpellE>garantiza</span> <span class=SpellE>que</span> <span class=SpellE>ni</span>
<span class=SpellE>las</span> <span class=SpellE>Aportaciones</span> de <span
class=SpellE>Usuario</span> <span class=SpellE>ni</span> el <span class=SpellE>Uso</span>
de <span class=SpellE>las</span> <span class=SpellE>Aportaciones</span> de <span
class=SpellE>Usuario</span> <span class=SpellE>según</span> lo <span
class=SpellE>permiten</span> <span class=SpellE>las</span> <span class=SpellE>presentes</span>
<span class=SpellE>Condiciones</span> de <span class=SpellE>Uso</span> <span
class=SpellE>contravendrán</span>, <span class=SpellE>malversarán</span> o <span
class=SpellE>infringirán</span> la <span class=SpellE>propiedad</span> <span
class=SpellE>intelectual</span>, <span class=SpellE>ni</span> los <span
class=SpellE>derechos</span> de <span class=SpellE>privacidad</span>, <span
class=SpellE>publicidad</span>, <span class=SpellE>reglamentarios</span>, <span
class=SpellE>contractuales</span>, <span class=SpellE>personales</span> u <span
class=SpellE>otros</span> <span class=SpellE>derechos</span> de <span
class=SpellE>ninguna</span> persona o <span class=SpellE>ente</span>, <span
class=SpellE>ni</span> <span class=SpellE>ninguna</span> Ley <span
class=SpellE>Aplicable</span>, y <span class=SpellE>que</span> <span
class=SpellE>usted</span> ha <span class=SpellE>obtenido</span> <span
class=SpellE>todos</span> los <span class=SpellE>derechos</span> <span
class=SpellE>necesarios</span> para el <span class=SpellE>otorgamiento</span> a
<span class=SpellE>las</span> <span class=SpellE>Partes</span> <span
class=SpellE>Autorizadas</span>, <span class=SpellE>incluidos</span>, entre <span
class=SpellE>otros</span>, los <span class=SpellE>descargos</span> <span
class=SpellE>escritos</span> de <span class=SpellE>todos</span> los <span
class=SpellE>derechos</span> de <span class=SpellE>privacidad</span> y de <span
class=SpellE>publicidad</span> de <span class=SpellE>todos</span> los <span
class=SpellE>individuos</span> <span class=SpellE>incluidos</span> de <span
class=SpellE>alguna</span> <span class=SpellE>manera</span> <span class=SpellE>en</span>
<span class=SpellE>las</span> <span class=SpellE>Aportaciones</span> de <span
class=SpellE>Usuario</span>. <span class=SpellE>Todas</span> <span
class=SpellE>las</span> <span class=SpellE>Aportaciones</span> de <span
class=SpellE>Usuario</span> <span class=SpellE>deben</span> <span class=SpellE>respetar</span>
el <span class=SpellE>Código</span> de <span class=SpellE>Conducta</span> <span
class=GramE>del</span> <span class=SpellE>Usuario</span> <span class=SpellE>según</span>
se <span class=SpellE>estableció</span> <span class=SpellE>anteriormente</span>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=GramE><span lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";
color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'>A <span class=SpellE>pesar</span>
de <span class=SpellE>que</span> <span class=SpellE><b style='mso-bidi-font-weight:
normal'>tumedicolaguna</b></span> no <span class=SpellE>tienen</span> la <span
class=SpellE>obligación</span> de <span class=SpellE>examinar</span> o <span
class=SpellE>vigilar</span> <span class=SpellE>las</span> <span class=SpellE>Aportaciones</span>
de <span class=SpellE>Usuario</span>, <span class=SpellE>las</span> <span
class=SpellE>Partes</span> <span class=SpellE>Autorizadas</span> se <span
class=SpellE>reservan</span> el derecho <span class=SpellE>absoluto</span> de <span
class=SpellE>hacerlo</span> a <span class=SpellE>su</span> <span class=SpellE>entera</span>
<span class=SpellE>discreción</span>.</span></span><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE><span class=GramE>Asimismo</span></span><span
class=GramE>, <span class=SpellE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span>
se <span class=SpellE>reservan</span> el derecho de <span class=SpellE>alterar</span>,
<span class=SpellE>editar</span>, <span class=SpellE>rechazar</span> para la <span
class=SpellE>publicación</span> o <span class=SpellE>retirar</span> <span
class=SpellE>cualquier</span> <span class=SpellE>Aportación</span> de <span
class=SpellE>Usuario</span>, <span class=SpellE>en</span> <span class=SpellE>su</span>
<span class=SpellE>totalidad</span> o <span class=SpellE>parcialmente</span>, <span
class=SpellE>por</span> la <span class=SpellE>razón</span> <span class=SpellE>que</span>
sea o <span class=SpellE>por</span> <span class=SpellE>ninguna</span> <span
class=SpellE>razón</span>.</span> <span class=SpellE>Usted</span> <span
class=SpellE>acepta</span> <span class=SpellE>que</span> </span><span
class=SpellE><b><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:191;mso-ansi-language:ES-MX'>tumedicolaguna</span></b></span><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> no <span class=SpellE>tiene</span> <span
class=SpellE>ninguna</span> <span class=SpellE>obligación</span> de <span
class=SpellE>utilizar</span> <span class=SpellE>ninguna</span> de <span
class=SpellE>las</span> <span class=SpellE>Aportaciones</span> de <span
class=SpellE>Usuario</span> <span class=SpellE><span class=GramE>ni</span></span>
de <span class=SpellE>contestar</span> a <span class=SpellE>las</span> <span
class=SpellE>mismas</span>. <span class=SpellE><span class=GramE><b
style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span></span> no <span
class=SpellE>está</span> <span class=SpellE>en</span> <span class=SpellE>condiciones</span>
de <span class=SpellE>poder</span> <span class=SpellE>controlar</span> <span
class=SpellE>si</span> <span class=SpellE>dichas</span> <span class=SpellE>Aportaciones</span>
de <span class=SpellE>Usuario</span> son de <span class=SpellE>naturaleza</span>
<span class=SpellE>tal</span> <span class=SpellE>que</span> <span class=SpellE>usted</span>
<span class=SpellE>las</span> <span class=SpellE>encuentre</span> <span
class=SpellE>ofensivas</span>, de mal gusto o de <span class=SpellE>alguna</span>
<span class=SpellE>otra</span> <span class=SpellE>manera</span> <span
class=SpellE>inaceptable</span> y, <span class=SpellE>en</span> <span
class=SpellE>consecuencia</span>, <span class=SpellE><b style='mso-bidi-font-weight:
normal'>tumedicolaguna</b></span> <span class=SpellE>expresamente</span> <span
class=SpellE>rechaza</span> <span class=SpellE>toda</span> <span class=SpellE>responsabilidad</span>
<span class=SpellE>en</span> <span class=SpellE>cuanto</span> a <span
class=SpellE>las</span> <span class=SpellE>Aportaciones</span> de <span
class=SpellE>Usuario</span>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>Si <span class=SpellE>usted</span> <span
class=SpellE>tiene</span> <span class=SpellE>conocimiento</span> de <span
class=SpellE>que</span> <span class=SpellE>alguna</span> de <span class=SpellE>las</span>
<span class=SpellE>Aportaciones</span> de <span class=SpellE>Usuario</span> <span
class=SpellE>en</span> <span class=SpellE><span class=GramE>este</span></span> <b
style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b> infringe <span
class=SpellE>las</span> <span class=SpellE>presentes</span> <span class=SpellE>Condiciones</span>
de <span class=SpellE>Uso</span>, <span class=SpellE>por</span> favor <span
class=SpellE>póngase</span> <span class=SpellE>en</span> <span class=SpellE>contacto</span>
con <span class=SpellE>nosotros</span> <span class=SpellE>visitando</span> <b
style='mso-bidi-font-weight:normal'>http://www.tumedicolaguna.com/contacto.php</b><span
class=apple-converted-space>&nbsp;</span>y <span class=SpellE>nos</span> <span
class=SpellE>comunicaremos</span> con <span class=SpellE>usted</span>. <o:p></o:p></span></p>

<p class=MsoListParagraph align=center style='margin-top:12.0pt;margin-right:
30.0pt;margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:
center;text-indent:-18.0pt;line-height:14.7pt;mso-list:l0 level1 lfo6'><![if !supportLists]><span
lang=EN-US style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;
mso-themetint:191;mso-bidi-font-weight:bold'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span class=SpellE><b><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>Alcance</span></b></span><b><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>geográfico</span>
del <span class=SpellE>sitio</span><o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=SpellE><span class=GramE><b><span style='font-size:10.5pt;font-family:
"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191;mso-ansi-language:ES-MX'>tumedicolaguna</span></b></span></span><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'><span style='mso-spacerun:yes'> 
</span><span class=SpellE>controla</span> y opera <span class=SpellE>este</span>
<b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b> <span class=SpellE>desde</span>
México y no <span class=SpellE>asevera</span> <span class=SpellE>que</span> los
<span class=SpellE>materiales</span> <span class=SpellE>en</span> <span
class=SpellE>este</span> &quot;Blog&quot; o los <span class=SpellE>productos</span>
<span class=SpellE>descritos</span> <span class=SpellE>en</span> el <span
class=SpellE>mismo</span> <span class=SpellE>sean</span> <span class=SpellE>adecuados</span>
o <span class=SpellE>estén</span> <span class=SpellE>disponibles</span> para <span
class=SpellE>utilizarse</span> <span class=SpellE>en</span> <span class=SpellE>otros</span>
<span class=SpellE>lugares</span>. Toda persona <span class=SpellE>que</span> <span
class=SpellE>visite</span> <span class=SpellE><span class=GramE>este</span></span>
&quot;Blog&quot; <span class=SpellE>tiene</span> la <span class=SpellE>responsabilidad</span>
de <span class=SpellE>cumplir</span> con <span class=SpellE>todas</span> <span
class=SpellE>las</span> <span class=SpellE>leyes</span> locales <span
class=SpellE>pertinentes</span> para <span class=SpellE>ellos</span> con <span
class=SpellE>respecto</span> al <span class=SpellE>contenido</span> y la <span
class=SpellE>operación</span> de <span class=SpellE>este</span> <span
class=SpellE>Servicio</span>.<o:p></o:p></span></p>

<p class=MsoListParagraph align=center style='margin-top:12.0pt;margin-right:
30.0pt;margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:
center;text-indent:-18.0pt;line-height:14.7pt;mso-list:l0 level1 lfo6'><![if !supportLists]><span
lang=EN-US style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;
mso-themetint:191;mso-bidi-font-weight:bold'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b><span lang=EN-US style='font-size:10.5pt;
font-family:"Arial","sans-serif";color:#3C3C3C;mso-themecolor:text1;mso-themetint:
191'>Enlaces a <span class=SpellE>otros</span> <span class=SpellE>sitios</span><o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>Para <span class=SpellE>su</span> <span
class=SpellE>conveniencia</span>, <span class=SpellE>gozo</span> y <span
class=SpellE>disfrute</span>, <span class=SpellE>es</span> <span class=SpellE>posible</span>
<span class=SpellE>que</span> <span class=SpellE>este</span> <b
style='mso-bidi-font-weight:normal'>&quot;Blog&quot; </b><span class=SpellE>provea</span>
enlaces a <span class=SpellE>otros</span> <span class=SpellE>sitios</span> Web <span
class=SpellE>que</span> no <span class=SpellE>estén</span> a cargo de <span
class=SpellE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span>, <span
class=SpellE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span>
no <span class=SpellE>tiene</span> control <span class=SpellE>sobre</span> <span
class=SpellE>dichos</span> <span class=SpellE>Sitios</span> de <span
class=SpellE>Terceros</span> y no se <span class=SpellE>hace</span> <span
class=SpellE>responsable</span> de la <span class=SpellE>disponibilidad</span>,
<span class=SpellE>seguridad</span>, <span class=SpellE>contenido</span> o <span
class=SpellE>recursos</span> de <span class=SpellE>dichos</span> <span
class=SpellE>Sitios</span> de <span class=SpellE>Terceros</span>. <span
class=SpellE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span>
no se <span class=SpellE>hace</span> <span class=SpellE>responsable</span>, <span
class=SpellE>directa</span> o <span class=SpellE>indirectamente</span>, de los <span
class=SpellE>daños</span> o <span class=SpellE>pérdidas</span> <span
class=SpellE>causados</span> o <span class=SpellE>supuestamente</span> <span
class=SpellE>causados</span> <span class=SpellE>por</span> el <span
class=SpellE>uso</span> de <span class=SpellE>dichos</span> <span class=SpellE>contenidos</span>,
<span class=SpellE>informaciones</span>, <span class=SpellE>productos</span>, <span
class=SpellE>bienes</span> o <span class=SpellE>servicios</span> <span
class=SpellE>disponibles</span> <span class=SpellE>en</span> <span
class=SpellE>cualquiera</span> de <span class=SpellE>dichos</span> <span
class=SpellE>Sitios</span> de <span class=SpellE>Terceros</span> o <span
class=SpellE>supuestamente</span> <span class=SpellE>causados</span> <span
class=SpellE>en</span> <span class=SpellE>relación</span> a <span class=SpellE>dicho</span>
<span class=SpellE>uso</span>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=SpellE><span lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";
color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'>En</span></span><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=SpellE>caso</span> de <span
class=SpellE>usted</span> <span class=SpellE>tomar</span> la <span
class=SpellE>determinación</span> de <span class=SpellE>compartir</span> <span
class=SpellE>cualquier</span> <span class=SpellE>información</span> <span
class=SpellE>acerca</span> de los <span class=SpellE>productos</span> de <span
class=SpellE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span> a
<span class=SpellE>través</span> de <span class=SpellE>una</span> <span
class=SpellE>plataforma</span> de <span class=SpellE>redes</span> <span
class=SpellE>sociales</span>, inclusive a <span class=SpellE>través</span> de
los enlaces <span class=SpellE>que</span> <span class=SpellE>provee</span> a <span
class=SpellE>través</span> del <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;,</b>
<span class=SpellE>es</span> <span class=SpellE>posible</span> <span
class=SpellE>que</span> <span class=SpellE>usted</span> <span class=SpellE>pueda</span>
<span class=SpellE>publicar</span> <span class=SpellE>dicha</span> <span
class=SpellE>información</span> <span class=SpellE>directamente</span> a <span
class=SpellE>su</span> <span class=SpellE>perfil</span> <span class=SpellE>en</span>
la <span class=SpellE>plataforma</span> de <span class=SpellE>redes</span> <span
class=SpellE>sociales</span> sin <span class=SpellE>necesidad</span> de <span
class=SpellE>salirse</span> del <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;.</b>
<span class=SpellE>Algunas</span> <span class=SpellE>plataformas</span> de <span
class=SpellE>redes</span> <span class=SpellE>sociales</span> <span
class=SpellE>habilitan</span> la <span class=SpellE>funcionalidad</span> <span
class=SpellE>que</span> le <span class=SpellE>permite</span> al <span
class=SpellE>usuario</span> <span class=SpellE>recibir</span> y <span
class=SpellE>transmitir</span> <span class=SpellE>datos</span> a la <span
class=SpellE>plataforma</span> de <span class=SpellE>redes</span> <span
class=SpellE>sociales</span> gracias a la <span class=SpellE>utilización</span>
de <span class=SpellE>superposiciones</span> y <span class=SpellE>otras</span> <span
class=SpellE>tecnologías</span>. A <span class=SpellE>pesar</span> de <span
class=SpellE>que</span> <span class=SpellE>pueda</span> <span class=SpellE>parecer</span>
<span class=SpellE>que</span> los <span class=SpellE>datos</span> los <span
class=SpellE>recopila</span> <span class=SpellE><b style='mso-bidi-font-weight:
normal'>tumedicolaguna</b></span>, los <span class=SpellE>datos</span> de <span
class=SpellE>hecho</span> los <span class=SpellE>recopila</span> de forma <span
class=SpellE>directa</span> la <span class=SpellE>plataforma</span> de <span
class=SpellE>redes</span> <span class=SpellE>sociales</span> y/o <span
class=GramE>un</span> <span class=SpellE>tercero</span> <span class=SpellE>proveedor</span>
de <span class=SpellE>servicios</span>. El <span class=SpellE>uso</span> <span
class=SpellE>que</span> <span class=SpellE>usted</span> <span class=SpellE>haga</span>
de la <span class=SpellE>plataforma</span> de <span class=SpellE>redes</span> <span
class=SpellE>sociales</span> para <span class=SpellE>compartir</span> <span
class=SpellE>cualquier</span> <span class=SpellE>información</span> <span
class=SpellE>está</span> <span class=SpellE>sujeta</span> a los <span
class=SpellE>términos</span>, <span class=SpellE>condiciones</span> y <span
class=SpellE>restricciones</span> de <span class=SpellE>dicha</span> <span
class=SpellE>plataforma</span> de <span class=SpellE>redes</span> <span
class=SpellE>sociales</span>, y <span class=SpellE>usted</span> <span
class=SpellE>debe</span> <span class=SpellE>regirse</span> <span class=SpellE>por</span>
los <span class=SpellE>mismos</span>.</span><b style='mso-bidi-font-weight:
normal'><span style='font-size:10.5pt;font-family:"Arial","sans-serif";
mso-fareast-font-family:"Times New Roman";color:#3C3C3C;mso-themecolor:text1;
mso-themetint:191;mso-ansi-language:ES-MX'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:14.7pt'><span class=GramE><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'>&#61623;</span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'><span style='mso-spacerun:yes'>  </span><b>Competencia</b></span></span><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'>&quot;Las Partes&quot;</span></b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'>&nbsp;estarán regidas por la Ley Federal de Protección
al Consumidor, de los Estados Unidos Mexicanos y cualquier controversia que se
derive de la aplicación de la misma se ventilará ante las autoridades y los
tribunales de la Ciudad de Torreón, Coahuila México., renunciando expresamente
a cualquier otra jurisdicción que les pudiera corresponder por razón de su
domicilio presente o futuro. Nos reservamos el derecho de hacer cambios a
nuestra página y/o exclusiones, términos y condiciones en cualquier tiempo.<o:p></o:p></span></p>

<p class=MsoListParagraph align=center style='margin-top:12.0pt;margin-right:
30.0pt;margin-bottom:12.0pt;margin-left:81.0pt;mso-add-space:auto;text-align:
center;text-indent:-18.0pt;line-height:14.7pt;mso-list:l0 level1 lfo6'><![if !supportLists]><span
style='font-size:10.5pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;color:#3C3C3C;mso-themecolor:text1;mso-themetint:
191;mso-ansi-language:ES-MX'><span style='mso-list:Ignore'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'>Responsabilidad<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=SpellE><b><span lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";
color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'>Contenido</span></b></span><b><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=GramE>del</span> <span
class=SpellE>Servicio</span><o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>LOS MATERIALES EN ESTE SERVICIO
(INCLUSIVE TODOS LOS GRÁFICOS, LOS PROGRAMAS INFORMÁTICOS, LAS RECOMENDACIONES
U OTROS MATERIALES) Y TODOS LOS MATERIALES DISPONIBLES A TRAVÉS DE ESTE
SERVICIO SE PROPORCIONAN &quot;TAL CUAL&quot; Y &quot;SEGÚN
DISPONIBILIDAD&quot; Y SIN GARANTÍAS DE NINGÚN TIPO, YA SEAN EXPRESAS O IMPLÍCITAS.
EN LA MEDIDA EN QUE LO PERMITA LA LEY PERTINENTE, <span class=SpellE><b
style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span> RECHAZA TODA
RESPONSABILIDAD DE LAS GARANTÍAS, EXPRESAS O IMPLÍCITAS, INCLUSIVE, DE FORMA NO
LIMITATIVA, LAS GARANTÍAS IMPLÍCITAS DE COMERCIABILIDAD, IDONEIDAD PARA UN FIN
EN PARTICULAR, TITULARIDAD Y NO CONTRAVENCIÓN. <span class=SpellE><b
style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span> NO GARANTIZA NI
PRETENDE HACER ASEVERACIONES REFERENTES AL USO O A LOS RESULTADOS DEL USO DE
ESTOS MATERIALES EN ESTE <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b>
EN TÉRMINOS DE SU EXACTITUD, VERACIDAD, CONFIABILIDAD O DE ALGUNA OTRA FORMA. <span
class=GramE>ES POSIBLE QUE LOS MATERIALES EN ESTE SERVICIO CONTENGAN
INEXACTITUDES TÉCNICAS O ERRORES TIPOGRÁFICOS.</span> PUEDE SER QUE ESTOS
MATERIALES ESTÉN INCORRECTOS O SE VUELVAN INCORRECTOS COMO RESULTADO DE LOS
DESARROLLOS QUE OCURRAN DESPUÉS DE LAS FECHAS RESPECTIVAS. <span class=SpellE><span
class=GramE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span></span>
NO SE OBLIGA A VERIFICAR O A MANTENER DICHA INFORMACIÓN PARA QUE ESTÉ AL DÍA.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>ASIMISMO, USTED COMPRENDE Y ACEPTA QUE
AL USAR EL PRESENTE SERVICIO, USTED ESTARÁ EXPUESTO A LAS APORTACIONES DE
USUARIO PUBLICADAS Y/O ENVIADAS POR LOS MISMOS USUARIOS. <span class=SpellE><b
style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span> NO SE HACE
RESPONSABLE DE NINGUNA MANERA DE LAS APORTACIONES DE USUARIO, Y <span
class=SpellE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span>
NO GARANTIZA LA EXACTITUD, INTEGRIDAD, CALIDAD O LOS DERECHOS DE PROPIEDAD
INTELECTUAL DE DICHAS APORTACIONES DE USUARIO O LOS DERECHOS RELACIONADOS A LAS
MISMAS. ASIMISMO, <span class=SpellE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span>
NO PUEDE DAR POR HECHO QUE NO APARECERÁN EN ESTE <b style='mso-bidi-font-weight:
normal'>&quot;Blog&quot;</b> APORTACIONES DE USUARIO QUE SEAN DAÑINAS,
INEXACTAS, ENGAÑOSAS, AGRAVIANTES, AMENAZANTES, DIFAMATORIAS, ILÍCITAS O
CENSURABLES DE ALGUNA OTRA FORMA. USTED RECONOCE QUE AL OTORGARLE LA CAPACIDAD
DE ACCEDER O VISUALIZAR LAS APORTACIONES DE USUARIO EN ESTE <b
style='mso-bidi-font-weight:normal'>&quot;Blog&quot;,</b> <span class=SpellE><b
style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span> MERAMENTE FUNGE
COMO UN MEDIO PASIVO DE TRANSMISIÓN PARA DICHA DISTRIBUCIÓN Y NO SE OBLIGA NI
SE HACE RESPONSABLE EN RELACIÓN CON LAS APORTACIONES DE USUARIO O EN RELACIÓN
CON LAS ACTIVIDADES DE LOS USUARIOS EN ESTE <b style='mso-bidi-font-weight:
normal'>&quot;Blog&quot;.</b> <span class=GramE>SIN LIMITAR LA GENERALIDAD DE
LO ANTERIOR, USTED RECONOCE Y ACEPTA QUE LA INFORMACIÓN, LOS MATERIALES Y
OPINIONES EXPRESADOS O INCLUIDOS EN LAS APORTACIONES DE USUARIO NO
NECESARIAMENTE EXPRESAN LAS OPINIONES DE <span class=SpellE><b
style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span> O DE SUS FILIALES
O ENTIDADES RELACIONADAS O DE LOS PROVEEDORES DE SERVICIOS.</span><a
name="148cd0738c5112ed_16"></a><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=SpellE><b><span lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";
color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'>Operación</span></b></span><b><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> <span class=GramE>del</span> <span
class=SpellE>Servicio</span><o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=SpellE><b style='mso-bidi-font-weight:normal'><span lang=EN-US
style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>tumedicolaguna</span></b></span><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> SE EMPEÑA POR MANTENER ESTE <b
style='mso-bidi-font-weight:normal'>&quot;Blog&quot; </b>Y SU OPERACIÓN, PERO
NO ES, NI PUEDE SER, RESPONSABLE DE LOS RESULTADOS DE ALGÚN DEFECTO QUE PUEDA
EXISTIR EN ESTE <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot; </b><span
style='mso-spacerun:yes'> </span>O EN SU OPERACIÓN. EN CUANTO A LA OPERACIÓN DE
ESTE <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b>, <span
class=SpellE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span>
EXPRESAMENTE RECHAZA TODA RESPONSABILIDAD DE LAS GARANTÍAS DE CUALQUIER TIPO,
YA SEAN EXPRESAS O IMPLÍCITAS, INCLUSIVE, DE FORMA NO LIMITATIVA, TODAS LAS
GARANTÍAS IMPLÍCITAS DE COMERCIABILIDAD, IDONEIDAD PARA UN FIN EN PARTICULAR,
TITULARIDAD Y NO CONTRAVENCIÓN. <span class=SpellE><b style='mso-bidi-font-weight:
normal'>tumedicolaguna</b></span> NO GARANTIZA QUE LA OPERACIÓN DE ESTE
SERVICIO SATISFARÁ LOS REQUISITOS DEL USUARIO; EL ACCESO A ESTE <b
style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b> SERÁ ININTERRUMPIDO,
OPORTUNO, SEGURO, LIBRE DE VIRUS, GUSANOS, CABALLOS TROYANOS U OTROS
COMPONENTES DAÑINOS, O LIBRE DE DEFECTOS O ERRORES; LOS RESULTADOS OBTENIDOS
POR EL USO DE ESTE <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b>
SERÁN EXACTOS O CONFIABLES; O SE CORREGIRÁN LOS DEFECTOS. USTED (Y NO <span
class=SpellE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span>)
ASUME LOS GASTOS COMPLETOS DE MANTENIMIENTO, REPARACIÓN O CORRECCIÓN QUE SEAN
NECESARIOS PARA SU EQUIPO DE CÓMPUTO O PARA SU DISPOSITIVO Y PROGRAMAS
INFORMÁTICOS MÓVILES QUE SURJAN COMO RESULTADO DE CUALQUIER VIRUS, ERROR O
PROBLEMA QUE TENGAN COMO RESULTADO DE VISITAR ESTE <b style='mso-bidi-font-weight:
normal'>&quot;Blog&quot;</b>.<a name="148cd0738c5112ed_17"></a><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
class=SpellE><b><span lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";
color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'>Limitación</span></b></span><b><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'> de la <span class=SpellE>Responsabilidad</span>
Legal<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";color:#3C3C3C;
mso-themecolor:text1;mso-themetint:191'>BAJO NINGÚN CONCEPTO SERÁN <span
class=SpellE><b style='mso-bidi-font-weight:normal'>tumedicolaguna</b></span>
NI SUS SOCIEDADES MATRICES, SUBSIDIARIAS Y AFILIADAS, NI SUS RESPECTIVOS
FUNCIONARIOS, DIRECTORES, EMPLEADOS, AGENTES, REPRESENTANTES, OTORGANTES DE
LICENCIAS, CONCESIONARIOS, SUCESORES Y CESIONARIOS LEGALMENTE RESPONSABLES POR
DAÑOS O LESIONES, INCLUSIVE DAÑOS DIRECTOS, ESPECIALES, INCIDENTALES,
CONSECUENTES, PUNITIVOS O DE OTRA ÍNDOLE, QUE PUEDAN RESULTAR DE USAR O DE LA
INCAPACIDAD DE USAR EL <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b>
O CUALESQUIERA MATERIALES EN EL MISMO, YA SEA EN UNA DEMANDA BASADA EN EL
INCUMPLIMIENTO DE UN CONTRATO, EN UN ACTO DE NEGLIGENCIA, OTRO TIPO DE ACTO
TORTICERO O DE OTRA MANERA, QUE SURJA EN CONEXIÓN CON EL USO O RENDIMIENTO DE
ESTE <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;</b> O DE LA
INFORMACIÓN DISPONIBLE EN ESTE <b style='mso-bidi-font-weight:normal'>&quot;Blog&quot;.</b>
<b><o:p></o:p></b></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'>tumedicolaguna.com&nbsp;<b>NO SE RESPONSABILIZA BAJO
NINGUNA CIRCUNSTANCIA POR LA INTERPRETACIÓN Y/O POR LA INCORRECTA INTERPRETACIÓN
DE LO EXPRESADO EN EL BLOG, EN LAS CONSULTAS REALIZADAS, NI DE SU USO INDEBIDO,
ASÍ COMO TAMPOCO SERÁ RESPONSABLE POR LOS PERJUICIOS DIRECTOS O INDIRECTOS
CAUSADOS POR O A QUIENES FUERAN INDUCIDOS A TOMAR U OMITIR DECISIONES O MEDIDAS
AL CONSULTAR EL BLOG.</b><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><b><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'>“Las Partes&quot;</span></b><span style='font-size:
10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;mso-ansi-language:ES-MX'>&nbsp;acuerdan
defender e indemnizar a&nbsp;<b>tumedicolaguna</b>, sus proveedores de
información, sus subsidiarias y a todos sus directores, empleados,
representantes, agentes, miembros, abogados y exonerarlos de cualquier o todos
los reclamos, demandas, daños, perjuicios, responsabilidades, pérdidas, costos
y gastos (incluyendo honorarios de los letrados legales y las costas del
litigio) derivadas del uso que usted realice en el&nbsp;<b>&quot;Blog&quot;</b>&nbsp;o
con cualquier información, producto, servicio, documentación o software
disponible en mismo así como de cualquier violación o actos impropios que usted
realice a los&nbsp;<b>&quot;Términos y Condiciones&quot;</b>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191;
mso-ansi-language:ES-MX'>Si usted no acepta estos&nbsp;“<b>Términos y
Condiciones”</b>&nbsp;o tiene alguna pregunta sobre los mismos, por favor
contáctese con nosotros.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt;margin-right:30.0pt;margin-bottom:
12.0pt;margin-left:45.0pt;text-align:justify;line-height:14.7pt'><span
lang=EN-US><a href="mailto:liverbetter@tumedicolaguna.com"><span
style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'>liverbetter@tumedicolaguna.com</span></a></span><span
lang=EN-US style='font-size:10.5pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
"Times New Roman";color:#3C3C3C;mso-themecolor:text1;mso-themetint:191'><o:p></o:p></span></p>

<p class=MsoNormal><span lang=EN-US style='font-size:10.5pt;line-height:115%;
font-family:"Arial","sans-serif";color:#3C3C3C;mso-themecolor:text1;mso-themetint:
191'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span lang=EN-US style='font-size:10.5pt;line-height:115%;
font-family:"Arial","sans-serif";color:#3C3C3C;mso-themecolor:text1;mso-themetint:
191'><o:p>&nbsp;</o:p></span></p>

</div>
            
            
            
            
        </div>
        
        
    </div>
        

        
    <?php include("includes/footer.php"); ?>
        
</body>
</html>