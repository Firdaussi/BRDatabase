 <html>
<body>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <fieldset id="nb">
   <table width="96%" frame="box" border="0" cellpadding="1">
     <tr>
	   <td><input type="text" name="locoid" id="search-text" size="14" maxlength="100" /></td>
     </tr>
     <tr>
       <td><input type="text" name="in1" id="search-text" size="14" maxlength="100" /></td>
       <td><input type="text" name="out1" id="search-text" size="14" maxlength="100" /></td>
       <td><input type="text" name="repair" id="search-text" size="14" maxlength="100" /></td>
       <td><input type="text" name="where" id="search-text" size="14" maxlength="100" /></td>
     </tr>
       <select size="1" name="year_select_start">
               <option value="1825">1825</option>
<?php
       for ($nx = 1826; $nx <= 1997; $nx++)
       {
         if ($nx == 1948)
                 printf("<option value=\"%d\" selected=\"selected\">%d</option>\n", $nx, $nx);
         else
                 printf("<option value=\"%d\">%d</option>\n", $nx, $nx);
       }
?>
       </select>

       </td>

       <td width="4%" align="right">End:</td>
       <td width="10%">

       <select size="1" name="mon_select_end">
         <option selected="selected" value="00">-</option>
         <option value="01">January</option>
         <option value="02">February</option>
         <option value="03">March</option>
         <option value="04">April</option>
         <option value="05">May</option>
         <option value="06">June</option>
         <option value="07">July</option>
         <option value="08">August</option>
         <option value="09">September</option>
         <option value="10">October</option>
         <option value="11">November</option>
         <option value="12">December</option>
       </select>

       </td>

       <td width="10%">

       <select size="1" name="year_select_end">
               <option value="-" selected="selected">-</option>
<?php
       for ($nx = 1826; $nx <= 1997; $nx++)
               printf("<option value=\"%d\">%d</option>\n", $nx, $nx);
?>
       </select>

       </td>

       <td width="14%" valign="middle">
       <input type="checkbox" name="locotype[]" value="S" checked="checked" />&nbsp; Steam<br />
       <input type="checkbox" name="locotype[]" value="D" checked="checked" />&nbsp; Diesel<br />
       <input type="checkbox" name="locotype[]" value="E" checked="checked" />&nbsp; Electric<br />
       </td>

       <td width="24%" valign="top">&nbsp;

       <select size="10" name="manuf[]" multiple="multiple">
         <option value="00" selected="selected">All</option>
         <option value="01">BR Workshops</option>
         <option value="02">GWR Workshops</option>
         <option value="03">LMS Workshops</option>
         <option value="04">LNER Workshops</option>
         <option value="05">SR Workshops</option>
         <option value="06">Private Workshops</option>

<?php
       $sql = 'select bl_code, 
                      coalesce(bl_short_name, bl_name) AS bl_name
               FROM   builders
               ORDER BY bl_name ASC';

       $result = $db->execute($sql);

       if ($result)
       {
         while ($row = mysqli_fetch_assoc($result))
         {
           printf("<option value=\"%s\">%s</option>\n",
                  $row['bl_code'],
                  $row['bl_name']);
         }
       }
        
?>
       </select>
       </td>
     </tr>
   </table>
   <br />
   <input type="submit" value="Submit" />&nbsp;&nbsp;
   <input type="reset" />
   </fieldset>
  </form>


</body>
</html> 